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
            <div id="nick">Nick123</div>
        </div>
        <div id="browse-header">
            <p id="browse-text">Przeglądaj</p>
        </div>
        <div id="container-bot">

            <div id="records">
                <?php foreach ($loceves as $loceve): ?>
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

                <?php endforeach; ?>


            </div>

        </div>
        
    </div>
</body>