<?php
session_start();
$serverPath = $_SERVER['DOCUMENT_ROOT'] . "/KultureVerse/";
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
$username 		= $_SESSION['username'];
$email_adress 	= $_SESSION['email_adress'];
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ADMIN - KultureVerse</title>

</head>
<?php
ob_start();
// Inclure l'en-tête et le footer du site
include_once($serverPath . "/assets/templates/admin_header.php");
$idQuizz 	= htmlspecialchars(strip_tags($_GET['id']));
?>

<body class="bg-body-tertiary wrapper">
	<meta name="theme-color" content="#712cf9">

	<main class="push">

		<div class="album py-5 bg-body-tertiary">
			<div class="container">

				<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
					<form method="post">
						<div class="mb-3">
							<label for="question" class="form-label">Questions</label>
							<textarea class="form-control" name="question" required></textarea>
						</div>
						<input type="radio" class="btn-check" name="answer" id="yes" autocomplete="off" value="true" checked>
						<label class="btn btn-outline-success" for="yes">Oui</label>

						<input style="margin-left: 1.3em;" type="radio" class="btn-check" name="answer" id="no" autocomplete="off" value="false">
						<label style="margin-left: 1.3em;" class="btn btn-outline-danger" for="no">Non</label>
						<br />
						<button style="margin-top: 1.3em;" type="submit" name="submit" class="btn btn-success">Ajouter la question</button>
					</form>
				</div>
			</div>
		</div>

	</main>

</body>
<?php
// Inclure l'en-tête et le footer du site
include_once($serverPath . "/assets/templates/footer.php");
?>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Vérifier si le formulaire a été soumis
	if (isset($_POST['submit'])) {
		// Vérifier si les variables answer et question sont définies
		if (isset($_POST['answer']) && isset($_POST['question'])) {
			// Vérifier si les champs ne sont pas vides
			if (!empty($_POST['answer']) && !empty($_POST['question'])) {
				// Récupérer et traiter les valeurs des champs
				$question = htmlspecialchars(strip_tags($_POST['question']));
				$reponse = $_POST['answer'] == "true" ? 1 : 0;

				try {
					// Appeler la fonction d'ajout de question avec les valeurs traitées
					addQuestionToQuizz($idQuizz, $question, $reponse);
					echo "<p style='color:green; display: flex; align-items: center; justify-content: center; margin: 5% 0;'>Question ajoutée avec succès.</p>";
				} catch (Exception $e) {
					echo 'ERROR: ' . $e->getMessage();
				}
			} else {
				echo "Tous les champs doivent être remplis.";
			}
		} else {
			echo "Tous les champs doivent être définis.";
		}
	}
}

?>