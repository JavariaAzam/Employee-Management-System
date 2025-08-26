<?php
// edit.php
session_start();
require 'db.php';
require 'logger.php'; // Include logger

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM employees WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$employee = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $department = htmlspecialchars(trim($_POST['department']));
    $position = htmlspecialchars(trim($_POST['position']));
    $salary = htmlspecialchars(trim($_POST['salary']));

    $stmt = $conn->prepare("UPDATE employees SET name=?, email=?, department=?, position=?, salary=? WHERE id=?");
    $stmt->bind_param("ssssdi", $name, $email, $department, $position, $salary, $id);
    
    if ($stmt->execute()) {
        logAction("Updated employee: $name");
        header("Location: view.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
</head>
<body>
    <h2>Edit Employee</h2>
    <form method="POST">
        Name: <input type="text" name="name" value="<?php echo htmlspecialchars($employee['name']); ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo htmlspecialchars($employee['email']); ?>" required><br>
        Department: <input type="text" name="department" value="<?php echo htmlspecialchars($employee['department']); ?>" required><br>
        Position: <input type="text" name="position" value="<?php echo htmlspecialchars($employee['position']); ?>" required><br>
        Salary: <input type="number" step="0.01" name="salary" value="<?php echo htmlspecialchars($employee['salary']); ?>" required><br>
        <input type="submit" value="Update Employee">
    </form>
</body>
</html>
