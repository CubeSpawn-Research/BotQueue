<?php


namespace App\Api\V2;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;

class MainController extends Controller
{
    use Helpers;

    public function version()
    {
        return [
            'status' => 'success',
            'version' => 'V1'
        ];
    }
}