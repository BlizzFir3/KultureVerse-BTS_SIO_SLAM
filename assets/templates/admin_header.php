<?php
ob_start();
$serverPath = $_SERVER['DOCUMENT_ROOT'] . "/KultureVerse/";
require($serverPath . "config/function.php");
?>

<link rel="shortcut icon" href="../assets/pics/kultureverse_favicon.ico" type="image/x-icon" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href="../assets/css/sign-in.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../assets/js/color-modes.js"></script>
<script language="javascript" type='text/javascript'>
	function session() {
		window.location = "../logout.php"; //page de déconnexion
	}
	setTimeout("session()", 300000);
</script>
</head>

<body class="bg-body-tertiary">
	<nav class="navbar navbar-expand-lg bg-body-tertiary">
		<div class="container-fluid">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand" href="index.php">Espace administrateur</a>
			<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link" href="add_quizz.php">Ajouter un Quizz</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="delete_quizz.php">Supprimer un Quizz</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="index.php">Liste des Quizz</a>
					</li>
				</ul>
				<a class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sure de vouloir vous déconnecter?');" href="../logout.php" ?>Se déconnecter</a>
			</div>
		</div>
	</nav>