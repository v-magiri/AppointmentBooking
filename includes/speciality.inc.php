<?php
    declare(strict_types= 1);

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $speciality=$_POST['speciality_name'];
        $speciality_description=$_POST['speciality_description'];

        try{

            require_once './database_config.php';
            require_once './speciality_controller.php';
            require_once './speciality_modal.php';

            $errors=[];

            if(is_speciality_input_empty($speciality,$speciality_description)){
                $errors['empty_input'] = 'Please fill all fields';
            }
            if(does_speciality_exist($conn,$speciality)){
                $errors['email_taken'] = 'Email is already registered';
            }

            require_once './config_session.inc.php';

            if($errors){
                $_SESSION['speciality_errors']=$errors;
                header("Location:../src/AdminModule/settings.php");
                die();
            }
            create_speciality($conn,$speciality,$speciality_description);
            header('Location:../src/AdminModule/settings.php');
            
            $conn=null;
            $stmt=null;
            die();
        }catch(PDOException $e){
            die("Query Failed ".$e -> getMessage());
        }
    }else{
        header("Location: ../src/AdminModule/settings.php");
    }    
?>