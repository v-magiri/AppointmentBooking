<?php
    require_once '../../includes/config_session.inc.php';
    require_once '../../includes/user_status.php';
    require_once '../../includes/profile_view.php';
    include('../../includes/database_config.php');
    if(isset($_SESSION["user_id"])){
        if(($_SESSION["user_id"]) == "" or $_SESSION['user_type'] != 'Patient'){
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
        <link href="../../styles/styles_patient.css" rel="stylesheet" type="text/css"/> 
        <title>Profile | Appointment Booking</title>
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
                        <a href="doctor.php">
                            <i class="fa-solid fa-user-doctor"></i>
                            <span>Doctors</span>
                        </a>
                    </li>
                    <li>
                        <a href="appointment.php">
                            <i class="fa-solid fa-calendar-check"></i>
                            <span>Appointments</span>
                        </a>
                    </li>

                    <li class="active">
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
                <div class="errors-wrapper">
                    <?php
                        check_profile_errors();
                    ?>
                </div>
                <div class="board_header">
                    <h4>Profile Settings</h4>
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
                <div class="profile-wrapper">
                    <div class="personal_wrapper">
                        <div class="personal-title">
                            <h4>Personal Details</h4>
                            <div class="actions-btn">
                                <button id="editProfileBtn" class="edit_profileBtn"><i class="fa-solid fa-pen-to-square"></i>Edit Profile</button>
                            </div>
                        </div>
                        <?php
                                if(isset($_SESSION["user_name"])){

                                    try{
                                        $username=$_SESSION["user_name"];
                                        $query="SELECT *  FROM tbl_patients WHERE username=:username;";
                                        $stmt=$conn->prepare($query);
                                        $stmt->bindParam(":username",$username);
                                        $stmt->execute();
                                    
                                        $result= $stmt->fetch(PDO::FETCH_ASSOC);
                                        if($result){
                                            echo "
                                                <div class='row_group mb-3'>
                                                    <div class='input-col'>
                                                        <span class='input-title mb-3'>Name</span>
                                                        <span class='input-txt'> <i class='fa-solid fa-user'></i>".$result['firstName']." ".$result['lastName']."</span>
                                                    </div>
                                                    <div class='input-col'>
                                                        <span class='input-title mb-3'>Username</span>
                                                        <span class='input-txt'> <i class='fa-solid fa-at'></i>".$result['username']."</span>
                                                    </div>                            
                                                </div>
                                                <div class='row_group'>
                                                    <div class='input-col'>
                                                        <span class='input-title mb-3'>Email Address</span>
                                                        <span class='input-txt'> <i class='fa-solid fa-envelope'></i>".$result['emailAddress']."</span>
                                                    </div>
                                                    <div class='input-col'>
                                                        <span class='input-title mb-3'>Phone Number</span>
                                                        <span class='input-txt'> <i class='fa-solid fa-phone'></i>".$result['phoneNumber']."</span>
                                                    </div>
                                                </div>
                                                ";
                                        }
                                    }catch(PDOException $e){
                                        echo "Query Failed: ".$e->getMessage();
                                    }
                                }else{
                                    header("location: ../../login.php");
                                }
                        ?>
                    </div>
                    <div class="password_wrapper">
                        <h4 class="mb-3">Change Password</h4>
                        <form action="">
                            <div class="mb-3">
                                <label for="pwd" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="pwd" name="pwd">
                            </div>
                            <div class="mb-3">
                                <label for="c_pwd" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="c_pwd" name="c_pwd">
                            </div>
                            <button type="submit" class="btn btn-primary text-center">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
            require_once '../modals/edit_profile_dialog.php';
        ?> 


        <script src="https://kit.fontawesome.com/2493969055.js" crossorigin="anonymous"></script>  
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="../../js/main.js"></script>
    </body>
</html>