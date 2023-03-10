<?php

namespace src;

use mysql_xdevapi\BaseResult;
use src\database\QueryBuilder;
use src\helper\Session;
use src\helper\Auth;

class Router
{
    protected array $routes = [];


    public function get($path , $callback){
        $this->routes['get'][$path] = $callback;
    }

    public function post($path , $callback){
        $this->routes['post'][$path] = $callback;
    }

    public function resolve(){
        $path = Request::getPath();
        $method = Request::getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false){
            return $this->renderView("404");
        }

        if (is_string($callback)){
            return $this->renderView($callback);
        }

        return call_user_func([new $callback[0] , $callback[1]]);
    }

    public function renderView($view , $params = []): void{
        $page = $this->layoutContent("/views/layouts/main.php");

        $header = $this->layoutContent("/views/layouts/header.php");
        $content = $this->renderOnlyView($view , $params);
        $footer = $this->layoutContent("/views/layouts/footer.html");

        $page = str_replace(array('{{header}}', '{{content}}', '{{footer}}'), array($header, $content, $footer), $page);
        echo $page;
    }

    protected function layoutContent(string $path){
        ob_start();
        include_once __DIR__ .$path;
        return ob_get_clean();
    }

    protected function renderOnlyView($view , $params){
        foreach ($params as $key => $value){
            $$key = $value;
        }
        ob_start();
        include_once __DIR__ ."/views/$view.php";
        return ob_get_clean();
    }
}