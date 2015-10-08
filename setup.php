<?php
    // the header file containg all the metatags etc.
    include('partials/header.php')
?>
<div class="row">
    <div class="col-md-6">
        <h1>Setup the script</h1>
        <p>
            You are a one step from publishing your music, ebooks, videos and so on for a group of people you would like to give it all to them. Put a few information required to run the script into the form.
            <br/><br/>
            After you have configured the script to work, login via FTP into your server and find the "public" directory placed in the root directory of the script. Then, upload the files
            you would like to publish for your audience.
            <br/><br/>
            That's all!
            <br/><br/>
            PS. If you have expierienced some problems with configuration of the script, do not hesitate to <a class="text-warning" href="mailto:andrew@itma.pl">contact</a> the author.
            <br/><br/>
            <div class="well">
                <strong>Important!</strong><br/>
                Remeber to set the rights to write into the "db" directory, which is placed in the root directory of the script.
            </div>
        </p>
        <img src="img/top-secret.png" class="img-responsive" />

    </div>
    <div class="col-md-6">
        <?php
            include('partials/setup-form.php')
        ?>
    </div>
</div>
<?php
    // the footer file
    include('partials/footer.php')
?>