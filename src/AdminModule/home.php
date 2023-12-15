<?php
    require_once '../../includes/config_session.inc.php';
    require_once '../../includes/user_status.php';
    include('../../includes/database_config.php');

    if(isset($_SESSION["user_id"])){
        if(($_SESSION["user_id"]) == "" or $_SESSION['user_type'] != 'Admin'){
            header("location: ../../login.php");
        }

    }else{
        header("location: ../../login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">   
        <link href="../../styles/main.css" rel="stylesheet" type="text/css"/>  
        <link href="../../styles/styles_admin.css" rel="stylesheet" type="text/css"/>  
        <title>Appointment Boooking</title>
    </head>
    <body>
        <div class="main_content">
            <div class="sidebar">
                <div class="user-profile">
                    <img src="../../assets/user_icon.png" alt="Person Avatar">
                    <div class="user-info">
                        <?php
                            echo "<span class='nameTxt'>". get_name() . "</span>";
                            echo "<span class='usernameTxt'>". get_username() . "</span>";
                        ?> 

                    </div>
                </div>
                <ul class="menu">
                    <li class="active">
                        <a href="home.php">
                            <i class="fa-solid fa-house"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="doctors.php">
                            <i class="fa-solid fa-user-doctor"></i>
                            <span>Doctors</span>
                        </a>
                    </li>
                    <li>
                        <a href="patient.php">
                            <i class="fa-solid fa-hospital-user"></i>
                            <span>Patients</span>
                        </a>
                    </li>
                    <li>
                        <a href="appointment.php">
                            <i class="fa-solid fa-calendar-check"></i>
                            <span>Appointments</span>
                        </a>
                    </li>

                    
                    <li>
                        <a href="settings.php">
                            <i class="fa-solid fa-gear"></i>
                            <span>Setting</span>
                        </a>
                    </li>
                    <li>
                        <a href="../../includes/logout.inc.php">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Log out</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="board-wrapper">
                <div class="board_header">
                    <h4>Home</h4>
                    <div class="date-wrapper">
                        <div class="date_specs">
                            <span class="date_title">Today's Date</span>
                            <?php
                                $currentDate=date('Y-m-d');
                                echo "<span class='dateTxt'>". $currentDate .'</span>'
                            ?>
                            <!-- <span class="dateTxt">Date Specification</span> -->
                        </div>
                        <div class="dateImg">
                            <span class="date_icon">
                                <i class="fa-solid fa-calendar-days"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="stats-wrapper">
                    <div class="stats-card doctor_card">
                        <i class="fa-solid fa-user-doctor"></i>
                        <div class="card-text">
                            <?php
                                try{
                                    $query="SELECT COUNT(*) as doctor_count FROM tbl_doctors";
                                    $stmt=$conn->query($query);
                                
                                    $result= $stmt->fetch(PDO::FETCH_ASSOC);
                                }catch(PDOException $e){
                                    echo 'Query Failed'. $e->getMessage() .'';
                                }
                                if($result){
                                    echo '<span class="count">'.$result['doctor_count'].'</span>';
                                }else{
                                    echo '<span class="count">0</span>';
                                }
                            ?>                            
                            <span class="card-title">Doctors</span>
                        </div>
                    </div>
                    <div class="stats-card patient_card">
                        <i class="fa-solid fa-hospital-user"></i>
                        <div class="card-text">
                            <?php
                                try{
                                    $query="SELECT COUNT(*) as patient_count FROM tbl_patients";
                                    $stmt=$conn->query($query);
                                
                                    $result= $stmt->fetch(PDO::FETCH_ASSOC);
                                }catch(PDOException $e){
                                    echo 'Query Failed'. $e->getMessage() .'';
                                }
                                if($result){
                                    echo '<span class="count">'.$result['patient_count'].'</span>';
                                }else{
                                    echo '<span class="count">0</span>';
                                }
                            ?> 
                            <span class="card-title">Patients</span>  
                        </div>
                    </div>
                    <div class="stats-card appointment_card">
                        <i class="fa-solid fa-calendar-check"></i>
                        <div class="card-text">
                             <?php
                                try{
                                    $query="SELECT COUNT(*) as appointment_count FROM tbl_appointments";
                                    $stmt=$conn->query($query);
                                
                                    $result= $stmt->fetch(PDO::FETCH_ASSOC);
                                }catch(PDOException $e){
                                    echo 'Query Failed'. $e->getMessage() .'';
                                }
                                if($result){
                                    echo '<span class="count">'.$result['appointment_count'].'</span>';
                                }else{
                                    echo '<span class="count">0</span>';
                                }
                            ?> 
                            <span class="card-title">Appointments</span>  
                        </div>
                    </div>
                </div>
                <div class="appointments_wrapper">
                    <h4>Upcoming Sessions</h4>
                    <table class="table-wrapper">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Session Title</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Doctor</th>
                                <th>Patient</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                try{
                                    $query="SELECT s.session_id,s.session_title,s.session_date,s.session_time,d.name,CONCAT(p.firstName,' ',p.lastName) AS patient_name FROM tbl_sessions s
                                            JOIN tbl_appointments a  ON a.appointment_id = s.appointment_id
                                            JOIN tbl_doctors d  ON d.doctor_id = a.doctor
                                            JOIN tbl_patients p  ON p.patient_id = a.patient_id
                                            WHERE  s.session_date >= CURRENT_DATE
                                            ORDER BY s.session_date DESC ;";
                                    $stmt=$conn->query($query);
                                    // $stmt->execute();
                                
                                    $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
                                }catch(PDOException $e){
                                    echo $e->getMessage();
                                }
                                if($result){
                                    foreach($result as $row){
                                        echo'
                                            <tr>
                                                <td>'.$row['session_id'].'
                                                </td>
                                                <td>'.substr($row['session_title'],0,20).'
                                                </td>
                                                <td>'.$row['session_date'].'
                                                </td>
                                                <td>'.$row['session_time'].'
                                                </td>
                                                <td>'.$row['name'].'
                                                </td>
                                                <td>'.$row['patient_name'].'
                                                </td>
                                            </tr>
                                        ';
                                    }

                                }else{
                                    echo'
                                        <tr>
                                            <td colspan="6">
                                                No Upcoming Appointments
                                            </td>
                                        </tr>
                                        ';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
            require_once '../modals/delete_appointment.php';
            require_once '../modals/appointment_dialog.php';
            require_once '../modals/reschedule_appointment.php';
        ?>

        <script src="https://kit.fontawesome.com/2493969055.js" crossorigin="anonymous"></script>  
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="../../js/appointment.js"></script>
    </body>
</html>