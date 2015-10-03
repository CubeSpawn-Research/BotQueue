<?php

namespace App\Models\File;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LocalFile extends FileInterface
{
    protected $fillable = [
        'path',
        'hash',
        'size',
        'type'
    ];

    public static function make($tmp_file, $name)
    {
        $uri = self::makeDirectoryPath().$name;
        $path = self::fullPath($uri);

        if(!($tmp_file instanceof File)) {
            $tmp_file = new File($tmp_file, $name);
        }

        $tmp_file->move(dirname($path), $name);

        // Create a local file model for that file.
        // Return that model
        return LocalFile::create([
            'path' => $uri,
            'hash' => md5_file($path),
            'size' => filesize($path),
            'type' => null // todo Change this to an actual type
        ]);
    }

    private static function fullPath($path)
    {
        return storage_path("files".DIRECTORY_SEPARATOR.$path);
    }

}
