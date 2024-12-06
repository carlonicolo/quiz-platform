<?php
require '../config/db.php';
require '../controllers/quiz.php';
require '../vendor/autoload.php';

use Dompdf\Dompdf;

$topic_id = $_POST['topic_id'];
$user_answers = $_POST['answers'];
$questions = QuizController::getQuestions($pdo, $topic_id);

$correct_count = 0;

$html = '<h1>Quiz Results</h1>';

foreach ($questions as $question) {
    $correct_answers = json_decode($question['correct_answers'], true);
    $user_answer = isset($user_answers[$question['id']]) ? $user_answers[$question['id']] : null;

    $html .= "<p><b>Question:</b> {$question['question_text']}</p>";
    if ($user_answer == $correct_answers || (is_array($user_answer) && sort($user_answer) == sort($correct_answers))) {
        $html .= "<p style='color: green;'>Your Answer: " . implode(', ', (array)$user_answer) . " (Correct)</p>";
        $correct_count++;
    } else {
        $html .= "<p style='color: red;'>Your Answer: " . implode(', ', (array)$user_answer) . " (Incorrect)</p>";
        $html .= "<p style='color: green;'>Correct Answer: " . implode(', ', (array)$correct_answers) . "</p>";
    }
}

$html .= "<h3>Final Score: {$correct_count} / " . count($questions) . "</h3>";

if (isset($_POST['download_pdf'])) {
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->render();
    $dompdf->stream("quiz_results.pdf");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Results</title>
</head>
<body>
    <?= $html ?>
    <form method="POST">
        <input type="hidden" name="answers" value='<?= json_encode($user_answers) ?>'>
        <input type="hidden" name="topic_id" value="<?= $topic_id ?>">
        <button type="submit" name="download_pdf">Download PDF</button>
    </form>
</body>
</html>
