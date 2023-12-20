<?php
    $stylePath = "./styles/";
    $title="Appointment Booking";
    require_once './includes/config_session.inc.php';
    include_once './includes/header.php';
?>
    <div class="container banner">
        <div class="row">
            <div class="banner-text col-md-6">
                <h2>Appointment Booking Application</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo, officia, nisi molestiae tempora soluta iste, eaque at aliquid expedita eveniet fugit ab exercitationem nam nulla minima qui natus porro officiis!</p>
                <div class="actions-Btn">
                    <a href="./login.php" class="appointmentBtn">Book Appointment</a>
                </div>
            </div>
            <div class="banner-illustration col-md-6">
                <img src="./assets/banner-img.png" alt="Appointment Banner">
            </div>
        </div>
    </div>
<?php
    include_once './includes/footer.php'
?>