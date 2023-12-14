<?php
    

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        try{
            require_once './database_config.php';
            require_once './appointment_controller.php';
            require_once './appointment_model.php';

            if(isset($_POST['appointment'])){
                $appointment = (int) $_POST['appointment'];
                $status = $_POST['status'];

                $result=read_appointment($conn,$appointment);

                if(!does_appointment_exist($result)){
                    echo update_appointment_status($conn,$appointment,$status);
                }else{
                    echo "Appointment does not exist";    
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