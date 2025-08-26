<?php
// add.php
session_start();
require 'db.php';
require 'logger.php'; // Include logger

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $department = htmlspecialchars(trim($_POST['department']));
    $position = htmlspecialchars(trim($_POST['position']));
    $salary = htmlspecialchars(trim($_POST['salary']));

    // Input validation
    if (!empty($name) && !empty($email) && !empty($department) && !empty($position) && !empty($salary)) {
        $stmt = $conn->prepare("INSERT INTO employees (name, email, department, position, salary) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssd", $name, $email, $department, $position, $salary);
        
        if ($stmt->execute()) {
            logAction("Added employee: $name");
            header("Location: view.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
</head>
<body>
    <h2>Add Employee</h2>
    <form method="POST">
        Name: <input type="text" name="name" required><br>
        Email: <input type="email" name="email" required><br>
        Department: <input type="text" name="department" required><br>
        Position: <input type="text" name="position" required><br>
        Salary: <input type="number" step="0.01" name="salary" required><br>
        <input type="submit" value="Add Employee">
    </form>
</body>
</html>
