<?php
    session_start();
    $get = $_GET;
    if (isset($get['file']) && !empty($get['file'])) {
        require_once('lib/user.php');
        $i18n = include_once(__DIR__ . '/i18n/en_gb.php');
        $user = new User($i18n);
        if ($user->isLogged()) {
            readfile('public/'. $get['file']);
        }
    }

?>