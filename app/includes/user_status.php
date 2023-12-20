<?php
    function get_username(){
        if(isset($_SESSION["user_name"])){
            return $_SESSION["user_name"];
        }else{
            return "JohnDoe";
        }
    }

    function get_name(){ 
        if(isset($_SESSION["name"])){
            return $_SESSION["name"];
        }else{
            return "John Doe";
        }
    }
?>