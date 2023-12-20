<?php
    

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        try{
            require_once './database_config.php';
            require_once './speciality_controller.php';
            require_once './speciality_modal.php';

            if(isset($_POST['speciality_id'])){
                $speciality_id= (int) $_POST['speciality_id'];

                require_once "../includes/config_session.inc.php"; 

                $result=fetch_speciality($conn,$speciality_id);

                if($result){
                    $speciality_details=array(
                        "speciality_name"=>$result['speciality_name'],
                        "speciality_id"=>$result["speciality_id"],
                        "speciality_description"=>$result['speciality_description'],
                    );
                    $jsonDetails=json_encode($speciality_details);

                    echo $jsonDetails;
                }else{
                    echo "Speciality not found";    
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