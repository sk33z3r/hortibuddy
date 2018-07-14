<?php require('../helpers/library.php');

// set the variables
$user = cleanInput($_GET["user"]);
$prev = cleanInput($_GET["prev"]);
global $create;
global $room;

// if a variable is missing, exit with errors
if ( (!isset($user) || $user === '') || (!isset($prev) || $prev === '') ) {
    error('Missing a variable');
}

// create the database if the variable is set
if ($_GET['create'] === "true") {
    global $create;
    global $room;
    $room = cleanInput($_GET['room']);
    $room = strtoupper($room);
    $create = cleanInput($_GET['create']);
    if (file_exists("../db/$user.hbd")) {
        $db = new SQLite3("../db/$user.hbd");
    } else {
        error('Database doesn\'t exist.');
    }
    // create the table/room
    $db->query("CREATE TABLE IF NOT EXISTS $room (id INTEGER PRIMARY KEY AUTOINCREMENT, sec INTEGER, date TEXT, time TEXT, temp INTEGER, rh INTEGER, light TEXT, period TEXT, par INTEGER, notes TEXT);");
    // set the room name variable from the database
    $roomName = $db->query('SELECT name FROM main.sqlite_master WHERE tbl_name="'.$room.'"')->fetchArray();
}

// custom html title
global $pageTitle;
$pageTitle = "New Room for $user";

// render the page

include('../helpers/header.php');

// navigation
print '<div class="nav"><a href="../app/view-rooms.php?user='.$user.'&prev='.$prev.'">BACK TO ROOM SELECT</a></div>';

if ($create !== "true") {
    print '<div id="del-form">';
    print '<h2>Create New Room</h2>';
    print '<div id="left">';
    print '<h3>Name <span class="red">*</span></h3>';
    print '</div>';
    print '<div id="right">';
    print '<form action="../app/room-add.php" method="GET">';
    print '<input type="hidden" name="create" value="true" />';
    print '<input type="hidden" name="user" value="'.$user.'" />';
    print '<input type="hidden" name="prev" value="'.$prev.'" />';
    print '<input class="formstyle" type="text" size="35" name="room" required /><br />';
    print '<button type="submit">SUBMIT</button>';
    print '</form>';
    print '</div>';
    print '</div>';
} else {
    print "<h2>$roomName[0] was Created Successfully!</h2>";
}

include('../helpers/footer.php');

?>