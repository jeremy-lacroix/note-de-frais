<?php
// include 'connectPdo.php';
/*
*****************************************************
                    Commentaire
* Cette classe doit être appelée une seule fois pour insérer tous les utilisateurs dans la base de données et créer un fichier csv contenant la liste des utilisateurs et leurs mots de passe
* la première fonction génère un mot de passe aléatoire
* la deuxième fonction lit le fichier csv et crée un tableau contenant la liste des utilisateurs et leurs mots de passe
* la troisième fonction crée un fichier csv contenant la liste des utilisateurs et leurs mots de passe

* la dernière fontion contient les trois fonctions précédentes, Dons elle doit être appelée une seule fois
*****************************************************
*/

class InsertUsers
{
    public static function GenerateMDP()
    {
        $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*';
        $pass = array();
        $combLen = strlen($comb) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $combLen);
            $pass[] = $comb[$n];
            $password = implode($pass);
        }
        return $password;
    }

    // lecture fichier csv
    public static function LectureCsv() // Lecture du fichier CSV et création de la liste des utilisateurs dans un tableau

    {
        $cpt = 1;
        // array list user
        $email_mdp_user = array("users" => array("e-mail" => array(), "Mot_de_passe" => array()));

        // Read documento and link go to documentos
        if (($OpenFile = fopen("uploads/etudiants.csv", "r")) !== FALSE) {

            // Read line by line and stop ;
            while (($data = fgetcsv($OpenFile, 1000, ";")) !== FALSE) {

                // add mdp générate
                $data[] = self::GenerateMDP();

                // count nb line in csv
                $num = count($data);
                $cpt++;

                // Read nom, prenom, email, code and password
                for ($i = 0; $i < $num; $i++) {
                    if ($i == 0) {
                        $matricule = $data[$i];
                    } elseif ($i === 1) {
                        $nom = $data[$i];
                    } elseif ($i === 2) {
                        $prenom = $data[$i];
                    } elseif ($i === 3) {
                        $email = $data[$i];
                    } elseif ($i === 4) {
                        $admin = $data[$i];
                    } elseif ($i === 5) {
                        $password = $data[$i];
                    } else {
                        echo "User no found<br>";
                    }
                }
                // Add user in array
                $email_mdp_user['users']['e-mail'][] = $email;
                $email_mdp_user['users']['Mot_de_passe'][] = $password;

                // create password hash
                $passwordSecure = password_hash($password, PASSWORD_DEFAULT);

                // Insert user in database
                $sql = "INSERT INTO utilisateur (Id, Mat, Nom, Prenom, Mail, Mdp, `Admin`) VALUES (NULL, '$matricule', '$nom', '$prenom', '$email', '$passwordSecure', '$admin')";
                connectPdo::getObjPdo()->exec($sql);
            }

            fclose($OpenFile); // fermeture du fichier
            echo ("<h1 classe='text-center mt-5'>Insertion des utilisateurs dans la base de données réussie<br><h1>");
        }
        return $email_mdp_user;
    }

    
    public static function CreateListUserLogin() // Création de la liste des utilisateurs et de leurs mots de passe
    {
        $list_email_and_mdp_user = self::LectureCsv(); // Call function LectureCsv
        $file = fopen('uploads/list_Email_mdp_user.csv', 'w'); // ouverture du fichier en mode écriture
        foreach ($list_email_and_mdp_user['users']['e-mail'] as $key => $value) {
            fputcsv($file, array($value, $list_email_and_mdp_user['users']['Mot_de_passe'][$key]));
        }
        fclose($file); // fermeture du fichier
    }
}
