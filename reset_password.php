<?php
    $stylePath = "./styles/";
    $title="Reset Password";
    require_once "./includes/config_session.inc.php";
    include_once './includes/header.php';
    require_once "./includes/login_view.php";

?>
<div class="verify-wrapper container">
    <div class="verify-form">
        <div class="title">
            <h4 class="text-center">Reset Password</h4>
        </div>
        <?php
            check_verify_errors();
        ?>
        <form  action="./includes/password.inc.php" method="POST">
            <div class="mb-3">
                <label for="pwd" class="form-label">Password:</label><br>
                <input type="password" class="form-control" id="pwd" name="pwd">
            </div>
            <div class="mb-3">
                <label for="c_pwd" class="form-label">Confirm Password:</label><br>
                <input type="password"class="form-control" id="c_pwd" name="c_pwd">
            </div>
            <?php
                if(isset($_GET['token'])){
                    $token= $_GET['token'];
                    echo '
                        <div class="mb-3 d-none">
                            <label for="token" class="form-label">Token:</label><br>
                            <input type="text"class="form-control" id="token" name="token" value="'.$token.'">
                        </div>
                        ';
                }
            ?>
            <div class="action_container">
                <button type="submit" class="btn btn-primary text-center mt-4">Set Password</button>
            </div>            
        </form>
    </div>
</div>
<?php
    include_once './includes/footer.php';
?>