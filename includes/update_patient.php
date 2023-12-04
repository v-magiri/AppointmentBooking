<?php
    

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $firstName=$_POST['firstName'];
        $lastName=$_POST['lastName'];
        $emailAddress=$_POST['emailAddress'];
        $phoneNumber=$_POST['phoneNumber'];
        $patient_id= (int) $_POST['patient_id'];
        try{
            require_once './database_config.php';
            require_once './appointment_controller.php';
            require_once './appointment_model.php';

            $errors=[];

            if(is_appointment_input_empty($updated_date,$updated_time)){
                $errors['empty_input'] = 'Please fill all fields';
            }

            $result=get_appointment($conn,$appointment_id);

            if(does_appointment_exist($result)){
                $errors['appointment_does_exist'] = 'Appointment does not exist';
            }
            require_once 'config_session.inc.php';

            if(isset($_SESSION["user_id"])){
                update_appointment($conn,$updated_date,$updated_time,$appointment_id);
            }else{
                header('Location: ../login.php');
            }
            

            if($errors){
                $_SESSION['appointment_errors']=$errors;
                redirect_user();
                die();
            }

            redirect_user();

            $conn=null;
            $stmt=null;         
            die();
        }catch(PDOException $e){
            echo "Could not reschedule Appointment: Error".$e->getMessage();
        }
    }else{
        echo "Could not reschedule Appointment.";
        redirect_user();
    }

?>