<?php require('../helpers/library.php');

// set the variables
$user = cleanInput($_GET["user"]);
$prev = cleanInput($_GET["prev"]);
$room = cleanInput($_GET["room"]);

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

// set the access type
$access = cleanInput($_GET['delete']);

// check how the page was accessed
if ($access === "true") {
    // delete the tables
    $rooms = $_GET['rooms'];
    for ($d = 0; $d < count($rooms); $d++) {
        $db->query("DROP TABLE main.$rooms[$d];");
    }
}

// render the page

include('../helpers/header.php');

// navigation
print '<div class="nav"><a href="../app/view-rooms.php?user='.$user.'&prev='.$prev.'">BACK TO ROOM SELECT</a></div>';

print '<h2>Delete Rooms</h2>';

// display the page based on access
if ($access !== "true") {
    // show the delete form
    print '<div id="del-form">';
    print '<form action="../app/room-del.php" method="GET">';
    print '<input type="hidden" name="delete" value="true" />';
    print '<input type="hidden" name="user" value="'.$user.'" />';
    print '<input type="hidden" name="prev" value="'.$prev.'" />';

    // set the SQL to get table names
    $tablesquery = $db->query("SELECT name FROM main.sqlite_master WHERE type='table';");
    // get and parse the table names for display, then display them
    while ($tables = $tablesquery->fetchArray(SQLITE3_ASSOC)) {
        if($tables['name'] != 'sqlite_sequence') {
            print '<input class="checkbox" type="checkbox" name="rooms[]" value="'.$tables['name'].'" /><span class="label">'.$tables['name'].'</span><br />';
        }
    }

    print '<button type="submit">Delete Selected</button>';
    print '</form>';
    print '</div>';
} elseif (!isset($rooms)) {
    // show an error
    print '<h2>No room selected!</h2>';
    print '<a href="javascript:history.go(-1)"><button>GO BACK</button></a>';
} elseif ($access === "true") {
    // show success message
    print '<h2>Rooms Deleted Successfully!</h2>';
}

include('../helpers/footer.php');

?>