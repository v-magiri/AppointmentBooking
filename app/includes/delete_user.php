<?php
    

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $user_id=(int)$_POST['user_id'];
        $user_type=$_POST['user_type'];
        try{
            require_once './database_config.php';
            require_once './doctors_model.php';
            require_once './patient_model.php';
            require_once './patient_controller.php';

            $errors=[];

            if($user_type == 'Doctor'){
                $result=get_specific_doctor($conn,$user_id);
                
            }else{
                $result=get_patient($conn,$user_id);
            }

            if(does_patient_exist($result)){
                $errors['user_does_exist'] = 'User does not exist';
                header('Location:../src/AdminModule/doctors.php');
                die();
            }

            if($user_type == 'Doctor'){
                deleteDoctor( $conn,$user_id );
                header('Location:../src/AdminModule/doctors.php');
                die();        
            }else{
                deletePatient($conn,$user_id);
                header('Location:../src/AdminModule/patient.php');
                die();
            }

            require_once './config_session.inc.php';

            if($errors){
                $_SESSION['deletion_errors']=$errors;
                if($user_type == 'Doctor'){
                    header('Location: ../src/AdminModule/doctors.php');
                }else{
                    header('Location: ../src/AdminModule/patient.php');
                }
                
                die();
            }

            
            $conn=null;
            $stmt=null;         
            die();
        }catch(Exception $e){
            echo "Could not delete User: Error".$e->getMessage();
        }
    }


?>