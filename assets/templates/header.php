<?php
$serverPath = $_SERVER['DOCUMENT_ROOT'] . "/KultureVerse/";
require($serverPath . "config/function.php");
?>

<link rel="shortcut icon" href="assets/pics/kultureverse_favicon.ico" type="image/x-icon" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


<header data-bs-theme="dark">

	<div class="collapse text-bg-dark" id="navbarHeader">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-md-7 py-4">
					<h4>A propos</h4>
					<p class="text-body-secondary">KultureVerse est un site de quizz en ligne. Testez vous sur votre culture ici !</p>
				</div>
				<div class="col-sm-4 offset-md-1 py-4">
					<h4>Connexion</h4>
					<ul class="list-unstyled">
						<li><a href="login.php" class="text-white">Se connecter</a></li>
						<li><a href="register.php" class="text-white">S'enregistrer</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="navbar navbar-dark bg-dark shadow-sm">
		<div class="container">
			<a href="index.php" class="navbar-brand d-flex align-items-center">
				<strong>KultureVerse</strong>
			</a>

			<ul class="navbar-nav me-auto mb-lg-0" style="display: flex; flex-direction: row;">
				<li class="nav-item">
					<a href="index.php" style="margin-right: 1.2em;" class="nav-link">Accueil</a>
				</li>
				<li class="nav-item">
					<a href="user_page.php" class="nav-link">Profil</a>
				</li>
			</ul>
			<?php if (isset($_SESSION['user_id'])) {
				echo '<a class="btn btn-outline-danger" style="margin-right: 3em;" onclick="return confirm(' . 'Êtes-vous sure de vouloir vous déconnecter?' . ');" href="logout.php">Se déconnecter</a>';
			}
			?>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		</div>
	</div>
</header>