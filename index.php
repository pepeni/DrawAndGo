<?php

require 'Routing.php';
 
$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('settings', 'DefaultController');
Routing::get('main_menu', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('browse', 'DefaultController');
Routing::get('drawn', 'DefaultController');
Routing::post('login', 'SecurityController');

Routing::run($path);

?>