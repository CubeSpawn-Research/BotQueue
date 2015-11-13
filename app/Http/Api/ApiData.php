<?php


namespace App\Http\Api;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

abstract class ApiData implements Arrayable, \Countable, \JsonSerializable, Jsonable
{
    /**
     * Return the data for this api
     *
     * @return array
     */
    public abstract function toArray();

    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function count()
    {
        return count($this->toArray());
    }
}