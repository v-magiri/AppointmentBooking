<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">   
    <link href="<?php echo $stylePath; ?>styles.css" rel="stylesheet" type="text/css"/> 
    <title><?php  echo $title?></title>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top header-nav">
        <div class="container-fluid">
            <div class="brand">
                <a href="/" class="logo">
                    <span>Appointment Booking</span>
                </a>
            </div>
            <div class="nav-links">
                <ul class="">
                    <?php
                        if(!isset($_SESSION['user_id'])){?>
                            <li>
                                <a href="./login.php">
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                    <span>Login</span>
                                </a>
                            </li>
                            <li>
                                <a href="./signup.php">
                                    <i class="fa-solid fa-user-plus"></i>
                                    <span>Register</span>
                                </a>
                            </li>
                       <?php } ?>
                </ul>
            </div>
        </div>
    </nav>