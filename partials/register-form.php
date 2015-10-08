<?php
// the logic responsible for creating new account
$post = $_POST;
$get = $_GET;

// if user has sent the form
$result = false;
if (isset($post) && is_array($post) && count($post) > 0) {
    // credentials given by the user
    $input = $post['registerForm'];
    $result = $user->create($input);
    if ($result !== false && !is_array($result)) {
        $user->setFlash($i18n['registration_account_created']);
        $url = 'index.php';
        header('Location: ' . $url);
        exit;     
    }
}
?>

<!-- Register form : START -->
<div class="well well-small">
    <?php if (is_array($result) && count($result) > 0): ?>
    <div class="alert alert-warning">
        <strong><i class="fa fa-times"></i> <?= $i18n['registration_errors'] ?>:</strong>
        <hr/>
        <ul>
            <?php foreach ($result as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
    <form action="" method="post">
      <div class="form-group">
        <label for="name"><?= $i18n['registration_form_label_name'] ?></label>
        <input value="<?= isset($input['name']) ? $input['name'] : '' ?>" name="registerForm[name]" type="text" class="form-control" id="name" placeholder="<?= $i18n['registration_form_placeholder_name'] ?>">
      </div>
      <div class="form-group">
        <label for="mobile"><?= $i18n['registration_form_label_mobile'] ?></label>
        <input value="<?= isset($input['mobile']) ? $input['mobile'] : '' ?>" name="registerForm[mobile]" type="text" class="form-control" id="mobile" placeholder="<?= $i18n['registration_form_placeholder_mobile'] ?>">
      </div>
      <div class="form-group">
        <label for="login"><?= $i18n['registration_form_label_email'] ?></label>
        <input value="<?= isset($input['email']) ? $input['email'] : '' ?>" name="registerForm[email]" type="email" class="form-control" id="login" placeholder="<?= $i18n['registration_form_placeholder_email'] ?>">
      </div>
      <div class="form-group">
        <label for="password"><?= $i18n['registration_form_label_password'] ?></label>
        <input value="<?= isset($input['password']) ? $input['password'] : '' ?>" name="registerForm[password]" type="password" class="form-control" id="password" placeholder="<?= $i18n['registration_form_placeholder_password'] ?>">
      </div>
      <button type="submit" class="btn btn-warning"><i class="fa fa-user"></i> <?= $i18n['registration_btn'] ?></button>
    </form>
</div>
<!-- Register form : STOP -->