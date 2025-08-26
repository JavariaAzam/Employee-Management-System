<?php
// view.php
session_start();
require 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM employees");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Employees</title>
</head>
<body>
    <h2>Employee List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Position</th>
            <th>Salary</th>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <th>Actions</th>
            <?php endif; ?>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['department']); ?></td>
            <td><?php echo htmlspecialchars($row['position']); ?></td>
            <td><?php echo htmlspecialchars($row['salary']); ?></td>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <td>
                    <a href="edit.php?id=<?php echo htmlspecialchars($row['id']); ?>">Edit</a>
                    <a href="delete.php?id=<?php echo htmlspecialchars($row['id']); ?>">Delete</a>
                </td>
            <?php endif; ?>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php if ($_SESSION['role'] === 'admin'): ?>
        <a href="add.php">Add New Employee</a>
    <?php endif; ?>
    <a href="logout.php">Logout</a>
</body>
</html>
