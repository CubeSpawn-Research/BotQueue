<?php


namespace App\Helpers\Api;


use Illuminate\Contracts\Support\Arrayable;

class ApiResult implements Arrayable
{
    public $success;
    public $data;

    /**
     * ApiResult constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->success = true;
        $this->data = $data;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'status' => ($this->success ? 'success' : 'error'),
            'data' => $this->data
        ];
    }
}