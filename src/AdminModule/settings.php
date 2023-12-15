<?php
    require_once '../../includes/config_session.inc.php';
    require_once '../../includes/user_status.php';
    require_once '../../includes/speciality_view.php';
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
        <title>Profile | Appointment Booking Application</title>
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
                    <li class="active">
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
                    <h4>Portal Setting</h4>
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
                <div class="specialities-wrapper">
                    <div class="speciality-header">
                        <h4>Doctor Specialities</h4>
                        <div class="actions-btn">
                            <button id="addSpecialityBtn"><i class="fa-solid fa-plus"></i> Add Speciality</button>
                        </div>
                    </div>
                    <div class="errors-wrapper">
                        <?php
                            check_profile_errors();
                        ?>
                    </div>
                    <div class="speciality_listing">
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Practitioners</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                try{
                                    $query="select s.speciality_id,s.speciality_name,s.speciality_description,COUNT(d.doctor_id)  AS doctor_count
                                            FROM tbl_speciality s 
                                            LEFT JOIN tbl_doctors d ON s.speciality_id=d.speciality
                                            GROUP BY s.speciality_id;";
                                    $stmt=$conn->query($query);
                                    // $stmt->execute();
                                
                                    $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
                                }catch(PDOException $e){
                                    echo $e->getMessage();
                                }
                                if($result){
                                    foreach($result as $row){
                                        echo '
                                                <tr>
                                                <td>'.$row['speciality_id'].'
                                                </td>
                                                <td>'.$row['speciality_name'].'
                                                </td>
                                                <td>'.substr($row['speciality_description'],0,40).'
                                                </td>
                                                <td>'.$row['doctor_count'].'
                                                </td>
                                                <td class="optionMenu">
                                                    <span id="showOptions" onclick="showPopupMenu(event)">
                                                        <i class="fa-solid fa-ellipsis"></i>
                                                    </span>
                                                    <div class="popupMenu" id="popUpMenu">
                                                        <div class="menu-item" onclick="editSpeciality(event,'.$row['speciality_id'].')">
                                                            <a href="#">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                                <span>Update Speciality</span>
                                                            </a>
                                                        </div>
                                                        <div class="menu-item" onclick="deleteSpeciality(event,'.$row['speciality_id'].')">
                                                            <a href="#">
                                                                <i class="fa-solid fa-trash"></i>
                                                                <span>Delete Speciality</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                </tr>
                                            ';
                                    }
                                }else{
                                    echo "<p>No Date Found</p>";
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <?php
            require_once '../modals/speciality_dialog.php';
            require_once '../modals/update_speciality_dialog.php';
            require_once '../modals/delete_speciality_dialog.php';
        ?> 


        <script src="https://kit.fontawesome.com/2493969055.js" crossorigin="anonymous"></script>  
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="../../js/admin.js"></script>
    </body>
</html>