<?php

// define global variable and default header title
global $pageTitle;
$pageTitle = 'The Garden Companion';

// basic debug printout helper
function error($msg) {
    print '<code>ERROR: '.$msg.'</code>';
    print '<br /><a href="javascript:history.go(-1)"><button>GO BACK</button></a>';
    exit(1);
}

?>