<?php

if (isset($_POST['Submit'])) {

   
    $ip = $_POST['ip'];

  
    $cmd = "ping -c 4 " . $ip;

    echo "<pre>";
    system($cmd);
    echo "</pre>";
}

?>
