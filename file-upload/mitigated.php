<?php
if (isset($_FILES['uploaded'])) {

    $target_dir = "uploads/";
    $filename = $_FILES['uploaded']['name'];
    $target_file = $target_dir . basename($filename);

   
    $allowed = ['jpg', 'png', 'jpeg', 'gif', 'pdf'];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        echo "File type not allowed";
        exit;
    }

    
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime  = finfo_file($finfo, $_FILES['uploaded']['tmp_name']);
    $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];

    if (!in_array($mime, $allowed_mimes)) {
        echo "MIME type not allowed";
        exit;
    }
    finfo_close($finfo);

    
    if (move_uploaded_file($_FILES['uploaded']['tmp_name'], $target_file)) {
        echo "File uploaded safely: " . htmlspecialchars($filename, ENT_QUOTES, 'UTF-8');
    } else {
        echo "Upload failed";
    }
}
?>
