<?php session_start(); ?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/browse.css">
    <title>BROWSE</title>
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
                    <img src="public/img/arrow_back.svg" id="arrow-back-img">Wróć
                </a>
            </div>
            <div id="nick"><?php
                echo $_SESSION['nick'];
                ?></div>
        </div>

        <div id="searchadd">

            <input class="<?php
            if( $_SESSION['nick']){
                echo 'search-bar-center';
            }
            else{
                echo 'search-bar';
            }
            ?>" placeholder="search lockeve">

            <?php
            if($_SESSION['admin']) {
                echo '<a href="';
                $address = trim($_SERVER['SERVER_NAME'], '_') . "upload";
                echo $address;

                echo '" class="add-link">';
                echo '<div class="add-lockeve">add locekve</div></a>';
            }
            ?>

        </div>


        <div id="browse-header">
            <p id="browse-text">Przeglądaj</p>
        </div>
        <div id="container-bot">

            <div id="records">
                <?php foreach ($loceves as $loceve): ?>
                <a id="link" href="<?=
                $address = trim($_SERVER['SERVER_NAME'], '_')."drawn?lockeve=".$loceve->getName();

                ?>" >
                    <div class="record">
                        <div id="left">
                            <div id="photo-div">
                                <img src="public/uploads/<?= $loceve->getImage(); ?>" id="photo">
                            </div>
                        </div>
                        <div id="right">
                            <div id="record-name">
                                <?= $loceve->getName(); ?>
                            </div>
                            <div id="price-div">
                                <?php
                                    for($i=0;$i<$loceve->getPrice();$i++){
                                        echo '<img src="public/img/coin.svg" id="price-img">';
                                    }
                                ?>

                            </div>
                            <div id="community-rating">
                                <div class="star" data-value="1"><img src="public/img/star.svg"></div>
                                <div class="star" data-value="2"><img src="public/img/star.svg"></div>
                                <div class="star" data-value="3"><img src="public/img/star.svg"></div>
                                <div class="star" data-value="4"><img src="public/img/star.svg"></div>
                                <div class="star" data-value="5"><img src="public/img/star.svg"></div>
                            </div>
                            <button id="i-was-there">Byłem tam</button>
                        </div>
                    </div>
                </a>

                <?php endforeach; ?>


            </div>

        </div>
        
    </div>
</body>