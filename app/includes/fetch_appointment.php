<?php
    

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        try{
            require_once './database_config.php';
            require_once './appointment_controller.php';
            require_once './appointment_model.php';

            if(isset($_POST['appointment_id'])){
                $appointment_id= (int) $_POST['appointment_id'];

                require_once "../includes/config_session.inc.php"; 

                if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Doctor'){
                    $result=fetch_appointment($conn,$appointment_id);
                    if($result){
                        $appointment_details=array(
                            "date"=>$result['date'],
                            "time"=>$result['time'],
                            "reason"=> $result["appointment_reason"],
                            "patient_name"=> $result["NAME"],
                        );
                        $jsonDetails=json_encode($appointment_details);

                        echo $jsonDetails;
                    }else{
                        echo "Appointment not found";    
                    }
                }else if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Patient'){
                    $result=get_appointment($conn,$appointment_id);
                    if($result){
                        $appointment_details=array(
                            "date"=>$result['date'],
                            "time"=>$result['time'],
                            "reason"=> $result["appointment_reason"],
                            "name"=> $result["name"],
                        );
                        $jsonDetails=json_encode($appointment_details);
                        echo $jsonDetails;
                    }else{
                        echo "Appointment not found";    
                    }
                }else if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Admin'){
                    $result=read_appointment($conn,$appointment_id);
                    if($result){
                        $appointment_details=array(
                            "date"=>$result['date'],
                            "time"=>$result['time'],
                            "reason"=> $result["appointment_reason"],
                            "name"=> $result["name"],
                            "patient_name"=>$result["patient_name"],
                        );
                        $jsonDetails=json_encode($appointment_details);
                        echo $jsonDetails;
                    }else{
                        echo "Appointment not found";    
                    }
                }
            }

            $conn=null;
            $stmt=null;         
            die();
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

?>