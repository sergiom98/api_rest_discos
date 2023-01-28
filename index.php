<?php
    require_once "./libs/Autoload.php";
    Autoload::init();
    require_once "./config/Config.php";

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header('Content-Type: application/json;');

    // var_dump($_SERVER);
    $method = $_SERVER["REQUEST_METHOD"];
    $url = $_GET["url"];

    $router = new Router($method, $url);
    $router->run();
