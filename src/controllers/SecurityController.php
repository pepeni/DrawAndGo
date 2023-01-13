<?php


use models\User;

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController
{
    public function login(){
        $user = new User('email@com.pl', 'admin', 'Jan', 'Nowak');

        if($this->isGet()){
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        if ($user->getEmail() !== $email){
            return $this->render('login', ['messeges' => ['User with this email not exists!']]);
        }

        if ($user->getPassword() !== $password){
            return $this->render('login', ['messeges' => ['Wrong password!']]);
        }

        return $this->render('main_menu');

    }

}