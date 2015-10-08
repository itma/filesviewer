<?php
    // the logic responsible for checking if given user
    // exist and given data is proper
    $post = $_POST;
    $get = $_GET;
    
    // check if the user would like to logout
    if (isset($get['logout']) && $get['logout'] == 'true') {
        $user->logout();
    }
    
    // if user has sent the form
    // the list of the errror that may happen
    $errors = array();
    if (isset($post) && is_array($post) && count($post) > 0) {
        // credentials given by the user
        $email = $post['loginForm']['email'];
        $password = $post['loginForm']['password'];
    
        if (($data = $user->auth($email, $password))) {
            if ($user->login($data)) {
                $url = 'viewier.php';
                header('Location: ' . $url);
                exit;     
            } else {
                $errors[] = $i18n['login_error_account_not_confirmed'];
            }
        } else {
            $errors[] = $i18n['login_error_wrong_login'];
        }
    }
?>

<!-- Login form : START -->
<div class="well well-small">
    <?php if (is_array($errors) && count($errors) > 0): ?>
    <div class="alert alert-warning">
        <strong><i class="fa fa-times"></i> <?= $i18n['login_errors'] ?>:</strong>
        <hr/>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
    <form action="" method="post">
      <div class="form-group">
        <label for="login"><?= $i18n['login_form_label_email'] ?></label>
        <input name="loginForm[email]" type="email" class="form-control" id="login" placeholder="<?= $i18n['login_form_placeholder_email'] ?>">
      </div>
      <div class="form-group">
        <label for="password"><?= $i18n['login_form_label_password'] ?></label>
        <input name="loginForm[password]" type="password" class="form-control" id="password" placeholder="<?= $i18n['login_form_placeholder_password'] ?>">
      </div>
      <button type="submit" class="btn btn-warning"><i class="fa fa-lock"></i> <?= $i18n['login_btn'] ?></button>
    </form>
</div>
<!-- Login form : STOP -->