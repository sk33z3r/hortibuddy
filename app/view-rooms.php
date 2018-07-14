<?php require('../helpers/library.php');

// set the variables
$user = $_GET["user"];
$prev = $_GET["prev"];

// if a variable is missing, exit with errors
if ( (!isset($user) || $user === '') || (!isset($prev) || $prev === '') ) {
    error('Missing a variable');
}

// open the db
if (file_exists("../db/$user.hbd")) {
    $db = new SQLite3("../db/$user.hbd");
} else {
    error('Database doesn\'t exist.');
}

// custom html title
global $pageTitle;
$pageTitle = "$user's Rooms";

// render the page

include('../helpers/header.php');

// setup the flow based on what the last page was
if ($prev === "view") {
    print '<div class="nav"><a href="../app/menu.php?user='.$user.'">'.$user.'\'s MENU</a> &rharu; <a href="#">VIEW LOGS</a></div>';

    print '<h2>Choose a log to view</h2>';

    // set the SQL to get table names
    $tablesquery = $db->query("SELECT name FROM main.sqlite_master WHERE type='table';");
    // get and parse the table names for display, then display them
    while ($table = $tablesquery->fetchArray(SQLITE3_ASSOC)) {
        if($table['name'] != 'sqlite_sequence') {
            print '<a href="../app/display-stats.php?user='.$user.'&room='.$table['name'].'&prev='.$prev.'"><button>'.$table['name'].'</button></a>';
        }
    }
} elseif ($prev === "new") {
    print '<div class="nav"><a href="../app/menu.php?user='.$user.'">'.$user.'\'s MENU</a> &rharu; <a href="#">NEW LOG</a></div>';

    print '<h2>Choose an existing room</h2>';

    // set the SQL to get table names
    $tablesquery = $db->query("SELECT name FROM main.sqlite_master WHERE type='table';");
    // get and parse the table names for display, then display them
    while ($table = $tablesquery->fetchArray(SQLITE3_ASSOC)) {
        if($table['name'] != 'sqlite_sequence') {
            print '<a href="../app/entry-form.php?user='.$user.'&room='.$table['name'].'"><button>'.$table['name'].'</button></a>';
        }
    }

    print '<h2>Create a new room</h2>';
}

include('../helpers/footer.php');

?>