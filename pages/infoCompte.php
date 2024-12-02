<?php 
include('../sql/connect_params.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Paramètres de Compte</title>
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <link rel="stylesheet" href="../css/styleEthan.css">
</head>
    <?php
        $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);

        try {
            if ($_COOKIE['type_compte'] == "membre") {
                $stmt=$dbh->prepare("SELECT * FROM pact.membre WHERE idC = :id_user");
                $stmt->bindParam(':id_user', $user_cookie);
                $stmt->execute();
            }
            else if ($_COOKIE['type_compte'] == "pro_public") {
                $stmt=$dbh->prepare("SELECT * FROM pact.secteur_public WHERE idC = :id_user");
                $stmt->bindParam(':id_user', $user_cookie);
                $stmt->execute();
            }
            else if ($_COOKIE['type_compte'] == "pro_privee") {
                $stmt=$dbh->prepare("SELECT * FROM pact.secteur_privee WHERE idC = :id_user");
                $stmt->bindParam(':id_user', $user_cookie);
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
            <!-- <?php
                include 'header.php';
            ?> -->
            </header>

    <div class="content">
        <h1 class="TS titre">Paramètres De Compte</h1>
    
        <div class="profile">
            <img src="../images/image 4.png" alt="Logo déconnecter" class="logo-nav" id="pfp" height="10%" width="10%">
            <div>
                <h2><?php echo $compte['prenom'] . ' ' . $compte['nom']; ?></h2>
                <p><?php echo $_COOKIE['type_compte']; ?></p>
            </div>
        </div>

        <div class="main-container">
            <div class="container-ligne">
                <div class="container-info">
                    <label>Prénom</label>
                    <input type="text" value=<?php echo $compte['prenom']; ?> readonly>
                </div>
                <div class="container-info">
                    <label>Nom</label>
                    <input type="text" value=<?php echo $compte['nom']; ?> readonly>
                </div>
            </div>
            <hr>
            <br><br>
            <div class="container-ligne">
                <div class="container-info">
                    <label>Téléphone</label>
                    <input type="text" value=<?php echo $compte['telephone']; ?> readonly>
                </div>
                <div class="container-info">
                    <label>Adresse Postale</label>
                    <input type="text" value=<?php echo $compte['numero_voie'] . ' ' . $compte['voie']; ?> readonly>
                </div>
            </div>
            <br><br>
            <div class="container-ligne">
                <div class="container-info">
                    <label>Code Postal</label>
                    <input type="text" value=<?php echo $compte['code_postal']; ?> readonly>
                </div>
                <div class="container-info">
                    <label>Ville</label>
                    <input type="text" value=<?php echo $compte['ville']; ?> readonly>
                </div>
            </div>
            <?php if ($_COOKIE['type_compte'] == "pro_public") { ?>
            <hr>
            <br><br>
            <div class="container-ligne">
                <div class="container-info">
                    <label>Raison sociale</label>
                    <input type="text" value=<?php echo $compte['denomination_sociale']; ?> readonly>
                </div>
            </div>
            <?php } ?>
            <?php if ($_COOKIE['type_compte'] == "pro_prive") { ?>
            <hr>
            <br><br>
            <div class="container-ligne">
                <div class="container-info">
                    <label>Dénomination sociale</label>
                    <input type="text" value=<?php echo $compte['denomination_sociale']; ?> readonly>
                </div>
                <div class="container-info">
                    <label>Numéro SIREN</label>
                    <input type="text" value=<?php echo $compte['siren']; ?> readonly>
                </div>
            </div>
            <?php } ?>
            <div class="container-ligne">
                <button class="edit-btn">Modifier les informations</button>
                <?php if ($_COOKIE['type_compte'] == "membre") { ?>
                <form method="POST" action="mes-avis.php">
                    <button type="submit" class="edit-btn">Afficher mes avis</button>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>

    <footer>
        <?php include_once 'footer.php'; ?>
    </footer>
</body>
</html>
