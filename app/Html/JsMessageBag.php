<?php


namespace App\Html;

use Illuminate\Contracts\Support\MessageBag as MessageBagContract;

class JsMessageBag implements MessageBagContract
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
     * @param  string $message
     * @return $this
     */
    public function add($key, $message)
    {
        $this->data[$key] = $message;
    }

    /**
     * Merge a new array of messages into the bag.
     *
     * @param  \Illuminate\Contracts\Support\MessageProvider|array $messages
     * @return $this
     */
    public function merge($messages)
    {
        // TODO: Implement merge() method.
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
}