<?php

session_start();

use models\User;

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';



class SecurityController extends AppController
{

    private $userRepository;
    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }
    public function login(){

        if(!$this->isPost()){
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = $this->userRepository->getUser($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['User not found!']]);
        }

        if ($user->getEmail() !== $email){
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if ($user->getPassword() !== $password){
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        $_SESSION['nick'] = $user->getNick();
        $_SESSION['admin'] = $user->getAdmin();

        return $this->render('main_menu');

    }

    public function register()
    {
        if (!$this->isPost()) {
            return $this->render('register');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $nick = $_POST['nick'];
        $salt = "aaa";
        $admin = false;
        $date = new DateTime();

        //TODO try to use better hash function
        $user = new User($email, $password, $nick, $salt, $admin);
        $user->setDateTime($date->format("Y-m-d-G-i-s"));

        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
    }



}