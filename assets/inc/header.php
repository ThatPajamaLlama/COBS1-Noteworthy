<div id="header">
    <div class="wrapper">
        <h1>Noteworthy</h1>
        <?php
            if (in_array(basename($_SERVER['PHP_SELF'], '.php'), ["notes", "edit"])){
                echo "<a id='logoutbtn' href='assets/proc/logout_process.php'>Logout</a>";
            }
        ?>
    </div>
</div>