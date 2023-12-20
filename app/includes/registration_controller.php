<?php
    declare(strict_types=1);

    function is_input_empty(string $firstName,string $lastName,string $email,string $phone,string $user_password,string $patient_username){
        if(empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($patient_username) || empty($user_password)){
            return true;
        }else{
            return false;
        }
    }

    function is_email_valid(string $email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }
    function is_phone_valid(string $phone){
        if(preg_match('/^(\+254|0)[1-9]\d{8}$/', $phone)){
            return true;
        }else{
            return false;
        }
    }
    function passwords_match(string $user_password,string $confirm_password){
        if($user_password === $confirm_password){
            return true;
        }else{
            return false;
        }
    }
    function is_username_taken(object $pdo, string $patient_username){
        if(get_username($pdo,$patient_username)){
            return true;
        }else{
            return false;
        }
    }
    function is_email_taken(object $pdo, string $email){
        if(get_email($pdo,$email)){
            return true;
        }else{
            return false;
        }
    }

    function create_patient(object $pdo,string $firstName,string $lastName,string $emailAddress, string $phoneNumber,string $password, string $username){
        add_user_role($pdo,$username,"Patient");
        save_patient($pdo, $firstName, $lastName, $emailAddress, $username,$phoneNumber,$password);
    }
?>