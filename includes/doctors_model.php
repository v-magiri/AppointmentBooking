<?php
    declare(strict_types= 1);

    function save_doctor(object $pdo,string $name,string $email,string $phone,int $speciality,string $username){
        $query="INSERT INTO tbl_doctors (name,email_address,phoneNumber,username,speciality) VALUES
        (:name,:email,:phone,:username,:speciality);";
        $stmt=$pdo->prepare($query);

        $stmt->bindParam(":name",$name);
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":phone",$phone);
        $stmt->bindParam(":username",$username);
        $stmt->bindParam(":speciality",$speciality);
        $stmt->execute();
    
        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_doctor_username(object $pdo,string $username){
        $query="SELECT username FROM tbl_doctors WHERE username=:username;";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":username",$username);
        $stmt->execute();
    
        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function fetch_email(object $pdo,string $email){
        $query="SELECT email_address FROM tbl_doctors WHERE email_address=:email;";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":email",$email);
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

    function get_specific_doctor(object $pdo,int $doctor_id){
        $query="SELECT d.name,d.email_address,d.phoneNumber,d.availability_status,s.speciality_name FROM tbl_doctors d 
                JOIN tbl_speciality s ON d.speciality = s.speciality_id
                WHERE d.doctor_id=:doctor_id;";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":doctor_id",$doctor_id);
        $stmt->execute();
    
        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
?>