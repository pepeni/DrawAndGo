<?php session_start(); ?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/drawn.css">
    <script type="text/javascript" src="public/js/iWasThere.js" defer></script>
    <script type="text/javascript" src="public/js/userRating.js" defer></script>
    <title>DRAWN</title>
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
        <div id="drawn-header">
            <p id="drawn-text"><?= $loceve->getName() ?></p>
        </div>
        <div id="container-bot">
            <div id="left">
                <div id="photo-div">
                    <img src="public/uploads/<?= $loceve->getImage() ?>" id="photo">
                </div>
            </div>
            <div id="right">
                <div id="description">
                    <p id="description-text">Opis:</p>
                    <p id="description-content"><?= $loceve->getDescription() ?></p>
                </div>

                <div id="price">
                    <p id="price-text">Ceny:</p>
                    <div id="price-div">
                        <?php
                        for($i=0; $i<$loceve->getPrice(); $i++){
                            echo '<img src="public/img/coin.svg" id="price-img">';
                        }

                        ?>
                    </div>
                </div>

                <div id="webpage">
                    <p id="webpage-text">Strona internetowa:</p>
                    <div id="webpage-div">
                        <a href="<?= $loceve->getWebsite() ?>" id="website">Link do strony atrakcji</a>
                    </div>
                </div>

                <div id="community-rating">
                    <p id="community-rating-text">Ocena społeczności:</p>
                    <div class="rating">
                        <?php

                        for($x=0; $x < $loceve->getRating(); $x++){
                            echo '<div><img class="star" src="public/img/star_selected.svg"></div>';
                        }
                        for(; $x < 5; $x++){
                            echo '<div><img class="star" src="public/img/star_unselected.svg"></div>';
                        }

                        ?>
                    </div>
                </div>

                <div id="user-options">
                    <button id="<?php if($loceve->getIWasThere()){
                        echo 'i-was-there';
                    } else {
                        echo 'i-was-not-there';
                    }
                    ?>" onclick="iWasThere(event, '<?= $loceve->getName(); ?>')">Byłem tam</button>
                    <div id="rating-div">
                        <p id="user-rating-text">Twoja ocena:</p>
                        <div class="rating" id="user-rating">
                            <div><img class="star" src="public/img/star_unselected.svg"></div>
                            <div><img class="star" src="public/img/star_unselected.svg"></div>
                            <div><img class="star" src="public/img/star_unselected.svg"></div>
                            <div><img class="star" src="public/img/star_unselected.svg"></div>
                            <div><img class="star" src="public/img/star_unselected.svg"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
    </div>
</body>