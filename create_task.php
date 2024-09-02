<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("INSERT INTO tasks (title, description) VALUES (:title, :description)");
    $stmt->execute(['title' => $title, 'description' => $description]);

    header('Location: index.php');
    exit;
}
?>
