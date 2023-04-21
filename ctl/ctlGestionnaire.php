<?php
include './model/DbNoteDeFrais.php';

$action = $_GET['action'];

switch ($action) {
    case 'profilAdmin':
        $listeAllUsers = DbNoteDeFrais::CallAllUsers();
        print_r($listeAllUsers);
        echo '<br><br><br><br><br>';
        $MissionUsers = DbNoteDeFrais::listeNoteDeFraisUsers();
        print_r($MissionUsers);
        echo '<br><br><br><br><br>';
        $ligneNoteDeFraisUsers = DbNoteDeFrais::ligneNoteDeFraisUsers();
        print_r($ligneNoteDeFraisUsers);
        include 'vue/Accueil/admin.php';     
        break;
}
