<?php session_start(); ?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/browse.css">
    <script type="text/javascript" src="public/js/search.js" defer></script>
    <script type="text/javascript" src="public/js/iWasThere.js" defer></script>
    <script type="text/javascript" src="public/js/communityRating.js" defer></script>
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
            if( !$_SESSION['admin']){
                echo 'search-bar-center';
            }
            else{
                echo 'search-bar';
            }
            ?>" placeholder="search loceve">

            <?php
            if($_SESSION['admin']) {
                echo '<a href="';
                $address = trim($_SERVER['SERVER_NAME'], '_') . "upload";
                echo $address;

                echo '" class="add-link">';
                echo '<div class="add-loceve">add loceve</div></a>';
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
                $address = trim($_SERVER['SERVER_NAME'], '_')."drawn?loceve=".$loceve->getName();

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
                                <?php

                                for($x=0; $x < $loceve->getRating(); $x++){
                                    echo '<div><img class="star-selected" src="public/img/star_selected.svg"></div>';
                                }
                                for(; $x < 5; $x++){
                                    echo '<div><img class="star-unselected" src="public/img/star_unselected.svg"></div>';
                                }

                                ?>
                            </div>
                            <button id="<?php if($loceve->getIWasThere()){
                                echo 'i-was-there';
                            } else {
                                echo 'i-was-not-there';
                            }
                            ?>" onclick="iWasThere(event, '<?= $loceve->getName(); ?>')">Byłem tam</button>
                        </div>
                    </div>
                </a>

                <?php endforeach; ?>


            </div>

        </div>
        
    </div>
</body>

<template id="loceve-template">
    <a id="link" href="" >
        <div class="record">
            <div id="left">
                <div id="photo-div">
                    <img src="" id="photo">
                </div>
            </div>
            <div id="right">
                <div id="record-name">
                    record name
                </div>
                <div id="price-div">

                    coins

                </div>
                <div id="community-rating">
                    stars
                </div>
                <button id="i-was-there">Byłem tam</button>
            </div>
        </div>
    </a>
</template>
