<?php

spl_autoload_register(function ($class) {
    $path = 'app/controllers/' . $class . '.php';
    if (file_exists($path)) {
        require $path;
    } else {
        die("Soubor pro třídu '$class' nebyl nalezen: $path");
    }
});

$request = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
$params = explode('/', trim($request ?? '', '/'));
$page = $params[0] ?? 'home';
$action = $params[1] ?? 'index';
$arguments = array_slice($params, 2);

require 'app/models/auth.php';
$configExists = file_exists('app/config/config.json');
$auth = new Auth();

$routes = [
    'creator' => [
        'controller' => creatorController::class,
        'requiresLogin' => false,
        'permission' => null,
        'redirect' => '/login',
    ],
    'login' => [
        'controller' => loginController::class,
        'requiresLogin' => false,
        'permission' => null,
        'redirect' => '/dashboard',
    ],
    'logout' => [
        'controller' => logoutController::class,
        'requiresLogin' => true,
        'permission' => null,
        'redirect' => '/login',
    ],
    'dashboard' => [
        'controller' => dashboardController::class,
        'requiresLogin' => true,
        'permission' => null,
        'redirect' => '/login',
    ],
    'changePassword' => [
        'controller' => changePasswordController::class,
        'requiresLogin' => true,
        'permission' => null,
        'redirect' => '/login',
    ],
    'moderators' => [
        'controller' => moderatorsController::class,
        'requiresLogin' => true,
        'permission' => 'manage_moderators',
        'redirect' => '/dashboard',
    ],
];

if (empty($page)) {
    header('Location: /login');
    exit();
}

if (array_key_exists($page, $routes)) {
    $route = $routes[$page];

    if ($route['requiresLogin'] && !$auth->isLoggedIn()) {
        header('Location: ' . $route['redirect']);
        exit();
    }

    if ($route['permission'] && !$auth->hasPermission($route['permission'])) {
        http_response_code(403);
        echo "403 - Nemáte oprávnění přistupovat na tuto stránku.";
        exit();
    }

    $controllerClass = $route['controller'];
    $controller = new $controllerClass();
    if (method_exists($controller, $action)) {
        call_user_func_array([$controller, $action], $arguments);
    } else {
        http_response_code(404);
        echo "404 - Akce nenalezena";
    }
} else {
    http_response_code(404);
    echo "404 - Stránka nenalezena";
}
