<?php

session_start();

if (!isset($_SESSION['username'])){
    header('location: default.php');
}

$conn = mysqli_connect("localhost", "root", "", "thenotesapp");

include "assets/inc/note_security.php";

$id = $_GET['id'];

function GetFormDetails($conn, $id) {
    $sqlNote = "SELECT * FROM note WHERE id=$id";
    $rsNote = mysqli_query($conn, $sqlNote);
    $note = mysqli_fetch_assoc($rsNote);
    return $note;
}

$note = GetFormDetails($conn, $id);

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="assets/style.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    </head>
    <body id="edit-page">
        <?php include 'assets/inc/header.php';?>
        <div id="content">
            <div class="wrapper">
                <!-- FORM TO CREATE NEW NOTES -->
                <form class="userform" action="assets/proc/editnote_process.php" method="POST">
                <a href="notes.php"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>    
                <h1>Edit Note</h1>
                    <div class="flex-container">
                        <div>       
                            <input type="text" name="title" id="title" placeholder="Title" value="<?php echo $note['title'];?>"/>
                            <textarea name="message" id="message" placeholder="Message" rows="6"><?php echo $note['message'];?></textarea>
                            <input type="hidden" name="id" id="id" value="<?php echo $id;?>"/>
                        </div>
                        <input type="submit" value="Save"/>
                    </div>
                </form>
            </div>
        </div>
        
        <?php include 'assets/inc/footer.php';?>
    </body>
</html>

<?php
include "assets/inc/toast_handler.php";
display_toast();
?>