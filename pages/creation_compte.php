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
            
        }else if($_POST["type"]=="pro_prive"){

        }
        ?>
    </body>
</html>