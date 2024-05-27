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
				<a class="btn btn-success" style="margin: 25px; display: flex; align-items: center; justify-content: center;" href="add_quizz.php">Ajouter un Quizz</a>
				<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th scope="col">Image</th>
								<th scope="col">Nom</th>
								<th scope="col">Nombre de question</th>
								<th scope="col">Description</th>
								<th scope="col">Editer</th>
								<th scope="col">Supprimer</th>
								<th scope="col">Consulter</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($quizz as $aQuizz) : ?>
								<tr>
									<th class="align-middle" scope="row"><img src="<?= $aQuizz->image ?>" width="100" height="100" /></th>
									<td class="align-middle"><?= $aQuizz->nom ?></td>
									<?php
									// Définir l'ID du quizz
									$id_quizz = $aQuizz->id; // par exemple

									// Appeler la fonction pour obtenir le nombre de questions
									$questions_count = countQuestionByQuizz($id_quizz);

									// Vérifier si des données ont été retournées
									if (!empty($questions_count)) {
										// Récupérer le nombre de questions à partir de l'objet retourné
										$total_questions = $questions_count[0]->total_questions;

										// Afficher le nombre de questions
										echo '<td class="align-middle"">' . $total_questions . " questions</td>";
									} else {
										echo '<td class="align-middle"">Aucune question trouvée pour ce quizz.</td>';
									}
									?>
									<td class="align-middle"><?= substr($aQuizz->description, 0, 100) ?>...</td>
									<td class="align-middle">
										<a href="edit_quizz.php?id=<?= $aQuizz->id ?>">
											<i class="fa fa-pen" style="font-size: 20px; color: blueviolet; margin-left: 1.5vh;"></i>
										</a>
									</td>
									<td class="align-middle">
										<a href="action_delete_quizz.php?id=<?= $aQuizz->id ?>&redirect=2">
											<i class="fa fa-trash-o" onclick="return confirm('Êtes-vous sure de vouloir supprimer ce quizz?');" style="font-size:20px; color: red; margin-left: 3vh;"></i>
									</td>
									<td class="align-middle">
										<a href="questions.php?id=<?= $aQuizz->id ?>">
											<button name="valider" type="button" class="btn btn-outline-success">Consulter</button></a>
									</td>
								</tr>
							<?php endforeach; ?>
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