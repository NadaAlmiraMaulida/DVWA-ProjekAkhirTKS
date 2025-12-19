<?php

if (isset($_GET['name'])) {
    
    $name = htmlspecialchars($_GET['name'], ENT_QUOTES, 'UTF-8');
    echo "Hello $name";
}

?>
