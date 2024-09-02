<?php
require 'db.php';

// Fetch tasks from the database
$stmt = $pdo->prepare("SELECT * FROM tasks ORDER BY created_at DESC");
$stmt->execute();
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Tracker</title>
</head>
<body>
    <h1>Task Tracker</h1>

    <form action="create_task.php" method="POST">
        <input type="text" name="title" placeholder="Task Title" required>
        <textarea name="description" placeholder="Task Description"></textarea>
        <button type="submit">Add Task</button>
    </form>

    <h2>Tasks</h2>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <strong><?php echo htmlspecialchars($task['title']); ?></strong>
                <p><?php echo htmlspecialchars($task['description']); ?></p>
                <p>Status: <?php echo htmlspecialchars($task['status']); ?></p>
                <?php if ($task['status'] === 'pending'): ?>
                    <a href="complete_task.php?id=<?php echo $task['id']; ?>">Complete</a>
                <?php endif; ?>
                <a href="delete_task.php?id=<?php echo $task['id']; ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
