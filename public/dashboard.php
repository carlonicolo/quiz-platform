<?php
require 'config/db.php';
require 'controllers/quiz.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$scores = QuizController::getUserScores($pdo, $_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?= $_SESSION['username'] ?></h1>
    <h2>Your Quiz History</h2>
    <ul>
        <?php foreach ($scores as $score): ?>
            <li>Topic: <?= $score['topic'] ?> | Score: <?= $score['score'] ?> | Date: <?= $score['created_at'] ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="logout.php">Logout</a>
</body>
</html>
