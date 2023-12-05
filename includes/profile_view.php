<?php
    declare(strict_types= 1);
    function check_profile_errors(){
        if(isset($_SESSION['profile_errors'])){
            $errors=$_SESSION['profile_errors'];
            echo "<br>";
            foreach($errors as $error){
                echo '<p class="form-error">'.$error.'</p>';
            }
            unset($_SESSION['profile_errors']);
        }
    }

?>