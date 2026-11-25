<?php
require dirname(__DIR__) . '/vendor/autoload.php';

use App\Controller\RegistrationController;
use App\Controller\LoginController;

$page = $_GET['page'] ?? 'signup';

switch ($page) {
    case 'signup':
        require dirname(__DIR__) . '/template/template_signup.php';
        break;

    case 'login':
        require dirname(__DIR__) . '/template/template_login.php';
        break;

    case 'register':
        $controller = new RegistrationController();
        $controller->register();
        break;

    case 'authenticate':
        $controller = new LoginController();
        $controller->authenticate();
        break;

    default:
        http_response_code(404);
        echo 'Page introuvable.';
        break;
}
