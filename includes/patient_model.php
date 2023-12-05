<?php
    declare(strict_types=1);

    function get_patient(object $pdo,int $patient_id){
        $query="SELECT * FROM tbl_patients WHERE patient_id=:patient_id;";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":patient_id",$patient_id);
        $stmt->execute();

        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function update_patient(object $pdo,string $firstName,string $lastName,string $email,string $phone,int $patient_id){
        $query= "UPDATE tbl_patients SET firstName = :updated_firstName,lastName = :updated_lastName,emailAddress= :updated_email,phoneNumber = :updated_phone WHERE patient_id = :patient_id";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":patient_id",$patient_id);
        $stmt->bindParam(":updated_firstName",$firstName);
        $stmt->bindParam(":updated_lastName",$lastName);
        $stmt->bindParam(":updated_email",$email);
        $stmt->bindParam(":updated_phone",$phone);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }

    }

    function delete_patient(){

    }
?>