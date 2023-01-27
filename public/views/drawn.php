<?php session_start(); ?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/drawn.css">
    <script type="text/javascript" src="public/js/iWasThere.js" defer></script>
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
                        <div class="star" data-value="1"><img src="public/img/star.svg"></div>
                        <div class="star" data-value="2"><img src="public/img/star.svg"></div>
                        <div class="star" data-value="3"><img src="public/img/star.svg"></div>
                        <div class="star" data-value="4"><img src="public/img/star.svg"></div>
                        <div class="star" data-value="5"><img src="public/img/star.svg"></div>
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
                        <p id="user-rating">Twoja ocena:</p>
                        <div class="rating">
                            <div class="star" data-value="1"><img src="public/img/star.svg"></div>
                            <div class="star" data-value="2"><img src="public/img/star.svg"></div>
                            <div class="star" data-value="3"><img src="public/img/star.svg"></div>
                            <div class="star" data-value="4"><img src="public/img/star.svg"></div>
                            <div class="star" data-value="5"><img src="public/img/star.svg"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
    </div>
</body>