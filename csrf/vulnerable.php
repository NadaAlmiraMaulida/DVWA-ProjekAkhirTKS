<?php

if (isset($_GET['Change'])) {

    // Get input
    $pass_new  = $_GET['password_new'];
    $pass_conf = $_GET['password_conf'];

    // Do the passwords match?
    if ($pass_new == $pass_conf) {

        // They do!
        $pass_new = (
            (isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"]))
            ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $pass_new)
            : mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $pass_new)
        );

        $pass_new = md5($pass_new);

        // Update the database
        $current_user = dvwaCurrentUser();
        $insert = "UPDATE `users` SET password = '$pass_new' WHERE user = '$current_user';";
        $result = mysqli_query($GLOBALS["___mysqli_ston"], $insert)
            or die('<pre>' . ((is_object($GLOBALS["___mysqli_ston"]))
            ? mysqli_error($GLOBALS["___mysqli_ston"])
            : mysqli_error()) . '</pre>');

        // Feedback for the user
        $html .= "<pre>Password Changed.</pre>";
    }
    else {

        // Issue with passwords matching
        $html .= "<pre>Passwords did not match.</pre>";
    }

    ((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"])))
        ? false
        : $___mysqli_res);
}

?>
