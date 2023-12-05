<?php
    declare(strict_types= 1);

    function check_login_errors(){
        if(isset($_SESSION['errors_login'])){
            $errors=$_SESSION['errors_login'];
            echo "<br>";
            foreach($errors as $error){
                echo '<p class="form-error">'.$error.'</p>';
            }
            unset($_SESSION['errors_login']);
        }else if(isset($_GET['login']) && $_GET["login"]== "success"){
            echo '<p>Successfully Loggged in</p>';
        }
    }

    function check_verify_errors(){
        if(isset($_SESSION['token_errors'])){
            $errors=$_SESSION['token_errors'];
            echo "<br>";
            foreach($errors as $error){
                echo '<p class="form-error">'.$error.'</p>';
            }
            unset($_SESSION['token_errors']);
        }elseif(isset($_GET['password_errors'])){
            $errors=$_SESSION['password_errors'];
            echo "<br>";
            foreach($errors as $error){
                echo '<p class="form-error">'.$error.'</p>';
            }
            unset($_SESSION['password_errors']);
        }
    }
?>