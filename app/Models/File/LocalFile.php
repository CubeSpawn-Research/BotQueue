<?php

namespace App\Models\File;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * App\Models\File\LocalFile
 *
 * @property integer $id
 * @property string $path
 * @property string $type
 * @property integer $size
 * @property string $hash
 * @property integer $user_id
 * @property integer $parent_id
 * @property string $source_url
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @property-read mixed $name
 */
class LocalFile extends FileInterface
{
    protected $fillable = [
        'path',
        'hash',
        'size',
        'type',
        'source_url'
    ];

    public static function make($tmp_file, $name, $attributes = [])
    {
        $uri = self::makeDirectoryPath().$name;
        $path = self::fullPath($uri);

        if(!($tmp_file instanceof File)) {
            $tmp_file = new File($tmp_file, $name);
        }

        $tmp_file->move(dirname($path), $name);

        // Create a local file model for that file.
        // Return that model
        $attributes = array_merge([
            'path' => $uri,
            'hash' => md5_file($path),
            'size' => filesize($path),
            'type' => null // todo Change this to an actual type
        ], $attributes);

        return LocalFile::create($attributes);
    }

    private static function fullPath($path)
    {
        return storage_path("files".DIRECTORY_SEPARATOR.$path);
    }

}
