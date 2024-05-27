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

$username = $_SESSION['username'];
$email_adress = $_SESSION['email_adress'];
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ADMIN - KultureVerse</title>

</head>
<?php
// Inclure l'en-tête et le footer du site
include_once($serverPath . "/assets/templates/admin_header.php");
$quizz = getQuizz();
?>

<body class="bg-body-tertiary wrapper">
	<meta name="theme-color" content="#712cf9">

	<main class="push">

		<div class="album py-5 bg-body-tertiary">
			<div class="container">

				<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
					<form method="post">
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Lien de l'image du quizz</label>
							<input type="text" class="form-control" name="image" required>
						</div>
						<div class="mb-3">
							<label for="exampleInputPassword1" class="form-label">Nom du quizz</label>
							<input type="name" class="form-control" name="name" required>
						</div>
						<div class="mb-3">
							<label for="exampleInputPassword1" class="form-label">Description</label>
							<textarea class="form-control" name="description" required></textarea>
						</div>
						<button type="submit" name="submit" class="btn btn-success">Ajouter le quizz</button>
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

if (isset($_POST['submit'])) {
	if (isset($_POST['image']) and isset($_POST['name']) and isset($_POST['description'])) {
		if (!empty($_POST['image']) and !empty($_POST['name'])  and !empty($_POST['description'])) {
			$image			= htmlspecialchars(strip_tags($_POST['image']));
			$name 			= htmlspecialchars(strip_tags($_POST['name']));
			$description	= htmlspecialchars(strip_tags($_POST['description']));

			try {
				addQuizz($name, $image, $description);
			} catch (Exception $e) {
				echo 'ERROR: ' . $e->getMessage();
			}
		}
	}
}

?>