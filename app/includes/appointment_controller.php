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

    function send_reschedule_email(object $pdo,bool|array $result,string $updated_date,string $updated_time){
            $user_result=get_patient($pdo,$result['patient_id']);
            $patient_email_message="Hello ".$user_result['firstName']."Your appointment scheduled on ".$result['date']." at ".$result['time']." has been rescheduled to ".$updated_date." at ".$updated_time; 
            sendEmail($user_result['emailAddress'],"Appointment Rescheduled",$patient_email_message);
            $doctor_result=get_specific_doctor($pdo,$result['doctor']);
            $doctor_email_message="Hello ".$doctor_result['name']."Your appointment Booking scheduled on ".$result['date']." at ".$result['time']." has been rescheduled to ".$updated_date." at ".$updated_time;
            sendEmail($doctor_result['email_address'],"Appointment Rescheduled",$doctor_email_message);
    }

    function send_status_email(int $appointment_id,string $status,string $appointmentDate,object $pdo,int $patient_id){
        $user_result=get_patient($pdo,$patient_id);
        if($status == "Accepted"){
            $status_email="Hello ".$user_result['firstName'].",\n Your Appointment rescheduled on ".$appointmentDate." has been accepted by the doctor. Please avail yourself";
        }else{
            $status_email="Hello ".$user_result['firstName'].",\n Your Appointment rescheduled on ".$appointmentDate." has been rejected by the doctor.";
        }
        sendEmail($user_result['emailAddress'],"Appointment Status Update",$status_email);  
    }


?>