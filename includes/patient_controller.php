<?php
    declare(strict_types=1);

    function is_update_input_empty(string $firstName,string $lastName,string $email,string $phone){
        if(empty($firstName) || empty($lastName) || empty($email) || empty($phone)){
            return true;
        }else{
            return false;
        }
    }

    function update_patient_details(object $pdo,string $firstName,string $lastName,string $email,string $phone,int $patient_id){
        update_patient($pdo,$firstName,$lastName,$email,$phone,$patient_id);
    }

    function does_patient_exist(bool|array $result){
        if(!$result){
            return true;
        }else{
            return false;
        }
    }
?>