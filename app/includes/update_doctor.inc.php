<?php
    

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $name=$_POST['fullName'];
        $emailAddress=$_POST['emailAddress'];
        $phoneNumber=$_POST['phoneNumber'];
        $doctor_id= (int) $_POST['doctor_id'];
        $speciality=$_POST['speciality'];

        try{
            require_once './database_config.php';
            require_once './doctor_controller.php';
            require_once './doctors_model.php';

            $errors=[];

            if(is_form_input_empty($name,$emailAddress,$phoneNumber,$speciality)){
                $errors['empty_input'] = 'Please fill all fields';
            }

            $result=get_specific_doctor($conn,$doctor_id);

            if(does_doctor_valid($result)){
                $errors['doctor_invalid'] = 'Doctor does not exist';
            }
            require_once './config_session.inc.php';

            if(isset($_SESSION["user_id"])){
                update_doctor_details($conn,$name,$emailAddress,$phoneNumber, $doctor_id,$speciality);
            }else{
                header('Location: ../login.php');
            }
            

            if($errors){
                $_SESSION['profile_errors']=$errors;
                header('Location: ../src/AdminModule/doctors.php');
                die();
            }

            header('Location: ../src/AdminModule/doctors.php');

            $conn=null;
            $stmt=null;         
            die();
        }catch(PDOException $e){
            echo "Could not Update Doctor: Error".$e->getMessage();
        }
    }else{
        echo "Could not update Doctor.";
        header('Location: ../src/AdminModule/doctors.php');
    }

?>