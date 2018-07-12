<?php
// set the username
$user = $_GET["user"];
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
            <?php print '<div class="nav"><a href="../php/menu.php?user='.$user.'">'.$user.'\'s MENU</a> &rharu; <a href="../php/view-rooms.php?user='.$user.'">VIEW LOGS</a></div>'; ?>
            <h2>Pick a Room</h2>
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
        </div>
    </body>
</html>