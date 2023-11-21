<?php
    declare(strict_types= 1);
    function is_form_input_empty(string $name,string $email,string $phoneNumber,string $speciality){
        if(empty($name) || empty($email) || empty($phoneNumber) || empty($speciality)){
            return true;
        }else{
            return false;
        }
    }

    
    function check_email_validity(string $email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }
    function check_phone_validity(string $phone){
        if(preg_match('/^(\+254|0)[1-9]\d{8}$/', $phone)){
            return true;
        }else{
            return false;
        }
    }

    function is_username_valid(object $pdo,string $username){
        if(get_doctor_username($pdo,$username)){
            return true;
        }else{
            return false;
        }
    }

    function is_email_registered(object $pdo, string $email){
        if(fetch_email($pdo,$email)){
            return true;
        }else{
            return false;
        }
    }

    function register_doctor(object $pdo,string $name,string $email,string $phoneNumber,int $speciality,string $username){
        add_user_role($pdo,$username,"Doctor");
        save_doctor($pdo,$name, $email, $phoneNumber, $speciality, $username);
    }
?>