<?php

namespace App\Core;

class Request
{
    public static function capture()
    {
        return new static;
    }

    public function getPath()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // Remove o prefixo '/calendario'
        return str_replace('/'. NOME_SITE, '', $path);
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
