<?php
// index.php - Belépési pont
session_start();
require_once 'config/database.php';
require_once 'src/core/Router.php';
require_once 'src/core/Auth.php';

$router = new Router();
$auth = new Auth();

// Statikus fájlok kiszolgálása
if (preg_match('/\.(?:css|js|png|jpg|gif|ico)$/', $_SERVER["REQUEST_URI"])) {
    return false;
}

// Útvonalak regisztrálása
$router->get('/', 'HomeController@index');
$router->get('/login', 'AuthController@loginForm');
$router->post('/login', 'AuthController@login');
$router->get('/register', 'AuthController@registerForm');
$router->post('/register', 'AuthController@register');
$router->get('/logout', 'AuthController@logout');

// Védett útvonalak
$router->get('/dashboard', 'DashboardController@index', true);
$router->get('/trooptool', 'TroopController@index', true);
$router->post('/trooptool/save', 'TroopController@save', true);
$router->get('/croptool', 'CropController@index', true);
$router->post('/croptool/calculate', 'CropController@calculate', true);
$router->get('/stats', 'StatsController@index', true);
$router->get('/calculators', 'CalculatorController@index', true);
$router->get('/map', 'MapController@index', true);

// Admin útvonalak
$router->get('/admin', 'AdminController@index', true, 'admin');

$router->dispatch();