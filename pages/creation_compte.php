<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <?php

        include("../sql/connect_params.php");


        print_r($_POST);
        if($_POST["type"]=="membre"){

            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $pseudo = $_POST["pseudo"];
            $email = $_POST["email"];
            $telephone = $_POST["telephone"];
            $code_postal = $_POST["codepostal"];
            $ville = $_POST["ville"];
            $adresse = $_POST["adresse"];
            $mdp = $_POST["password"];

        }else if($_POST["type"]=="pro_public"){

            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $denomination = $_POST["denomination-sociale-pro"];
            $email = $_POST["email"];
            $telephone = $_POST["telephone"];
            $code_postal = $_POST["codepostal"];
            $ville = $_POST["ville"];
            $adresse = $_POST["adresse"];
            $mdp = $_POST["password"];
            $propietaire_carte = $_POST["cardholder_name"];
            $code_securite = $_POST["cvv"];
            $expiration = $_POST["expiration"];

        }else if($_POST["type"]=="pro_prive"){

            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $denomination = $_POST["denomination-sociale-pro"];
            $raison_sociale = $_POST["raison-sociale-pro"];
            $email = $_POST["email"];
            $telephone = $_POST["telephone"];
            $code_postal = $_POST["codepostal"];
            $ville = $_POST["ville"];
            $adresse = $_POST["adresse"];
            $mdp = $_POST["password"];
            $propietaire_carte = $_POST["cardholder_name"];
            $code_securite = $_POST["cvv"];
            $expiration = $_POST["expiration"];

        }
        ?>
    </body>
</html>