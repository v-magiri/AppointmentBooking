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
        <title>Sessions</title>
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
                    <li>
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
                    <li class="active">
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
                    <h4>Sessions</h4>
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
                <div class="sessions-wrapper">
                    <h4>All Sessions</h4>
                    <table class="table_listing">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Session Title</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Patient Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                try{
                                    $doctor_id = $_SESSION["user_id"];
                                    $query="SELECT s.session_id,s.session_title,s.session_time,s.session_date,CONCAT(p.firstName,' ',p.lastName) AS NAME FROM tbl_sessions s
                                            JOIN tbl_appointments a  ON a.appointment_id = s.appointment_id
                                            JOIN tbl_patients p ON p.patient_id = a.patient_id
                                            WHERE a.doctor = :doctor_id  
                                            ORDER BY s.session_date DESC ;";
                            
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
                                                <td>'.$row['session_id'].'
                                                </td>
                                                <td>'.substr($row['session_title'],0,20).'
                                                </td>
                                                <td>'.$row['session_date'].'
                                                </td>
                                                <td>'.$row['session_time'].'
                                                </td>
                                                <td>'.$row['NAME'].'
                                                </td>
                                            </tr>
                                        ';
                                    }
                                }else{
                                    echo'
                                        <tr>
                                            <td colspan="5">
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


        <script src="https://kit.fontawesome.com/2493969055.js" crossorigin="anonymous"></script>  
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>