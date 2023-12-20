<?php
    

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        try{
            require_once './database_config.php';
            require_once './doctor_controller.php';
            require_once './doctors_model.php';

            if(isset($_POST['doctorId'])){
                $doctor_id= (int) $_POST['doctorId'];
                $result=get_specific_doctor($conn,$doctor_id);
                if($result){
                    $doctorDetails=array(
                        "name"=>$result['name'],
                        "speciality"=>$result['speciality_name'],
                        "availability"=> $result["availability_status"],
                        "email_address"=> $result["email_address"],
                        "phoneNumber"=> $result["phoneNumber"],
                    );
                    $jsonDetails=json_encode($doctorDetails);
                    echo $jsonDetails;
                }else{
                    echo "Doctor not found";    
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