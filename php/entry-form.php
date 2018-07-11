<?php
// set the username
$user = $_GET["user"];
// open the db
$db = new SQLite3("../db/$user.hbd");
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php print "HortiBuddy! | New Log Entry for ".$user; ?></title>
        <meta name="description" content="HortiBuddy, the garden companion">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div id="main">
            <h2>New Log Entry</h2>
            <div id="left">
                <h3>Room ID <span class="red">*</span></h3>
                <h3>Temp. (F) <span class="red">*</span></h3>
                <h3>RH (%) <span class="red">*</span></h3>
                <h3>Light Type <span class="red">*</span></h3>
                <h3>Photoperiod <span class="red">*</span></h3>
                <h3>PAR (&#181;m)</h3>
                <h3>Notes</h3>
            </div>
            <div id="right">
                <form action="../php/new-entry.php?user=<?php print $user; ?>" method="POST">
                    <input type="text" size="35" name="room" required/><br />
                    <input type="text" size="35" name="temp" required/><br />
                    <input type="text" size="35" name="rh" required/><br />
                    <select name="light" required>
                        <option value="HPS">HPS</option>
                        <option value="MH">MH</option>
                        <option value="CFL">CFL</option>
                        <option value="LED">LED</option>
                    </select><br />
                    <select name="period" required>
                        <option value="MOM">MOM</option>
                        <option value="GROW">GROW</option>
                        <option value="BLOOM">BLOOM</option>
                    </select><br />
                    <input type="text" size="35" name="par" /><br />
                    <textarea name="notes" class="notes"></textarea><br />
                    <input type="submit" value="SUBMIT" />
                </form>
            </div>
        </div>
    </body>
</html>