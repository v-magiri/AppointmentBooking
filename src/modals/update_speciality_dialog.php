<div class="dialog" id="speciality_dialog">
    <div class="dialog-content">
        <div class="dialog-header">
            <span class="dialog-title">Update Speciality</span>
            <span class="close" id="closeBtn">&times;</span>
        </div>
        <div class="dialog-body doctor_dialog">
            <form role="form" action="../../includes/update_speciality.php" method="post">
                <div class="form-group my-1">
                    <label for="speciality_name" class="my-1">Speciality Name:</label>
                    <input type="date" class="form-control" name="speciality_name" min="" required>
                </div>
                <div class="form-group my-1">
                    <label for="speciality_description" class="my-1">Speciality ID:</label>
                    <input type="time" class="form-control"  name="speciality_description" required>
                </div>
                <div class="form-group my-1 d-none">
                    <label for="doctor_id" class="my-1">Speciality ID:</label>
                    <input type="hidden" class="form-control" id="speciality_id" name="speciality_id" value="">
                </div>
                <div class="btns-group mt-2 mb-2">
                    <a href="#" class="closeBtn" id="hideDialogBtn">Close</a>
                    <input type="submit" value="Update" class="btn submit-Btn btn-primary ml-auto">
                </div>
            </form>
        </div>
    </div>
</div>