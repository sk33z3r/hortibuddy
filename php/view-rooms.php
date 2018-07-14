<?php
// if a variable is missing, exit with errors
if ( (!isset($_GET["user"]) || $_GET["user"] === '') || (!isset($_GET["prev"]) || $_GET["prev"] === '') ) {
    print '<code>ERROR: Missing a variable';
    print '<br /><a href="/">Go Back</a>';
    exit(1);
}
// set the variables
$user = $_GET["user"];
$prev = $_GET["prev"];
// open the db
if (file_exists("../db/$user.hbd")) {
    $db = new SQLite3("../db/$user.hbd");
}
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php print "HortiBuddy! | ".$user."'s Rooms"; ?></title>
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
            <?php if ($prev === "view") { ?>
                <?php print '<div class="nav"><a href="../php/menu.php?user='.$user.'">'.$user.'\'s MENU</a> &rharu; <a href="#">VIEW LOGS</a></div>'; ?>
                <h2>Choose a log to view</h2>
                <form action="../php/display-stats.php?user=<?php print $user; ?>" method="POST">
                <?php
                    // set the SQL to get table names
                    $tablesquery = $db->query("SELECT name FROM main.sqlite_master WHERE type='table';");
                    // get and parse the table names for display, then display them
                    while ($table = $tablesquery->fetchArray(SQLITE3_ASSOC)) {
                        if($table['name'] != 'sqlite_sequence') {
                            print "<button type=\"submit\" name=\"room\" value=\"".$table['name']."\">".$table['name']."</button>";
                        }
                    }
                ?>
                </form>
            <?php } elseif ($prev === "new") { ?>
                <?php print '<div class="nav"><a href="../php/menu.php?user='.$user.'">'.$user.'\'s MENU</a> &rharu; <a href="#">NEW LOG</a></div>'; ?>
                <h2>Choose an existing room</h2>
                <?php
                    // set the SQL to get table names
                    $tablesquery = $db->query("SELECT name FROM main.sqlite_master WHERE type='table';");
                    // get and parse the table names for display, then display them
                    while ($table = $tablesquery->fetchArray(SQLITE3_ASSOC)) {
                        if($table['name'] != 'sqlite_sequence') {
                            print '<a href="../php/entry-form.php?user='.$user.'&room='.$table['name'].'"><button>'.$table['name'].'</button></a>';
                        }
                    }
                ?>
                <h2>Create a new room</h2>
            <?php } ?>
        </div>
    </body>
</html>