<?php
if ($_GET['delete'] !== "true") {
    // scan the db directory if not deleting
    $files = scandir("../db/", 0);
} elseif ($_GET['delete'] === "true") {
    // get ready to destroy the databases if deleting
    $dbs = $_GET['db'];
    for ($d = 0; $d < count($dbs); $d++) {
        unlink("../db/$dbs[$d].hbd");
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
        <title><?php print "HortiBuddy! The Garden Companion"; ?></title>
        <meta name="description" content="HortiBuddy, the garden companion">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div id="main">
            <div id="logo"></div>
            <div class="nav"><a href="../index.php">BACK TO USER SELECT</a></div>
            <h2>Delete Users</h2>
            <?php if ($_GET['delete'] !== "true") { ?>
            <form action="../php/del-db.php" method="GET">
                <input type="hidden" name="delete" value="true" />
                <?php
                    // Grab the filenames of all .hbd files in the db folder, then strip out .hbd and present the user with all the options
                    // Start with 2 because unix prints `.` and `..` as items in the array
                    for ($i = 2; $i < count($files); $i++) {
                        print '<input type="checkbox" name="db[]" value="'.substr($files[$i], 0, -4).'" /><b>'.substr($files[$i], 0, -4).'</b><br />';
                    }
                ?>
                <button type="submit">Delete Selected</button>
            </form>
            <?php } elseif (!isset($_GET['db'])) { ?>
                <h2>No user selected!</h2>
                <a href="javascript:history.go(-1)"><button>GO BACK</button></a>
            <?php } elseif ($_GET['delete'] === "true") { ?>
                <h2>Databases Deleted Successfully!</h2>
            <?php } ?>
        </div>
    </body>
</html>