<?php
// db.php
$servername = "localhost";
$username = "root"; // Change as needed
$password = "Javairia2005"; // Change as needed
$dbname = "employee_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
