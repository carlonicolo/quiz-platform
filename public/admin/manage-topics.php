<?php
require '../config/db.php';
require '../controllers/admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $parent_id = $_POST['parent_id'] ?: null;

    if (AdminController::addTopic($pdo, $name, $parent_id)) {
        echo "Topic added successfully!";
    } else {
        echo "Failed to add topic!";
    }
}

$topics = AdminController::getAllTopics($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Topics</title>
</head>
<body>
    <h1>Manage Topics</h1>
    <form method="POST">
        <label>Topic Name: <input type="text" name="name" required></label><br>
        <label>Parent Topic:
            <select name="parent_id">
                <option value="">None</option>
                <?php foreach ($topics as $topic): ?>
                    <option value="<?= $topic['id'] ?>"><?= $topic['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </label><br>
        <button type="submit">Add Topic</button>
    </form>
    <h2>Existing Topics</h2>
    <ul>
        <?php foreach ($topics as $topic): ?>
            <li>
                <?= $topic['name'] ?>
                <?php if ($topic['parent_id']): ?>
                    (Subcategory of <?= $topic['parent_id'] ?>)
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
