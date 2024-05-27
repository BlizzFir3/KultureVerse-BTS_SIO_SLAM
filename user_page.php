<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['isAdmin'] == 1) {
	header("Location: login.php");
	exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email_adress = $_SESSION['email_adress'];
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

<body class="bg-body-tertiary wrapper">
	<meta name="theme-color" content="#712cf9">

	<main>



		<div class="page-content page-container" id="page-content">
			<div class="padding">
				<div class="row container d-flex justify-content-center">
					<div class="col-xl-6 col-md-12">
						<div class="card user-card-full">
							<div class="row m-l-0 m-r-0">
								<div class="col-sm-4 bg-c-lite-green user-profile">
									<div class="card-block text-center text-white">
										<div class="m-b-25">
											<img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
										</div>
										<h6 class="f-w-600"><?php echo htmlspecialchars($username); ?></h6>
										<i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
									</div>
								</div>
								<div class="col-sm-8">
									<div class="card-block">
										<h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
										<div class="row">
											<div class="col-sm-6">
												<p class="m-b-10 f-w-600">Email</p>
												<h6 class="text-muted f-w-400"><?php echo htmlspecialchars($email_adress); ?></h6>

											</div>
										</div>
										<a href="edit_user.php?id=<?= $user_id ?>">
											<i class="fa fa-pen" style="font-size: 20px; color: blueviolet; margin-right: 4em; margin-left: 80%; margin-top: 1.2em;"></i>
										</a>

									</div>
								</div>
							</div>
						</div>
					</div>
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