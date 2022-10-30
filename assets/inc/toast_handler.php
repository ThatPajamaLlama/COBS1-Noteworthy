<?php

function create_toast($type, $header, $body, $redirect) {
    if (is_array($body)) {
        $message = "";
        foreach ($body as $bulletPoint) {
            $message .= "<li>" . $bulletPoint . "</li>"; 
        }
    } else {
        $message = $body;
    }

    $_SESSION['toast'] = [
        "type" => $type,
        "header" => $header,
        "message" => $message
    ];
    header('location: ' . $redirect);
}

function display_toast() {
    if (isset($_SESSION['toast'])) {
        $type = $_SESSION['toast']['type'];
        $header = $_SESSION['toast']['header'];
        $message = $_SESSION['toast']['message'];
        echo "<script src='assets/js/tata.js'></script>";
        echo "<script type='text/javascript'>
            tata.$type('$header', '$message', {
                position: 'br',
                duration: 5000
            });
            </script>";
        unset($_SESSION['toast']);
    }
}
?>