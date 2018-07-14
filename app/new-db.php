<?php require('../helpers/library.php');

// set variables if user is in post
if ( isset($_GET['user']) ) {
    $user = $_GET['user'];
    $create = $_GET['create'];
}

// create the database if the variable is set
if ($create === "true") {
    if (!file_exists("../db/$user.hbd")) {
        $db = new SQLite3("../db/$user.hbd");
    } else {
        error('Database already exists?');
    }
}

// custom html title
global $pageTitle;
$pageTitle = 'New User Database';

// render the page

include('../helpers/header.php');

// navigation
print '<div class="nav"><a href="../index.php">BACK TO USER SELECT</a></div>';

if ($create !== "true") {
    print '<div id="del-form">';
    print '<h2>Create New Database</h2>';
    print '<div id="left">';
    print '<h3>Username <span class="red">*</span></h3>';
    print '<h3>PIN Protect?</h3>';
    print '</div>';
    print '<div id="right">';
    print '<form action="../app/new-db.php" method="GET">';
    print '<input type="hidden" name="create" value="true" />';
    print '<input class="formstyle" type="text" size="35" name="user" required /><br />';
    print '<input class="checkbox" type="checkbox" name="pin" /><br />';
    print '<button type="submit">SUBMIT</button>';
    print '</form>';
    print '</div>';
    print '</div>';
} elseif ($create === "true") {
    print '<h2>Database Created Successfully!</h2>';
} else {
    print '<h2>Something odd happened.</h2>';
}

include('../helpers/footer.php');

?>