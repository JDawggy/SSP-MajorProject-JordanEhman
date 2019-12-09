<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($_SESSION)) session_start();               // Starts a session to pass your session variables if another session hasnt been started already

if( $_SERVER["SERVER_NAME"] == "dev.justjordan.ca") {
    // PRODUCTION - connects to plesk database
    $conn = mysqli_connect("localhost", "cats_db_network", "SuperJaynedog0", "cats_network");
} else {
    // DEVELOPMENT/LOCAL - connects to mamp database
    $conn = mysqli_connect("localhost", "root", "root", "cats_network");
}

if(mysqli_connect_errno( $conn ) ){
    echo  "Failed to conntect to MySQL: " . mysqli_connect_error();
}

?>