const appointmentDialog=document.getElementById('appointment_dialog');

//appointment Dialog
const hideForm=document.getElementById('hideBtn');
const closeFormDialogBtn=document.getElementById('closeDialogBtn');
//reschedule Dialog
const closeBtn=document.getElementById('closeBtn');
const hideRescheduleBtn=document.getElementById('hideDialogBtn');

const rescheduleDialog=document.getElementById('reschedule_dialog');
const appointmentContainer=document.getElementById('appointment_container');

closeBtn.addEventListener('click',closeRescheduleDialog);
hideRescheduleBtn.addEventListener('click',closeRescheduleDialog);

closeFormDialogBtn.addEventListener('click',closeDialog);
hideForm.addEventListener('click',closeDialog);

function closeDialog(){
    appointmentDialog.style.display='none';
}
function closeRescheduleDialog(){
    rescheduleDialog.style.display='none';
}
function showPopupMenu(event){
    event.stopPropagation();

    const optionsBtn=event.target;

    const tableCell=optionsBtn.parentElement.parentElement;

    const popUpMenu = tableCell.querySelector(".popupMenu");

    popUpMenu.classList.toggle('menu-visible');

    event.preventDefault();

    
}
function rescheduleAppointmentDialog(event,appointment_id){
    const optionsBtn=event.target;

    const pop_up_menu=optionsBtn.parentElement.parentElement.parentElement;

    // const appointmentDetails=getAppointment(appointment_id);

    // console.log(appointmentDetails);

    $.ajax({
        url: '../../includes/fetch_appointment.php',
        method: 'POST',
        data: { appointment_id: appointment_id },
        success: function (response) {
            const appointment= JSON.parse(response);

            let appointment_date=appointment.date
            // const date=appointmentDetails.date;
            const time=appointment.time;
        
        
            const appointment_input=document.getElementById('appointment_input');
            const appointment_dateInput=document.getElementById('dateInput');
            const appointment_timeInput=document.getElementById('timeInput');
        
        
            appointment_input.value=appointment_id;
            appointment_dateInput.value=appointment_date;
            appointment_timeInput.value=time;
        }
    });



    rescheduleDialog.style.display='block';

    pop_up_menu.classList.toggle('menu-visible');
}
function openAppointmentDialog(event,appointment_id){
    const optionsBtn=event.target;

    const pop_up_menu=optionsBtn.parentElement.parentElement.parentElement;

    $.ajax({
        url: '../../includes/fetch_appointment.php',
        method: 'POST',
        data: { appointment_id: appointment_id },
        success: function (response) {
            // Display the response in a dialog or handle it as needed
            const appointmentDetails=JSON.parse(response);
            const date=appointmentDetails.date;
            const time=appointmentDetails.time;
            const doctor=appointmentDetails.name;
            const patientName=appointmentDetails.patient_name;
            const reason=appointmentDetails.reason;

            if(patientName !=null){
                appointmentContainer.innerHTML=`
                        <div class="form-group my-1">
                            <label for="reason" class="my-1">Appointment Reason:</label>
                            <p class="appointment_reason">${reason}</p>
                        </div>
                        <div class="form-group my-1">
                            <label for="date" class="my-1">Appointment Date:</label>
                            <input type="text" class="form-control" id="appointmentDateTxt" name="date" value="${date}"  readonly>
                        </div>
                        <div class="form-group my-1">
                            <label for="time" class="my-1">Time:</label>
                            <input type="text" class="form-control" id="time" name="time"  value="${time}" readonly>
                        </div>
                        <div class="form-group my-1">
                            <label for="doctor" class="my-1">Patient Name</label>
                            <input type="text" class="form-control" id="doctor" name="doctor"  value="${patientName}" readonly>
                        </div>
                    `;
            }else{
                appointmentContainer.innerHTML=`
                        <div class="form-group my-1">
                            <label for="reason" class="my-1">Appointment Reason:</label>
                            <p class="appointment_reason">${reason}</p>
                        </div>
                        <div class="form-group my-1">
                            <label for="date" class="my-1">Appointment Date:</label>
                            <input type="text" class="form-control" id="appointmentDateTxt" name="date" value="${date}"  readonly>
                        </div>
                        <div class="form-group my-1">
                            <label for="time" class="my-1">Time:</label>
                            <input type="text" class="form-control" id="time" name="time"  value="${time}" readonly>
                        </div>
                        <div class="form-group my-1">
                            <label for="doctor" class="my-1">Doctor</label>
                            <input type="text" class="form-control" id="doctor" name="doctor"  value="${doctor}" readonly>
                        </div>
                    `;
            }
        },
        error: function () {
            alert('Error fetching appointment details.');
        }
    });

    appointmentDialog.style.display='block';

    pop_up_menu.classList.toggle('menu-visible');
}

function changeAppointmentStatus(event,appointment_id){
    event.preventDefault();

    const optionsBtn=event.target;

    let appointment_status="Accepted";

    const pop_up_menu=optionsBtn.parentElement.parentElement.parentElement;

    const statusOption=optionsBtn.parentElement.parentElement;

    if(statusOption.id === "rejectBtn"){

        appointment_status="Rejected";
    }

    $.ajax({
        type:"POST",
        url:"../../includes/change_appointment_status.php",
        data:{status:appointment_status,appointment:appointment_id},
        success:function(response){
            console.log(response);
        },
        error:function(error){
            console.error(error);
        }

    });

    pop_up_menu.classList.toggle('menu-visible');
}

