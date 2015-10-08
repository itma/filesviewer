<?php
    // the header file containg all the metatags etc.
    include('partials/header.php')
?>
<div class="row">
    <div class="col-md-6">
        <h1><?= $config['site_name'] ?></h1>
        <?php
            // The welcome to text. You can easily change the place
            // where the form appears in the website by copy & paste it
            // into another place
            include('partials/welcome-txt.php')
        ?>
    </div>
    <div class="col-md-6">
        <h3><?= $i18n['login_cta'] ?> <a href="register.php"><?= $i18n['login_register_new_account'] ?></a>.</h3>
        <?php
            // The login form. You can easily change the place
            // where the form appears in the website by copy & paste it
            // into another place
            include('partials/login-form.php')
        ?>
        <img src="img/top-secret.png" class="img-responsive" style="width:30%;" />
    </div>
</div>
<?php
    // the footer file
    include('partials/footer.php')
?>