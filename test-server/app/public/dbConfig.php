<?php
// Database configuration
$dbHost     = "mysql"; // localhost, 127.0.0.1:27017
$dbUsername = "root";
$dbPassword = $_ENV["DEV_ROOT_PASSWORD"]; //''
$dbName     = $_ENV["DEV_DATABASE"]; // photos

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>