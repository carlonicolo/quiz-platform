<?php

class Topic
{
    // Retrieve all top-level topics
    public static function getAllTopics($pdo)
    {
        $stmt = $pdo->query("SELECT * FROM topics WHERE parent_id IS NULL");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retrieve subcategories for a specific topic
    public static function getSubcategories($pdo, $parent_id)
    {
        $stmt = $pdo->prepare("SELECT * FROM topics WHERE parent_id = ?");
        $stmt->execute([$parent_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new topic or subcategory
    public static function create($pdo, $name, $parent_id = null)
    {
        try {
            $stmt = $pdo->prepare("INSERT INTO topics (name, parent_id) VALUES (?, ?)");
            $stmt->execute([$name, $parent_id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Fetch a topic by ID
    public static function getTopicById($pdo, $topic_id)
    {
        $stmt = $pdo->prepare("SELECT * FROM topics WHERE id = ?");
        $stmt->execute([$topic_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
