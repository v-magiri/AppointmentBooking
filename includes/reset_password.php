<?php
    

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $password=$_POST['pwd'];
        $confirm_password=$_POST['c_pwd'];
        $user_id= (int) $_POST['user_id'];
        $user_type=$_POST["role"];
        try{
            require_once './database_config.php';
            require_once './patient_model.php';
            require_once './doctors_model.php';
            require_once './doctor_controller.php';
            require_once './patient_controller.php';
            require_once './registration_controller.php';

            $errors=[];

            if(!passwords_match($password,$confirm_password)){
                $errors['password_match'] = 'Passwords do not match';
            }

            if($user_type == 'Doctor'){
                $result=get_specific_doctor($conn,$user_id);

                if(does_doctor_valid($result)){
                    $errors['doctor_invalid'] = 'Doctor does not exist';
                }
                require_once 'config_session.inc.php';
    
                if(isset($_SESSION["user_id"])){
                    reset_password($conn,$password,$user_id);
                    header('Location:../src/DoctorModule/profile.php');
                }else{
                    header('Location: ../login.php');
                }
            }else{
                $result=fetch_patient($conn,$user_id);

                if(does_patient_exist($result)){
                    $errors['patient_invalid'] = 'Patient does not exist';
                }

                require_once 'config_session.inc.php';

                if(isset($_SESSION["user_id"])){
                    update_password($conn,$password,$user_id);
                    header('Location:../src/PatientModule/profile.php');
                }else{
                    header('Location: ../login.php');
                }
            }

            $conn=null;
            $stmt=null;         
            die();
        }catch(PDOException $e){
            echo "Could not Reset Password: Error".$e->getMessage();
        }
    }else{
        echo "Could not change Password.";
        header('Location: ../login.php');
    }

?>