<?php

/*
  This file is part of BotQueue.

  BotQueue is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  BotQueue is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with BotQueue.  If not, see <http://www.gnu.org/licenses/>.
*/

class UploadController extends Controller
{
    public function home()
    {
        $this->assertLoggedIn();

        $this->setTitle("Step 1 of 2: Choose File to Print");
    }

    public function uploader()
    {
        $payload = base64_encode(serialize($this->args('payload')));

        $this->setArg('label');

        //where you want me go?
        $redirect = "http://" . Config::get("hostname") . "/upload/success/$payload";
        $acl = "public-read";
        $expiration = gmdate("Y-m-d\TH:i:s\Z", strtotime("+1 day"));

        //create amazons crazy policy data array.
        $policy_json = '
			{
				"expiration": "' . $expiration . '",
				"conditions": [
					{"acl": "' . $acl . '"},
					{"bucket": "' . AMAZON_S3_BUCKET_NAME . '"},
					["starts-with", "$key", "uploads/"],
					["starts-with", "$Content-Type", ""],
					["starts-with", "$Content-Disposition", ""],
					{"success_action_redirect": "' . $redirect . '"},
					["content-length-range", 1, 262144000]
				]
			}';

        //create our various encoded/signed stuff.
        $policy_json_cleaned = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $policy_json);
        $policy_encoded = base64_encode($policy_json_cleaned);
        $signature = hex2b64(hash_hmac('sha1', $policy_encoded, Config::get("aws/secret")));

