<?php 

require 'class/database.php';
/**
 * verifie
 *
 * @param  mixed $data
 * @return void
 */
function verifie($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_POST['login'])) {
	// Saisie des valeurs d‘entrée
	$name = verifie(verifie($_POST['name']));
	$email = verifie(verifie($_POST['email']));
	$mobile = verifie(verifie($_POST['mobile']));

	if (!empty($_POST)) {
		 header("Location: index.php");
		$erreurs = [];

		//Le nom
		if (!empty($_POST['name'])) {
			$namelength = strlen($name);
			if ($namelength <= 100) {

			}else{
			 $erreurs['name'] = "Votre nom ne doit pas dépassé 100 caractères !";
			}
		}else{
			$erreurs['name'] = "Veuillez entrer votre nom";
		}
		//L'email
		if (!empty($_POST['email'])) {
			$emaillength = strlen($email);
			if ($emaillength <= 100) {
				if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
					# code...
				}else{
					$erreurs['email'] = "Votre adresse email n'est pas valide";
				}
			}else{
			 $erreurs['email'] = "Votre adresse email ne doit pas dépassé 100 caractères !";
			}
		}else{
			$erreurs['email'] = "Veuillez entrer une adresse email";
		}

		//Le téléphone
		if (!empty($_POST['mobile'])) {
			$mobilelength = strlen($mobile);
			if ($mobilelength <= 10) {
				if (!preg_match("/^\d\d(.)\d\d\\1\d\d\\1\d\d\\1\d\d$/", $mobile)) {

				}else{
					$erreurs['mobile'] = "Votre numéro de téléphone est invalable";
				}
			}else{
			 $erreurs['mobile'] = "Votre numéro de téléphone ne doit pas dépassé 10 caractères !";
			}
		}else{
			$erreurs['mobile'] = "Veuillez entrer un numéro de téléphone";
		}
// Entrer des données
if (empty($erreurs)) {
     $pdo = Database::connect();
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $sql = "INSERT INTO customers (name,email,mobile) values(?, ?, ?)";
     $q = $pdo->prepare($sql);
     $q->execute(array($name,$email,$mobile));
     Database::disconnect();
     header("Location: index.php");
}
      }
}