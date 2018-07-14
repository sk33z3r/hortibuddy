<?php require('../helpers/library.php');

// set the variables
$user = $_GET["user"];
$prev = $_GET["prev"];
$room = $_GET["room"];

// if a variable is missing, exit with errors
if ( (!isset($user) || $user === '') || (!isset($prev) || $prev === '') ) {
    error('Missing a variable');
}

// set the access type
$access = $_GET['delete'];

// check how the page was accessed
if ($access !== "true") {
    // get the list of tables
} elseif ($access === "true") {
    // delete the table
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

    print '<input class="checkbox" type="checkbox" name="tables[]" value="'.$room.'" /><span class="label">List of Existing Table Names</span><br />';

    print '<button type="submit">Delete Selected</button>';
    print '</form>';
    print '</div>';
} elseif (!isset($dbs)) {
    // show an error
    print '<h2>No room selected!</h2>';
    print '<a href="javascript:history.go(-1)"><button>GO BACK</button></a>';
} elseif ($access === "true") {
    // show success message
    print '<h2>Rooms Deleted Successfully!</h2>';
}

include('../helpers/footer.php');

?>