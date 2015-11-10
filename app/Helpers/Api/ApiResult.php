<?php


namespace App\Helpers\Api;


use Illuminate\Contracts\Support\Arrayable;

class ApiResult implements Arrayable, \Countable
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

    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return count($this->data);
    }
}