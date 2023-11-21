<div class="dialog" id="appointmentModal">
    <div class="dialog-content">
        <div class="dialog-header">
            <span class="dialog-title">Book Appointment</span>
            <span class="close" id="closeBtn">&times;</span>
        </div>
        <div class="dialog-body">
            <form action="" method="post" role="form">
                <div class="form-group my-1">
                    <label for="fullName" class="my-1">Date:</label>
                    <input type="text" class="form-control" name="fullName" placeholder="John Doe" >
                </div>
                <div class="form-group my-1">
                    <label for="emailAddress" class="my-1">Time:</label>
                    <input type="text" class="form-control" name="emailAddress" placeholder="johnDoe@gmail.com" required>
                </div>
                <div class="form-group my-1">
                    <label for="phoneNumber" class="my-1">Appointment reason/Title:</label>
                    <input type="text" class="form-control" name="phoneNumber" placeholder="0722000000" required>
                </div>
                <div class="btns-group mt-4 mb-2">
                    <a href="#" class="closeBtn" id="closeDialogBtn">Close</a>
                    <input type="submit" value="Book Appointment" class="btn submit-Btn btn-primary ml-auto">
              </div>
            </form>
        </div>
    </div>
</div>