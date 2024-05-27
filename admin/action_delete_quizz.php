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
$redirect = htmlspecialchars(strip_tags($_GET['redirect']));
if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
	if ($redirect == 1) {
		header("Location: delete_quizz.php");
	} elseif ($redirect == 2) {
		header("Location: index.php");
	}
}
$idQuizz = htmlspecialchars(strip_tags($_GET['id']));

try {
	deleteQuizz($idQuizz);
	if ($redirect == 1) {
		header("Location: delete_quizz.php");
	} elseif ($redirect == 2) {
		header("Location: index.php");
	}
} catch (Exception $e) {
	echo 'ERROR: ' . $e->getMessage();
}
