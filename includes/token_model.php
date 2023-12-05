<?php
    declare(strict_types= 1);

    function fetch_token(object $pdo,string $token){
        $query="SELECT *  FROM tbl_account_tokens WHERE token=:token;";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":token",$token);
        $stmt->execute();
    
        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function verify_token(object $pdo,string $token,string $timestamp){
        $query= "UPDATE tbl_account_tokens SET verified_at = :timestamp WHERE token = :token";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":timestamp",$timestamp);
        $stmt->bindParam(":token",$token);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
?>