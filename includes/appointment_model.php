<?php
    declare(strict_types= 1);

    function save_appointment(object $pdo,string $date,string $time,string $appointment_reason,int $patient_id,int $doctor_id){
        $query="INSERT INTO tbl_appointments (date,time,appointment_reason,patient_id,doctor) VALUES
        (:date,:time,:appointment_reason,:patient_id,:doctor);";
        $stmt=$pdo->prepare($query);

        $stmt->bindParam(":date",$date);
        $stmt->bindParam(":time",$time);
        $stmt->bindParam(":appointment_reason",$appointment_reason);
        $stmt->bindParam(":patient_id",$patient_id);
        $stmt->bindParam(":doctor",$doctor_id);
        $stmt->execute();
    
        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_doctor(object $pdo,int $doctor_id){
        $query="SELECT *  FROM tbl_doctors WHERE doctor_id=:id;";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":id",$doctor_id);
        $stmt->execute();
    
        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_appointment(object $pdo,int $appointment_id){
        $query="SELECT a.appointment_id,a.date,a.time,a.appointment_reason,d.name FROM tbl_appointments a 
        JOIN tbl_doctors d ON a.doctor = d.doctor_id
        WHERE a.appointment_id=:appointment_id;";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":appointment_id",$appointment_id);
        $stmt->execute();

        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function reschedule_appointment(object $pdo,int $appointment_id,string $date,string $time){
        $query= "UPDATE tbl_appointments SET date = :updated_date,time = :updated_time WHERE appointment_id = :appointment_id";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":appointment_id",$appointment_id);
        $stmt->bindParam(":updated_date",$date);
        $stmt->bindParam(":updated_time",$time);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    
    function delete_appointment(object $pdo, int $appointment_id){
        $query = "DELETE FROM tbl_appointments WHERE appointment_id = :appointment_id";
        // Use prepared statements to prevent SQL injection
        $stmt = $pdo->prepare($query);
        // Bind parameters
        $stmt->bindParam(':appointment_id', $appointment_id);
        // Execute the query
        $stmt->execute();
        if($stmt->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }
?>
