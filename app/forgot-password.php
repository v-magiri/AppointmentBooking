<?php
    $stylePath = "./styles/";
    $title="Forgot Password";
    require_once "./includes/config_session.inc.php";
    include_once './includes/header.php';
    require_once "./includes/login_view.php";

?>
<div class="login-wrapper container">
    <div class="login-form">
        <div class="title">
            <h4 class="text-center">Forgot Password ?</h4>
        </div>
        <?php
            check_reset_errors();
        ?>
        <form  action="./includes/forgot_password.php" method="POST">
            <div class="my-3">
                <label for="username" class="form-label">Enter your Username:</label><br>
                <input type="text" class="form-control" id="username" name="user_name"  required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary text-center resetPassword">Submit</button>
            </div>            
            <!-- <p class="text-end">Create Account? <a href="signup.php">Sign Up</a></p> -->
            
        </form>
    </div>
</div>

<?php
    include_once './includes/footer.php';
?>