<?php
    $stylePath = "./styles/";
    $title="Login";
    require_once "./includes/config_session.inc.php";
    include_once './includes/header.php';
    require_once "./includes/login_view.php";

?>
<div class="login-wrapper container">
    <div class="login-form">
        <div class="title">
            <h4 class="text-center">Appointment System Login</h4>
        </div>  
        <?php
            check_login_errors();
        ?>
        <form  action="./includes/signin.inc.php" method="POST">
            <div class="mb-3">
                <label for="user_name" class="form-label">Username:</label><br>
                <input type="text" class="form-control" id="user_name" name="user_name">
            </div>
            <div class="mb-3">
                <label for="user_password" class="form-label">Password:</label><br>
                <input type="password"class="form-control" id="user_password" name="user_password">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary text-center loginBtn">Login</button>
            </div>            
            <p class="text-end"><a href="forgot-password.php">Forgot Password ?</a></p>
            <!-- <p class="text-end">Create Account? <a href="signup.php">Sign Up</a></p> -->
            
        </form>
    </div>
</div>

<?php
    include_once './includes/footer.php'
?>