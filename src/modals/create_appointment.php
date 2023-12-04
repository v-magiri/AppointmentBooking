<div class="dialog" id="appointmentModal">
    <div class="dialog-content">
        <div class="dialog-header">
            <span class="dialog-title">Book Appointment</span>
            <span class="close" id="closeBtn">&times;</span>
        </div>
        <div class="dialog-body">
            <form action="../../includes/appointment.inc.php" method="post" role="form">
                <div class="form-group my-1">
                    <label for="appointment_date" class="my-1">Date:</label>
                    <input type="date" class="form-control" id="dateInput" name="appointment_date" min="" required>
                </div>
                <div class="form-group my-1">
                    <label for="appointment_time" class="my-1">Time:</label>
                    <input type="time" class="form-control"  name="appointment_time" required>
                </div>
                <div class="form-group my-1 d-none">
                    <label for="doctor_id" class="my-1">Doctor:</label>
                    <input type="hidden" class="form-control" id="doctorInput" name="doctor_id" value="" required>
                </div>
                <div class="form-group">
                    <label for="description" class="my-1">Appointment Reason/Title::</label>
                    <div class="text-wrapper">
                        <textarea  cols="30" rows="3" name="appointment_reason" id="appointment_reason" placeholder=" Event Description" class="form-control text-area" required></textarea>
                        <p><span id="wordCount">0</span>/<span id="wordLimit">30</span> words</p>
                    </div>
                </div>
                <div class="btns-group mt-2 mb-2">
                    <a href="#" class="closeBtn" id="closeFormBtn">Close</a>
                    <input type="submit" value="Book Appointment" class="btn submit-Btn btn-primary ml-auto">
              </div>
            </form>
        </div>
    </div>
</div>