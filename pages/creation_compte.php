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

        $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);

        print_r($_POST);
        if($_POST["type"]=="membre"){

            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $pseudo = $_POST["pseudo"];
            $email = $_POST["email"];
            $telephone = $_POST["telephone"];
            $code_postal = $_POST["codepostal"];
            $ville = $_POST["ville"];
            $temp = explode(" ",$_POST["adresse"]);
            $num_adresse = $temp[0];
            array_shift($temp);
            $adresse = implode(" ", $temp);
            $mdp = $_POST["password"];
            print_r($code_postal);

            $stmt = $dbh->prepare("INSERT INTO pact.membre(pseudo, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) VALUES ('$pseudo', '$nom', '$prenom', '$email', $telephone, '$mdp', '$ville', $num_adresse, '$adresse', $code_postal, '')");



        }else if($_POST["type"]=="pro_public"){

            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $denomination = $_POST["denomination-sociale-pro"];
            $email = $_POST["email"];
            $telephone = $_POST["telephone"];
            $code_postal = $_POST["codepostal"];
            $ville = $_POST["ville"];
            $temp = explode(" ",$_POST["adresse"]);
            $num_adresse = $temp[0];
            array_shift($temp);
            $adresse = implode(" ", $temp);
            $mdp = $_POST["password"];

            $stmt = $dbh->prepare("INSERT INTO pact.secteur_public(codePro, denomination_sociale, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) VALUES (1002, '$denomination', '$nom', '$prenom', '$email', $telephone, '$mdp', '$ville', $num_adresse, '$adresse', $code_postal, '')");

        }else if($_POST["type"]=="pro_prive"){

            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $denomination = $_POST["denomination-sociale-pro"];
            $raison_sociale = $_POST["raison-sociale-pro"];
            $email = $_POST["email"];
            $telephone = $_POST["telephone"];
            $code_postal = $_POST["codepostal"];
            $ville = $_POST["ville"];
            $temp = explode(" ",$_POST["adresse"]);
            $num_adresse = $temp[0];
            array_shift($temp);
            $adresse = implode(" ", $temp);
            $siren = $POST["num_SIREN"];
            $mdp = $_POST["password"];
            $iban = $_POST["iban"];
            $bic = $_POST["bic"];

            if (!empty($POST["iban"])) {
                $stmt = $dbh->prepare("INSERT INTO pact.secteur_prive(codePro, denomination_sociale, iban, bic, siren, raison_sociale, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) VALUES (1003, '$denomination', '$iban', '$bic', '$siren', '$raison_sociale', '$nom', '$prenom', '$email', $telephone, '$mdp', '$ville', $num_adresse, '$adresse', $code_postal, '')");
            }
            else {
                $stmt = $dbh->prepare("INSERT INTO pact.secteur_prive(codePro, denomination_sociale, iban, bic, siren, raison_sociale, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) VALUES (1003, '$denomination', '', '', '$siren', '$raison_sociale', '$nom', '$prenom', '$email', $telephone, '$mdp', '$ville', $num_adresse, '$adresse', $code_postal, '')");
            }
        }
        $stmt->execute();
        $dbh = null;
        ?>
    </body>
</html>
