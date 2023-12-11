<?php
    require_once '../../includes/config_session.inc.php';
    require_once '../../includes/user_status.php';
    include('../../includes/database_config.php');
    if(isset($_SESSION["user_id"])){
        if(($_SESSION["user_id"]) == "" or $_SESSION['user_type'] != 'Doctor'){
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
        <link rel="stylesheet" href="../../styles/styles_doctor.css" type="text/css">
        <title>Doctor Home</title>
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
                    <li  class="active">
                        <a href="home.php">
                            <i class="fa-solid fa-house"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="appointment.php">
                            <i class="fa-solid fa-calendar-check"></i>
                            <span>Appointments</span>
                        </a>
                    </li>
                    <li>
                        <a href="sessions.php">
                            <i class="fa-solid fa-calendar-check"></i>
                            <span>Sessions</span>
                        </a>
                    </li>

                    <li>
                        <a href="profile.php">
                            <i class="fa-solid fa-user"></i>
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
                <div class="welcome_container">
                    <span>Welcome</span>
                    <?php
                        echo "<span class='nameTxt'>". get_name() . "</span>";
                    ?> 
                    <div class="instruction_container">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam numquam laudantium corrupti nobis eos cumque placeat eligendi sunt, animi asperiores, nemo nihil veniam? Debitis cumque, porro officiis vitae id ducimus!</p>
                    </div>

                </div>
                <div class="session-wrapper">
                    <h4>Upcoming Bookings</h4>
                    <table class="booking_listing">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Session Title</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Patient</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                try{
                                    $doctor_id = $_SESSION["user_id"];
                                    $query="SELECT a.appointment_id,a.date,a.time,a.appointment_reason, CONCAT(p.firstName,' ',p.lastName) AS NAME FROM tbl_appointments a
                                            JOIN tbl_patients p  ON p.patient_id = a.patient_id
                                            WHERE a.doctor = :doctor_id AND a.date > CURRENT_DATE   
                                            ORDER BY a.date DESC ;";
                            
                                        $stmt=$conn->prepare($query);
                                        $stmt->bindParam(":doctor_id",$doctor_id);
                                        $stmt->execute();
                                
                                    $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
                                }catch(PDOException $e){
                                    echo $e->getMessage();
                                }
                                if($result){
                                    foreach($result as $row){
                                        echo'
                                            <tr>
                                                <td>'.$row['appointment_id'].'
                                                </td>
                                                <td>'.substr($row['appointment_reason'],0,20).'
                                                </td>
                                                <td>'.$row['date'].'
                                                </td>
                                                <td>'.$row['time'].'
                                                </td>
                                                <td>'.$row['NAME'].'
                                                </td>
                                                <td class="optionMenu">
                                                    <span id="showOptions" onclick="showPopupMenu(event)">
                                                        <i class="fa-solid fa-ellipsis"></i>
                                                    </span>
                                                    <div class="popupMenu" id="popUpMenu">
                                                        <div class="menu-item" onclick="openAppointmentDialog(event,'.$row['appointment_id'].')">
                                                            <a href="#">
                                                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                                                <span>View Appointment</span>
                                                            </a>
                                                        </div>
                                                        <div class="menu-item" onclick="rescheduleAppointmentDialog(event,'.$row['appointment_id'].')">
                                                            <a href="#">
                                                                <i class="fa-solid fa-book-medical"></i>
                                                                <span>Reshedule Appointment</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        ';
                                    }
                                }else{
                                    echo'
                                        <tr>
                                            <td colspan="6">
                                                No Upcoming Sessions
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
            require_once '../modals/appointment_dialog.php';
            require_once '../modals/reschedule_appointment.php';
        ?>

        <script src="https://kit.fontawesome.com/2493969055.js" crossorigin="anonymous"></script>  
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="../../js/doctor.js"></script>
    </body>
</html>