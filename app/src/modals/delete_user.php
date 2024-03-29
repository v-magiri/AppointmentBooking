<div class="dialog" id="delete_user_dialog">
    <div class="dialog-content">
        <div class="dialog-header">
            <span class="dialog-title">Delete User</span>
            <span class="close" id="closeDeleteUserDialog">&times;</span>
        </div>
        <div class="dialog-body doctor_dialog">
            <form action="../../includes/delete_user.php" method="POST" role="form">
                <div class="form-group my-1">
                    <p class="delete_warning"> Are you sure you want to delete user. Please note this action can not be undone.</p>
                </div>
                <div class="form-group my-1 d-none">
                    <label for="user_id" class="my-1">User ID:</label>
                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="">
                </div>
                <div class="form-group my-1 d-none">
                    <label for="user_id" class="my-1">User Type:</label>
                    <input type="hidden" class="form-control" id="user_type" name="user_type" value="">
                </div>
                <div class="btns-group mt-2 mb-2">
                    <a href="#" class="closeBtn" id="cancelDeleteButton">Close</a>
                    <input type="submit" value="Delete" class="btn btn-danger ml-auto deleteBtn">
                </div>
            </form>
        </div>
    </div>
</div>