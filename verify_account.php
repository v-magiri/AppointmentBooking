<?php
    $stylePath = "./styles/";
    $title="Verify Account";
    require_once "./includes/config_session.inc.php";
    include_once './includes/header.php';
    require_once "./includes/login_view.php";
    include('./includes/database_config.php');

?>
<div class="verify-wrapper container">
    <div class="verify-form">
        <div class="title">
            <h4 class="text-center">Verify Account</h4>
        </div>
        <?php
            check_verify_errors();
        ?>
        <form  action="./includes/verify_token.php" method="POST">
            <?php
                if (isset($_GET["token"])) {
                    $token = $_GET["token"];
                    try{
                        $query="SELECT d.name FROM tbl_doctors d JOIN tbl_account_tokens t
                                ON d.doctor_id= t.user_id 
                                WHERE t.token=:verification_code";
                        // $stmt=$conn->query($query);
                        $stmt=$conn->prepare($query);
                        $stmt->bindParam(":verification_code",$token);
                        $stmt->execute();
                
                        $result= $stmt->fetch(PDO::FETCH_ASSOC);

                    
                        // $result= $stmt->fetch(PDO::FETCH_ASSOC);
                    }catch(PDOException $e){
                        echo 'Query Failed'. $e->getMessage() .'';
                    }
                    if($result){
                        echo '
                            <div class="welcome-text">
                                <p>Hey <span class="name-txt">'.$result['name'].'</span>, Welcome to the Appointment Booking Application.Please verify your account to proceed.</p>
                            </div>
                            <div class="form-group my-1 d-none">
                                <label for="token" class="my-1">Patient ID:</label>
                                <input type="hidden" class="form-control" id="token" name="token" value="'.$token.'">
                            </div>
                            ';
                    }else{
                        echo '<p>Verification Failed</p>';
                    }
                    
                }
            ?>
            <div class="action_container">
                <button type="submit" class="btn btn-primary text-center" id="verifyBtn">Verify Account</button>
            </div>
        </form>
    </div>
</div>

<?php
    include_once './includes/footer.php'
?>