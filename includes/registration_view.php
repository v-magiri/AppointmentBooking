<?php
    declare(strict_types= 1);
    function check_registration_errors(){
        if(isset($_SESSION['signup_errors'])){
            $errors=$_SESSION['signup_errors'];
            echo "<br>";
            foreach($errors as $error){
                echo '<p class="form-error">'.$error.'</p>';
            }
            unset($_SESSION['signup_errors']);
        }
    }

?>