<?php

if (isset($_POST['Submit'])) {

       $ip = $_POST['ip'];
    if (!filter_var($ip, FILTER_VALIDATE_IP)) {
        echo "<pre>Invalid IP address</pre>";
        exit;
    }

        $safe_ip = escapeshellarg($ip);

   
    $cmd = "ping -c 4 " . $safe_ip;

    echo "<pre>";
    system($cmd);
    echo "</pre>";
}

?>
