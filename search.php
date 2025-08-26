<?php
// search.php
session_start();
require 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$search = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search = htmlspecialchars(trim($_POST['search']));
}

$stmt = $conn->prepare("SELECT * FROM employees WHERE name LIKE ? OR department LIKE ?");
$search_param = "%$search%";
$stmt->bind_param("ss", $search_param, $search_param);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Employees</title>
</head>
<body>
    <h2>Search Employees</h2>
    <form method="POST">
        Search: <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>">
        <input type="submit" value="Search">
    </form>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Position</th>
            <th>Salary</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['department']); ?></td>
            <td><?php echo htmlspecialchars($row['position']); ?></td>
            <td><?php echo htmlspecialchars($row['salary']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="view.php">Back to Employee List</a>
</body>
</html>
