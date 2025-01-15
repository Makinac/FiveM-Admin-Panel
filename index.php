<?php
$request = $_GET['url'] ?? '';
$params = explode('/', trim($request, '/')); // Rozdělení URL
$page = $params[0] ?? 'home'; // První část URL (např. 'creator')
$action = $params[1] ?? 'index'; // Druhá část URL (např. 'index')
$arguments = array_slice($params, 2); // Zbytek URL jako argumenty

$page = $params[0] ?? 'home';
$action = $params[1] ?? 'index';
$arguments = array_slice($params, 2);

switch ($page) {
    case 'creator':
        require 'app/controllers/creatorController.php';
        $controller = new CreatorController();
        call_user_func_array([$controller, $action], $arguments);
        break;
    case 'login':

    default:
        // Stránka nenalezena
        http_response_code(404);
        echo "404 - Page Not Found";
        break;
}
