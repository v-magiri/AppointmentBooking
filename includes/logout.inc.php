<?php

    session_start();
    session_unset();
    session_destroy();

    //redirect user to login page 

    header("Location: ../login.php");
    die();
?>