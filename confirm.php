<?php
    // The confirmation point. Here user may confirm the newly created account.
    $get = $_GET;
    if (isset($get['hash']) && !empty($get['hash'])) {
        require_once('lib/user.php');
        $user = new User();
        if ($user->confirm($get['hash'])) {
            $user->setFlash('Your account has been activated. Now, you are able to login into the account and see the hidden assets we have uploaded for you.');
            $url = 'index.php';
            header('Location: ' . $url);
            exit;     
        }
    }

?>