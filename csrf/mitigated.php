<?php
session_start();

/*
 * Generate CSRF Token
 */
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/*
 * Proses Form
 */
if (isset($_POST['Change'])) {

    // Validasi CSRF Token
    if (
        !isset($_POST['csrf_token']) ||
        $_POST['csrf_token'] !== $_SESSION['csrf_token']
    ) {
        die('<pre>CSRF validation failed</pre>');
    }

    // Ambil input
    $pass_new  = $_POST['password_new'];
    $pass_conf = $_POST['password_conf'];

    if ($pass_new === $pass_conf) {

        // Hash password
        $pass_new = md5($pass_new);

        // Update database
        $query = "UPDATE users SET password = '$pass_new'
                  WHERE user_id = '" . $_SESSION['user_id'] . "';";

        mysqli_query($GLOBALS["___mysqli_ston"], $query);

        echo "<pre>Password Changed Successfully.</pre>";

        // Regenerate token setelah sukses
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}
?>
