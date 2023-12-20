<?php
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $user_name = $_POST['user_name'];

        try{
            require_once '../includes/database_config.php';
            require_once '../includes/login_model.php';
            require_once './email_service.php';
            require_once '../includes/login_controller.php';

            $errors=[];
            //get The role of the user
            $role_result=get_user_type($conn,$user_name);
            
            $result=[];
            $emailAddress;
            $user_id;
            if(verify_username($result)){
                if($role_result["role"] === "Doctor"){
                    $result=get_doctor($conn,$user_name);
                    $emailAddress=$result['email_address'];
                }else if($role_result["role"] === "Patient"){
                    $result=fetch_patient($conn,$user_name);
                    $emailAddress=$result['emailAddress'];
                }else if($role_result["role"] === "Admin"){
                    $result=get_admin($conn,$user_name);
                    $emailAddress=$result['email_address'];
                }
                if(verify_username($result)){
                    $errors['username_invalid'] = 'User does not exist';
                }
        
                // echo "Password reset instructions sent to your email.";
            }else{
                $errors['invalid_user_name'] = 'Username does not exist';
            }

            require_once './config_session.inc.php';

            if($errors){
                $_SESSION['reset_errors']=$errors;
                header('Location: ../forgot-password.php');
                die();
            }

            // Generate a random token
            $token = bin2hex(random_bytes(10));;

            create_password_reset_token($conn,$token,$user_name);
    
            // Send email with the reset link
            $resetLink = "http://localhost/portal/reset_password.php?token=$token";
            $to = $emailAddress;
            $subject = "Password Reset";
            $message = "Click the following link to reset your password: $resetLink";

            sendEmail($to,$subject,$message);
            header('Location: ../forgot-password.php');

            $conn=null;
            $stmt=null;
            die();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
?>