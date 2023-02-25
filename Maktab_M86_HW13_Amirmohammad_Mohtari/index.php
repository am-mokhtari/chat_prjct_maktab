<?php
session_start();
require_once "vendor/autoload.php";

$app = new src\Application();

$app->router->get('/' , [\src\Controller\HomeController::class , 'index']);
$app->router->get('/home' , [\src\Controller\HomeController::class , 'index']);
$app->router->get('/register' , [\src\Controller\RegisterController::class , 'index']);
$app->router->get('/login' , [\src\Controller\LoginController::class , 'index']);
$app->router->post('/register' , [\src\Controller\RegisterController::class , 'store']);
$app->router->post('/login' , [\src\Controller\LoginController::class , 'store']);
$app->router->post('/logout' , [\src\Controller\LoggedController::class , 'logout']);

$app->run();
