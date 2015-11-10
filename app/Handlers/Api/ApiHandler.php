<?php


namespace App\Handlers\Api;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Query\Builder;

abstract class ApiHandler implements Arrayable
{
    /** @var Builder $query */
    protected $query;
    protected $handled_keys = [];

    protected function singleKey($key, $element) {

        if(is_array($element) || $element instanceof \ArrayAccess) {
            if($this->query instanceof \Illuminate\Database\Eloquent\Builder) {
                $this->query->getQuery()->whereIn($key, $element);
            } else {
                $this->query->whereIn($key, $element);
            }
        } else {
            if(in_array($key, $this->handled_keys)) {
                $this->query->orWhere($key, $element);
            } else {
                $this->query->where($key, $element);
            }
            $this->handled_keys[] = $key;
        }
        return $this;
    }
}