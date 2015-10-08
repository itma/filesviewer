<?php
    
    $get = $_GET;

    // check if user is logged into the app
    require_once('lib/user.php');
    $i18n = include_once(__DIR__ . '/i18n/en_gb.php');
    $user = new User($i18n);
    if (!$user->isLogged()) {
        $url = 'index.php';
        header('Location: ' . $url);
    }

    $file = 'public/' . $get['file'];

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        readfile($file);
        exit;
    }
?>