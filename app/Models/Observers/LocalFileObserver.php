<?php


namespace App\Models\Observers;


use App\Models\File\LocalFile;
use Illuminate\Support\Facades\Auth;

class LocalFileObserver
{

    /**
     * @param LocalFile $file
     * @return bool
     */
    public function creating($file)
    {
        // The user must be logged in to create a file
        if(Auth::check()) {
            $file->user()->associate(Auth::user());
            return true;
        }
        return false;
    }
}