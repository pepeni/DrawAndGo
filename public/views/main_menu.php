<?php session_start(); ?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/main_menu.css">
    <title>MENU</title>
</head>
<body>
    <div class="container">

        <div id="container-top">
            <div id="logo">
                <img src="public/img/logo.svg">
                <div id="logo-text">Draw & Go</div>
            </div>
            <div id="info-account">
                <p id="nick"><?php
                    echo $_SESSION['nick'];
                    ?></p>
            </div>
        </div>

        <div id="container-bottom">
            <div class="option">
                <p class="bot-title">Przeglądaj</p>
                <a id="link" href="<?php
                $address = trim($_SERVER['SERVER_NAME'], '_')."browse";
                echo $address;

                ?>">
                    <div class="bot-picture" id="checkout">
                    
                    </div>
                </a>
            </div>
            <div class="option">
                <p class="bot-title">Losuj</p>
                <a id="link" href="<?php
                $address = trim($_SERVER['SERVER_NAME'], '_')."randomDrawn";
                echo $address;

                ?>">
                    <div class="bot-picture" id="draw">
                    
                    </div>
                </a>
            </div>
            <div class="option">
                <p class="bot-title">Ustawienia</p>
                <a id="link" href="<?php
                $address = trim($_SERVER['SERVER_NAME'], '_')."settings";
                echo $address;

                ?>">
                    <div class="bot-picture" id="options">
                    
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>