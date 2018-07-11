<?php
// set user variable if it's in post
if ($_GET['user']) {
    $user = $_GET['user'];
}
// create the database if the variable is set
if ($_GET['create'] === "true") {
    if (!file_exists("../db/$user.hbd")) {
        $db = new SQLite3("../db/$user.hbd");
    }
}
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php print "HortiBuddy! | New User Database"; ?></title>
        <meta name="description" content="HortiBuddy, the garden companion">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div id="main">
            <div class="nav"><a href="../index.php">BACK TO USER SELECT</a></div>
            <?php if ($_GET['create'] !== "true") { ?>
                <div id="form">
                    <h2>Create New Database</h2>
                    <div id="left">
                        <h3>Username <span class="red">*</span></h3>
                        <h3>PIN Protect?</h3>
                    </div>
                    <div id="right">
                        <form action="../php/new-db.php" method="GET">
                            <input type="hidden" name="create" value="true" />
                            <input type="text" size="35" name="user" required /><br />
                            <input type="checkbox" name="pin" /><br />
                            <input type="submit" value="SUBMIT" />
                        </form>
                    </div>
                </div>
            <?php } elseif ($_GET['create'] === "true") { ?>
                <h2>Database Created Successfully!</h2>
            <?php } else { ?>
                <h2>Something odd happened.</h2>
            <?php } ?>
        </div>
    </body>
</html>