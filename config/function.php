<?php

//* redirectToUrl
/** 
 * Redirects to the specified URL
 * @param string $url
 * @return string
 */
function redirectToUrl(string $url): string
{
	header("Location: {$url}");
	exit();
}
//* addQuestionToQuizz
/** 
 * Ajoute une question dans la base de donnees passer en parametre
 * @param string $table l'id du quizz pour lequelle on ajoute la question
 * @param string $question la question
 * @param string $reponse la reponse
 * @return void
 */
function addQuestionToQuizz($id_quizz, $question, $reponse)
{
	if (require("dbconnect.php")) {
		$req = $access->prepare("INSERT INTO questions (question, reponse, id_quizz) VALUES (:question, :reponse, :id_quizz)");
		$req->execute(
			array(
				":id_quizz" => (int) $id_quizz,
				":question" => $question,
				":reponse" => $reponse
			)
		);
	}
}
//* deleteAllQuestionsFromQuizz
/** 
 * Supprime toutes les donnees de questions ou id_quizz est egale a l'id passe en parametre
 * @param mixed $id_quizz id du quizz
 * @return void
 */
function deleteAllQuestionsFromQuizz($id_quizz)
{
	if (require("dbConnect.php")) {
		$req = $access->prepare("DELETE FROM questions WHERE id_quizz = :id_quizz");
		$req->execute(array(":id_quizz" => $id_quizz));
	}
	$req->closeCursor();
}
//* getAllQuestion
/**
 * Recupere les questions  en fonction de l'id du quizz
 * @param mixed $table
 * @param mixed $id
 * @return mixed les donnees de la questions ou faux si elle n'existe pas
 */
function getAllQuestion($id_quizz)
{
	if (require("dbConnect.php")) {
		$req = $access->prepare("SELECT * FROM questions WHERE id_quizz =?");
		$req->execute([$id_quizz]);
		$req->execute();
		$data = $req->fetchAll(PDO::FETCH_OBJ);
		return $data;
	}
	$req->closeCursor();
}
//* editQuestion
/** 
 * Modifie une question
 * @param mixed $idQuestion
 * @param mixed $question
 * @param mixed $reponse
 * @return void
 */
function editQuestion($idQuestion, $question, $reponse)
{
	if (require("dbConnect.php")) {
		$req = $access->prepare("UPDATE questions  SET question = :question, reponse = :reponse WHERE id = :id");
		$req->execute(array(
			":question" => $question,
			":reponse" 	=> $reponse,
			":id" 		=> $idQuestion
		));
		$req->closeCursor();
	}
}
//* createAccount
/**
 * Ce code vérifie si le nom d'utilisateur ou l'adresse e-mail existe déjà dans la base de données. Si ce n'est pas le cas, il hache le mot de passe à l'aide de la fonction password_hash avec l'algorithme PASSWORD_BCRYPT pour une sécurité accrue, puis insère les informations de l'utilisateur dans la base de données.
 * @param mixed $username
 * @param mixed $email_adress
 * @param mixed $password
 * @return string
 */
function createAccount($username, $email_adress, $password)
{
	$serverPath = $_SERVER['DOCUMENT_ROOT'] . "/KultureVerse/";
	// Configuration de la connexion à la base de données
	$servername = "localhost";
	$dbname = "kultureverse";
	$db_username = "createAccount";
	$db_password = "createAccount/98uY";

	// Connexion à la base de données
	$conn = new mysqli($servername, $db_username, $db_password, $dbname);

	// Vérifier la connexion
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// Vérifier si l'utilisateur ou l'adresse e-mail existe déjà
	$stmt = $conn->prepare("SELECT id FROM user WHERE username = ? OR email_adress = ?");
	$stmt->bind_param("ss", $username, $email_adress);
	$stmt->execute();
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
		// L'utilisateur ou l'adresse e-mail existe déjà
		$stmt->close();
		$conn->close();
		return "Username or email address already exists.";
	}

	$stmt->close();

	// Hachage du mot de passe
	$hashed_password = password_hash($password, PASSWORD_BCRYPT);

	// Préparation et exécution de la requête d'insertion
	$stmt = $conn->prepare("INSERT INTO user (username, email_adress, password, isAdmin) VALUES (?, ?, ?, 0)");
	$stmt->bind_param("sss", $username, $email_adress, $hashed_password);

	if ($stmt->execute()) {
		$stmt->close();
		$conn->close();
		return true;
	} else {
		$stmt->close();
		$conn->close();
		return "Error: " . $conn->error;
	}
}
//* authenticateUser
/** 
 * Verifie que l'utilisateur existe et le connecte
 * @param mixed $username_or_email
 * @param mixed $password
 * @return string
 */
