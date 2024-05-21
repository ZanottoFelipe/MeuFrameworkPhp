<?php

namespace App\Core;

class Response
{
    protected $content;
    protected $status;

    public function __construct($content, $status = 200, $header = null)
    {
        $this->content = $content;
        $this->status = $status;
    }

    public function send()
    {
        http_response_code($this->status);
        echo $this->content;
    }
}
