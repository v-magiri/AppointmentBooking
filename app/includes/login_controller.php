<?php
    declare(strict_types= 1);

    function input_empty(string $user_name, string $user_password){
        if(empty($user_name) || empty($user_password)){
            return true;
        }else{
            return false;
        }
    }

    function verify_username(bool|array $result) {   
        if(!$result){
            return true;
        }else{
            return false;
        }
    }

    function verify_password(string $pwd,string $hashedPwd) {   
        if(!password_verify($pwd,$hashedPwd)){
            return true;
        }else{
            return false;
        }
    }
?>