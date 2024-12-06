<?php
require 'config/db.php';
require 'controllers/quiz.php';

$topic_id = $_GET['topic_id'];
$questions = QuizController::getQuestions($pdo, $topic_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz</title>
</head>
<body>
    <h1>Quiz</h1>
    <form method="POST" action="result.php">
        <input type="hidden" name="topic_id" value="<?= $topic_id ?>">
        <?php foreach ($questions as $index => $question): ?>
            <div>
                <p><?= ($index + 1) . ". " . $question['question_text'] ?></p>
                <?php if ($question['type'] === 'multiple'): ?>
                    <?php foreach (json_decode($question['possible_answers']) as $option): ?>
                        <label><input type="checkbox" name="answers[<?= $question['id'] ?>][]" value="<?= $option ?>"> <?= $option ?></label><br>
                    <?php endforeach; ?>
                <?php elseif ($question['type'] === 'yes_no'): ?>
                    <label><input type="radio" name="answers[<?= $question['id'] ?>]" value="yes"> Yes</label>
                    <label><input type="radio" name="answers[<?= $question['id'] ?>]" value="no"> No</label>
                <?php else: ?>
                    <input type="text" name="answers[<?= $question['id'] ?>]">
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
