<?php

session_start();

require 'Routing.php';
 
$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('settings', 'DefaultController');
Routing::get('main_menu', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('browse', 'UploadController');
Routing::get('drawn', 'DrawnController');
Routing::get('randomDrawn', 'DrawnController');
Routing::get('logout', 'SecurityController');
Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('upload', 'UploadController');
Routing::post('search', 'UploadController');
Routing::post('iWasThere', 'UploadController');
Routing::post('userRating', 'UploadController');



if( $path == 'upload'){
    if(!isset($_SESSION['admin'])) {
        $path = 'main_menu';
    }
    elseif (!$_SESSION['admin']){
        $path = 'main_menu';
    }
}

if(!isset($_SESSION['nick'])){
    if($path != 'login' && $path != 'register' ){
        $path = '';
    }
}
Routing::run($path);

?>