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
// $routes->get('/test', 'AuthController::test');

$routes->get('/prof-debiprasad-mishra', 'Home::profDebiprasadMishra');

$routes->post('/fetch-states', 'ApplicationController::states');
$routes->post('/fetch-cities', 'ApplicationController::cities');
$routes->post('/application/submit', 'ApplicationController::saveApplication');
$routes->post('/fetch-record', 'ApplicationController::getApplicantRecord');
$routes->post('/login-submit', 'AuthController::loginSubmit');
$routes->post('/register-submit', 'AuthController::registerSubmit');
$routes->post('/contact-us-data', 'AuthController::contactUsData');

// Demo Routes
$routes->get('demo1','DemoController::hindi');
$routes->get('demo2','DemoController::english');
$routes->get('demo3','DemoController::login');