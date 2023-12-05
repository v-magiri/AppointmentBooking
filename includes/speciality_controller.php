<?php
    declare(strict_types= 1);

    function is_speciality_input_empty(string $name,string $description){
        if(empty($name) || empty($description)){
            return true;
        }else{
            return false;
        }
    }

    function does_speciality_exist(object $pdo,string $speciality){
        if(get_speciality($pdo, $speciality)){
            return true;
        }else {
            return false;
        }
    }

    function create_speciality(object $pdo,string $speciality,string $speciality_description){
        add_speciality($pdo, $speciality, $speciality_description);
    }

    function check_speciality_exists(bool|array $result){
        if(!$result){
            return true;
        }else{
            return false;
        }
    }

    function delete_speciality_details($pdo,int $speciality){
        delete_speciality($pdo,$speciality);
    }
?>