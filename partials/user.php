<?php
    // retrieve the user data
    $user = $user->getData();
?>

<div class="col-md-2">
    <img src="img/top-secret.png" class="img-responsive" />
</div>
<div class="col-md-7">
</div>
<div class="col-md-3">
    <div class="panel panel-default">
      <div class="panel-body">
        <p><?= $i18n['user_logged_as'] ?> <?= $user['name'] ?> <a href="index.php?logout=true" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-lock"></i> <?= $i18n['logout_btn'] ?></a></p>
      </div>
    </div>
</div>