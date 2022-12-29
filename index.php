<?php 

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('home', 'DefaultController');
Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('addDog', 'DogInfoController');
Routing::get('getUserDogPhoto', 'DogInfoController');
Routing::get('getIfUserHasDog', 'DogInfoController');


Routing::run($path);