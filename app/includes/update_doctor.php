<?php
    

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $name=$_POST['fullName'];
        $emailAddress=$_POST['emailAddress'];
        $phoneNumber=$_POST['phoneNumber'];
        $doctor_id= (int) $_POST['doctor_id'];
        try{
            require_once './database_config.php';
            require_once './doctor_controller.php';
            require_once './doctors_model.php';

            $errors=[];

            if(validate_doctor_field($name,$emailAddress,$phoneNumber)){
                $errors['empty_input'] = 'Please fill all fields';
            }

            $result=get_specific_doctor($conn,$doctor_id);

            if(does_doctor_valid($result)){
                $errors['doctor_invalid'] = 'Doctor does not exist';
            }
            require_once 'config_session.inc.php';

            if(isset($_SESSION["user_id"])){
                update_doctor_profile($conn,$name,$emailAddress,$phoneNumber, $doctor_id);
            }else{
                header('Location: ../login.php');
            }
            

            if($errors){
                $_SESSION['profile_errors']=$errors;
                header('Location: ../src/DoctorModule/profile.php');
                die();
            }

            header('Location: ../src/DoctorModule/profile.php');

            $conn=null;
            $stmt=null;         
            die();
        }catch(PDOException $e){
            echo "Could not Update Doctor: Error".$e->getMessage();
        }
    }else{
        echo "Could not update Doctor.";
        header('Location: ../src/DoctorModule/profile.php');
    }

?>