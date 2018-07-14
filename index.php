<?php require('helpers/library.php');

// scan the db directory
$files = scandir("db/", 0);

// render the page

include('helpers/header.php');

print '<h2>Current Users</h2>';

// Grab the filenames of all .hbd files in the db folder, then strip out .hbd and present the user with all the options
// Start with 2 because unix prints `.` and `..` as items in the array
for($i = 2; $i < count($files); $i++) {
    print '<a href="app/menu.php?user='.substr($files[$i], 0, -4).'"><button>'.substr($files[$i], 0, -4).'</button></a>';
}

// user management nav
print '<div>';
print '<h2>User Management</h2>';
print '<a href="app/del-db.php"><button>Delete</button></a>';
print '<a href="app/new-db.php"><button>Create New</button></a>';
print '</div>';

include('helpers/footer.php');

?>