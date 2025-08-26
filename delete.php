<?php
// delete.php
session_start();
require 'db.php';
require 'logger.php'; // Include logger

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM employees WHERE id = ?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    logAction("Deleted employee with ID: $id");
    header("Location: view.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
?>
