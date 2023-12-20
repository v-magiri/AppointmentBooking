<?php
    

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $firstName=$_POST['firstName'];
        $lastName=$_POST['lastName'];
        $emailAddress=$_POST['emailAddress'];
        $phoneNumber=$_POST['phoneNumber'];
        $patient_id= (int) $_POST['patient_id'];
        try{
            require_once './database_config.php';
            require_once './patient_controller.php';
            require_once './patient_model.php';

            $errors=[];

            if(is_update_input_empty($firstName,$lastName,$emailAddress,$phoneNumber)){
                $errors['empty_input'] = 'Please fill all fields';
            }

            $result=get_patient($conn,$patient_id);

            if(does_patient_exist($result)){
                $errors['patient_invalid'] = 'Patient does not exist';
            }
            require_once 'config_session.inc.php';

            if(isset($_SESSION["user_id"])){
                update_patient_details($conn,$firstName,$lastName,$emailAddress,$phoneNumber, $patient_id);
            }else{
                header('Location: ../login.php');
            }
            

            if($errors){
                $_SESSION['profile_errors']=$errors;
                header('Location: ../src/PatientModule/profile.php');
                die();
            }

            header('Location: ../src/PatientModule/profile.php');

            $conn=null;
            $stmt=null;         
            die();
        }catch(PDOException $e){
            echo "Could not Update Patient: Error".$e->getMessage();
        }
    }else{
        echo "Could not update Patient.";
        header('Location: ../src/PatientModule/profile.php');
    }

?>