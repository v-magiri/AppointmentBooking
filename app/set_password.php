<?php
    $stylePath = "./styles/";
    $title="Set Password";
    require_once "./includes/config_session.inc.php";
    include_once './includes/header.php';
    require_once "./includes/login_view.php";
    include('./includes/database_config.php');
    if(!isset($_GET['id'])){
        header('Location: ./index.php');
    }
?>
<div class="verify-wrapper container">
    <div class="verify-form">
        <div class="title">
            <h4 class="text-center">Set Password</h4>
        </div>
        <?php
            check_verify_errors();
        ?>
        <form  action="./includes/set_password.php" method="POST">
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label><br>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="c_password" class="form-label">Confirm Password:</label><br>
                <input type="password"class="form-control" id="c_password" name="c_password">
            </div>
            <?php
                if(isset($_GET['id'])){
                    $doctor_id= $_GET['id'];
                    echo '
                        <div class="mb-3 d-none">
                            <label for="doctor_id" class="form-label">Doctor ID:</label><br>
                            <input type="password"class="form-control" id="doctor_id" name="doctor_id" value="'.$doctor_id.'">
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
    include_once './includes/footer.php'
?>