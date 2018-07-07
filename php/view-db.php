<?php
$dir = '../db';
$files = scandir($dir, 0); ?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>HortiBuddy!</title>
        <meta name="description" content="HortiBuddy, the garden companion">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div id="main">
            <h2>Available Users</h2>
            <form action="view-rooms.php" method="POST">
                <?php
                    for($i = 2; $i < count($files); $i++) {
                        print "<button type=\"submit\" name=\"user\" value=\"".$files[$i]."\">".$files[$i]."</button>";
                    }
                ?>
            </form>
        </div>
    </body>
</html>