<?php
include 'connectPdo.php';

class DbProfil{

    public static function ajoutvehicule($marque, $modele, $carburant, $cylindre, $id)
	{
        $sql = "INSERT INTO `vehicule` (`Marque`, `Modele`, `Carburant`, `Cylindre`, `Id_utilisateur`) VALUES ('".$marque."', '".$modele."', '".$carburant."', '".$cylindre."', '".$id."')";
		connectPdo::getObjPdo()->exec($sql);

        $sql2 = "select * FROM `vehicule` where `Id_utilisateur` =".$_SESSION['id'];
		$objResultat = connectPdo::getObjPdo()->query($sql2);
		$result_vehicule = $objResultat->fetchAll();
		return $result_vehicule;

    }

	public static function modifiervehicule($marque, $modele, $carburant, $cylindre, $id)
	{
		$sql = "UPDATE `vehicule` SET `Marque` = '$marque', `Modele` = '$modele', `Carburant` = '$carburant', `Cylindre` = '$cylindre' WHERE Id_utilisateur = $id";
		connectPdo::getObjPdo()->exec($sql);
	}

	// fonction
}

?>