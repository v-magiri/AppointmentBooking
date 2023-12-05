<?php
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $token=$_POST['token'];
            try{
                require_once './database_config.php';
                require_once './token_controller.php';
                require_once './token_model.php';

                $errors=[];

                $result=fetch_token($conn,$token);

                if(does_token_exist($result)){
                    $errors['token_does_not_exist']="Token does not exist";
                }
                
            require_once '../includes/config_session.inc.php';
            
            if($errors){
                $_SESSION['token_errors']=$errors;
                header('Location: ../verify_account.php');
                die();
            }
            confirm_token($conn,$token);
            
            header('Location: ../set_password.php?id='.$result['user_id']);
            
            $conn=null;
            $stmt=null;         
            die();
            }catch(PDOException $e){
                die("Query Failed ".$e -> getMessage());
            }
        }else{
            header("Location: ../verify_account.php");
        }    
?>