<?php

session_start();
include 'connect-db.php';

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "headtags.html"; ?>
    <title>Team LaundryKu</title>
</head>
<body>
    
    <!-- header -->
    <?php include "header.php"; ?>
    <!-- end header -->


    <!-- body -->
    <div class="row">
        <h3 class="header light center">Team LaundryKu</h3>
        <br>
        <div class="col s2 offset-s2">
            <div class="card">
                <div class="card-image center">
                    <img src="img/logo.png">
                    <h5 class="header light">Nadya Oktaviana</h5>
                </div>
                <div class="card-content">
                <p>I am a very simple card. I am good at containing small bits of information.
                I am convenient because I require little markup to use effectively.</p>
                </div>
                <div class="card-action">
                <a href="#">This is a link</a>
                </div>
            </div>
        </div>
        <div class="col s2">
            <div class="card">
                <div class="card-image center">
                    <img src="img/logo.png">
                    <h5 class="header light">Eka Nadya</h5>
                </div>
                <div class="card-content">
                <p>I am a very simple card. I am good at containing small bits of information.
                I am convenient because I require little markup to use effectively.</p>
                </div>
                <div class="card-action">
                <a href="#">This is a link</a>
                </div>
            </div>
        </div>
        <div class="col s2">
            <div class="card">
                <div class="card-image center">
                    <img src="img/logo.png">
                    <h5 class="header light">Hairul Lana</h5>
                </div>
                <div class="card-content">
                <p>I am a very simple card. I am good at containing small bits of information.
                I am convenient because I require little markup to use effectively.</p>
                </div>
                <div class="card-action">
                <a href="#">This is a link</a>
                </div>
            </div>
        </div>
        <div class="col s2">
            <div class="card">
                <div class="card-image center">
                    <img src="img/logo.png">
                    <h5 class="header light">Wina Artha</h5>
                </div>
                <div class="card-content">
                <p>I am a very simple card. I am good at containing small bits of information.
                I am convenient because I require little markup to use effectively.</p>
                </div>
                <div class="card-action">
                <a href="#">This is a link</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end body -->



    <!-- footer -->
    <?php include "footer.php" ?>
    <!-- end footer -->




</body>
</html>