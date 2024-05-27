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
ob_start();
// Inclure l'en-tête et le footer du site
include_once($serverPath . "/assets/templates/admin_header.php");

if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
	header("Location: index.php");
}
$idQuizz 	= htmlspecialchars(strip_tags($_GET['id']));
$questions 	= getAllQuestion($idQuizz);
?>

<body class="bg-body-tertiary wrapper">
	<meta name="theme-color" content="#712cf9">

	<main class="push">

		<div class="album py-5 bg-body-tertiary">
			<div class="container">
				<a class="btn btn-success" style="margin: 25px; display: flex; align-items: center; justify-content: center;" href="add_question.php?id=<?= $idQuizz ?>">Ajouter une question</a>
				<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th scope="col">Question</th>
								<th scope="col">Reponse</th>
								<th scope="col">Editer</th>
								<th scope="col">Supprimer</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($questions as $aQuestion) : ?>
								<tr>
									<td class="align-middle"><?= $aQuestion->question ?></td>
									<td class="align-middle"><?php if ($aQuestion->reponse == 1) {
																	echo 'Oui';
																} else {
																	echo 'Non';
																} ?></td>
									<td class="align-middle">
										<a href="edit_question.php?id=<?= $aQuestion->id ?>&idQuizz=<?= $idQuizz ?>">
											<i class="fa fa-pen" style="font-size: 20px; color: blueviolet; margin-left: 1.5vh;"></i>
										</a>
									</td>
									<td class="align-middle">
										<a href="delete_question.php?id=<?= $aQuestion->id ?>&idQuizz=<?= $idQuizz ?>">
											<i class="fa fa-trash-o" onclick="return confirm('Êtes-vous sure de vouloir supprimer cette question?');" style="font-size:20px; color: red; margin-left: 3vh;"></i>
									</td>
								</tr>
							<?php endforeach; ?>
							<?php
							if (empty($questions)) {
								echo "<p style='color:red; display: flex; align-items: center; justify-content: center; margin: 5% 0;'>Il n'y a pas encore de questions pour ce quizz.</p>";
							}
							?>
						</tbody>
					</table>
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