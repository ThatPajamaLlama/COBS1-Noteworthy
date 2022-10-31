<?php

$id = $_GET['id'];
$username = $_SESSION['username'];

$sqlYourNote = "SELECT * FROM note WHERE username LIKE '$username' AND id=$id";
$rsYourNote = mysqli_query($conn, $sqlYourNote);

if (mysqli_num_rows($rsYourNote) == 0) {
    header('location: notes.php');
}

?>