<?php
require_once '../config/db.php';

class QuizController
{
    // Fetch questions for a specific topic
    public static function getQuestions($pdo, $topic_id)
    {
        $stmt = $pdo->prepare("SELECT * FROM questions WHERE topic_id = ?");
        $stmt->execute([$topic_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Store a user's quiz score
    public static function storeScore($pdo, $user_id, $topic_id, $score)
    {
        try {
            $stmt = $pdo->prepare("INSERT INTO scores (user_id, topic_id, score) VALUES (?, ?, ?)");
            $stmt->execute([$user_id, $topic_id, $score]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Fetch a user's quiz history
    public static function getUserScores($pdo, $user_id)
    {
        $stmt = $pdo->prepare("SELECT s.id, t.name AS topic, s.score, s.created_at 
                               FROM scores s
                               JOIN topics t ON s.topic_id = t.id
                               WHERE s.user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
