<?php
include 'connectPdo.php';

class DbConnection
{

	public static function connectUser($email, $password)
	{
		$sql = "SELECT * FROM `utilisateur` WHERE Mail='$email' AND Mdp='$password'";
		$objResultat = connectPdo::getObjPdo()->query($sql);
		$result = $objResultat->fetchAll();

		return $result;
	}

	public static function getVehicule($id)
	{
		$sql_v = "SELECT * FROM `vehicule` WHERE $id = vehicule.Id_utilisateur";
		$objResultat = connectPdo::getObjPdo()->query($sql_v);
		if ($objResultat != null) {
			$result_v = $objResultat->fetchAll();
			return $result_v;
		}
	}

	// fonction verify connection user and admin
	public static function verifyUserConnection()
	{
		$Msgerrors = "";
		// if user post form
		if (isset($_POST['validate'])) {

			// verify if user post email and password exist
			if (!empty($_POST['email']) && !empty($_POST['password'])) {

				// ovoid sql injection
				$email = htmlspecialchars($_POST['email']);
				$password = htmlspecialchars($_POST['password']);

				// Verify if user exists in database
				$checkIfuserExists = connectPdo::getObjPdo()->prepare('SELECT * FROM `utilisateur` WHERE Mail= ?');
				$checkIfuserExists->execute(array($email));

				if ($checkIfuserExists->rowCount() > 0) {

					// take all user data
					$usersInfos = $checkIfuserExists->fetch();

					// Verify if password is correct
					if (password_verify($password, $usersInfos['Mdp'])) {
						// Recover all user data and store in session
						$_SESSION['id'] = $usersInfos['Id'];
						$_SESSION['matricule'] = $usersInfos['Mat'];
						$_SESSION['nom'] = $usersInfos['Nom'];
						$_SESSION['prenom'] = $usersInfos['Prenom'];
						$_SESSION['login'] = $usersInfos['Mail'];
						$_SESSION['Mdp'] = $usersInfos['Mdp'];
						$_SESSION['Admin'] = $usersInfos['Admin'];
						$result_v = DbConnection::getVehicule($_SESSION['id']);
						if ($result_v != null) {
							$_SESSION['vehicule'] = [$result_v[0]['Marque'], $result_v[0]['Modele'], $result_v[0]['Carburant'], $result_v[0]['Cylindre']];
						}
						// Verify if user is admin and redirect to admin page
						if ($_SESSION['Admin'] == 0) {
							header('Location:index.php?ctl=notedefrais&action=lister&vue=saisie&TypeNdf=0');
						} else {
							header('Location:index.php?ctl=gestionnaire&action=profilAdmin');
						}
					} else {
						$Msgerrors = "Mot de passe est incorrect.";
						// echo '<h6 class="alert alert-danger text-center" role="alert">' . $Msgerrors . '</h6>';
					}
				} else {
					$Msgerrors = "Votre E-mail est incorrect.";
					// echo '<h6 class="alert alert-danger text-center" role="alert">' . $Msgerrors . '</h6>';
				}
			} else {
				$Msgerrors = "Veuillez remplir tout les champs.";
				// echo '<h6 class="alert alert-danger text-center" role="alert">' . $Msgerrors . '</h6>';
			}
		}
		return $Msgerrors;
	}

	// function to add password in database of old user
	public static function test()
	{
		$m = "mdp";
		$ms = password_hash($m, PASSWORD_DEFAULT);
		$sql = "UPDATE `utilisateur` SET `Mdp` = '$ms' WHERE `utilisateur`.`Nom` = 'sniper'";
		$objResultat = connectPdo::getObjPdo()->query($sql);
		$result = $objResultat->fetchAll();
		echo ("test_réussie<br>");

		return $result;
	}
}
