<div class="dialog" id="profile">
    <div class="dialog-content">
        <div class="dialog-header">
            <span class="dialog-title">Edit Profile</span>
            <span class="close" id="closeBtn">&times;</span>
        </div>
        <div class="dialog-body">
                <?php
                    if( $_SESSION['user_type'] == 'Patient'){
                ?>
                <form action="../../includes/update_patient.php" method="post" role="form">
                    <div class='form-group my-1'>
                        <label for='firstName' class='my-1'>FirstName:</label>
                        <input type='text' class='form-control' name='firstName' value="<?php echo $result['firstName']?>"  required>
                    </div>
                    <div class='form-group my-1'>
                        <label for='lastName' class='my-1'>LastName:</label>
                        <input type='text' class='form-control' name='lastName' value="<?php echo $result['lastName']?>"  required>
                    </div>
                    <div class='form-group my-1'>
                        <label for='emailAddress' class='my-1'>Email Address:</label>
                        <input type='text' class='form-control' name='emailAddress' value="<?php echo $result['emailAddress']?>" required>
                    </div>
                    <div class='form-group my-1'>
                        <label for='phoneNumber' class='my-1'>Phone Number:</label>
                        <input type='text' class='form-control' name='phoneNumber' value="<?php echo $result['phoneNumber']?>"  required>
                    </div>
                    <div class='form-group my-1 d-none'>
                        <label for='patient_id' class='my-1'>Patient ID:</label>
                        <input type='hidden' class='form-control' id='patient_id' name='patient_id' value="<?php echo $result['patient_id']?>">
                    </div>
                    <div class="btns-group mt-4 mb-2">
                        <a href="#" class="closeBtn" id="closeDialogBtn">Close</a>
                        <input type="submit" value="Update" class="btn submit-Btn btn-primary ml-auto">
                    </div>
                </form>
                <?php
                    }
                    if( $_SESSION['user_type'] == 'Doctor'){
                        echo "
                        <form action='../../includes/update_doctor.php' method='post' role='form'>
                            <div class='form-group my-1'>
                                <label for='fullName' class='my-1'>Name:</label>
                                <input type='text' class='form-control' name='fullName' value='' >
                            </div>
                            <div class='form-group my-1'>
                                <label for='emailAddress' class='my-1'>Email Address:</label>
                                <input type='text' class='form-control' name='emailAddress' value=''  required>
                            </div>
                            <div class='form-group my-1'>
                                <label for='phoneNumber' class='my-1'>Phone Number:</label>
                                <input type='text' class='form-control' name='phoneNumber' value=''  required>
                            </div>
                            <div class='form-group my-1 d-none'>
                                <label for='doctor_id' class='my-1'> ID:</label>
                                <input type='hidden' class='form-control' id='doctor_id' name='doctor_id' value='".$result["doctor_id"]."'>
                            </div>
                            <div class='btns-group mt-4 mb-2'>
                                <a href='#' class='closeBtn' id='closeDialogBtn'>Close</a>
                                <input type='submit' value='Update' class='btn submit-Btn btn-primary ml-auto'>
                            </div>
                        </form>
                        ";
                    }
                ?>
        </div>
    </div>
</div>