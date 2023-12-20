<?php
    declare(strict_types= 1);

    function check_errors(){
        if(isset($_SESSION['registration_errors'])){
            $errors=$_SESSION['registration_errors'];
            echo "<br>";
            foreach($errors as $error){
                echo '<p class="form-error">'.$error.'</p>';
            }
            unset($_SESSION['registration_errors']);
        }else if(isset($_GET['registration']) && $_GET['registration'] ==='success'){
            echo '<p>Doctor registered Successfully</p>';
        }else if(isset($_SESSION["appointment_errors"])){
            $errors=$_SESSION['appointment_errors'];
            echo "<br>";
            foreach($errors as $error){
                echo '<p class="form-error">'.$error.'</p>';
            }
            unset($_SESSION['appointment_errors']);
        }
    }
?>