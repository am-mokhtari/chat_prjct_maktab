<?php

namespace src;

use mysql_xdevapi\BaseResult;

class Router
{
    protected array $routes = [];
    public Request $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function get($path , $callback){
        $this->routes['get'][$path] = $callback;
    }

    public function post($path , $callback){
        $this->routes['post'][$path] = $callback;
    }

    public function resolve(){
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false){
            echo "Not Found";
            return;
        }

        if (is_string($callback)){
            return $this->renderView($callback);
        }

        return call_user_func([new $callback[0] , $callback[1]]);
    }

    public function renderView($view , $params = []): void{
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view , $params);
        $signHeader = $this->signed();
        $view = str_replace('{{signIn}}' , $signHeader , $layoutContent);
        $view = str_replace('{{content}}' , $viewContent , $view);
        echo $view;
    }

    protected function layoutContent(){
        ob_start();
        include_once __DIR__ ."/views/layouts/main.php";
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

    private function signed()
    {
        if (isset($_SESSION["user_id"])){
            return $_SESSION['user_name'];
        }
        ob_start();
        include_once __DIR__ ."/views/layouts/signHeader.php";
        return ob_get_clean();
    }
}