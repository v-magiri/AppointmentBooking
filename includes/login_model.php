<?php
    declare(strict_types= 1);

    function get_user_type(object $pdo,string $username){
        $query="SELECT *  FROM tbl_user_roles WHERE username=:username;";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":username",$username);
        $stmt->execute();
    
        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function fetch_patient(object $pdo,string $username){
        $query="SELECT *  FROM tbl_patients WHERE username=:username;";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":username",$username);
        $stmt->execute();
    
        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_doctor(object $pdo,string $username){
        $query="SELECT *  FROM tbl_doctors WHERE username=:username;";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":username",$username);
        $stmt->execute();
    
        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_admin(object $pdo,string $username){
        $query="SELECT *  FROM tbl_admin WHERE admin_username=:username;";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":username",$username);
        $stmt->execute();
    
        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function create_password_reset_token(object $pdo,string $token,string $username){
        $query="INSERT INTO tbl_password_reset_token (username,token,expires_at) VALUES
        (:user,:token,:expiry);";
        $stmt=$pdo->prepare($query);
        // Set token and expiry in the database
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $stmt->bindParam(":user",$username);
        $stmt->bindParam(":token",$token);
        $stmt->bindParam(":expiry",$expiry);
        $stmt->execute();

        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_user_from_token(object $pdo,string $token){
        $query="SELECT a.username,a.role  FROM tbl_user_roles a
                JOIN tbl_password_reset_token p ON p.username = a.username
                 WHERE p.token=:token;";

        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":token",$token);
        $stmt->execute();
    
        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function update_admin_password(object $pdo,$password,int $admin_id){
        $query= "UPDATE tbl_admin SET password = :updated_password WHERE admin_id = :admin_id";
        //hashing the password
        $hashingOptions=[
            "cost" => 12
        ];
        $hashedPwd=password_hash($password,PASSWORD_BCRYPT,$hashingOptions); 
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":admin_id",$admin_id);
        $stmt->bindParam(":updated_password",$hashedPwd);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

?>