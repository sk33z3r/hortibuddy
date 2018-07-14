<?php require('../helpers/library.php');

// set the username
$user = cleanInput($_GET["user"]);

// if a variable is missing, exit with errors
if ( (!isset($user) || $user === '') ) {
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
$pageTitle = "$user's Menu";

// render the page

include('../helpers/header.php');

// navigation
print '<div class="nav"><a href="../index.php">CHOOSE ANOTHER USER</a></div>';

print "<h2>$user's Menu</h2>";
print "<a href=\"../app/view-rooms.php?user=$user&prev=new\"><button>New Log Entry</button></a>";
print "<a href=\"../app/view-rooms.php?user=$user&prev=view\"><button>View Logs</button></a>";

include('../helpers/footer.php');

?>