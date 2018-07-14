<?php require('../helpers/library.php');

// set the variables
$user = $_GET["user"];
$room = $_GET["room"];
$prev = $_GET["prev"];

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

// custom html title
global $pageTitle;
$pageTitle = "New Log Entry for $user";

// render the page

include('../helpers/header.php');

// navigation
print '<div class="nav"><a href="../app/menu.php?user='.$user.'">'.$user.'\'s MENU</a> &rharu; <a href="../app/view-rooms.php?user='.$user.'&prev='.$prev.'">CHOOSE ROOM</a> &rharu; <a href="#">NEW LOG ENTRY</a></div>';

print '<div id="entry-form">';
print '<h2>New Log Entry</h2>';
print '<div id="left">';
print '<h3>Temp. (F) <span class="red">*</span></h3>';
print '<h3>RH (%) <span class="red">*</span></h3>';
print '<h3>Light Type <span class="red">*</span></h3>';
print '<h3>Photoperiod <span class="red">*</span></h3>';
print '<h3>PAR (&#181;m)</h3>';
print '<h3>Notes</h3>';
print '</div>';
print '<div id="right">';
print '<form action="../app/log-entry.php" method="POST">';
print '<input type="hidden" name="room" value="'.$room.'" />';
print '<input type="hidden" name="user" value="'.$user.'" />';
print '<input class="formstyle" type="text" size="35" name="temp" required/><br />';
print '<input class="formstyle" type="text" size="35" name="rh" required/><br />';
print '<select class="formstyle" name="light" required>';
print '<option value="HPS">HPS</option>';
print '<option value="MH">MH</option>';
print '<option value="CFL">CFL</option>';
print '<option value="LED">LED</option>';
print '</select><br />';
print '<select class="formstyle" name="period" required>';
print '<option value="MOM">MOM</option>';
print '<option value="GROW">GROW</option>';
print '<option value="BLOOM">BLOOM</option>';
print '</select><br />';
print '<input class="formstyle" type="text" size="35" name="par" /><br />';
print '<textarea class="formstyle" name="notes" class="notes"></textarea><br />';
print '<button type="submit">SUBMIT</button>';
print '</form>';
print '</div>';
print '</div>';

include('../helpers/footer.php');

?>