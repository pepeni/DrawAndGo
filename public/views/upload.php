<?php session_start(); ?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/upload.css">
    <title>UPLOAD</title>
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
    <div id="upload-header">
        <p id="upload-text">Dodaj atrakcję, lub event:</p>
    </div>
    <div id="container-bot">
        <section class="project-form">
            <form id="form" action="upload" method="POST" ENCTYPE="multipart/form-data">
                <div class="messages">
                    <?php
                    if(isset($messages)){
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>

                <select class="select_option" name="choice">
                    <option value="location">Lokalizacja</option>
                    <option value="event">Event</option>
                </select>

                <input id="upload-input" name="name" type="text" placeholder="localization/event name">
                <textarea id="upload-textarea" name="description" rows=5 placeholder="description"></textarea>
                <input id="upload-input" name="website" type="text" placeholder="website url">

                <select class="select_option" name="price">
                    <option value=1>Cena: 1</option>
                    <option value=2>Cena: 2</option>
                    <option value=3>Cena: 3</option>
                </select>

                <p id="photo-text"><br/>Wybierz zdjęcie:<br/></p>
                <label class="custom-file-upload"></label><input id="upload-file" type="file" name="file"/>
                <button id="submit" type="submit">Wyślij</button>
            </form>
        </section>

    </div>

</div>
</body>