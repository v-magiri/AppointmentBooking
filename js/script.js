const addDoctorBtn=document.getElementById('addDoctorBtn');
const closeDialogBtn=document.getElementById('closeDialogBtn');
const dialog=document.getElementById('doctorModal');
const closeDialogIcon=document.getElementById('closeBtn');


addDoctorBtn.addEventListener('click',openDoctorForm);

closeDialogIcon.addEventListener('click',closeDialog);

closeDialogBtn.addEventListener('click',closeDialog);


function openDoctorForm() {
    dialog.style.display = 'block';
}



function closeDialog() {
    dialog.style.display = 'none';
}

