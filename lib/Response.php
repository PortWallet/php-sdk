<?php


namespace PortWallet;


use PortWallet\Exceptions\InvalidArgumentException;

class Response
{
    /**
     * @var object $data
     */
    public $data;

    /**
     * @var string $result
     */
    public $result;

    /**
     * Response constructor.
     * @param $content
     */
    public function __construct($content)
    {
        $this->result = $content->result;
        $this->data = $content->data;
    }

    /**
     * Get all data from response
     *
     * @return object
     */
    public function all(): object
    {
        return $this->data;
    }

    /**
     * Set a new property to existing data
     *
     * @param $name string the new key to set
     * @param $value mixed
     */
    public function __set(string $name, $value): void
    {
        if (property_exists($this->data, $name)) {
            throw new InvalidArgumentException('Property ' . $name . ' exists. You cannot update existing property.');
        } else {
            $this->data->{$name} = $value;
        }
    }

    /**
     * Dynamically accessing data properties
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (isset($this->data->{$name})) {
            return $this->data->{$name};
        } else {
            throw new InvalidArgumentException('Property ' . $name . ' not found.');
        }
    }
}
