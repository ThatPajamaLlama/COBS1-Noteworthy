<?php

function validate_inputs($username, $password, $errors, $conn) {
    global $errors;

    // Length check for username
    // 6 characters or more to minimise repeated usernames (less processing power to check it)
    // 25 characters or less to meet database requirements and stop people forgetting their usernames
    if (strlen($username) < 6 || strlen($username) > 25) {
        $errors[] = "Username must be 6-25 characters";
    }

    // Length check for password
    // 8 characters or more to make passwords more secure and less likely to be guessed/brute-forced
    // 20 characters or less to minimise people forgetting their passwords
    if (strlen($password) < 8 || strlen($password) > 20) {
        $errors[] = "Password must be 8-20 characters";
    }

    // Check if username is taken by someone else
    // Username must be unique as it is the primary key in the database and would lead to database errors otherwise
    $username = mysqli_real_escape_string($username,  $conn);
    $sql_username = "SELECT * FROM user WHERE username LIKE '$username'";
    $rs_username = mysqli_query($conn, $sql_username);
    if (mysqli_num_rows($rs_username) != 0){
        $errors[] = "That username is taken";
    }

    // Return true if validates, return false if not.
    if (count($errors) == 0) {
        return true;
    } else {
        return false;
    }
}

session_start();

$username = $_POST['rusername'];
$password = $_POST['rpassword'];

include "../inc/db_connect.php";
include "../inc/toast_handler.php";

$errors = [];
if (validate_inputs($username, $password, $errors, $conn)) {
    $password = password_hash($password, PASSWORD_BCRYPT);
    $username = mysqli_real_escape_string($conn, $username);
    $sql_newuser = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
    $rs_newuser = mysqli_query($conn, $sql_newuser);

    $_SESSION['username'] = $username;
    create_toast("success", "Welcome!", "New account registered", "../../notes.php");
} else {
    create_toast("error", "Registration Failed", $errors, "../../default.php");
}


?>