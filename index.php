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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Task Tracker</h1>

        <form action="create_task.php" method="POST" class="mb-6">
            <div class="mb-4">
                <input type="text" name="title" placeholder="Task Title" required
                       class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <textarea name="description" placeholder="Task Description"
                          class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
            <button type="submit"
                    class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition duration-300">
                Add Task
            </button>
        </form>

        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Tasks</h2>
        <ul class="space-y-4">
            <?php foreach ($tasks as $task): ?>
                <li class="p-4 bg-gray-50 border border-gray-200 rounded-lg shadow">
                    <div class="flex justify-between items-center mb-2">
                        <strong class="text-xl text-gray-900"><?php echo htmlspecialchars($task['title']); ?></strong>
                        <div>
                            <?php if ($task['status'] === 'pending'): ?>
                                <a href="complete_task.php?id=<?php echo $task['id']; ?>"
                                   class="text-green-500 hover:underline mr-2">Complete</a>
                            <?php endif; ?>
                            <a href="delete_task.php?id=<?php echo $task['id']; ?>"
                               class="text-red-500 hover:underline">Delete</a>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-1"><?php echo htmlspecialchars($task['description']); ?></p>
                    <p class="text-sm text-gray-500">Status: <?php echo htmlspecialchars($task['status']); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
