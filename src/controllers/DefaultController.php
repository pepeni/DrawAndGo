<?php

require_once 'AppController.php';

class DefaultController extends AppController{

    public function index() {
        $this->render('login');
    }

    public function settings() {
        $this->render('settings');
    }

    public function main_menu() {
        $this->render('main_menu');
    }

    public function register() {
        $this->render('register');
    }
}

?>