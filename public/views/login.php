<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
    <title>LOGIN PAGE</title>
</head>
<body>
    <div class="container">
        <div id="logo">
            <img src="public/img/logo.svg">
            <div id="logo-text-1">Draw & Go</div>
            <div id="logo-text-2">explore the world</div>
        </div>
        <div id="login-container">
            <form class="login" action="login" method="POST">
                <label id="login-text">Zaloguj się</label>
                <label id="login-info">
                    <?php
                        if(isset($messages)){
                            foreach ($messages as $message) {
                                echo $message;
                            }
                        }
                    ?>
                </label>
                
                <label for="email" id="email-text">E-mail</label>
                <input name="email" type="text" placeholder="jan.kowalski@gmail.com" required>

                <label for="password" id="password-text">Hasło</label>
                <input name="password" type="password" placeholder="**********" required>
                
                <button type="submit">Zaloguj</button>
                <a href="<?php
                $address = trim($_SERVER['SERVER_NAME'], '_')."register";
                echo $address;

                ?>" id="register-link"><label id="click-register-1">Nie masz konta? </label><label id="click-register-2">Zarejestruj się!</label></a>

            </form>
        </div>
    </div>
</body>