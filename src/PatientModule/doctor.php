<?php

    require_once '../../includes/config_session.inc.php';
    require_once '../../includes/user_status.php';
    include('../../includes/database_config.php');
    require_once '../../includes/doctors_view.php';

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
        <title>Doctors</title>
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
                    <li class="active">
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
                    <li>
                        <a href="sessions.php">
                            <i class="fa-solid fa-calendar"></i>
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
                    <h4>Doctors</h4>
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
                <div class="errors">
                    <?php
                        check_errors();
                    ?>
                </div>
                <div class="doctors-wrapper">
                    <h4>All Doctors</h4>
                    <table class="table_listing">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Speciality</th>
                                <th>Availability Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                try{
                                    $query="select d.doctor_id,d.name,d.email_address,d.availability_status,s.speciality_name
                                            FROM tbl_doctors d JOIN tbl_speciality s ON d.speciality = s.speciality_id ORDER BY d.doctor_id desc;";
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
                                                <td>'.$row['doctor_id'].'
                                                </td>
                                                <td>'.substr($row['name'],0,30).'
                                                </td>
                                                <td>'.substr($row['email_address'],0,30).'
                                                </td>
                                                <td>'.substr($row['speciality_name'],0,20).'
                                                </td>';
                                                
                                                if($row['availability_status'] == 1){
                                                    echo "<td class='availability'><span class='available-txt'>Available</span></td>";
                                                }else{
                                                    echo "<td class='availability'><span class='non_availabilityTxt'>Not Available</span></td>";
                                                }
                                               echo                                         
                                                '<td class="optionMenu">
                                                    <span id="showOptions" onclick="showPopupMenu(event)">
                                                        <i class="fa-solid fa-ellipsis"></i>
                                                    </span>
                                                    <div class="popupMenu" id="popUpMenu">
                                                        <div class="menu-item" onclick="openDoctorDailog(event,'.$row['doctor_id'].')">
                                                            <a href="#">
                                                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                                                <span>View Doctor</span>
                                                            </a>
                                                        </div>
                                                        <div class="menu-item" onclick="bookAppointment(event,'.$row['doctor_id'].')">
                                                            <a href="#">
                                                                <i class="fa-solid fa-book-medical"></i>
                                                                <span>Book Appointment</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            ';
                                    }
                                }else{
                                    echo "<p>No Doctors Data Found</p>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php 
            require_once '../modals/create_appointment.php';
            require_once '../modals/doctor_dialog.php';
        ?>

        <script src="https://kit.fontawesome.com/2493969055.js" crossorigin="anonymous"></script>  
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script>
            const dateInput=document.getElementById('dateInput');
            // const timeInput=document.getElementById('timeInput');
            const appointmentDialog=document.getElementById('appointmentModal');
            const doctorDailog=document.getElementById('doctorDailog');
            const hideForm=document.getElementById('closeBtn');
            const closeFormDialogBtn=document.getElementById('closeFormBtn');
            const closeBtn=document.getElementById('hideBtn');
            const hideDailogBtn=document.getElementById('hideDialog');
            const viewDoctorDialog=document.getElementById('doctor_dialog');
            const doctorEmailTxt=document.getElementById('emailAddressTxt');
            const doctorName=document.getElementById('nameTxt');
            const doctorPhoneNumber =document.getElementById('phoneNumberTxt');
            const doctorAvailability=document.getElementById('availabilityTxt');
            const doctorSpecialityTxt=document.getElementById('speciality');

            closeBtn.addEventListener('click',hideDoctorDialog);
            hideDailogBtn.addEventListener('click',hideDoctorDialog);

            closeFormDialogBtn.addEventListener('click',closeAppointmentForm);
            hideForm.addEventListener('click',closeAppointmentForm);

            function hideDoctorDialog(){
                doctorDailog.style.display='none';
            }

            function closeAppointmentForm(){
                console.log("Clicked");
                appointmentDialog.style.display='none';
            }
        
            function showPopupMenu(event){
                event.stopPropagation();

                const optionsBtn=event.target;

                const tableCell=optionsBtn.parentElement.parentElement;

                const popUpMenu = tableCell.querySelector(".popupMenu");

                popUpMenu.classList.toggle('menu-visible');

                event.preventDefault();

                
            }

            function bookAppointment(event,doctor_id){
                const optionsBtn=event.target;

                const pop_up_menu=optionsBtn.parentElement.parentElement.parentElement;


                const doctor_input=document.getElementById('doctorInput');

                doctor_input.value=doctor_id;

                appointmentDialog.style.display='block';

                pop_up_menu.classList.toggle('menu-visible');
            }

            function openDoctorDailog(event,doctor_id){ 
                const optionsBtn=event.target;

                const pop_up_menu=optionsBtn.parentElement.parentElement.parentElement;

                // const popUpMenu = tableCell.querySelector(".popupMenu");

                $.ajax({
                    url: '../../includes/fetch_doctor.php',
                    method: 'POST',
                    data: { doctorId: doctor_id },
                    success: function (response) {
                        // Display the response in a dialog or handle it as needed
                        const doctorDetails=JSON.parse(response);
                        const name=doctorDetails.name;
                        const speciality=doctorDetails.speciality;
                        const email=doctorDetails.email_address;
                        const phoneNumber=doctorDetails.phoneNumber;
                        const availability=doctorDetails.availability;

                        const availability_status= availability == 1 ? "Available" :"Not Available";
                    
                        viewDoctorDialog.innerHTML=`
                                        <div class="form-group my-1">
                                            <label for="fullName" class="my-1">Name:</label>
                                            <input type="text" class="form-control" id="nameTxt" name="fullName" value="${name}" readonly>
                                        </div>
                                        <div class="form-group my-1">
                                            <label for="emailAddress" class="my-1">Email Address:</label>
                                            <input type="text" class="form-control" id="emailAddressTxt" name="emailAddress" value="${email}"  readonly>
                                        </div>
                                        <div class="form-group my-1">
                                            <label for="phoneNumber" class="my-1">Phone Number:</label>
                                            <input type="text" class="form-control" id="phoneNumberTxt" name="phoneNumber"  value="${phoneNumber}" readonly>
                                        </div>
                                        <div class="form-group my-1 categorySelect">
                                            <label for="speciality" class="my-1">Doctor Speciality</label>
                                            <input type="text" class="form-control" id="speciality" name="speciality"  value="${speciality}" readonly>
                                        </div>
                                        <div class="form-group my-1 categorySelect">
                                            <label for="speciality" class="my-1">Doctor Availability</label>
                                            <input type="text" class="form-control" id="availabilityTxt" name="availability" value="${availability_status}"  readonly>
                                        </div>
                                    `;
                    },
                    error: function () {
                        alert('Error fetching doctor details.');
                    }
                });
                doctorDailog.style.display='block';
                // fetch the doctor details 

                pop_up_menu.classList.toggle('menu-visible');
            }

            //set the minimum date for date input Element
            const currentDate = new Date().toISOString().split('T')[0];
            dateInput.min=currentDate;

            // Set the minimum time to 8:00 AM
            const minimumTime = '08:00';
            // Set the maximum time to 10:00 PM
            const maximumTime = '22:00';

            // Set the minimum and maximum time for the time input
            document.getElementById('timeInput').min = minimumTime;
            document.getElementById('timeInput').max = maximumTime;

            const textArea=document.querySelector('.reason');
            const currentWordCount=document.getElementById('wordCount');
            const wordLimit=30;

            textArea.addEventListener('input', () => {
                let text = textArea.value;

                if (text.length > wordLimit) {
                    text = text.slice(0, wordLimit);
                    textArea.value = text;
                }

                currentWordCount.textContent = text.length;
            });

            textArea.addEventListener('keydown',function(event){
                var text=textArea.value;
                if(event.key==="Backspace" && text.length === 0 ){
                    event.preventDefault();
                }else if (text.length >= wordLimit) {
                    event.preventDefault();
                }
            })
        </script>
    </body>
</html>
