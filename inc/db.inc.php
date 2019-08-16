<?php

$ini = parse_ini_file('config.inc.ini');

$servername = $ini['db_server'];
$username = $ini['db_user'];
$password = $ini['db_password'];
$dbname = $ini['db_name'];

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
$conn->query("SET NAMES 'utf8'");
$conn->query("SET CHARACTER SET utf8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
