<?php
ob_start();
session_start();
$serverPath = $_SERVER['DOCUMENT_ROOT'] . "/KultureVerse/";
if (isset($_SESSION['user_id'])) {
	$user_id = $_SESSION['user_id'];
	$username = $_SESSION['username'];
	$email_adress = $_SESSION['email_adress'];
} else {
	header("Location: login.php");
	exit();
}
if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
	header("Location: index.php");
}

$id_quizz = $_GET['id'];
// Inclure l'en-tête et le footer du site
include_once($serverPath . "/assets/templates/header.php");
$questions = getAllQuestion($id_quizz);
if (empty($questions)) {
	header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<title>Quiz</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link href="assets/css/sign-in.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="assets/js/color-modes.js"></script>
	<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>


<body>
	<div class="album py-5 bg-body-tertiary">
		<div class="container">
			<form method="post" action="result.php">
				<input type="hidden" name="id_quizz" value="<?= htmlspecialchars($id_quizz) ?>">
				<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th scope="col">Question</th>
								<th scope="col">Oui</th>
								<th scope="col">Non</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($questions as $question) : ?>
								<tr>
									<td><?php echo htmlspecialchars($question->question); ?></td>
									<td>
										<input type="radio" name="answer[<?php echo $question->id; ?>]" value="1" required>
									</td>
									<td>
										<input type="radio" name="answer[<?php echo $question->id; ?>]" value="0" required>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<button class="btn btn-sm btn-outline-success" type="submit" name="submit">Confirmer les réponses</button>
				</div>
			</form>
		</div>
	</div>
</body>

</html>
<?php

// Inclure le footer du site
include_once(__DIR__ . "/assets/templates/footer.php");

?>