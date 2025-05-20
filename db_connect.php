<?php
$servername = "localhost";
$username = "root"; // Update with actual database username
$password = "inno"; // Update with actual password
$dbname = "cd_growth_partners";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
