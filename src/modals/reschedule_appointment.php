<div class="dialog" id="reschedule_dialog">
    <div class="dialog-content">
        <div class="dialog-header">
            <span class="dialog-title">Reschedule Appointment</span>
            <span class="close" id="closeBtn">&times;</span>
        </div>
        <div class="dialog-body doctor_dialog">
            <form role="form" action="../../includes/update_appointment.php" method="post">
                <div class="form-group my-1">
                    <label for="appointment_date" class="my-1">Date:</label>
                    <input type="date" class="form-control" id="dateInput" name="appointment_date" min="" required>
                </div>
                <div class="form-group my-1">
                    <label for="appointment_time" class="my-1">Time:</label>
                    <input type="time" class="form-control"  id="timeInput" name="appointment_time" value="" min=""  max="" required>
                </div>
                <div class="form-group my-1 d-none">
                    <label for="doctor_id" class="my-1">Appointment ID:</label>
                    <input type="hidden" class="form-control" id="appointment_input" name="appointment_id" value="">
                </div>
                <div class="btns-group mt-2 mb-2">
                    <a href="#" class="closeBtn" id="hideDialogBtn">Close</a>
                    <input type="submit" value="Submit" class="btn submit-Btn btn-primary ml-auto">
                </div>
            </form>
        </div>
    </div>
</div>