<?php 

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('home', 'DefaultController');
Routing::get('place', 'DefaultController');
Routing::get('adminPanel', 'DefaultController');

Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('addDog', 'DogInfoController');
Routing::post('goForAWalk', 'WalkController');
Routing::post('newPlaceIdea', 'WalkController');
Routing::post('changePassword', 'SecurityController');

Routing::get('getUserDogPhoto', 'DogInfoController');
Routing::get('getIfUserHasDog', 'DogInfoController');
Routing::get('getPlaceID', 'WalkController');
Routing::get('isUserOnAWalk', 'WalkController');
Routing::get('getPlacePhoto', 'WalkController');
Routing::get('endTheWalk', 'WalkController');
Routing::get('removeDog', 'DogInfoController');
Routing::get('checkRole', 'SecurityController');


Routing::run($path);