<?php

namespace src;

class Application
{
    public Router $router;
    public static Application $app;
    public Request $request;

    public function __construct()
    {
        self::$app = $this;
        $this->router = new Router();
    }

    public function run(){
        $this->router->resolve();
    }
}