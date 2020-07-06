<?php


namespace PortWallet;


class Response
{
    public $data;

    public $result;

    public function __construct($content)
    {
        $this->result = $content->result;
        $this->data = $content->data;
    }

    public function all()
    {
        return $this->data;
    }
}
