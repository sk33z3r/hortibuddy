<?php require('../helpers/library.php');

// set variables
$user = cleanInput($_GET["user"]);
$room = cleanInput($_GET["room"]);
$prev = cleanInput($_GET["prev"]);

// if a variable is missing, exit with errors
if ( (!isset($user) || $user === '') || (!isset($room) || $room === '') || (!isset($prev) || $prev === '') ) {
    error('Missing a variable');
}

// open the db
if (file_exists("../db/$user.hbd")) {
    $db = new SQLite3("../db/$user.hbd");
} else {
    error('Database doesn\'t exist.');
}

// set SQL to grab rows of data
$getRoom = $db->query("SELECT * FROM $room;");

// custom html title
global $pageTitle;
$pageTitle =  "Stats for $room";

// render the page

include('../helpers/header.php');

// navigation
print '<div class="nav"><a href="../app/menu.php?user='.$user.'">'.$user.'\'s MENU</a> &rharu; <a href="../app/view-rooms.php?user='.$user.'&prev='.$prev.'">VIEW LOGS</a></div>';

print "<h2>Log for $room</h2>";

// display the log
print '<table class="darkTable">';
print '<thead>';
print '<tr>';
print '<th width="100">Date</th>';
print '<th width="100">Time</th>';
print '<th width="100">Temp. (F)</th>';
print '<th width="100">RH (%)</th>';
print '<th width="100">Light Type</th>';
print '<th width="100">Photo-period</th>';
print '<th width="100">PAR (&#181;m)</th>';
print '<th width="100">Notes</th>';
print '</tr>';
print '</thead>';
print '<tbody>';

// parse and display each row from the db
while(($row = $getRoom->fetchArray())){
    print "<tr><td>" . $row['date'] . "</td><td>" . $row['time'] . "</td><td>" . $row['temp'] . "</td><td>" . $row['rh'] . "</td><td>" . $row['light'] . "</td><td>" . $row['period'] . "</td><td>" . $row['par'] . "</td><td>" . $row['notes'] . "</td></tr>";
}

print '</tbody>';
print '</table>';
print '</div>';
print '</div>';
print '</body>';
print '</html>';

include('../helpers/footer.php');

?>