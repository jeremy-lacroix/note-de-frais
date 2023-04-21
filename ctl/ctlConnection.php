<?php
include './model/DbConnection.php';
// Call class which contains the function to insert users_CSV in database
// require('./model/DbInsertAllUsers.php');

$action = $_GET['action'];

switch ($action) {
    case 'formConnect':
        // function verify connection user and admin
        DbConnection::verifyUserConnection();
        include 'vue/vueConnexion/v_Connexion.php';
        break;

    case 'formDeconnect':
        session_unset();
        header('Location: index.php');
        break;

    case 'connect':
        // function verify connection user and admin
        DbConnection::verifyUserConnection();
        break;
}
