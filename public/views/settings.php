<?php session_start(); ?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/settings.css">
    <title>SETTINGS</title>
</head>
<body>
    <div class="container">
        <div id="container-top">
            <div id="back">
                <a href="
                <?php
                    $address = trim($_SERVER['SERVER_NAME'], '_')."main_menu";
                    echo $address;

                ?>
                " id="back-link">
                    <img src="public/img/arrow_back.svg" id="arrow-back-img">Wróć</a>
            </div>
            <div id="nick"><?php
                echo $_SESSION['nick'];
                ?></div>
        </div>
        <div id="settings-header">
            <p id="setting-text">Ustawienia</p>
            <img src="public/img/settings.svg" id="setting-img">
        </div>

        <div id="buttons">
            <a id="a-logout" href="/logout"><button class="end-button" id="logout" >Wyloguj</button></a>
        </div>
    </div>
</body>