<?php
require_once '../config/db.php';

class AuthController
{
    // Register a new user
    public static function register($pdo, $username, $password, $email)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
            $stmt->execute([$username, $hashedPassword, $email]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Log in a user
    public static function login($pdo, $username, $password)
    {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        echo '<pre>';
        print_r($user); // Check if the user data is being fetched
        echo '</pre>';

        if ($user && password_verify($password, $user['password'])) {
            // Start a session and store user data
            echo "Password verified!";
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];
            return true;
        }

        return false;
    }

    // Log out a user
    public static function logout()
    {
        session_start();
        session_destroy();
        header('Location: public/index.php');
        exit;
    }
}
?>
