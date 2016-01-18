<?php


namespace App\Api\V1;

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