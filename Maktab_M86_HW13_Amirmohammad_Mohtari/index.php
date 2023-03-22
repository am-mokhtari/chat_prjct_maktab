<?php
session_start();
require_once "vendor/autoload.php";

$app = new src\Application();

// home
$app->router->get('/' , [\src\Controller\HomeController::class , 'index']);
$app->router->get('/home' , [\src\Controller\HomeController::class , 'index']);

$app->router->get('/contact' , [\src\Controller\HomeController::class , 'contact']);

$app->router->get('/showDetails' , [\src\Controller\HomeController::class , 'show']);

$app->router->post('/showDetails/reserve' , [\src\Controller\HomeController::class , 'store']);
$app->router->post('/showDetails/cancel' , [\src\Controller\HomeController::class , 'delete']);


// register
$app->router->get('/register' , [\src\Controller\RegisterController::class , 'index']);
$app->router->post('/register' , [\src\Controller\RegisterController::class , 'store']);


// login
$app->router->get('/login' , [\src\Controller\LoginController::class , 'index']);
$app->router->post('/login' , [\src\Controller\LoginController::class , 'store']);


// logout
$app->router->post('/logout' , [\src\helper\Auth::class , 'logout']);
$app->router->get('/logout' , [\src\helper\Auth::class , 'logout']);


// panel
$app->router->get('/panel' , [\src\Controller\PanelController::class , 'index']);
$app->router->get('/profile' , [\src\Controller\PanelController::class , 'index']);


// admin panel
$app->router->post('/panel/changeStatus' , [\src\Controller\AdminController::class , 'changeStatus']);

$app->router->post('/panel/updatePage' , [\src\Controller\AdminController::class , 'indexUpdate']);
$app->router->post('/panel/updateDprt' , [\src\Controller\AdminController::class , 'update']);

$app->router->post('/panel/delete' , [\src\Controller\AdminController::class , 'delete']);

$app->router->post('/panel/addPart' , [\src\Controller\AdminController::class , 'addPrt']);


// doctor panel
$app->router->post('/panel/setInfo' , [\src\Controller\DoctorController::class , 'storeInfo']);

$app->router->post('/panel/setTime' , [\src\Controller\DoctorController::class , 'storeTime']);


$app->run();

