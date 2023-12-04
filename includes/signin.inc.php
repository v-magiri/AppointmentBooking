<?php
    //validate the request
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $user_password=$_POST['user_password'];
        $user_name=$_POST['user_name'];

        try{

            require_once '../includes/database_config.php';
            require_once '../includes/login_controller.php';
            require_once '../includes/login_model.php';
            
            
            $errors=[];

            if(input_empty($user_name, $user_password)){
                $errors['empty_input'] = 'Please fill all fields';
            }

            //get The role of the user
            $role_result=get_user_type($conn,$user_name);

            $result=[];

            if($role_result["role"] === "Doctor"){
                $result=get_doctor($conn,$user_name);
            }else if($role_result["role"] === "Patient"){
                $result=get_patient($conn,$user_name);
            }else if($role_result["role"] === "Admin"){
                $result=get_admin($conn,$user_name);
            }

            

            if(verify_username($result)){
                $errors['username_invalid'] = 'Username does not exist';
            }

            if(!verify_username($result) && verify_password($user_password,$result["password"])){
                $errors['password_invalid']= 'Password is invalid';
        
            }

            require_once "../includes/config_session.inc.php"; 

            //check in case there are errors
            if($errors){
                $_SESSION['errors_login']=$errors;
                header("Location:../login.php");
                die();
            }

            //require the session 

            $new_session_id=session_create_id();
            $session_id;
            if($role_result["role"] === "Admin"){
                $session_id= $new_session_id . "_" . $result["admin_id"];
                $_SESSION['user_id']=$result['admin_id'];
                $_SESSION['user_name']= htmlspecialchars($result['admin_username']);
                $_SESSION['user_type']= 'Admin';
                $_SESSION['name']= 'Administrator';
            }else if($role_result["role"] === "Doctor"){
                $session_id= $new_session_id ."_". $result["doctor_id"];
                $_SESSION['user_id']=$result['doctor_id'];
                $_SESSION['user_name']= htmlspecialchars($result['username']);
                $_SESSION['user_type']= 'Doctor';
                $_SESSION['name']= $result['name'];
            }else if($role_result["role"] === "Patient"){
                $session_id= $new_session_id ."_". $result["patient_id"];
                $_SESSION['user_id']=$result['patient_id'];
                $_SESSION['user_name']= htmlspecialchars($result['username']);
                $_SESSION['name']= $result['firstName'].' '.$result['lastName'];
                $_SESSION['user_type']= 'Patient';
            }
            
            session_id($session_id);

            $_SESSION['last_regeneration']=time();

            //redirect to various screens depending on the role

            if($role_result["role"] === "Doctor"){
                header("Location: ../src/DoctorModule/home.php?login=success");
            }else if($role_result["role"] === "Patient"){
                header("Location: ../src/PatientModule/home.php?login=success");
            }else if($role_result["role"] === "Admin"){
                header("Location: ../src/AdminModule/home.php?login=success");
            }
            

            $conn=null;
            $stmt=null;         
            die();
        }catch(PDOException $e){
            die("Query Failed ".$e -> getMessage());
        }
    }else{
        header("Location: ../login.php");
    }


?>