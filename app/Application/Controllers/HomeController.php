<?php

namespace App\Application\Controllers;
use \App\Core\Response;
final class HomeController
{
    public function index(){
        return new Response('Welcome to Home Page', 200);
    }
}
