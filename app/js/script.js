const addDoctorBtn=document.getElementById('addDoctorBtn');
const closeDialogBtn=document.getElementById('closeDialogBtn');
const doctorDialog=document.getElementById('doctorModal');
const closeDoctorDialog=document.getElementById('closeBtn');
const doctorsModal=document.getElementById('doctorDailog');
const closeDoctorModal=document.getElementById('hideBtn');
const closeModalBtn=document.getElementById('hideDialog');
const viewDoctorDialog=document.getElementById('doctor_dialog');

// update profile dialog 
const doctorProfileDialog=document.getElementById('profileDialog');
const profileContainer=document.getElementById('updateProfileContainer');
const hideProfileBtn=document.getElementById('closeProfileBtn');
const hideProfileDialog=document.getElementById('hideProfileDialogBtn');

hideProfileBtn.addEventListener('click',closeProfileDialog);
hideProfileDialog.addEventListener('click',closeProfileDialog);


addDoctorBtn.addEventListener('click',openDoctorForm);

closeDoctorDialog.addEventListener('click',closeDialog);

closeDialogBtn.addEventListener('click',closeDialog);

closeModalBtn.addEventListener('click',hideDoctorDialog);
closeDoctorModal.addEventListener('click',hideDoctorDialog);


function openDoctorForm() {
    doctorDialog.style.display = 'block';
}

function closeDialog() {
    doctorDialog.style.display = 'none';
}

function showPopupMenu(event){
    event.stopPropagation();

    const optionsBtn=event.target;

    const tableCell=optionsBtn.parentElement.parentElement;

    const popUpMenu = tableCell.querySelector(".popupMenu");

    popUpMenu.classList.toggle('menu-visible');

    event.preventDefault();

    
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

function hideDoctorDialog(){
    doctorsModal.style.display='none';
}

function editDoctor(event,doctor_id){
    const optionsBtn=event.target;

    const pop_up_menu=optionsBtn.parentElement.parentElement.parentElement;

    // fetch the doctor details 
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
        
            profileContainer.innerHTML=`
                            <div class="form-group my-1">
                                <label for="fullName" class="my-1">Name:</label>
                                <input type="text" class="form-control" id="nameTxt" name="fullName" value="${name}" required>
                            </div>
                            <div class="form-group my-1">
                                <label for="emailAddress" class="my-1">Email Address:</label>
                                <input type="text" class="form-control" id="emailAddressTxt" name="emailAddress" value="${email}"  required>
                            </div>
                            <div class="form-group my-1">
                                <label for="phoneNumber" class="my-1">Phone Number:</label>
                                <input type="text" class="form-control" id="phoneNumberTxt" name="phoneNumber"  value="${phoneNumber}" required>
                            </div>
                            <div class="form-group my-1 d-none">
                                <label for="doctor_id" class="my-1">Doctor ID:</label>
                                <input type="text" class="form-control" id="doctors" name="doctor_id"  value="${doctor_id}" required>
                            </div>
                        `;
        },
        error: function () {
            alert('Error fetching doctor details.');
        }
    });

    doctorProfileDialog.style.display='block';

    
    pop_up_menu.classList.toggle('menu-visible');
}

function closeProfileDialog(){
    doctorProfileDialog.style.display='none';
}
