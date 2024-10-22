<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link rel="stylesheet" type="text/css" href="../css/styleHarry.css">

</head>
<?php
include('../../test/connect_params.php'); // must be changed
//include('../sql/connect_params.php');

/*
if (isset($_COOKIE['user'])){
    print_r($_COOKIE['user']);
}
*/

if ($_POST!=[]) {
    $identifiant = $_POST['identifiant'];
    try{
        $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname",
            $user, $pass);

        $stmt = $dbh->prepare(
            "SELECT idC, pseudo, mdp FROM pact.membre where pseudo = '$identifiant';"
        );
            
        $stmt->execute();
        $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($stmt!=[]) {
            if ($stmt[0]['mdp'] == $_POST['password']) {
                $idC = strval($stmt[0]['idc']);
                setcookie("user", $idC);
                //header('Location:accueil.php');
            }
        }

        $identifiant = (int)$identifiant;

        $stmt = $dbh->prepare(
            "SELECT codePro, mdp FROM pact.professionnel where codePro = $identifiant;"
        );

        $stmt->execute();
        $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($stmt!=[]) {
            if ($stmt[0]['mdp'] == $_POST['password']) {
                $idC = strval($stmt[0]['idc']);
                setcookie("user", $idC);
                header('Location:tableau_de_bord.php');
            }
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }

    
}
?>
<body class="login-page">
    <div class="container">
        <button class="back-button"> <img src="../icons/arrow-left-o.svg" alt="">Retour</button>

        <div class="logo-container">
            <img src="../logo/logo_vert.png" alt="Logo Vert" class="logo">
        </div>

        <form action="connexion.php" method="post" class="login-form">
            <div class="form-group">
                <!--Identifiant correspond au pseudo ou codePro, pas à l'idC-->
                <label for="identifiant">Identifiant compte</label>
                <input id="identifiant" name="identifiant" placeholder="Identifiant" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            </div>

            <button type="submit" class="submit-button">Se connecter</button>

            <div class="links">
                <a href="#">Mot de passe oublié ?</a>
                <a href="creation_compte_membre.php">S'inscrire</a>
            </div>
        </form>
    </div>
</body>

</html>