function authenticateUser($username_or_email, $password)
{
	$serverPath = $_SERVER['DOCUMENT_ROOT'] . "/KultureVerse/";
	// Configuration de la connexion à la base de données
	$servername = "localhost";
	$dbname = "kultureverse";
	$db_username = "root";
	$db_password = "";

	// Connexion à la base de données
	$conn = new mysqli($servername, $db_username, $db_password, $dbname);

	// Vérifier la connexion
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// Préparation de la requête pour vérifier le nom d'utilisateur ou l'adresse e-mail
	$stmt = $conn->prepare("SELECT id, username, email_adress, password, isAdmin FROM user WHERE username = ? OR email_adress = ?");
	$stmt->bind_param("ss", $username_or_email, $username_or_email);
	$stmt->execute();
	$stmt->store_result();

	// Vérifier si l'utilisateur existe
	if ($stmt->num_rows > 0) {
		$stmt->bind_result($id, $username, $email_adress, $hashed_password, $isAdmin);
		$stmt->fetch();

		// Vérifier le mot de passe
		if (password_verify($password, $hashed_password)) {
			// L'authentification est réussie
			session_start();
			$_SESSION['user_id'] = $id;
			$_SESSION['username'] = $username;
			$_SESSION['email_adress'] = $email_adress;
			$_SESSION['isAdmin'] = $isAdmin;
			$stmt->close();
			$conn->close();
			// Redirection basée sur le statut d'administrateur
			if ($isAdmin == 1) {
				header("Location: admin/index.php");
				exit();
			} else {
				header("Location: index.php");
				exit();
			}
		} else {
			// Mot de passe incorrect
			$stmt->close();
			$conn->close();
			return "Invalid password";
		}
	} else {
		// Nom d'utilisateur ou adresse e-mail incorrect
		$stmt->close();
		$conn->close();
		return "Invalid username or email address";
	}
}
//* editUser
/**
 * Modifie le profil de l'utilisateur
 * @param mixed $current_password
 * @param mixed $user_id
 * @param mixed $new_username
 * @param mixed $new_email_adress
 * @param mixed $new_password si modifier sinon le meme que l'ancien
 * @return void
 */
