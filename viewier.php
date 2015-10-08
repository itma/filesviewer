<?php

    // the header file containg all the metatags etc.
    include('partials/header.php');

    $get = $_GET;
    
    // set the directory to retrevie files from
    $dir = isset($get['dir']) ? $get['dir'] : '';
    $dir = str_replace(array('./', '../', '..'), array('/'), $dir);

    require_once('lib/asset.php');
    require_once('helper/asset.php');

    $asset = new Asset();

    // check if user is logged into the app
    if (!$user->isLogged()) {
        $url = 'index.php';
        header('Location: ' . $url);
    }

    include('partials/user.php');
?>
<div class="row">
    <div class="col-md-3">
        <h2><?= $i18n['directories'] ?></h2>
        <?php if(count($asset->getDirList()) > 0): ?>
            <ul class="nav nav-pills nav-stacked">
                <li class="<?php if (empty($dir)): ?>active<?php endif; ?>"><a href="viewier.php" class="<?php if (empty($dir)): ?>text-warning<?php endif; ?>"><i class="glyphicon glyphicon-upload"></i>&nbsp;&nbsp;<?= $i18n['directory_main'] ?></a></li>
                <?php foreach($asset->getDirList() as $file): ?>
                    <li class="<?php if ($dir == $file['dirname']): ?>active<?php endif; ?>">
                        <a href="viewier.php?dir=<?= $file['dirname'] ?>" class="dirname <?php if ($dir == $file['dirname']): ?>text-warning<?php endif; ?>"><i class="glyphicon glyphicon-folder-<?php if ($dir == $file['dirname']): ?>open<?php else: ?>close<?php endif; ?>"></i>&nbsp;&nbsp;<?= $file['dirname'] ?> <span class="badge"><?= $file['files'] ?></span></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <div>
                <p><?= $i18n['directory_empty'] ?></p>
            </div>    
        <?php endif; ?>
    </div>
    <div class="col-md-9">
        <h2><?= $i18n['directory_files_list'] ?> <u><?= empty($dir) ? $i18n['directory_main'] : '/' . $dir ?></u></h2>

        <?php if (file_exists(__DIR__ . '/public/' . $dir . '/' . 'readme.txt')): ?>

        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-file-text-o"></i> readme.txt</div>
            <div class="panel-body">
                <?= file_get_contents(__DIR__ . '/public/' . $dir . '/' . 'readme.txt') ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if(count($asset->getList($dir)) > 0): ?>
            <table class="table table-responsive">
            <?php foreach($asset->getList($dir) as $file): ?>
                <tr>
                    <td class="text-center" style="width:80%;">
                        <?php $filePath = ($dir ? $dir . '/' : '') . $file['filename'] ?>
                        <?php 
                            // read jpg, png, gif
                            if ($file['readable'] == true && in_array($file['ext'], array('jpg', 'gif', 'png'))): ?>
                                <img alt="<?= $file['filename'] ?>" src="image.php?file=<?= $filePath ?>" class="img-responsive img-rounded" />
                        <?php endif; ?>
                        <?php
                            // read mp3, wav
                            if ($file['readable'] == true && in_array($file['ext'], array('mp3', 'wav'))): ?>
                                <audio controls="controls">
                                    <source src="image.php?file=<?= $filePath ?>" type="audio/mp3"  />
                                </audio>
                        <?php endif; ?>

                        <?php
                            // read mp4
                            if ($file['readable'] == true && in_array($file['ext'], array('mp4'))): ?>
                                <video controls width="100%" height="264">
                                    <source src="video.php?file=<?= $filePath ?>" type="video/mp4"  />
                                </vido>
                        <?php endif; ?>

                        <?php
                            // read txt
                            if ($file['readable'] == true && in_array($file['ext'], array('pdf', 'odp', 'odt', 'ods'))): ?>
                            <iframe src = "js/ViewerJS/#../../public/<?= $filePath ?>" width='100%' height='400' allowfullscreen webkitallowfullscreen></iframe>
                        <?php endif; ?>

                        <?php if ($file['readable'] == false): ?> <span class="label label-danger"><small><?= $i18n['file_is_not_readable'] ?></small> <i data-toggle="tooltip" data-placement="right" title="<?= $i18n['file_is_not_readable_info'] ?>" class="glyphicon glyphicon-question-sign"></i></span><?php endif; ?>
                    </td>
                    <td style="vertical-align:middle;">
                        <a href="download.php?file=<?= $filePath ?>"><?= $file['filename'] ?></a><br/>
                        <small class="text-muted"><?= $file['mtime'] ?></small>
                    </td>
                    <td class="text-center" style="vertical-align:middle; width:10%;">
                        <a class="btn btn-danger" href="download.php?file=<?= $filePath ?>"><i class="fa fa-arrow-circle-o-down"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </table>
        <?php else: ?>
            <div>
                <p><?= $i18n['directory'] ?> "<?= empty($dir) ? "the main directory" : '/' . $dir ?>" <?= $i18n['is_empty'] ?>.</p>
                <?php if (!empty($dir)): ?>
                    <p><a href="viewier.php" class="btn btn-warning"><?= $i18n['back_to_main_directory'] ?></a></p>
                <?php endif; ?>
            </div>    
        <?php endif; ?>
    </div>            
</div>
<script>
    $(document).ready(function(){
        $('.dirname').mouseover(function(){
            if (!$(this).hasClass('text-warning')) {
                $('i', this).removeClass('glyphicon glyphicon-folder-close');
                $('i', this).addClass('glyphicon glyphicon-folder-open');
            }
        });
        $('.dirname').mouseout(function(){
            if (!$(this).hasClass('text-warning')) {
                $('i', this).removeClass('glyphicon glyphicon-folder-open');
                $('i', this).addClass('glyphicon glyphicon-folder-close');
            }
        });
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<?php
    // the footer file
    include('partials/footer.php')
?>