<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
                $errors->add($key, $this->error());
            }
        }

        if ($errors->any())
            return $this->response($request, $errors);

        return $next($request);
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

        if ($file_max >= pow(1024, 4))
            return $this->fun($file_max, 4, 'terabyte');
        if ($file_max >= pow(1024, 3))
            return $this->fun($file_max, 3, 'gigabyte');
        if ($file_max >= pow(1024, 2))
            return $this->fun($file_max, 2, 'megabyte');
        if ($file_max >= pow(1024, 1))
            return $this->fun($file_max, 1, 'kilobyte');
        return $this->fun($file_max, 0, 'byte');
    }

    /**
     * @return string
     * @internal param $file_max
     */
    private function error()
    {
        return 'The file may not be greater than ' .
        $this->convert_to_human_readable(UploadedFile::getMaxFilesize()) .
        '.';
    }

    private function fun($file_max, $power, $unit)
    {
        $count = $file_max / pow(1024, $power);
        return $count . ' ' . ($count == 1 ? $unit : str_plural($unit));
    }
}
