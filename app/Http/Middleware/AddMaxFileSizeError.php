<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;

class AddMaxFileSizeError
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $errors = new MessageBag();
        foreach ($_FILES as $key => $file) {
            if ($file['error'] == UPLOAD_ERR_INI_SIZE) {
                $errors->add($key, $this->error()
                );
            }
        }

        if ($errors->any())
            return $this->response($request, $errors);

        return $next($request);
    }

    private function convert_from_ini_format($size)
    {
        $val = trim($size);
        $last = strtoupper($val[strlen($val) - 1]);
        switch ($last) {
            case 'G':
                $val *= pow(1024, 3);
                break;
            case 'M':
                $val *= pow(1024, 2);
                break;
            case 'K':
                $val *= 1024;
                break;
            default:
                $val = $size;
        }

        return $val;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $errors
     * @return JsonResponse
     */
    private function response($request, $errors)
    {
        if ($request->ajax()) {
            return new JsonResponse($errors, 422);
        }

        return redirect()->back()->withErrors($errors)->withInput();
    }

    private function convert_to_human_readable($file_max)
    {
        if ($file_max >= pow(1024, 3))
            return ($file_max / pow(1024, 3)) . ' gigabytes';
        if ($file_max >= pow(1024, 2))
            return ($file_max / pow(1024, 2)) . ' megabytes';
        if ($file_max >= 1024)
            return ($file_max / 1024) . ' kilobytes';
        return $file_max . ' bytes';
    }

    /**
     * @return string
     * @internal param $file_max
     */
    private function error()
    {
        $file_max_human_readable = ini_get('upload_max_filesize');
        $file_max = $this->convert_from_ini_format($file_max_human_readable);

        return 'The file may not be greater than ' .
        $this->convert_to_human_readable($file_max) .
        '.';
    }
}
