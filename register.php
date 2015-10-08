<?php
    // the header file containg all the metatags etc.
    include('partials/header.php')
?>
<div class="row">
    <div class="col-md-6">
        <h1><?= $i18n['registration_cta_short'] ?></h1>
        <?php
            // The register intro text. You can easily change the place
            // where the form appears in the website by copy & paste it
            // into another place
            include('partials/register-txt.php')
        ?>
    </div>
    <div class="col-md-6">
        <h3><?= $i18n['registration_cta_long'] ?> <a href="index.php"><?= $i18n['registration_login'] ?></a>.</h3>
        <?php
            // The register form. You can easily change the place
            // where the form appears in the website by copy & paste it
            // into another place
            include('partials/register-form.php')
        ?>
    </div>
</div>
<?php
    // the footer file
    include('partials/footer.php')
?>