        //okay, set our view vars.
        $this->set('redirect', $redirect);
        $this->set('acl', $acl);
        $this->set('policy', $policy_encoded);
        $this->set('signature', $signature);
    }

    public function url()
    {
        $this->assertLoggedIn();

        $this->setTitle("Create Job from URL");

        try {
            //did we get a url?
            $url = $this->args('url');
            if (!$url)
                throw new Exception("You must pass in the URL parameter!");

            $matches = array();
            if (preg_match("/thingiverse.com\\/thing:([0-9]+)/i", $url, $matches)) {
                $thing_id = $matches[1];

                //echo "found: $thing_id<Br/>";

                // TODO: We need to define a thingiverse api client ID, or get it when the user
                // authenticates it.
                $api = new ThingiverseAPI(THINGIVERSE_API_CLIENT_ID, THINGIVERSE_API_CLIENT_SECRET, User::$me->getThingiverseToken());

                //load thingiverse data.
                $thing = $api->make_call("/things/{$thing_id}");
                $files = $api->make_call("/things/{$thing_id}/files");

                //echo "<pre>";
                //print_r($thing);
                //print_r($files);
                //echo "</pre>";

                //open zip file.
                $zip_path = tempnam("/tmp", "BQ");
                $zip = new ZipArchive();
                if ($zip->open($zip_path, ZIPARCHIVE::CREATE)) {
                    //echo "opened $zip_path<br/>";

                    //pull in all our files.
                    foreach ($files AS $row) {
                        if (preg_match("/\\.(stl|obj|amf|gcode)$/i", $row->name)) {
                            $data = Utility::downloadUrl($row->public_url);
                            //echo "downloaded " . $data['realname'] . " to " . $data['localpath'] . "<br/>";

                            $zip->addFile($data['localpath'], $data['realname']);
                        }
                    }
                    $zip->close();

                    //create zip name.
                    $filename = basename($thing->name . ".zip");
                    $filename = str_replace(" ", "_", $filename);
                    $filename = preg_replace("/[^-_.[0-9a-zA-Z]/", "", $filename);
                    $path = "assets/" . S3File::getNiceDir($filename);

                    //okay, upload it and handle it.
                    $s3 = new S3File();
                    $s3->set('user_id', User::$me->id);
                    $s3->set('source_url', $url);

                    //echo "uploading $zip_path to $path<br/>";

                    $s3->uploadFile($zip_path, $path);
                    $this->_handleZipFile($zip_path, $s3);

                    $this->forwardToUrl("/job/create/file:{$s3->id}");
                } else
                    throw new Exception("Unable to open zip {$zip_path} for writing.");
            } else {
                $data = Utility::downloadUrl($url);

                //does it match?
                if (!preg_match("/\\.(stl|obj|amf|gcode|zip)$/i", $data['realname']))
                    throw new Exception("The file <a href=\"".$url."\">{$data['realname']}</a> is not valid for printing.");

                $s3 = new S3File();
                $s3->set('user_id', User::$me->id);
                $s3->set('source_url', $url);
                $s3->uploadFile($data['localpath'], S3File::getNiceDir($data['realname']));

                //is it a zip file?  do some magic on it.
                if (!preg_match("/\.zip$/i", $data['realname']))
                    $this->_handleZipFile($data['localpath'], $s3);

                Activity::log("uploaded a new file called " . $s3->getLink() . ".");

                //send us to step 2.
                $this->forwardToUrl("/job/create/file:{$s3->id}");
            }
        } catch (Exception $e) {
            $this->set('megaerror', $e->getMessage());
        }
    }

    public function success()
    {
        $this->assertLoggedIn();

        //get our payload.
        // We don't actually need the payload
        unserialize(base64_decode($this->args('payload')));

        //handle our upload
        try {
            //some basic error checking.
            if (!preg_match('/(gcode|stl|obj|amf|zip)$/i', $this->args('key')))
                throw new Exception("Only .gcode, .stl, .obj, .amf, and .zip files are allowed at this time.");

            //make our file.
            // We don't need file info
            //$info = $this->_lookupFileInfo();
            $file = $this->_createS3File();

            //is it a zip file?  do some magic on it.
            if (preg_match("/\\.zip$/i", $this->args('key'))) {
                $path = tempnam("/tmp", "BQ");
                $file->downloadToPath($path);
                $this->_handleZipFile($path, $file);
            }

            Activity::log("uploaded a new file called " . $file->getLink() . ".");

            //send us to step 2.
            $this->forwardToUrl("/job/create/file:{$file->id}");
        } //did anything go wrong?
        catch (Exception $e) {
            $this->setTitle("Upload File - Error");
            $this->set('megaerror', $e->getMessage());
        }
    }

    private function _lookupFileInfo()
    {
        //look up our real info.
        $s3 = new S3(Config::get("aws/key"), Config::get("aws/secret"));
        $info = $s3->getObjectInfo($this->args('bucket'), $this->args('key'), true);

        if ($info['size'] == 0) {
            //capture for debug
            ob_start();

            //var_dump($args);
            var_dump($info);

            //try it again.
            sleep(1);
            $info = $s3->getObjectInfo($this->args('bucket'), $this->args('key'), true);
            var_dump($info);

            //still bad?
            if ($info['size'] == 0) {
                $text = ob_get_contents();
                $html = "<pre>{$text}</pre>";

                //email the admin
                $admin = User::byUsername('hoeken');
                Email::queue($admin, "upload fail", $text, $html);

                //show us.
                if (User::isAdmin()) {
                    @ob_end_clean();

                    echo "'failed' file upload:<br/><br/>$html";
                    exit;
                }

                //$this->set('megaerror', "You cannot upload a blank/empty file.");
            }

            @ob_end_clean();
        }

        //send it back.
        return $info;
    }

    private function _createS3File()
    {
        //format the name and stuff
        $filename = basename($this->args('key'));
        $filename = str_replace(" ", "_", $filename);
        $filename = preg_replace("/[^-_.[0-9a-zA-Z]/", "", $filename);
        $path = "assets/" . S3File::getNiceDir($filename);

        //check our info out.
        $info = $this->_lookupFileInfo();

        //create new s3 file
        $file = new S3File();
        $file->set('user_id', User::$me->id);
        $file->set('type', $info['type']);
        $file->set('size', $info['size']);
        $file->set('hash', $info['hash']);
        $file->set('add_date', date('Y-m-d H:i:s'));
        $file->set('bucket', AMAZON_S3_BUCKET_NAME);
        $file->set('path', $path);
        $file->save();

        //copy to new location in s3.
        $s3 = new S3(Config::get("aws/key"), Config::get("aws/secret"));
        $s3->copyObject($this->args('bucket'), $this->args('key'), AMAZON_S3_BUCKET_NAME, $path, S3::ACL_PUBLIC_READ);

        //remove the uploaded file.
        $s3->deleteObject($this->args('bucket'), $this->args('key'));

        return $file;
    }

    private function _handleZipFile($path, $file)
    {
        $za = new ZipArchive();
        $za->open($path);

        for ($i = 0; $i < $za->numFiles; $i++) {
            //look up file info.
            $filename = $za->getNameIndex($i);

            //okay, is it a supported file?
            if (preg_match('/(gcode|stl|obj|amf)$/i', $filename)) {
                $temp = tempnam("/tmp", "BQ");
                copy("zip://" . $path . "#" . $filename, $temp);

                //format for s3
                $s3_filename = str_replace(" ", "_", $filename);
                $s3_filename = preg_replace("/[^-_.[0-9a-zA-Z]/", "", $s3_filename);
                $s3_path = "assets/" . S3File::getNiceDir($s3_filename);

                //create our s3 file
                $s3 = new S3File();
                $s3->set('parent_id', $file->id);
                $s3->set('user_id', User::$me->id);
                $s3->uploadFile($temp, $s3_path);

                //echo "$filename - $s3_path<br/>";
            }
        }

        //exit;
    }
}

// Function to help sign the policy
function hex2b64($str)
{
    $raw = '';
    for ($i = 0; $i < strlen($str); $i += 2) {
        $raw .= chr(hexdec(substr($str, $i, 2)));
    }
    return base64_encode($raw);
}