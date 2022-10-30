<?php 
session_start();

if (isset($_SESSION['username'])){
    header('location: notes.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="assets/style.css"/>
    </head>
    <body id="home-page">
        <?php include 'assets/inc/header.php';?>
        <div id="content">
            <div class="wrapper">
                <div class="flex-container">
                    <div class="image">
                        <img src="assets/img/list.png"/>
                    </div>
                    <div>
                        <form id="login" action="assets/proc/login_process.php" method="post">
                            <h1>Login</h1>
                            <input type="text" id="lusername" name="lusername" placeholder="Username"/>
                            <input type="password" id="lpassword" name="lpassword" placeholder="Password"/>
                            <input type="submit" value="Go!"/>
                        </form>
                        <form id="register" action="assets/proc/register_process.php" method="post">
                            <h1>Register</h1>
                            <input type="text" id="rusername" name="rusername" placeholder="Username"/>
                            <input type="password" id="rpassword" name="rpassword" placeholder="Password"/>
                            <input type="submit" value="Go!"/>
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>
        <?php include 'assets/inc/footer.php';?>
    </body>
</html>

<?php
include "assets/inc/toast_handler.php";
display_toast();
?>