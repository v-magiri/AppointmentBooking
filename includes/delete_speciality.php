<?php
    

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $speciality_id=(int)$_POST['speciality_id'];
        try{
            require_once './database_config.php';
            require_once './speciality_controller.php';
            require_once './speciality_modal.php';

            $errors=[];

            $result=fetch_speciality($conn,$speciality_id);

            if(check_speciality_exists($result)){
                $errors['speciality_does_exist'] = 'Speciality does not exist';
            }

            require_once '../includes/config_session.inc.php';

            if(isset($_SESSION['user_id'])){
                delete_speciality_details($conn,$speciality_id);
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