<?php

function cleanInput($var) {
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}

/*
 * Generate a random string, using a cryptographically secure
 * pseudorandom number generator (random_int)
 *
 * For PHP 7, random_int is a PHP core function
 * For PHP 5.x, depends on https://github.com/paragonie/random_compat
 *
 * @param int $length      How many characters do we want?
 * @param string $keyspace A string of all possible characters
 *                         to select from
 * @return string
 */

function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_-+=;:<>/?')
{
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}

function genPin() {
    random_str(32);
}

function genPasswd() {
    random_str(16);
}

function encryptDB($pin) {
    // encrypt the database file after it's created with $pin
}

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