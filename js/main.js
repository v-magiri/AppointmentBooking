const editProfileBtn=document.getElementById('editProfileBtn');
const closeProfileDialogBtn=document.getElementById('closeBtn');
const closeProfileModal=document.getElementById('closeDialogBtn');
const editForm=document.getElementById('profile');
const popUpMenu=document.getElementById('popUpMenu');

editProfileBtn.addEventListener('click',openDialog);

closeProfileDialogBtn.addEventListener('click',hideForm);
closeProfileModal.addEventListener('click',hideForm);

function openDialog(){
    editForm.style.display = 'block';
}
function hideForm(){
    editForm.style.display='none';
}
