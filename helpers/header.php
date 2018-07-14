<?php

// display html document and header
print '<!DOCTYPE html>';
print '<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->';
print '<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->';
print '<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->';
print '<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->';
print '<head>';
print '<meta charset="utf-8">';
print '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
print "<title>HortiBuddy! | $pageTitle</title>";
print '<meta name="description" content="HortiBuddy, the garden companion">';
print '<meta name="viewport" content="width=device-width, initial-scale=1">';
print '<link rel="stylesheet" href="/css/style.css">';
print '</head>';
print '<body>';
print '<!--[if lt IE 7]>';
print '<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>';
print '<![endif]-->';
print '<div id="main">';
print '<div id="logo"></div>';

?>