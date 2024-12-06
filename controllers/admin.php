<?php
require_once '../config/db.php';

class AdminController
{
    // Add a new topic or subcategory
    public static function addTopic($pdo, $name, $parent_id = null)
    {
        try {
            $stmt = $pdo->prepare("INSERT INTO topics (name, parent_id) VALUES (?, ?)");
            $stmt->execute([$name, $parent_id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Fetch all topics
    public static function getAllTopics($pdo)
    {
        $stmt = $pdo->query("SELECT * FROM topics");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new question
    public static function addQuestion($pdo, $topic_id, $type, $question_text, $correct_answers, $possible_answers = null)
    {
        try {
            $stmt = $pdo->prepare("INSERT INTO questions (topic_id, type, question_text, correct_answers, possible_answers) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$topic_id, $type, $question_text, $correct_answers, $possible_answers]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
