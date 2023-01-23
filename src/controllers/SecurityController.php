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

        $user = $this->userRepository->getUserByEmail($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['User not found!']]);
        }

        if ($user->getEmail() !== $email){
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if (!password_verify($password, $user->getPassword())){
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
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $nick = $_POST['nick'];
        $admin = false;
        $date = new DateTime();

        $nickPattern = '/[A-Za-z\d]{5,64}$/i';
        $passwordPattern = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/i';
        $emailPattern = '/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/i';


        if (strlen($_POST['password']) < 8) {
            return $this->render('register', ['messages' => ['password should contain at least 8 characters']]);
        }

        if (strlen($nick) < 5 || strlen($nick) > 64) {
            return $this->render('register', ['messages' => ['nick should contain between 5-64 characters']]);
        }

        if (!preg_match($passwordPattern ,$_POST['password'])) {
            return $this->render('register', ['messages' => ['password should contain at least 1 number and 1 letter']]);
        }

        if (!preg_match($nickPattern ,$nick)) {
            return $this->render('register', ['messages' => ['nick should contain only letters and numbers']]);
        }

        if (!preg_match($emailPattern ,$email)) {
            return $this->render('register', ['messages' => ['email is not proper']]);
        }


        $user = $this->userRepository->getUserByEmail($email);
        if ($user) {
            return $this->render('register', ['messages' => ['User with this email already exist!']]);
        }

        $user = $this->userRepository->getUserByNIck($nick);
        if ($user) {
            return $this->render('register', ['messages' => ['User with this nick already exist!']]);
        }

        $user = new User($email, $password, $nick, $admin);
        $user->setDateTime($date->format("Y-m-d-G-i-s"));

        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
    }



}