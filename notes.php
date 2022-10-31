<?php

session_start();

if (!isset($_SESSION['username'])){
    header('location: default.php');
}

$conn = mysqli_connect("localhost", "root", "", "thenotesapp");

function DisplayNotes($conn) {
    $username = $_SESSION['username'];
    $sql_usernotes = "SELECT id, title, message FROM note WHERE username LIKE '$username'";
    $rs_usernotes = mysqli_query($conn, $sql_usernotes);
    $colors = ["blue", "green", "pink", "yellow", "orange"];

    for ($i = 1; $i <= mysqli_num_rows($rs_usernotes); $i++){
        $color = $colors[array_rand($colors, 1)];
        $note = mysqli_fetch_assoc($rs_usernotes);
        echo "<div class='note $color'>";
        echo    "<h1><i class='fa fa-thumb-tack' aria-hidden='true'></i>" . $note['title'] . "</h1>";
        echo    "<p>" . $note['message'] . "</p>";
        echo    "<div class='buttons'>";
        echo    "<a class='edit' href='edit.php?id=" . $note['id'] . "'><i class='fa fa-pencil' aria-hidden='true'></i></a>";
        echo    "<a class='delete' href='delete.php?id=" . $note['id'] . "'><i class='fa fa-times' aria-hidden='true'></i></a>";
        echo    "</div>";
        echo "</div>";
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="assets/style.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    </head>
    <body id="notes-page">
        <?php include 'assets/inc/header.php';?>
        <div id="content">
            <div class="wrapper">
                <!-- FORM TO CREATE NEW NOTES -->
                <form class="userform" action="assets/proc/newnote_process.php" method="POST">
                    <h1>New Note</h1>
                    <div class="flex-container">
                        <div>       
                            <input type="text" name="title" id="title" placeholder="Title"/>
                            <textarea name="message" id="message" placeholder="Message" rows="6"></textarea>
                        </div>
                        <input type="submit" value="Create"/>
                    </div>
                </form>

                <!-- PUBLISHED NOTES -->
                <div id="published-notes" class="flex-container">
                    <?php DisplayNotes($conn); ?>
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