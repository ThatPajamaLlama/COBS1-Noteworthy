<?php

session_start();

$id = $_GET['id'];

include "../inc/db_connect.php";

include "../inc/note_security.php";

$sqlDelete = "DELETE FROM note WHERE id=$id";
$rsDelete = mysqli_query($conn, $sqlDelete);

include "../inc/toast_handler.php";
create_toast("success", "Note Deleted", "Your note has been removed", "../../notes.php");

?>

