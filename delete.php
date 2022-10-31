<?php

session_start();

if (!isset($_SESSION['username'])){
    header('location: default.php');
}

$conn = mysqli_connect("localhost", "root", "", "thenotesapp");

$id = $_GET['id'];

include "assets/inc/note_security.php";

function GetNoteDetails($conn, $id) {
    $sqlNote = "SELECT * FROM note WHERE id=$id";
    $rsNote = mysqli_query($conn, $sqlNote);
    $note = mysqli_fetch_assoc($rsNote);
    return $note;
}

$note = GetNoteDetails($conn, $id);

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="assets/style.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    </head>
    <body id="delete-page">
        <?php include 'assets/inc/header.php';?>
        <div id="content">
            <div class="wrapper">
                <div class="userform">
                    <h1>Delete Note</h1>
                    <p>Are you sure you'd like to delete this note?</p>
                    <div class="note">
                        <h1><i class='fa fa-thumb-tack' aria-hidden='true'></i><?php echo $note['title'];?></h1>
                        <p><?php echo $note['message'];?></p>
                    </div>
                    <div class="flex-container">
                        <a id="yes" href="assets/proc/deletenote_process.php?id=<?php echo $id;?>">Yes</a>
                        <a id="no" href="notes.php">No</a>
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