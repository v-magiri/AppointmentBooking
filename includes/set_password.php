<?php
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $password=$_POST['password'];
            $c_password=$_POST['c_password'];
            $doctor_id=(int) $_POST['doctor_id'];

            try{
                require_once './database_config.php';
                require_once './doctor_controller.php';
                require_once './registration_controller.php';
                require_once './doctors_model.php';

                $errors=[];

                $result=get_specific_doctor($conn,$doctor_id);

                if(does_doctor_valid($result)){
                    $errors['doctor_invalid']='Doctor does not exist';
                }

                if(!passwords_match($password,$c_password)){
                    $errors['password_do_not_match']="Passwords do not match";
                }
                
                require_once '../includes/config_session.inc.php';
                
                if($errors){
                    $_SESSION['password_errors']=$errors;
                    header('Location: ../set_password.php?id='.$doctor_id);
                    die();
                }

                set_password($conn,$password,$doctor_id);

                header('Location: ../login.php');
                
                $conn=null;
                $stmt=null;         
                die();
            }catch(PDOException $e){
                die("Query Failed ".$e -> getMessage());
            }
        }else{
            header("Location: ../set_password.php");
        }    
?>