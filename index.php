<?php
// scan the db directory
$files = scandir("db/", 0); ?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php print "HortiBuddy! The Garden Companion"; ?></title>
        <meta name="description" content="HortiBuddy, the garden companion">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div id="main">
            <h2>Open or Create a Database</h2>
            <?php
                // Grab the filenames of all .hbd files in the db folder, then strip out .hbd and present the user with all the options
                // Start with 2 because unix prints `.` and `..` as items in the array
                for($i = 2; $i < count($files); $i++) {
                    print '<a href="php/menu.php?user='.substr($files[$i], 0, -4).'"><button>'.substr($files[$i], 0, -4).'</button></a>';
                }
            ?>
            <a href="php/new-db.php"><button id="create">Create New</button></a>
        </div>
    </body>
</html>