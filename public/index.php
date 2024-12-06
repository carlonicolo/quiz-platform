<?php
require '../config/db.php';
require '../models/Topic.php';

$topics = Topic::getAllTopics($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz Platform</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Welcome to the Quiz Platform</h1>
    <p>Select a topic to start:</p>
    <ul>
        <?php foreach ($topics as $topic): ?>
            <li><a href="quiz.php?topic_id=<?= $topic['id'] ?>"><?= $topic['name'] ?></a></li>
        <?php endforeach; ?>
    </ul>
    <a href="login.php">Login</a> | <a href="register.php">Register</a>
</body>
</html>
