<?php
ob_start();
session_start();
if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
	exit();
}
if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
	header("Location: user_page.php");
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email_adress = $_SESSION['email_adress'];

$error_message = '';

?>
<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
	<script src="/docs/5.3/assets/js/color-modes.js"></script>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profil</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="assets/css/sign-in.css" rel="stylesheet">
	<link href="assets/css/user_page.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="assets/js/color-modes.js"></script>
	<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<?php
// Inclure l'en-tête et le footer du site
include_once(__DIR__ . "/assets/templates/header.php");
?>

<body class="bg-body-tertiary">

	<div class="album py-5 bg-body-tertiary">
		<div class="container">
			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
				<form method="post">
					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Username</label>
						<input type="name" class="form-control" name="username" value="<?= $username ?>" required>
					</div>
					<div class="mb-3">
						<label for="exampleInputPassword1" class="form-label">Email</label>
						<input type="email" class="form-control" name="email_adress" value="<?= $email_adress ?>" required>
					</div>
					<div class="mb-3">
						<label for="current_password" class="form-label">Mot de passe actuel:</label>
						<input type="password" class="form-control" id="current_password" name="current_password" required>
					</div>
					<div class="mb-3">
						<label for="new_password" class="form-label">Nouveau mot de passe (laissez vide si pas de changement):</label>
						<input type="password" class="form-control" id="new_password" name="new_password">
					</div>
					<button type="submit" name="valider" onclick="return confirm('Êtes-vous sure de vouloir modifier votre profil?');" class="btn btn-warning">Modifier le profil</button>
				</form>
			</div>
		</div>
	</div>
</body>
<?php
// Inclure l'en-tête et le footer du site
include_once(__DIR__ . "/assets/templates/footer.php");

// Si le formulaire est soumis, mettre à jour les informations de l'utilisateur
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$current_password = $_POST['current_password'];
	$new_username = $_POST['username'];
	$new_email_adress = $_POST['email_adress'];
	$new_password = $_POST['new_password'];
	$user_id = $_SESSION['user_id']; // Assurez-vous que l'ID de l'utilisateur est défini dans la session


	editUser($current_password, $user_id, $new_username, $new_email_adress, $new_password);
}
?>

</html>