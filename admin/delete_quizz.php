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
					<?php foreach ($quizz as $aQuizz) : ?>
						<div class="col stretch">
							<div class="card shadow-sm">
								<title><?= $aQuizz->nom ?></title>
								<img src="<?= $aQuizz->image ?>" width="200" height="200" />
								<div class="card-body">
									<p class="bold"><?= $aQuizz->nom ?></p>
									<p class="center"><?= substr($aQuizz->description, 0, 70) ?>...</p>
									<a href="action_delete_quizz.php?id=<?= $aQuizz->id ?>&redirect=1">
										<button name="valider" onclick="return confirm('Êtes-vous sure de vouloir supprimer ce quizz?');" type="button" class="btn btn-danger">Supprimer le produit</button>
									</a>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
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