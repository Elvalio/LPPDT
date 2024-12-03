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
        function annulation() {
            location.assign("infoCompte.php");
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
            <!-- <?php
                include 'header.php';
            ?> -->
            </header>

    <div class="content">
        <h1 class="TS titre">Paramètres De Compte</h1>
    
        <div class="profile">
            <img src="../images/59.png" alt="Logo déconnecter" class="logo-nav" id="pfp" height="10%" width="10%">
            <div>
                <h2>
                    <?php
                        if ($_COOKIE['type_compte'] == "membre") {
                            echo $compte[0]['pseudo'];
                        }
                        else {
                            echo $compte[0]['prenom'] . ' ' . $compte[0]['nom'];
                        }
                    ?>
                </h2>
                <p><?php echo $_COOKIE['type_compte']; ?></p>
            </div>
        </div>

        <form class="main-container" action="infoCompte.php">
            <div class="container-ligne">
                <div class="container-info">
                    <label>Prénom</label>
                    <input type="text" value=<?php echo $compte[0]['prenom']; ?>>
                </div>
                <div class="container-info">
                    <label>Nom</label>
                    <input type="text" value=<?php echo $compte[0]['nom']; ?>>
                </div>
            </div>
            <hr>
            <br><br>
            <div class="container-ligne">
                <div class="container-info">
                    <label>Téléphone</label>
                    <input type="text" value=<?php echo $compte[0]['telephone']; ?>>
                </div>
                <div class="container-info">
                    <label>Adresse Postale</label>
                    <input type="text" value="<?php echo htmlspecialchars($compte[0]['numero_voie'] . ' ' . $compte[0]['voie']); ?>">
                </div>
            </div>

            <div class="container-ligne">
                <div class="container-info">
                    <label>Code Postal</label>
                    <input type="text" value=<?php echo $compte[0]['code_postal']; ?>>
                </div>
                <div class="container-info">
                    <label>Ville</label>
                    <input type="text" value=<?php echo $compte[0]['ville']; ?>>
                </div>
            </div>
            <?php if ($_COOKIE['type_compte'] == "pro_public") { ?>
            <hr>
            <br><br>
            <div class="container-ligne">
                <div class="container-info">
                    <label>Raison sociale</label>
                    <input type="text" value=<?php echo $compte[0]['denomination_sociale']; ?>>
                </div>
            </div>
            <?php } ?>
            <?php if ($_COOKIE['type_compte'] == "pro_prive") { ?>
            <hr>
            <br><br>
            <div class="container-ligne">
                <div class="container-info">
                    <label>Dénomination sociale</label>
                    <input type="text" value=<?php echo $compte[0]['denomination_sociale']; ?>>
                </div>
                <div class="container-info">
                    <label>Numéro SIREN</label>
                    <input type="text" value=<?php echo $compte[0]['siren']; ?>>
                </div>
            </div>
            <?php } ?>
            <button class="edit-btn">Modifier les informations bancaires</button>
            <br><br>
            <div class="container-ligne">
                <div class="container-info">
                    <label>Entrer le mot de passe</label>
                    <input type="password" value=<?php echo $compte[0]['mdp']; ?>>
                </div>
            </div>
            <div class="container-ligne">
                <button type="submit" class="edit-btn">Enregistrer les modifications</button>
                <button type="reset" class="cancel-btn" onclick=annulation()>Annuler les modifications</button>
            </div>
        </form>
    </div>

    <footer class="content">
        <?php include_once 'footer.php'; ?>
    </footer>
</body>
</html>
