<?php

    declare(strict_types=1);
function get_username(object $pdo,string $patient_username){
    $query="SELECT username FROM tbl_patients WHERE username=:username;";
    $stmt=$pdo->prepare($query);
    $stmt->bindParam(":username",$patient_username);
    $stmt->execute();

    $result= $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_email(object $pdo,string $email){
    $query="SELECT emailAddress FROM tbl_patients WHERE emailAddress=:email;";
    $stmt=$pdo->prepare($query);
    $stmt->bindParam(":email",$email);
    $stmt->execute();

    $result= $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

//save a patient to db 
function save_patient(object $pdo,string $firstName, string $lastName,string $email,
            string $username,string $phoneNumber,string $password){

    $query="INSERT INTO tbl_patients (firstName,lastName,emailAddress,phoneNumber,username,password) VALUES
            (:firstName,:lastName,:email,:phone,:username,:pwd);";
    $stmt=$pdo->prepare($query);

    //hashing the password
    $hashingOptions=[
        "cost" => 12
    ];
    $hashedPwd=password_hash($password,PASSWORD_BCRYPT,$hashingOptions);
    $stmt->bindParam(":firstName",$firstName);
    $stmt->bindParam(":lastName",$lastName);
    $stmt->bindParam(":email",$email);
    $stmt->bindParam(":phone",$phoneNumber);
    $stmt->bindParam(":username",$username);
    $stmt->bindParam(":pwd",$hashedPwd);
    $stmt->execute();

    $result= $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function add_user_role(object $pdo,string $username, string $role){
    $query="INSERT INTO tbl_user_roles (username,role) VALUES
    (:username,:role);";

    $stmt=$pdo->prepare($query);
    $stmt->bindParam(":username",$username);
    $stmt->bindParam(":role",$role);
    $stmt->execute();

    $result= $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}