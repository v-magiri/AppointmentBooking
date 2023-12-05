const addSpecialityBtn=document.getElementById('addSpecialityBtn');
const dialog=document.getElementById('specialityModal');
const closeBtn=document.getElementById('closeDialogBtn');
const clostDialogIcon=document.getElementById('closeBtn');

const specialityDeleteDialog=document.getElementById('delete_speciality_dialog');

// delete speciality dialog
const hideBtn=document.getElementById('closeDeleteDialog');
const hideDeleteDialog=document.getElementById('cancelDeleteBtn');

hideDeleteDialog.addEventListener('click',closeDeleteDialog);
hideBtn.addEventListener('click',closeDeleteDialog);

addSpecialityBtn.addEventListener('click',openSpecialityDialog);
clostDialogIcon.addEventListener('click',closeDialog);
closeBtn.addEventListener('click',closeDialog);

function closeDeleteDialog(){
    specialityDeleteDialog.style.display='none';
}


function openSpecialityDialog(){
    dialog.style.display='block';
}

function closeDialog(){
    dialog.style.display='none';
}

function showPopupMenu(event){
    event.stopPropagation();

    const optionsBtn=event.target;

    const tableCell=optionsBtn.parentElement.parentElement;

    const popUpMenu = tableCell.querySelector(".popupMenu");

    popUpMenu.classList.toggle('menu-visible');

    event.preventDefault();
}

function editSpeciality(){

}
function deleteSpeciality(event,speciality_id){
    const optionsBtn=event.target;

    const pop_up_menu=optionsBtn.parentElement.parentElement.parentElement;


    const speciality_input=document.getElementById('specialityInput');

    speciality_input.value=speciality_id;

    specialityDeleteDialog.style.display='block';

    pop_up_menu.classList.toggle('menu-visible');
}