<?php


namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class FileUtils extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'file_utils';
    }

}