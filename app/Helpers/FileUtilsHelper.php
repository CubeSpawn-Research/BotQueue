<?php


namespace App\Helpers;


class FileUtilsHelper
{

    /**
     * @param $url
     * @return string
     */
    public function download($url)
    {
        $tmp_file = tempnam(sys_get_temp_dir(), 'BOTQUEUE-');

        copy($url, $tmp_file);

        return $tmp_file;
    }
}