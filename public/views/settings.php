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
        <div id="prices">
            <p id="prices-text">Ceny</p>
            <button class="price-button" id="free">
                <p class="price">Za Darmo</p>
                <img src="public/img/free_icon.svg" class="price-img">
            </button>
            <button class="price-button" id="low">
                <p class="price">Niskie</p>
                <img src="public/img/coin.svg" class="price-img">
            </button>
            <button class="price-button" id="medium">
                <p class="price">Średnie</p>
                <img src="public/img/coin.svg" class="price-img">
                <img src="public/img/coin.svg" class="price-img">
            </button>
            <button class="price-button" id="high">
                <p class="price">Wysokie</p>
                <img src="public/img/coin.svg" class="price-img">
                <img src="public/img/coin.svg" class="price-img">
                <img src="public/img/coin.svg" class="price-img">
            </button>
        </div>
        <div id="city">
            <p id="city-text">Miasto</p>
            <select id="city-select">
                <option value="option1">Krakow</option>
                <option value="option2">Kielce</option>
            </select>
        </div>
        <div id="draw-new">
            <p id="draw-new-text">Losuj tylko nowe</p>
            <button class="draw-new-button" id="draw-new-yes">tak</button>
            <button class="draw-new-button" id="draw-new-no">nie</button>
        </div>
        <div id="buttons">
            <button class="end-button" id="reset-account">Resetuj konto</button>
            <button class="end-button" id="logout">Wyloguj</button>
        </div>
    </div>
</body>