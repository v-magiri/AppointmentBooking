<?php
    //validate request

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $firstName=$_POST['firstName'];
        $lastName=$_POST['lastName'];
        $email=$_POST['emailAddress'];
        $phoneNumber=$_POST['phoneNumber'];
        $user_password=$_POST['pwd'];
        $confirm_password=$_POST['confirm_password'];
        $patient_username=$_POST['username'];

        try{
            require_once 'database_config.php';
            require_once 'registration_controller.php';
            require_once 'registration_model.php';

            $errors=[];

            if(is_input_empty($firstName,$lastName,$email,$phoneNumber,$user_password,$patient_username)){
                $errors['empty_input'] = 'Please fill all fields';
            }
            if(!is_email_valid($email)){
                $errors['email_invalid'] = 'Email is invalid';
            }
            if(!is_phone_valid($phoneNumber)){
                $errors['phone_invalid'] = 'Phone number is invalid';
            }
            if(is_username_taken($conn,$patient_username)){
                $errors['username_taken'] = 'Username is already taken';
            }
            if(is_email_taken($conn,$patient_username)){
                $errors['email_taken'] = 'Email is already registered';
            }
            if(!passwords_match($user_password,$confirm_password)){
                $errors['password_match'] = 'Passwords do not match';
            }

            require_once 'config_session.inc.php';

            if($errors){
                $_SESSION['signup_errors']=$errors;
                header("Location:../signup.php");
                die();
            }
            create_patient($conn,$firstName,$lastName,$email,$phoneNumber,$user_password,$patient_username);
            header("Location: ../login.php");

            $conn=null;
            $stmt=null;
            die();

        }catch(PDOException $e){
            die("Query Failed ".$e -> getMessage());
        }
    }else{
        header("Location:../index.php");
    }
?>
