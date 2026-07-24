<?php

declare(strict_types=1);
session_start(); 

$controllerName = $_GET['controller'] ?? 'category';
$action = $_GET['action'] ?? 'index';

// Whitelist — tránh gọi class/hàm tùy ý từ URL
$map = [
    'category' => 'CategoryController',
];

if (!isset($map[$controllerName])) {
    http_response_code(404);
    exit('Controller not found');
}

require_once __DIR__ . '/../controllers/' . $map[$controllerName] . '.php';

$controller = new $map[$controllerName]();

if (!method_exists($controller, $action)) {
    http_response_code(404);
    exit('Action not found');
}

$controller->{$action}();
