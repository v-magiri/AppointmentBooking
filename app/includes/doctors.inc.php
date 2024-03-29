<?php
    declare(strict_types= 1);

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $fullName=$_POST['fullName'];
        $email=$_POST['emailAddress'];
        $phoneNumber=$_POST['phoneNumber'];
        $speciality=$_POST['speciality'];

        try{
            require_once 'database_config.php';
            require_once 'doctor_controller.php';
            require_once 'doctors_model.php';
            require_once './email_service.php';

            $errors=[];

            if(is_form_input_empty($fullName,$email,$phoneNumber,$speciality)){
                $errors['empty_input'] = 'Please fill all fields';
            }
            if(!check_email_validity($email)){
                $errors['email_invalid'] = 'Email is invalid';
            }
            if(is_email_registered($conn,$email)){
                $errors['email_taken'] = 'Email is already registered';
            }
            if(!check_phone_validity($phoneNumber)){
                $errors['phone_invalid'] = 'Phone number is invalid';
            }
            $extracted_lastName=explode(' ',strtolower($fullName));
        
            $username=strtolower(substr($fullName, 0, 1)).end($extracted_lastName);

            if(is_username_valid($conn,$username)){
                $errors['username_taken'] = 'Username is already taken';
            }

            require_once 'config_session.inc.php';

            if($errors){
                $_SESSION['registration_errors']=$errors;
                header("Location:../src/AdminModule/doctors.php");
                die();
            }

            $speciality=(int) $speciality;

            register_doctor($conn, $fullName, $email, $phoneNumber, $speciality,$username);

            $doctor_result=fetch_doctor($conn, $username);

            if(!does_doctor_valid($doctor_result)){
                // generate verification code 
                $verificationCode = bin2hex(random_bytes(10));
                saveToken($conn,$verificationCode,$doctor_result['doctor_id']);
                $email_subject="Account Created";
                $link="http://localhost/portal/verify_account.php?token=".$verificationCode;
               
                $email_message= "Hello ".$fullName.".\n Your account on the Appointment Booking portal has been created.Please access your account using the following link \n".$link."\n Please note your username is ".$username;

            }else{
                header("Location: ../src/AdminModule/doctors.php?registration=token_not_generated");
            }

            if(!sendEmail($email,$email_subject,$email_message)){
                header("Location: ../src/AdminModule/doctors.php?registration=email_not_sent");
            }


            header("Location: ../src/AdminModule/doctors.php?registration=success");

            $conn=null;
            $stmt=null;
            die();


        }catch(PDOException $e){
            die("Query Failed ".$e -> getMessage());
            // die();
        }
    }else{
        header("Location: ../src/AdminModule/doctors.php");
    }
?>