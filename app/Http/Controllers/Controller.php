<?php namespace App\Http\Controllers;

use App\Html\JsMessageBag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function js_data($data) {
        /** @var JsMessageBag $bag */
        $bag = app(JsMessageBag::class);

        foreach($data as $key => $value) {
            $bag->add($key, $value);
        }
    }
}
