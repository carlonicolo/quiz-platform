CREATE DATABASE IF NOT EXISTS quiz_platform;

USE quiz_platform;

-- Create tables (as defined earlier)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS topics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    parent_id INT DEFAULT NULL,
    FOREIGN KEY (parent_id) REFERENCES topics(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    topic_id INT NOT NULL,
    type ENUM('open', 'closed', 'multiple', 'yes_no') NOT NULL,
    question_text TEXT NOT NULL,
    correct_answers TEXT NOT NULL,
    possible_answers TEXT,
    FOREIGN KEY (topic_id) REFERENCES topics(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    topic_id INT NOT NULL,
    score INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (topic_id) REFERENCES topics(id) ON DELETE CASCADE
);

-- Add sample data
INSERT INTO users (username, password, email, role)
VALUES 
    ('admin', '$2y$10$XvvNsQiT6X08Pt/uAwdA4O7OGJv8NL9nncZSi9zF1x6bJjUwYmjCG', 'admin@example.com', 'admin'),
    ('student', '$2y$10$zWBlhdPprhEiWadf.Mwl1uXvHTRCJt4Dy.kCN/xibIGVJscT8p5Dq', 'student@example.com', 'user');

INSERT INTO topics (name, parent_id) VALUES 
    ('Programming', NULL), 
    ('Networking', NULL), 
    ('Linux', NULL),
    ('C Programming', 1), 
    ('Java', 1);

INSERT INTO questions (topic_id, type, question_text, correct_answers, possible_answers)
VALUES
    (3, 'multiple', 'Which of the following are valid C data types?', '["int", "float"]', '["int", "char", "float", "word"]'),
    (4, 'yes_no', 'Does Java support multiple inheritance?', '["no"]', NULL),
    (5, 'closed', 'What is the command to list files in Linux?', '["ls"]', NULL);

INSERT INTO scores (user_id, topic_id, score) VALUES 
    (2, 3, 75), 
    (2, 4, 85), 
    (2, 5, 80);
