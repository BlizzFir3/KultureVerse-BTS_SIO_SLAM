<?php
ob_start();
session_start();
$serverPath = $_SERVER['DOCUMENT_ROOT'] . "/KultureVerse/";
require($serverPath . "config/function.php");
// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
	// Redirigez vers la page de connexion si l'utilisateur n'est pas connecté
	header("Location: " . $serverPath . "/login.php");
	exit();
}

// Vérifiez si l'utilisateur est un administrateur
if ($_SESSION['isAdmin'] != 1) {
	// Redirigez vers la page de l'utilisateur normal ou affichez un message d'erreur
	header("Location: " . $serverPath . "/user_page.php");
	exit();
}
$idQuizz = htmlspecialchars(strip_tags($_GET['idQuizz']));
if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {

	header("Location: questions.php?id=" . $idQuizz);
}

$idQuestion = htmlspecialchars(strip_tags($_GET['id']));
try {
	deleteQuestion($idQuestion);
	header("Location: questions.php?id=" . $idQuizz);
} catch (Exception $e) {
	echo 'ERROR: ' . $e->getMessage();
}
