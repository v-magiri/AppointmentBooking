<div class="dialog" id="specialityModal">
    <div class="dialog-content">
        <div class="dialog-header">
            <span class="dialog-title">Create New Speciality</span>
            <span class="close" id="closeBtn">&times;</span>
        </div>
        <div class="dialog-body">
            <form action="../../includes/speciality.inc.php" method="post" role="form">
                <div class="form-group my-1">
                    <label for="speciality_name" class="my-1">Speciality Name:</label>
                    <input type="text" class="form-control" name="speciality_name" required>
                </div>
                <div class="form-group my-1">
                    <label for="speciality_description" class="my-1">Speciality Description:</label>
                    <div class="text-wrapper">
                        <textarea  cols="30" rows="3" name="speciality_description" id="speciality_description" placeholder="Speciality Description" class="form-control text-area" required></textarea>
                        <p><span id="wordCount">0</span>/<span id="wordLimit">30</span> words</p>
                    </div>
                </div>
                <div class="btns-group mt-4 mb-2">
                    <a href="#" class="closeBtn" id="closeDialogBtn">Close</a>
                    <input type="submit" value="Add" class="btn submit-Btn btn-primary ml-auto">
              </div>
            </form>
        </div>
    </div>
</div>