<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/','Home::index');
$routes->get('index1','Home::hindi');
$routes->get('index2','Home::english');
$routes->get('form','Home::form');
$routes->get('login','AuthController::login');
$routes->get('register','AuthController::register');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/test', 'AuthController::test');

$routes->post('/fetch-states', 'ApplicationController::states');
$routes->post('/fetch-cities', 'ApplicationController::cities');
$routes->post('/application/submit', 'ApplicationController::saveApplication');
$routes->post('/fetch-record', 'ApplicationController::getApplicantRecord');
$routes->post('/login-submit', 'AuthController::loginSubmit');
$routes->post('/register-submit', 'AuthController::registerSubmit');