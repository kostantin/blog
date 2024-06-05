<?php
/** @var \classes\Router $router */

const MIDDLEWARE = [
    'auth' => \classes\middleware\Auth::class,
    'guest' => \classes\middleware\Guest::class,
];


$router->get('/', 'HomePageController.php');

$router->get('/register', 'RegisterController.php')->only('guest');
$router->post('/register', 'RegisterController.php')->only('guest');

$router->get('/login', 'LoginController.php')->only('guest');
$router->post('/login', 'LoginController.php')->only('guest');

$router->get('/logout', 'LogoutController.php');

$router->get('/new', 'NewPostController.php')->only('auth');
$router->post('/new', 'NewPostController.php')->only('auth');

