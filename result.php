<?php
session_start();
if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
	exit();
}

$serverPath = $_SERVER['DOCUMENT_ROOT'] . "/KultureVerse/";
include_once($serverPath . "config/function.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$id_quizz = (int)$_POST['id_quizz'];
	$answers = $_POST['answer'];
	$user_id = $_SESSION['user_id'];

	$total_questions = count($answers);
	$correct_answers = 0;

	foreach ($answers as $question_id => $user_answer) {
		$correct_answer = getCorrectAnswer($question_id); // Fonction pour obtenir la réponse correcte
		if ($user_answer == $correct_answer) {
			$correct_answers++;
		}
	}

	$score = $correct_answers;

	saveScore($id_quizz, $user_id, $total_questions, $score); // Fonction pour sauvegarder le score

	header("Location: score.php?score=$score&total=$total_questions");
	exit();
}
