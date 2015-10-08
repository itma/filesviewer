<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    // check if the config file exists, if not redirect to setup
    $scriptFilename = isset($_SERVER['SCRIPT_FILENAME']) ? $_SERVER['SCRIPT_FILENAME'] : '';
    $scriptFilename = explode('/', $scriptFilename);
    $scriptFilename = array_pop($scriptFilename);

    $configFile = __DIR__ . '/../db/config.php';
    if (!file_exists($configFile)) {
        $config['site_name'] = 'The Secured Files Viewier';
        $config['owner_name'] = 'Andrew Bernat / andrew@itma.pl';
        $i18n = include_once(__DIR__ . '/../i18n/en_gb.php');
        if ($scriptFilename != 'setup.php') {
            header('Location: setup.php');
        }
    } else {
        if ($scriptFilename == 'setup.php') {
            header('Location: index.php');
        }
        $config = include_once('db/config.php'); 
        $i18n = include_once(__DIR__ . '/../i18n/' . $config['site_language'] . '.php');
    }

    require_once('lib/user.php');
    $user = new User($i18n);
    $message = $user->getFlash();
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $config['site_name'] ?></title>
    <link href="css/bootstrap/css/bootstrap.css" rel="stylesheet">        
    <link href="css/style.css" rel="stylesheet" type='text/css'>
    <script src="js/jquery.js"></script>
    <link href="css/bootswatch.css" rel="stylesheet" type='text/css'>
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <script src="css/bootstrap/js/bootstrap.min.js"></script>  
</head>
<body>
<div class="container">
<?php
    if (isset($message) && !empty($message)):
?>
<div class="row">
    <div class="col-md-12 text-center">
        <div class="alert alert-success">
            <i class="fa fa-check-square"></i> <?= $message ?>    
        </div>        
    </div>
</div>
<?php
    endif;
?>