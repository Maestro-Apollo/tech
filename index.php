<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/fontawesme.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animate.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
    .back_img {
        background-color: #FF4500;
        height: 95vh;
    }
    </style>
</head>

<body>
    <?php include('layout/navbar.php'); ?>

    <div class="back_img">
        <div class="container">
            <h3 class="text-white wow fadeInUp"
                style="padding-top:200px; font-size:40px; font-family: 'Montserrat', sans-serif;">
                Student Management System</h3>
            <p class="text-white wow fadeInUp" data-wow-delay="1s"
                style="font-size:20px; font-family: 'Montserrat', sans-serif;">A student management
                system helps a school manage data</p>
        </div>
    </div>




    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.js"></script>
    <script>
    new WOW().init();
    </script>

</body>

</html>