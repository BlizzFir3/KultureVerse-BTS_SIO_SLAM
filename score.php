<?php
session_start();
if (!isset($_SESSION['user_id'])) {
	header("Location: index.php");
	exit();
}

$score = isset($_GET['score']) ? (int)$_GET['score'] : 0;
$total = isset($_GET['total']) ? (int)$_GET['total'] : 0;
$serverPath = $_SERVER['DOCUMENT_ROOT'] . "/KultureVerse/";
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Score</title>


	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link href="assets/css/sign-in.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="assets/js/color-modes.js"></script>
	<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<style>
	/* Epilogue */
	@import url("https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&display=swap");

	/* Embed Code */
	@import url("https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&family=Kurale&display=swap");
	/* Gluten */
	@import url("https://fonts.googleapis.com/css2?family=Gluten:wght@100..900&display=swap");

	h1 {
		font-family: "Gluten";
	}
</style>
<?php
// Inclure l'en-tête et le footer du site
include_once($serverPath . "/assets/templates/header.php");
?>

<body>
	<div class="container">
		<h1>Résultat du Quizz</h1>
		<p>Vous avez obtenu un score de <?= htmlspecialchars($score) ?>sur <?= htmlspecialchars($total) ?>.</p><a href="index.php" class="btn btn-primary">Retour à l'accueil</a>
	</div>
</body><?php
		// Inclure l'en-tête et le footer du site
		include_once(__DIR__ . "/assets/templates/footer.php");
		?>

</html>