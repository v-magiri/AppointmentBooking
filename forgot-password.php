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
            check_login_errors();
        ?>
        <form  action="./includes/signin.inc.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Enter your Email Address:</label><br>
                <input type="email" class="form-control" id="email" name="email"  required>
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