<?php


namespace App\Html;

use Countable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\MessageBag as MessageBagContract;

class JsMessageBag implements Arrayable, Countable, Jsonable, MessageBagContract
{

    protected $data = [];
    /**
     * Get the keys present in the message bag.
     *
     * @return array
     */
    public function keys()
    {
        return array_keys($this->data);
    }

    /**
     * Add a message to the bag.
     *
     * @param  string $key
     * @param  string $value
     * @return $this
     */
    public function add($key, $value)
    {
        if($this->has($key)) {
            return $this->merge([$key => $value]);
        } else
            $this->data[$key] = $value;
        return $this;
    }

    /**
     * Merge a new array of messages into the bag.
     *
     * @param  \Illuminate\Contracts\Support\MessageProvider|array $messages
     * @return $this
     */
    public function merge($messages)
    {
        $this->data = array_replace_recursive($this->data, $messages);
        return $this;
    }

    /**
     * Determine if messages exist for a given key.
     *
     * @param  string $key
     * @return bool
     */
    public function has($key = null)
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * Get the first message from the bag for a given key.
     *
     * @param  string $key
     * @param  string $format
     * @return string
     */
    public function first($key = null, $format = null)
    {
        return $this->get($key, $format);
    }

    /**
     * Get all of the messages from the bag for a given key.
     *
     * @param  string $key
     * @param  string $format
     * @return array
     */
    public function get($key, $format = null)
    {
        return $this->data[$key];
    }

    /**
     * Get all of the messages for every key in the bag.
     *
     * @param  string $format
     * @return array
     */
    public function all($format = null)
    {
        // TODO: Implement all() method.
    }

    /**
     * Get the default message format.
     *
     * @return string
     */
    public function getFormat()
    {
        // TODO: Implement getFormat() method.
    }

    /**
     * Set the default message format.
     *
     * @param  string $format
     * @return $this
     */
    public function setFormat($format = ':message')
    {
        // TODO: Implement setFormat() method.
    }

    /**
     * Determine if the message bag has any messages.
     *
     * @return bool
     */
    public function isEmpty()
    {
        return $this->count() == 0;
    }

    /**
     * Get the number of messages in the container.
     *
     * @return int
     */
    public function count()
    {
        return count($this->keys());
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        if($this->isEmpty())
            return json_encode($this->toArray(), JSON_FORCE_OBJECT | $options);

        return json_encode($this->toArray(), $options);
    }
}