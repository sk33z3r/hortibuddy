<?php require('../helpers/library.php');

// set the access type
$access = $_GET['delete'];

// check how the page was accessed
if ($access !== "true") {
    // scan the db directory if not deleting
    $files = scandir("../db/", 0);
} elseif ($access === "true") {
    // get ready to destroy the databases if deleting
    $dbs = $_GET['db'];
    for ($d = 0; $d < count($dbs); $d++) {
        unlink("../db/$dbs[$d].hbd");
    }
}

// render the page

include('../helpers/header.php');

// navigation
print '<div class="nav"><a href="../index.php">BACK TO USER SELECT</a></div>';

print '<h2>Delete Users</h2>';

// display the page based on access
if ($access !== "true") {
    // show the delete form
    print '<div id="del-form">';
    print '<form action="../app/user-del.php" method="GET">';
    print '<input type="hidden" name="delete" value="true" />';
    // Grab the filenames of all .hbd files in the db folder, then strip out .hbd and present the user with all the options
    // Start with 2 because unix prints `.` and `..` as items in the array
    for ($i = 2; $i < count($files); $i++) {
        print '<input class="checkbox" type="checkbox" name="db[]" value="'.substr($files[$i], 0, -4).'" /><span class="label">'.substr($files[$i], 0, -4).'</span><br />';
    }
    print '<button type="submit">Delete Selected</button>';
    print '</form>';
    print '</div>';
} elseif (!isset($dbs)) {
    // show an error
    print '<h2>No user selected!</h2>';
    print '<a href="javascript:history.go(-1)"><button>GO BACK</button></a>';
} elseif ($access === "true") {
    // show success message
    print '<h2>Users Deleted Successfully!</h2>';
}

include('../helpers/footer.php');

?>