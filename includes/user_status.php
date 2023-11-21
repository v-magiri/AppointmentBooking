<?php
    function is_user_logged_in(){
        if(isset($_SESSION["user_id"])){
            return $_SESSION["user_name"];
        }else{
            return "John Doe";
        }
    }

    function check_user_logged_in(){ 

    }
?>