<?php
require_once('lib/configuration.php');

// the logic responsible for checking if given user
// exist and given data is proper
$post = $_POST;
$get = $_GET;
$configuration = new Configuration();

// if user has sent the form
// the list of the errror that may happen
$errors = array();
if (isset($post) && is_array($post) && count($post) > 0) {
    // credentials given by the user
    $input = $post;
    $errors = $configuration->create($input);
    if ($errors !== false && !is_array($errors)) {
        $user->setFlash('Congratulations! Configuration file has been created. From this moment you can publish the hidden assets on your own webiste!');
        $url = 'index.php';
        header('Location: ' . $url);
        exit;     
    }
} else {
    // try to detect the url under the script is placed
    $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $url = explode('/', $url);
    array_pop($url);
    $input['websiteForm']['url'] = 'http://' . implode('/', $url);
}
 
?>

<!-- Setup forms : START -->
<div class="well well-small">
    <?php if (is_array($errors) && count($errors) > 0): ?>
    <div class="alert alert-warning">
        <strong><i class="fa fa-times"></i> Fill the forms correctly. The errors are listed below:</strong>
        <hr/>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
    <form action="" method="post">
        <?php
            include('site-setup-form.php')
        ?>
        <?php
            include('email-setup-form.php')
        ?>
        <button type="submit" class="btn btn-warning"><i class="fa fa-rocket"></i> Setup the website</button>
    </form>
</div>
<!-- Setup forms : STOP -->