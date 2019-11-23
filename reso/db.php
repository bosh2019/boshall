<?php
$servername = "localhost";
$username = "boshall";
$password = "boshall#$*";
$db="boshall_db";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";
?>