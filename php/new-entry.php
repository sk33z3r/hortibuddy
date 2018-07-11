<?php

// set variables
$date = date("Y-m-d");
$time = date("H:i:s");
$user = $_GET["user"];
$room = $_POST["room"];
$temp = $_POST["temp"];
$rh = $_POST["rh"];
$light = $_POST["light"];
$period = $_POST["period"];
$par = $_POST["par"];
$notes = $_POST["notes"];

// open the db
$db = new SQLite3("../db/$user.hbd");
$db->exec("CREATE TABLE IF NOT EXISTS $room (id INTEGER PRIMARY KEY AUTOINCREMENT, date TEXT, time TEXT, temp INTEGER, rh INTEGER, light TEXT, period TEXT, par INTEGER, notes TEXT);");

// destroy the db
// unlink("$user.db");

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

// setup the html page
$html = '<!DOCTYPE html>';
$html .= '<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->';
$html .= '<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->';
$html .= '<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->';
$html .= '<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->';
$html .= '<head>';
$html .= '<meta charset="utf-8">';
$html .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
$html .= '<title>HortiBuddy! | Entry Logged</title>';
$html .= '<meta name="description" content="HortiBuddy, the garden companion">';
$html .= '<meta name="viewport" content="width=device-width, initial-scale=1">';
$html .= '<link rel="stylesheet" href="../css/style.css">';
$html .= '</head>';
$html .= '<body>';
$html .= '<!--[if lt IE 7]>';
$html .= '<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>';
$html .= '<![endif]-->';
$html .= '<div id="main">';
$html .= '<h2>Entry Logged</h2>';
$html .= '<div id="left">';
$html .= '<h3>Entry ID</h3>';
$html .= '<h3>Entered</h3>';
$html .= '<h3>Room ID</h3>';
$html .= '<h3>Temp. (F)</h3>';
$html .= '<h3>RH (%)</h3>';
$html .= '<h3>Light Type</h3>';
$html .= '<h3>Photoperiod</h3>';
$html .= '<h3>PAR (&#181;m)</h3>';
$html .= '<h3>Notes</h3>';
$html .= '</div>';
$html .= '<div id="right">';
$html .= "<h3>: $lastID</h3>";
$html .= "<h3>: $date at $time</h3>";
$html .= "<h3>: $room</h3>";
$html .= "<h3>: $temp</h3>";
$html .= "<h3>: $rh</h3>";
$html .= "<h3>: $light</h3>";
$html .= "<h3>: $period</h3>";
$html .= "<h3>: $par</h3>";
$html .= "<h3>: $notes</h3>";
$html .= '</div>';
$html .= '</div>';
$html .= '</body>';
$html .= '</html>';

// show the html
print $html;

?>