<?php
    declare(strict_types= 1);

    function get_speciality(object $pdo,string $speciality){
        $query="SELECT speciality_name FROM tbl_speciality WHERE speciality_name=:speciality;";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":speciality",$speciality);
        $stmt->execute();
    
        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function fetch_speciality(object $pdo,int $speciality){
        $query="SELECT * FROM tbl_speciality WHERE speciality_id=:speciality;";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":speciality",$speciality);
        $stmt->execute();
    
        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function add_speciality(object $pdo,string $speciality,string $specialityDescription){
        $query="INSERT INTO tbl_speciality (speciality_name,speciality_description) VALUES
                (:name,:description);";
        $stmt=$pdo->prepare($query);

        $stmt->bindParam(":name",$speciality);
        $stmt->bindParam(":description",$specialityDescription);
        $stmt->execute();

        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function delete_speciality(object $pdo,int $speciality){
        $query = "DELETE FROM tbl_speciality WHERE speciality_id = :speciality";
        // Use prepared statements to prevent SQL injection
        $stmt = $pdo->prepare($query);
        // Bind parameters
        $stmt->bindParam(':speciality', $speciality);
        // Execute the query
        $stmt->execute();
        if($stmt->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }

    function update_speciality(object $pdo,string $speciality,string $specialityDescription,int $id){
        $query= "UPDATE tbl_speciality SET speciality_name = :updated_name,speciality_description = :updated_description
                 WHERE speciality_id = :speciality_id";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":speciality_id",$id);
        $stmt->bindParam(":updated_name",$speciality);
        $stmt->bindParam(":updated_description",$specialityDescription);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }

    }
?>