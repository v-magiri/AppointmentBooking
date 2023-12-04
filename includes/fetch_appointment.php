<?php
    

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        try{
            require_once './database_config.php';
            require_once './appointment_controller.php';
            require_once './appointment_model.php';

            if(isset($_POST['appointment_id'])){
                $appointment_id= (int) $_POST['appointment_id'];
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
            }

            $conn=null;
            $stmt=null;         
            die();
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

?>