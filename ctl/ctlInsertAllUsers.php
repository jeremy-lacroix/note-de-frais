<?php
include './model/DbInsertAllUsers.php';

$action = $_GET['action'];

switch ($action) {
    case 'InsertUsers':
        include './vue/vueConnexion/generateUser&Mdp.php';
        break;
    case 'ImportAndCreateUser':
        // fonction qui insère les utilisateurs dans la base de données
        // InsertUsers::CreateListUserLogin();

        break;
}
