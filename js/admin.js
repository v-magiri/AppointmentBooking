const addSpecialityBtn=document.getElementById('addSpecialityBtn');
const dialog=document.getElementById('specialityModal');
const closeBtn=document.getElementById('closeDialogBtn');
const closeDialogIcon=document.getElementById('closeBtn');
const updateDialog=document.getElementById('speciality_dialog');
const hideSpecialityBtn=document.getElementById('hideDialogBtn');
const hideSpecialityDialog=document.getElementById('hideBtn');
const deleteUserDialog=document.getElementById('delete_user_dialog');
//doctor dialog
const doctorDailog=document.getElementById('doctorDailog');
const viewDoctorDialog=document.getElementById('doctor_dialog');
const doctor_updateDialog=document.getElementById('');

const specialityDeleteDialog=document.getElementById('delete_speciality_dialog');
const specialityContainer=document.getElementById('specialityContainer');

// delete speciality dialog
const hideBtn=document.getElementById('closeDeleteDialog');
const hideDeleteDialog=document.getElementById('cancelDeleteBtn');

//user dialog controls
const hideUserDelete=document.getElementById('cancelDeleteButton');
const hideUserDeleteDialog=document.getElementById('closeDeleteUserDialog');

hideUserDelete.addEventListener('click',closeUserDeleteDialog);
hideUserDeleteDialog.addEventListener('click',closeUserDeleteDialog);

// event listeners for update dialog
hideSpecialityBtn.addEventListener('click',hideSpecialityModal);
hideSpecialityDialog.addEventListener('click',hideSpecialityModal);

hideDeleteDialog.addEventListener('click',closeDeleteDialog);
hideBtn.addEventListener('click',closeDeleteDialog);

addSpecialityBtn.addEventListener('click',openSpecialityDialog);
closeDialogIcon.addEventListener('click',closeDialog);
closeBtn.addEventListener('click',closeDialog);

function closeDeleteDialog(){
    specialityDeleteDialog.style.display='none';
}

function closeDialog(){
    dialog.style.display='none';
}

function closeUserDeleteDialog(){
    deleteUserDialog.style.display="none";
}

function openSpecialityDialog(){
    dialog.style.display='block';
}

function hideSpecialityModal(){
    updateDialog.style.display='none';
}
function showPopupMenu(event){
    event.stopPropagation();

    const optionsBtn=event.target;

    const tableCell=optionsBtn.parentElement.parentElement;

    const popUpMenu = tableCell.querySelector(".popupMenu");

    popUpMenu.classList.toggle('menu-visible');

    event.preventDefault();
}

function editSpeciality(event,speciality_id){
    const optionsBtn=event.target;

    const pop_up_menu=optionsBtn.parentElement.parentElement.parentElement;

    $.ajax({
        url: '../../includes/fetch_speciality.php',
        method: 'POST',
        data: { speciality_id: speciality_id },
        success: function (response) {
            // Display the response in a dialog or handle it as needed
            const specialityDetails=JSON.parse(response);
            const speciality_name=specialityDetails.speciality_name;
            const speciality_description=specialityDetails.speciality_description;
            const speciality_id=specialityDetails.speciality_id;
    
            specialityContainer.innerHTML=`
                    <div class="form-group my-2">
                        <label for="speciality_name" class="my-1">Speciality Name:</label>
                        <input type="text" class="form-control" name="speciality_name" min="" value="${speciality_name}" required>
                    </div>
                    <div class="form-group my-2">
                        <label for="speciality_description" class="my-1">Speciality Description:</label>
                        <input type="text" class="form-control"  name="speciality_description" value="${speciality_description}" required>
                    </div>
                    <div class="form-group my-1 d-none">
                        <label for="doctor_id" class="my-1">Speciality ID:</label>
                        <input type="hidden" class="form-control" id="speciality_id" name="speciality_id" value="${speciality_id}" readonly >
                    </div>
                    
                    <div class="btns-group mt-2 mb-2">
                        <a href="#" class="closeBtn" id="hideDialogBtn">Close</a>
                        <input type="submit" value="Update" class="btn submit-Btn btn-primary ml-auto">
                    </div>
                    `;
        },
        error: function () {
            alert('Error fetching Speciality details.');
        }
    });

    updateDialog.style.display='block';

    pop_up_menu.classList.toggle('menu-visible');
}
function deleteSpeciality(event,speciality_id){
    const optionsBtn=event.target;

    const pop_up_menu=optionsBtn.parentElement.parentElement.parentElement;


    const speciality_input=document.getElementById('specialityInput');

    speciality_input.value=speciality_id;

    specialityDeleteDialog.style.display='block';

    pop_up_menu.classList.toggle('menu-visible');
}

//function to delete patient /doctor
function deleteUser(event,user_id){
    const optionsBtn=event.target;
    
    let user_type="Patient";

    const pop_up_menu=optionsBtn.parentElement.parentElement.parentElement;

    const role_input=document.getElementById('user_type');

    const statusOption=optionsBtn.parentElement.parentElement;

    if(statusOption.id === "deleteDoctor"){

        user_type="Doctor";
    }

    role_input.value=user_type;

    const user_input=document.getElementById('user_id');

    user_input.value=user_id;

    deleteUserDialog.style.display='block';

    pop_up_menu.classList.toggle('menu-visible');
}

function editPatient(event, patient_id){

}