<?php
    declare(strict_types= 1);
    function check_appointment_status(){
        if(isset($_SESSION['appointment_errors'])){
            $errors=$_SESSION['appointment_errors'];
            echo "<br>";
            foreach($errors as $error){
                echo '<p class="form-error">'.$error.'</p>';
            }
            unset($_SESSION['appointment_errors']);
        }else if(isset($_SESSION['deletion_errors'])){
            $errors=$_SESSION['deletion_errors'];
            echo "<br>";
            foreach($errors as $error){
                echo '<p class="form-error">'.$error.'</p>';
            }
            unset($_SESSION['deletion_errors']);
        }
    }
?>