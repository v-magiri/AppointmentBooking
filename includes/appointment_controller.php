<?php
    declare(strict_types= 1);

    function is_input_empty(string $date,string $time,string $appointment_reason){
        if(empty($date) || empty($time) || empty($appointment_reason)){
            return true;
        }else{
            return false;
        }
    }

    // check the schedule of the doctor

    function is_doctor_available(int $availability_status){
        if($availability_status == 1){
            return true;
        }else{
            return false;
        }
    }

    function does_doctor_exist(bool|array $result){
        if(!$result){
            return true;
        }else{
            return false;
        }
    }

    function create_appointment(object $pdo,string $appointment_date,string $time,string $appointment_reason, int $doctor_id,int $patient_id){
        save_appointment($pdo,$appointment_date,$time,$appointment_reason,$patient_id,$doctor_id);
    }

    function is_appointment_input_empty(string $date,string $time){
        if(empty($date) || empty($time)){
            return true;
        }else{
            return false;
        }
    }

    function does_appointment_exist(bool|array $result){
        if(!$result){
            return true;
        }else{
            return false;
        }
    }

    function update_appointment(object $pdo,string $date,string $time,int $appointment_id){
       return reschedule_appointment($pdo,$appointment_id,$date,$time);
    }

    function delete_appointment_details(object $pdo,int $appointment_id){
        delete_appointment($pdo, $appointment_id);
    }

    function redirect_user(){
        if(isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'Patient'){
            header('Location:../src/PatientModule/appointment.php');
        }else if(isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'Admin'){
            header('Location:../src/AdminModule/appointment.php');
        }else if(isset($_SESSION['user_type']) && $_SESSION['user_type']  === 'Doctor'){
            header('Location:../src/DoctorModule/appointment.php');
        }
    }


?>