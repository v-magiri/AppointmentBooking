const appointmentDialog=document.getElementById('appointment_dialog');
const doctorDailog=document.getElementById('doctorDailog');
//appointment Dialog
const hideForm=document.getElementById('hideBtn');
const closeFormDialogBtn=document.getElementById('closeDialogBtn');
//delete Dialog
const cancelDelete=document.getElementById('cancelDeleteBtn');
const closeDeleteDialogBtn=document.getElementById('closeDeleteDialog');
//reschedule Dialog
const closeBtn=document.getElementById('closeBtn');
const hideRescheduleBtn=document.getElementById('hideDialogBtn');

//time Inputs
const dateInput = document.getElementById('dateInput');
const timeInput = document.getElementById('timeInput');

const deleteDialog=document.getElementById('delete_dialog');
const rescheduleDialog=document.getElementById('reschedule_dialog');
const appointmentContainer=document.getElementById('appointment_container');


closeFormDialogBtn.addEventListener('click',closeDialog);
hideForm.addEventListener('click',closeDialog);

deleteDialog.addEventListener('click',closeDeleteDialog);
closeDeleteDialogBtn.addEventListener('click',closeDeleteDialog);

closeBtn.addEventListener('click',closeRescheduleDialog);
hideRescheduleBtn.addEventListener('click',closeRescheduleDialog);

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

function closeDialog(){
    appointmentDialog.style.display='none';
}

function closeDeleteDialog(){
    deleteDialog.style.display='none';
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

function openDeleteDialog(event,appointment_id){
    const optionsBtn=event.target;

    const pop_up_menu=optionsBtn.parentElement.parentElement.parentElement;


    const appointment_input=document.getElementById('appointmentInput');

    appointment_input.value=appointment_id;

    deleteDialog.style.display='block';

    pop_up_menu.classList.toggle('menu-visible');
}
function rescheduleAppointmentDialog(event,appointment_id){
    const optionsBtn=event.target;

    const pop_up_menu=optionsBtn.parentElement.parentElement.parentElement;

    console.log(appointment_id);

    const appointment_input=document.getElementById('appointment_input');

    appointment_input.value=appointment_id;

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
            console.log(appointmentDetails);
            const date=appointmentDetails.date;
            const time=appointmentDetails.time;
            const doctor=appointmentDetails.name;
            const reason=appointmentDetails.reason;

        
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
                            <div class="form-group my-1 categorySelect">
                                <label for="doctor" class="my-1">Doctor</label>
                                <input type="text" class="form-control" id="doctor" name="doctor"  value="${doctor}" readonly>
                            </div>
                        `;
        },
        error: function () {
            alert('Error fetching appointment details.');
        }
    });

    appointmentDialog.style.display='block';

    pop_up_menu.classList.toggle('menu-visible');
}
