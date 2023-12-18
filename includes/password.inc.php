<?php
    

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $password=$_POST['pwd'];
        $confirm_password=$_POST['c_pwd'];
        $token=$_POST['token'];

        try{
            require_once './database_config.php';
            require_once './patient_model.php';
            require_once './doctors_model.php';
            require_once './doctor_controller.php';
            require_once './patient_controller.php';
            require_once './registration_controller.php';
            require_once '../includes/login_model.php';

            $errors=[];

            $user_id;

            if(!passwords_match($password,$confirm_password)){
                $errors['password_match'] = 'Passwords do not match';
            }

            $role_result=get_user_from_token($conn,$token);

            if($role_result){
                $user_type=$role_result['role'];
                $username=$role_result['username'];
                if($user_type == 'Doctor'){

                    $result=get_doctor($conn,$username);
                    $user_id=$result['doctor_id'];
                    if(does_doctor_valid($result)){
                        $errors['doctor_invalid'] = 'Doctor does not exist';
                    }
                    require_once 'config_session.inc.php';
        
                    reset_password($conn,$password,$user_id);

                    header('Location: ../login.php');
                }else if($user_type == 'Patient'){
                    $result=fetch_patient($conn,$username);

                    $user_id=$result['patient_id'];

                    if(does_patient_exist($result)){
                        $errors['patient_invalid'] = 'Patient does not exist';
                    }
    
                    require_once 'config_session.inc.php';
    
                    update_password($conn,$password,$user_id);

                    header('Location: ../login.php');
                }else if($user_type == 'Admin'){
                    $result=get_admin($conn,$username);

                    $user_id=$result['admin_id'];

                    if(does_patient_exist($result)){
                        $errors['admin_invalid'] = 'Admin does not exist';
                    }
    
                    require_once 'config_session.inc.php';

                    update_admin_password($conn,$password,$user_id);

                    header('Location: ../login.php');
                }
            }else{
                $errors["invalid_token"]="Token does not exist";
            }
            if($errors){
                $_SESSION['reset_errors']=$errors;
                header('Location: ../login.php');
                die();
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