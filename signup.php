<?php
    $stylePath = "./styles/";
    $title="Patient Registration";
    include_once './includes/header.php';
    require_once "./includes/config_session.inc.php";
    require_once "./includes/registration_view.php";

?>
<div class="signup-wrapper">
    <div class="signup-form">
        <div class="title mb-4">
            <h4 class="text-center">Patient Registration</h4>
        </div>
        <form action="./includes/signup.inc.php" method="POST">
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName">
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName">
            </div>
            <div class="mb-3">
                <label for="emailAddress" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="emailAddress" name="emailAddress">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber">
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Password</label>
                <input type="password" class="form-control" id="pwd" name="pwd">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            </div>
            
            <button type="submit" class="btn btn-primary text-center">Submit</button>

        </form>
        <?php 
            check_registration_errors();
        ?>
    </div>
</div>

<?php
    include_once './includes/footer.php'
?>