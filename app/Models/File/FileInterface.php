<?php
/**
 * Created by PhpStorm.
 * User: jnesselr
 * Date: 9/27/15
 * Time: 8:47 PM
 */

namespace App\Models\File;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;

abstract class FileInterface extends Model
{
    public static function make($tmp_file, $name) {
        return static::make($tmp_file, $name);
    }

    public static function makeDirectoryPath()
    {
        $hash = sha1(mt_rand() . mt_rand() . mt_rand() . mt_rand());

        $directory = substr($hash, 0, 2);
        $directory .= DIRECTORY_SEPARATOR;
        $directory .= substr($hash, 2, 2);
        $directory .= DIRECTORY_SEPARATOR;
        $directory .= substr($hash, 4, 2);
        $directory .= DIRECTORY_SEPARATOR;
        $directory .= substr($hash, 6, 2);
        $directory .= DIRECTORY_SEPARATOR;
        $directory .= substr($hash, 8, 2);
        $directory .= DIRECTORY_SEPARATOR;

        return $directory;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}