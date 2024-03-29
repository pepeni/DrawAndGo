<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/register.css">
    <script type="text/javascript" src="./public/js/register.js" defer></script>
    <title>REGISTER PAGE</title>
</head>
<body>
<div class="container">
    <div id="logo">
        <img src="public/img/logo.svg">
        <div id="logo-text-1">Draw & Go</div>
        <div id="logo-text-2">explore the world</div>
    </div>
    <div id="register-container">
        <form class="register" action="register" method="POST">
            <label id="register-text">Zarejestruj się</label>


            <label id="register-info"><?php
                if(isset($messages)){
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?></label>

            <label for="email" id="email-text">E-mail</label>
            <input name="email" type="text" placeholder="jan.kowalski@gmail.com" required>

            <label for="nick" id="nick-text">Nick</label>
            <input name="nick" type="text" placeholder="jankowal12" required>

            <label for="password" id="password-text">Hasło</label>
            <input name="password" type="password" placeholder="**********" required>

            <button>Zarejestruj</button>
            <a href="<?php
            $address = trim($_SERVER['SERVER_NAME'], '_')."login";
            echo $address;

            ?>" id="login-link"><label id="click-login-1">Masz konto? </label><label id="click-login-2">Zaloguj się!</label></a>

        </form>
    </div>
</div>
</body>