<?php
    

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $speciality=$_POST['speciality_name'];
        $speciality_description=$_POST['speciality_description'];
        $speciality_id= (int) $_POST['speciality_id'];
        try{
            require_once './database_config.php';
            require_once './speciality_controller.php';
            require_once './speciality_modal.php';

            $errors=[];

            if(is_speciality_input_empty($speciality,$speciality_description)){
                $errors['empty_input'] = 'Please fill all fields';
            }

            $result=fetch_speciality($conn,$speciality_id);

            if(check_speciality_exists($result)){
                $errors['speciality_invalid'] = 'Speciality does not exist';
            }
            require_once 'config_session.inc.php';

            if(isset($_SESSION["user_id"])){
                update_speciality_details($conn,$speciality,$speciality_description, $speciality_id);
            }else{
                header('Location: ../login.php');
            }
            

            if($errors){
                $_SESSION['profile_errors']=$errors;
                header('Location: ../src/AdminModule/settings.php');
                die();
            }

            header('Location: ../src/AdminModule/settings.php');

            $conn=null;
            $stmt=null;         
            die();
        }catch(PDOException $e){
            echo "Could not Update Patient: Error".$e->getMessage();
        }
    }else{
        echo "Could not update Patient.";
        header('Location: ../src/AdminModule/settings.php');
    }

?>