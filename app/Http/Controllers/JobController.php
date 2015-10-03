<?php

namespace App\Http\Controllers;

use App\Models\File\FileInterface;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public function getCreateFile(FileInterface $file)
    {
        dd($file);
    }
}
