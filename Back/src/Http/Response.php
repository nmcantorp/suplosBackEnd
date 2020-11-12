<?php
namespace App\Http;

class Response{
    protected $info; //array, json, pdf...

    public function __construct($info)
    {
        $this->info = $info; //home, contact
    }

    public function getInfo()
    {
        return $this->info;
    }

    public function send()
    {
        var_dump($this->getInfo());die;
        return $this->getInfo();
    }
}