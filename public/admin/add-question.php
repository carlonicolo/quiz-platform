<?php
require '../../config/db.php';
require '../../controllers/admin.php';

$topics = AdminController::getAllTopics($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $topic_id = $_POST['topic_id'];
    $type = $_POST['type'];
    $question_text = $_POST['question_text'];
    $correct_answers = json_encode(explode(',', $_POST['correct_answers'])); // Convert answers to JSON
    $possible_answers = !empty($_POST['possible_answers']) ? json_encode(explode(',', $_POST['possible_answers'])) : null;

    if (AdminController::addQuestion($pdo, $topic_id, $type, $question_text, $correct_answers, $possible_answers)) {
        echo "Question added successfully!";
    } else {
        echo "Failed to add question!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Question</title>
</head>
<body>
    <h1>Add a New Question</h1>
    <form method="POST">
        <label>Topic:
            <select name="topic_id">
                <?php foreach ($topics as $topic): ?>
                    <option value="<?= $topic['id'] ?>"><?= $topic['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </label><br>
        <label>Type:
            <select name="type">
                <option value="open">Open</option>
                <option value="closed">Closed</option>
                <option value="multiple">Multiple</option>
                <option value="yes_no">Yes/No</option>
            </select>
        </label><br>
        <label>Question: <textarea name="question_text" required></textarea></label><br>
        <label>Correct Answers (comma-separated): <input type="text" name="correct_answers" required></label><br>
        <label>Possible Answers (for multiple-choice, comma-separated): <input type="text" name="possible_answers"></label><br>
        <button type="submit">Add Question</button>
    </form>
    <a href="manage-topics.php">Back to Topic Management</a>
</body>
</html>
