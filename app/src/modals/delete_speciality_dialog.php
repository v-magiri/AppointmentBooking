<div class="dialog" id="delete_speciality_dialog">
    <div class="dialog-content">
        <div class="dialog-header">
            <span class="dialog-title">Delete Speciality</span>
            <span class="close" id="closeDeleteDialog">&times;</span>
        </div>
        <div class="dialog-body doctor_dialog">
            <form action="../../includes/delete_speciality.php" method="POST" role="form">
                <div class="form-group my-1">
                    <p class="delete_warning"> Are you sure you want to delete Speciality. Please note this action can not be undone.</p>
                </div>
                <div class="form-group my-1 d-none">
                    <label for="speciality_id" class="my-1">Speciality ID:</label>
                    <input type="hidden" class="form-control" id="specialityInput" name="speciality_id" value="">
                </div>
                <div class="btns-group mt-2 mb-2">
                    <a href="#" class="closeBtn" id="cancelDeleteBtn">Close</a>
                    <input type="submit" value="Delete" class="btn btn-danger ml-auto deleteBtn">
                </div>
            </form>
        </div>
    </div>
</div>