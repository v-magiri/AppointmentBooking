<?php

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $date=$_POST['appointment_date'];
        $time=$_POST['appointment_time'];
        $appointment_reason=$_POST['appointment_reason'];
        $doctor=$_POST['doctor_id'];

        try{
            require_once 'database_config.php';
            require_once 'appointment_controller.php';
            require_once 'appointment_model.php';

            $errors=[];

            if(is_input_empty($date,$time,$appointment_reason,$doctor)){
                $errors['empty_input'] = 'Please fill all fields';
            }

            $result=get_doctor($conn,$doctor);

            if(!is_doctor_available($result['availability_status'])){
                $errors['doctor_not_available'] = 'Doctor is not Available';
            }
            if(does_doctor_exist($result)){
                $errors['doctor_does_exist'] = 'Doctor does not exist';
            }

            require_once 'config_session.inc.php';

            if($errors){
                $_SESSION['appointment_errors']=$errors;
                header("Location:../src/PatientModule/doctor.php");
                die();
            }

            if(isset($_SESSION["user_id"])){
                $patient_id= $_SESSION["user_id"];
                create_appointment($conn, $date, $time, $appointment_reason, $doctor,$patient_id);
            }else{
                header("Location: ../login.php");
            }

            header("Location: ../src/PatientModule/doctor.php?appointment=success");

            $conn=null;
            $stmt=null;
            die();


        }catch(PDOException $e){
            die("Query Failed ".$e -> getMessage());
        }
    }else{
        header("Location: ../src/PatientModule/doctors.php");
    }
    
?>