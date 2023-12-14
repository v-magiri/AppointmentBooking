<div class="dialog" id="delete_dialog">
    <div class="dialog-content">
        <div class="dialog-header">
            <span class="dialog-title">Delete Doctor</span>
            <span class="close" id="closeDeleteDialog">&times;</span>
        </div>
        <div class="dialog-body doctor_dialog">
            <form action="../../includes/delete_appointment.php" method="POST" role="form">
                <div class="form-group my-1">
                    <p class="delete_warning"> Are you sure you want to delete doctor. Please note this action can not be undone.</p>
                </div>
                <div class="form-group my-1 d-none">
                    <label for="doctor_id" class="my-1">Doctor ID:</label>
                    <input type="hidden" class="form-control" id="appointmentInput" name="doctor_id" value="">
                </div>
                <div class="btns-group mt-2 mb-2">
                    <a href="#" class="closeBtn" id="cancelDeleteBtn">Close</a>
                    <input type="submit" value="Delete" class="btn btn-danger ml-auto deleteBtn">
                </div>
            </form>
        </div>
    </div>
</div>