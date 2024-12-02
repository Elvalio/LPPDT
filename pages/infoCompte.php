<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../sql/connect_params.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Paramètres de Compte</title>
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <link rel="stylesheet" href="../css/styleEthan.css">


    <script>
        function deconnexion() {
            document.cookie = "user=; expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;";
            document.cookie = "type_compte=; expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;";
            location.assign("accueil.php");
                                        }
    </script>
</head>
    <?php
        $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);

        try {
            if ($_COOKIE['type_compte'] == "membre") {
                $stmt=$dbh->prepare("SELECT * FROM pact.membre WHERE idC = :id_user");
                $stmt->bindParam(':id_user', $_COOKIE['user']);
                $stmt->execute();
            }
            else if ($_COOKIE['type_compte'] == "pro_public") {
                $stmt=$dbh->prepare("SELECT * FROM pact.secteur_public WHERE idC = :id_user");
                $stmt->bindParam(':id_user', $_COOKIE['user']);
                $stmt->execute();
            }
            else if ($_COOKIE['type_compte'] == "pro_privee") {
                $stmt=$dbh->prepare("SELECT * FROM pact.secteur_privee WHERE idC = :id_user");
                $stmt->bindParam(':id_user', $_COOKIE['user']);
                $stmt->execute();
            }

            $compte = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }




        if(isset($_COOKIE['type_compte'])){
            if ($_COOKIE['type_compte'] == "pro_public" || $_COOKIE['type_compte'] == "pro_prive") { ?>
                <body class="BO"> <?php   
            }  else { ?>
                <body class="FO"> <?php
            }
        } else { ?>
            <body class="FO"> <?php
        }?>
            <nav class="desktop-element">
            <?php 
                include_once 'nav.php';     
            ?>
            </nav>
            <header class="phone-element">
            <?php
                include 'header.php';
            ?>
            </header>

    <div class="content">
        <h1 class="TS titre">Paramètres De Compte</h1>
    
        <div class="profile">
            <img src="../images/image 4.png" alt="Logo déconnecter" class="logo-nav" id="pfp" height="10%" width="10%">
            <div>
                <h2><?php echo $compte[0]['prenom'] . ' ' . $compte[0]['nom']; ?></h2>
                <p><?php echo $_COOKIE['type_compte']; ?></p>
                <br>
                <?php if ($_COOKIE['type_compte'] == "membre") { ?>
                <form method="POST" action="mes-avis.php">
                    <button type="submit" class="edit-btn">Afficher mes avis</button>
                </form>
                <?php } ?>
            </div>
        </div>

        <div class="main-container">
            <div class="container-ligne">
                <div class="container-info">
                    <label>Prénom</label>
                    <input type="text" value=<?php echo $compte[0]['prenom']; ?> readonly>
                </div>
                <div class="container-info">
                    <label>Nom</label>
                    <input type="text" value=<?php echo $compte[0]['nom']; ?> readonly>
                </div>
            </div>
            <hr>
            <br><br>
            <div class="container-ligne">
                <div class="container-info">
                    <label>Téléphone</label>
                    <input type="text" value=<?php echo $compte[0]['telephone']; ?> readonly>
                </div>
                <div class="container-info">
                    <label>Adresse Postale</label>
                    <!-- I NEED TO IMPLODE BOTH OF THESE SO THAT THEY ARE SHOWN CORRECTLY -->
                    <input type="text" value=<?php echo $compte[0]['numero_voie'] . ' ' . $compte[0]['voie']; ?> readonly>
                </div>
            </div>
            <br><br>
            <div class="container-ligne">
                <div class="container-info">
                    <label>Code Postal</label>
                    <input type="text" value=<?php echo $compte[0]['code_postal']; ?> readonly>
                </div>
                <div class="container-info">
                    <label>Ville</label>
                    <input type="text" value=<?php echo $compte[0]['ville']; ?> readonly>
                </div>
            </div>
            <?php if ($_COOKIE['type_compte'] == "pro_public") { ?>
            <hr>
            <br><br>
            <div class="container-ligne">
                <div class="container-info">
                    <label>Raison sociale</label>
                    <input type="text" value=<?php echo $compte[0]['denomination_sociale']; ?> readonly>
                </div>
            </div>
            <?php } ?>
            <?php if ($_COOKIE['type_compte'] == "pro_prive") { ?>
            <hr>
            <br><br>
            <div class="container-ligne">
                <div class="container-info">
                    <label>Dénomination sociale</label>
                    <input type="text" value=<?php echo $compte[0]['denomination_sociale']; ?> readonly>
                </div>
                <div class="container-info">
                    <label>Numéro SIREN</label>
                    <input type="text" value=<?php echo $compte[0]['siren']; ?> readonly>
                </div>
            </div>
            <?php } ?>
            <div class="container-ligne">
                <form method="POST" action="modifInfo.php">
                    <button type="submit" class="edit-btn">Modifier les informations</button>
                </form>
                <button class="deco-btn" onclick="deconnexion()">Se déconnecter</button>
            </div>
        </div>
    </div>

    <footer>
        <?php include_once 'footer.php'; ?>
    </footer>
</body>
</html>
