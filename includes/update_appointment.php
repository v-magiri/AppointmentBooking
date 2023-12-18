<?php
    

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $updated_date=$_POST['appointment_date'];
        $updated_time=$_POST['appointment_time'];
        $appointment_id= (int) $_POST['appointment_id'];
        try{
            require_once './database_config.php';
            require_once './appointment_controller.php';
            require_once './appointment_model.php';
            require_once './doctors_model.php';
            require_once './patient_model.php';
            require_once './email_service.php';

            $errors=[];

            if(is_appointment_input_empty($updated_date,$updated_time)){
                $errors['empty_input'] = 'Please fill all fields';
            }

            $appointment_result=get_specific_appointment($conn,$appointment_id);

            if(does_appointment_exist($appointment_result)){
                $errors['appointment_does_exist'] = 'Appointment does not exist';
            }
            require_once 'config_session.inc.php';

            if(isset($_SESSION["user_id"])){
                update_appointment($conn,$updated_date,$updated_time,$appointment_id);
                send_reschedule_email($conn,$appointment_result,$updated_date,$updated_time);
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