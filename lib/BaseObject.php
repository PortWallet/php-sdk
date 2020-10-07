<?php


namespace PortWallet;


use PortWallet\Exceptions\InvalidArgumentException;

abstract class BaseObject
{
    public function __construct(object $content)
    {
        $this->setContent($content);
    }

    abstract protected function setContent(object $content);

    /**
     * Set a new property to existing data
     *
     * @param $name string the new key to set
     * @param $value mixed
     */
    public function __set(string $name, $value): void
    {
        if (property_exists($this, $name)) {
            throw new InvalidArgumentException('Property ' . $name . ' exists. You cannot update existing property.');
        } else {
            $this->{$name} = $value;
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
        if (isset($this->{$name})) {
            return $this->{$name};
        } else {
            throw new InvalidArgumentException('Property ' . $name . ' not found.');
        }
    }
}
