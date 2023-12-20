<?php
    

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        try{
            require_once './database_config.php';
            require_once './appointment_controller.php';
            require_once './appointment_model.php';
            require_once './patient_model.php';
            require_once './email_service.php';

            if(isset($_POST['appointment'])){
                $appointment = (int) $_POST['appointment'];
                $status = $_POST['status'];

                $result=read_appointment($conn,$appointment);

                if(!does_appointment_exist($result)){
                    if($status == 'Accepted'){
                        if(update_appointment_status($conn,$appointment,$status) == true){
                            echo create_appointment_session($conn,$result);
                        }                           
                    }else{
                        echo update_appointment_status($conn,$appointment,$status);
                    }
                    send_status_email($appointment,$status,$conn,$result['date'],$result['$patient_id']);
                }else{
                    echo "Appointment does not exist";    
                }
            }

            redirect_user();

            $conn=null;
            $stmt=null;         
            die();
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

?>