function editUser($current_password, $user_id, $new_username, $new_email_adress, $new_password)
{
	// Connexion à la base de données
	$servername = "localhost";
	$dbname = "kultureverse";
	$db_username = "root";
	$db_password = "";

	$conn = new mysqli($servername, $db_username, $db_password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// Vérifier le mot de passe actuel
	$stmt = $conn->prepare("SELECT password FROM user WHERE id = ?");
	$stmt->bind_param("i", $user_id);
	$stmt->execute();
	$stmt->store_result(); // Ajoutez cette ligne
	$stmt->bind_result($hashed_password);
	$stmt->fetch();

	if (password_verify($current_password, $hashed_password)) {
		// Mettre à jour les informations de l'utilisateur
		if (!empty($new_password)) {
			$new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
			$stmt->close(); // Fermez la première requête avant d'en exécuter une nouvelle
			$stmt = $conn->prepare("UPDATE user SET username = ?, email_adress = ?, password = ? WHERE id = ?");
			$stmt->bind_param("sssi", $new_username, $new_email_adress, $new_hashed_password, $user_id);
		} else {
			$stmt->close(); // Fermez la première requête avant d'en exécuter une nouvelle
			$stmt = $conn->prepare("UPDATE user SET username = ?, email_adress = ? WHERE id = ?");
			$stmt->bind_param("ssi", $new_username, $new_email_adress, $user_id);
		}

		if ($stmt->execute()) {
			// Mettre à jour les informations de session
			$_SESSION['username'] = $new_username;
			$_SESSION['email_adress'] = $new_email_adress;
			$stmt->close();
			$conn->close();
			header("Location: user_page.php");
			exit();
		} else {
			$error_message = "Error updating profile: " . $stmt->error;
		}
	} else {
		$error_message = "Current password is incorrect.";
	}

	$stmt->close();
	$conn->close();
}
//* getQuizz
/**
 * Recupere tous les quizz
 * @return mixed
 */
function getQuizz()
{
	if (require("dbconnect.php")) {
		$req = $access->prepare("SELECT * FROM quizz ORDER BY id DESC");
		$req->execute();
		$data = $req->fetchAll(PDO::FETCH_OBJ);
		return $data;
	}
	$req->closeCursor();
}
//* addQuizz
/**
 * Creer un nouveau quizz sans questions
 * @param mixed $name
 * @param mixed $image
 * @param mixed $description
 * @return void
 */
function addQuizz($name, $image, $description)
{
	if (require("dbconnect.php")) {
		$req = $access->prepare("INSERT INTO quizz (nom, image, description) VALUES (:nom, :image, :description)");
		$req->execute(array(
			":nom"			=> $name,
			":image"		=> $image,
			":description"	=> $description
		));
		$req->closeCursor();
	}
}
//* countQuestionByQuizz
/**
 * Compte le nombre de questions lier a un quizz
 * @param mixed $id_quizz l'id du quizz
 * @return mixed
 */
function countQuestionByQuizz($id_quizz)
{
	if (require("dbconnect.php")) {
		$req = $access->prepare("SELECT COUNT(*) AS total_questions FROM questions WHERE id_quizz = ?");
		$req->execute([$id_quizz]);
		$data = $req->fetchAll(PDO::FETCH_OBJ);
		return $data;
	}
	$req->closeCursor();
}
//* updateQuizz
/**
 * Modifie les informations d'un quizz
 * @param mixed $id
 * @param mixed $name
 * @param mixed $image
 * @param mixed $description
 * @return void
 */
function updateQuizz($id, $name, $image, $description)
{
	if (require("dbconnect.php")) {
		$req = $access->prepare("UPDATE quizz SET nom = :name, image = :image, description = :description WHERE id = :id");
		$req->execute(array(
			":name"			=> $name,
			":image"		=> $image,
			":description"	=> $description,
			":id"			=> $id
		));
		$req->closeCursor();
	}
}
//* deleteQuizz
/**
 * Suprrime un quizz de la bdd
 * @param mixed $id
 * @return void
 */
function deleteQuizz($id)
{
	if (require("dbConnect.php")) {
		$req = $access->prepare("DELETE FROM quizz WHERE id=?");
		$req->execute([$id]);
		deleteAllQuestionsFromQuizz($id);
	}
	$req->closeCursor();
}
//* getQuestion
/**
 * Recupere UNE SEULE question en fonction de son id
 * @param mixed $id id de la question
 * @return mixed
 */
function getQuestion($id)
{
	if (require("dbconnect.php")) {
		$req = $access->prepare("SELECT * FROM questions WHERE id=?");
		$req->execute([$id]);
		$data = $req->fetchAll(PDO::FETCH_OBJ);
		return $data;
	}
	$req->closeCursor();
}
//* deleteQuestion
/**
 * Suprrime une question de la bdd
 * @param mixed $id
 * @return void
 */
function deleteQuestion($id)
{
	if (require("dbConnect.php")) {
		$req = $access->prepare("DELETE FROM questions WHERE id=?");
		$req->execute([$id]);
	}
	$req->closeCursor();
}
//* getQuizzById
/**
 * Recupere un quizz selon son id
 * @param mixed $id
 * @return mixed
 */
function getQuizzById($id)
{
	if (require("dbconnect.php")) {
		$req = $access->prepare("SELECT * FROM quizz WHERE id = ?");
		$req->execute([$id]);
		$data = $req->fetchAll(PDO::FETCH_OBJ);
		return $data;
	}
	$req->closeCursor();
}
//* getCorrectAnswer
/**
 * Recupere la reponse correcte pour une question selon son id
 * @param mixed $question_id
 * @return mixed
 */
function getCorrectAnswer($question_id)
{
	if (require("dbconnect.php")) {
		$req = $access->prepare("SELECT reponse FROM questions WHERE id = ?");
		$req->execute([$question_id]);
		$data = $req->fetch(PDO::FETCH_OBJ);
		return $data->reponse;
	}
}

//* saveScore
/**
 * Sauvegarde le score qu'un utilisateur a fait sur un quizz
 * @param mixed $id_quizz
 * @param mixed $user_id
 * @param mixed $total_questions
 * @param mixed $score
 * @return void
 */
function saveScore($id_quizz, $user_id, $total_questions, $score)
{
	if (require("dbConnect.php")) {
		$req = $access->prepare("INSERT INTO score (id_quizz, id_user, total_questions, score) VALUES (?, ?, ?, ?)");
		$req->execute([$id_quizz, $user_id, $total_questions, $score]);
	}
}

function getQuizzWithQuestions()
{
	if (require("dbConnect.php")) {
		$req = $access->prepare("
            SELECT q.id, q.nom, q.image, q.description
            FROM quizz q
            JOIN questions qs ON q.id = qs.id_quizz
            GROUP BY q.id
        ");
		$req->execute();
		$data = $req->fetchAll(PDO::FETCH_OBJ);
		return $data;
	}
}
