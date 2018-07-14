<?php require('../helpers/library.php');

// set variables
$date = date("Y-m-d");
$time = date("H:i:s");
$prev = $_POST['prev'];
$user = $_POST["user"];
$room = $_POST["room"];
$temp = $_POST["temp"];
$rh = $_POST["rh"];
$light = $_POST["light"];
$period = $_POST["period"];
$par = $_POST["par"];
$notes = $_POST["notes"];

// open the db
if (file_exists("../db/$user.hbd")) {
    $db = new SQLite3("../db/$user.hbd");
} else {
    error('Database doesn\'t exist.');
}

// write the form data

// main
$db->exec("INSERT INTO $room (date, time, temp, rh, light, period) VALUES ('$date', '$time', '$temp', '$rh', '$light', '$period');");

// grab the row ID that was just created for later use
$lastID = $db->lastInsertRowID();

// set non-required fields separately, to avoid some entry and syntax errors if left empty
$db->exec("UPDATE $room SET par = $par WHERE id = $lastID;");
$db->exec("UPDATE $room SET notes = \"$notes\" WHERE id = $lastID;");

// read back values from the db for the html display, as a method of verifying the entry was successful
$temp = $db->querySingle("SELECT temp FROM $room WHERE id = $lastID;");
$rh = $db->querySingle("SELECT rh FROM $room WHERE id = $lastID;");
$light = $db->querySingle("SELECT light FROM $room WHERE id = $lastID;");
$period = $db->querySingle("SELECT period FROM $room WHERE id = $lastID;");
$par = $db->querySingle("SELECT par FROM $room WHERE id = $lastID;");
$notes = $db->querySingle("SELECT notes FROM $room WHERE id = $lastID;");

// custom html title
global $pageTitle;
$pageTitle = 'Entry Logged';

// render the page

include('../helpers/header.php');

print '<div class="nav"><a href="../app/menu.php?user='.$user.'">'.$user.'\'s MENU</a> &rharu; <a href="../app/entry-form.php?user='.$user.'&room='.$room.'&prev='.$prev.'">NEW LOG ENTRY</a></div>';
print '<div id="entry-form">';
print '<h2>Entry Logged</h2>';
print '<div id="left">';
print '<h3>Entry ID</h3>';
print '<h3>Entered</h3>';
print '<h3>Room ID</h3>';
print '<h3>Temp. (F)</h3>';
print '<h3>RH (%)</h3>';
print '<h3>Light Type</h3>';
print '<h3>Photoperiod</h3>';
print '<h3>PAR (&#181;m)</h3>';
print '<h3>Notes</h3>';
print '</div>';
print '<div id="right">';
print "<h3>: $lastID</h3>";
print "<h3>: $date at $time</h3>";
print "<h3>: $room</h3>";
print "<h3>: $temp</h3>";
print "<h3>: $rh</h3>";
print "<h3>: $light</h3>";
print "<h3>: $period</h3>";
print "<h3>: $par</h3>";
print "<h3>: $notes</h3>";
print '</div>';
print '</div>';

include('../helpers/footer.php');

?>