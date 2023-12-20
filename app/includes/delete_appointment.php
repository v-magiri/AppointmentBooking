<?php
    

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $appointment_id=(int)$_POST['appointment_id'];
        try{
            require_once './database_config.php';
            require_once './appointment_controller.php';
            require_once './appointment_model.php';

            $errors=[];

            $result=get_appointment($conn,$appointment_id);

            if(does_appointment_exist($result)){
                $errors['appointment_does_exist'] = 'Appointment does not exist';
            }

            require_once '../includes/config_session.inc.php';

            if(isset($_SESSION['user_id'])){
                delete_appointment_details($conn,$appointment_id);
            }else{
                header('Location: ../login.php');
                die();
            }

            if($errors){
                $_SESSION['deletion_errors']=$errors;
                redirect_user();
                die();
            }

            redirect_user();
            
            $conn=null;
            $stmt=null;         
            die();
        }catch(Exception $e){
            echo "Could not delete Appointment: Error".$e->getMessage();
        }
    }


?>