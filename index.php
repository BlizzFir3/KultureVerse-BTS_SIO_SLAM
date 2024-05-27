<?php
session_start();
if (isset($_SESSION['user_id'])) {
	$user_id = $_SESSION['user_id'];
	$username = $_SESSION['username'];
	$email_adress = $_SESSION['email_adress'];
}
$serverPath = $_SERVER['DOCUMENT_ROOT'] . "/KultureVerse/";
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>KultureVerse</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link href="assets/css/index.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="assets/js/color-modes.js"></script>
	<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<?php
// Inclure l'en-tête et le footer du site
include_once($serverPath . "/assets/templates/header.php");
$quizz = getQuizzWithQuestions();
?>

<body class="bg-body-tertiary wrapper">
	<meta name="theme-color" content="#712cf9">

	<main>
		<div class="album py-5 bg-body-tertiary">
			<div class="container col-container">
				<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
					<?php foreach ($quizz as $aQuizz) : ?>
						<div class="card shadow-sm box col" style="margin: 0.2rem; ">
							<title><?= $aQuizz->nom  ?></title><img src="<?= $aQuizz->image  ?>" width="200" height="200" />
							<div class="card-body">
								<p class="bold"><?= $aQuizz->nom  ?></p>
								<p class="card-text" style="align-items: center"><?= substr($aQuizz->description, 0, 70)  ?>...</p>
								<div class="d-flex justify-content-between align-items-center" style="display: flex; align-content: flex-end;">
									<div class="btn-group">
										<a href="quizz.php?id=<?= htmlspecialchars($aQuizz->id)  ?>">
											<button type="button" class="btn btn-sm btn-outline-success">Commencer le quizz</button>
										</a>
									</div>
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
include_once(__DIR__ . "/assets/templates/footer.php");
?>

</html>