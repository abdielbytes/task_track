<?php
require 'db.php';

$stmt = $pdo->query('SELECT * FROM tasks ORDER BY created_at DESC');
$tasks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Tracker</title>
</head>
<body>
    <h1>Task Tracker</h1>
    <a href="create.php">Add New Task</a>
    <table border="1">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= htmlspecialchars($task['title']); ?></td>
                <td><?= htmlspecialchars($task['description']); ?></td>
                <td><?= htmlspecialchars($task['status']); ?></td>
                <td>
                    <a href="edit.php?id=<?= $task['id']; ?>">Edit</a>
                    <a href="delete.php?id=<?= $task['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
