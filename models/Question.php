<?php

class Question
{
    // Retrieve all questions for a specific topic
    public static function getQuestionsByTopic($pdo, $topic_id)
    {
        $stmt = $pdo->prepare("SELECT * FROM questions WHERE topic_id = ?");
        $stmt->execute([$topic_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new question
    public static function create($pdo, $topic_id, $type, $question_text, $correct_answers, $possible_answers = null)
    {
        try {
            $stmt = $pdo->prepare("INSERT INTO questions (topic_id, type, question_text, correct_answers, possible_answers) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$topic_id, $type, $question_text, $correct_answers, $possible_answers]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Fetch a question by ID
    public static function getQuestionById($pdo, $question_id)
    {
        $stmt = $pdo->prepare("SELECT * FROM questions WHERE id = ?");
        $stmt->execute([$question_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
