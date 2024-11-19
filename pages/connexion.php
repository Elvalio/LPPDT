


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link rel="stylesheet" type="text/css" href="../css/styleConnexion.css">

</head>
<?php
include('../sql/connect_params.php');

if ($_POST!=[]) {
    $identifiant = $_POST['identifiant'];
    $message_erreur = '';
    $trouve = false;
    try{
        $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname",
            $user, $pass);

        //verifie si membre

        $stmt = $dbh->prepare(
            "SELECT idC, pseudo, mdp FROM pact.membre where pseudo = '$identifiant';"
        );
            
        $stmt->execute();
        $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
        if ($stmt!=[]) {
            if ($stmt[0]['mdp'] == $_POST['password']) {
                $idC = strval($stmt[0]['idc']);
                setcookie("user", $idC, time() + 3600, '/');
                setcookie("type_compte", 'membre', time() + 3600, '/');
                header('Location:accueil.php');
                $trouve = true;
            }
        }
        
        //verifie si professionnel

        $identifiant = (int)$identifiant;

        $stmt = $dbh->prepare(
            "SELECT idC, codePro, mdp FROM pact.professionnel where codePro = $identifiant;"
        );

        $stmt->execute();
        $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($stmt!=[]) {
            if ($stmt[0]['mdp'] == $_POST['password']) {
                $idC = strval($stmt[0]['idc']);
                setcookie("user", $idC, time() + 3600, '/');

                $stmt = $dbh->prepare(
                    "select * from pact.professionnel where idC in (select idC from pact.secteur_prive where idC = $idC);"
                );
        
                $stmt->execute();
                $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($stmt!=[]) {
                    setcookie("type_compte", 'pro_prive', time() + 3600, '/');
                }else{
                    setcookie("type_compte", 'pro_public', time() + 3600, '/');
                }
                header('Location:tableau_de_bord.php');   
                $trouve = true;
            }
        }

        if (!$trouve){
            $message_erreur = "Nom d'utilisateur ou mot de pass incorrecte, veuillez réessayer";
        }

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }

    
}
?>

<div class="phone-element">
        <?php include_once 'header.php' ?>
    </div>
    

<body class="login-page"


    
    <div class="container">
        <button class="back-button"> <img src="../icons/arrow-left-o.svg" alt="">Retour</button>

        <div class="logo-container">
            <img src="../logo/logo_vert.png" alt="Logo Vert" class="logo">
        </div>
        <?php if (!empty($message_erreur)) { ?>
        <p class="message-erreur"><?php echo $message_erreur; ?></p>
        <?php } ?>
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
                <a href="#" class="mdpOublie">Mot de passe oublié ?</a>
                <a href="creation_compte_formulaire.php" class="inscription">S'inscrire</a>
            </div>
        </form>
    </div>
            <?php include_once'footerNav.php' ?>
</body>


