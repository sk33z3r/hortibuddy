<?php

// variables
$user = $_POST["user"];
$room = $_POST["room"];

// setup the db
$db = new SQLite3("../db/$user");

$getRoom = $db->query("SELECT * FROM $room;");

$html = '<!DOCTYPE html>';
$html .= '<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->';
$html .= '<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->';
$html .= '<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->';
$html .= '<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->';
$html .= '<head>';
$html .= '<meta charset="utf-8">';
$html .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
$html .= '<title>HortiBuddy!</title>';
$html .= '<meta name="description" content="HortiBuddy, the garden companion">';
$html .= '<meta name="viewport" content="width=device-width, initial-scale=1">';
$html .= '<link rel="stylesheet" href="../css/style.css">';
$html .= '</head>';
$html .= '<body>';
$html .= '<!--[if lt IE 7]>';
$html .= '<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>';
$html .= '<![endif]-->';
$html .= '<div id="table">';
$html .= '<table class="darkTable">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th width="100">Date</th>';
$html .= '<th width="100">Time</th>';
$html .= '<th width="100">Temp. (F)</th>';
$html .= '<th width="100">RH (%)</th>';
$html .= '<th width="100">Light Type</th>';
$html .= '<th width="100">Photo-period</th>';
$html .= '<th width="100">PAR (&#181;m)</th>';
$html .= '<th width="100">Notes</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

while(($row = $getRoom->fetchArray())){
    $html .= "<tr><td>" . $row['date'] . "</td><td>" . $row['time'] . "</td><td>" . $row['temp'] . "</td><td>" . $row['rh'] . "</td><td>" . $row['light'] . "</td><td>" . $row['period'] . "</td><td>" . $row['par'] . "</td><td>" . $row['notes'] . "</td></tr>";
}

$html .= '</tbody>';
$html .= '</table>';
$html .= '</div>';
$html .= '</div>';
$html .= '</body>';
$html .= '</html>';

print $html;

?>