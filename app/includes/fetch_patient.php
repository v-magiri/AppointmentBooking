<?php
    

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        try{
            require_once './database_config.php';
            require_once './patient_controller.php';
            require_once './patient_model.php';

            if(isset($_POST['patient_id'])){
                $patient_id= (int) $_POST['patient_id'];
                $result=get_patient($conn,$patient_id);
                if($result){
                    $patientDetails=array(
                        "firstName"=>$result['firstName'],
                        "lastName"=>$result['lastName'],
                        "username"=> $result["username"],
                        "email_address"=> $result["emailAddress"],
                        "phoneNumber"=> $result["phoneNumber"],
                    );
                    $jsonDetails=json_encode($patientDetails);
                    echo $jsonDetails;
                }else{
                    echo "Patient not found";    
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