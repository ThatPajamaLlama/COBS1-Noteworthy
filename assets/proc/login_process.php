<?php

session_start();

$username = $_POST['lusername'];
$password = $_POST['lpassword'];

include "../inc/db_connect.php";

$sql_login = "SELECT username, password FROM user WHERE username LIKE '$username';";
$rs_login = mysqli_query($conn, $sql_login);

if (mysqli_num_rows($rs_login) == 1){
    $details = mysqli_fetch_assoc($rs_login);

    if (password_verify($password, $details['password'])){
        $_SESSION['username'] = $details['username'];
        header('location: ../../notes.php');
        exit;
    } else {
        $errorMessage = "Incorrect password";
    }
} else {
    $errorMessage = "Username not recognised";
}

include "../inc/toast_handler.php";
create_toast("error", "Login Failed", $errorMessage, "../../default.php");

?>