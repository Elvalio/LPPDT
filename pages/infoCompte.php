<?php
ini_set('display_errors', 1);
error_reporting(0);

include('../sql/connect_params.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Paramètres de Compte</title>
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <link rel="stylesheet" href="../css/samStyles.css">
    <?php 
    if(isset($_COOKIE['type_compte'])){
        if ($_COOKIE['type_compte'] == "pro_public" || $_COOKIE['type_compte'] == "pro_prive") { ?>
            <link id="dynamic-favicon" rel="icon" type="image/x-icon" href="../logo/rouge.ico"> <?php   
        }  else { ?>
            <link id="dynamic-favicon" rel="icon" type="image/x-icon" href="../logo/bleu.ico"> <?php
        }
    } else { ?>
        <link id="dynamic-favicon" rel="icon" type="image/x-icon" href="../logo/bleu.ico"> <?php
    }?>
    
    <script src="../js/infoCompte.js" async></script>

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
            if ($_POST['delete'] == "oui") {
                $stmt=$dbh->prepare("DELETE FROM pact.membre WHERE idC = :id_user");
                $stmt->bindParam(':id_user', $_COOKIE['user']);
                $stmt->execute();
                ?>
                <script>
                    document.cookie = "user=; expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;";
                    document.cookie = "type_compte=; expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;";
                    location.assign("accueil.php");
                </script>
                <?php
            }
            else {
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
                else if ($_COOKIE['type_compte'] == "pro_prive") {
                    $stmt=$dbh->prepare("SELECT * FROM pact.secteur_prive WHERE idC = :id_user");
                    $stmt->bindParam(':id_user', $_COOKIE['user']);
                    $stmt->execute();
                }

                $compte = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

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

    <div class="content-compte">
        <h1 class="TS titre-compte">Paramètres De Compte</h1>
    
        <div class="profile-compte">
            <img src="../images/59.png" alt="Logo déconnecter" class="img-compte" id="pfp" height="150px" width="150px">
            <div>
                <br>
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
                <p>
                    <?php 
                        if($_COOKIE['type_compte'] == "membre") {
                            echo "Membre";
                        }
                        else if ($_COOKIE['type_compte'] == "pro_public"){
                            echo "Professionnel Public";
                        }
                        else if ($_COOKIE['type_compte'] == "pro_prive"){
                            echo "Professionnel Privé";
                        }
                    ?>
                </p>
                <?php if ($_COOKIE['type_compte'] == "membre") { ?>
                <form method="POST" action="mes-avis.php">
                    <button type="submit" class="avis-btn-compte">Afficher mes avis</button>
                </form>
                <?php } ?>
            </div>
        </div>

        <div class="main-container-compte">
            <div class="container-ligne-compte">
                <div class="container-info-compte">
                    <label>Prénom</label>
                    <input type="text" value=<?php echo $compte[0]['prenom']; ?> readonly>
                </div>
                <div class="container-info-compte">
                    <label>Nom</label>
                    <input type="text" value=<?php echo $compte[0]['nom']; ?> readonly>
                </div>
            </div>
            <hr class="hr-compte">
            <br><br>
            <div class="container-ligne-compte">
                <div class="container-info-compte">
                    <label>Téléphone</label>
                    <input type="text" value=<?php echo $compte[0]['telephone']; ?> readonly>
                </div>
                <div class="container-info-compte">
                    <label>Adresse Postale</label>
                    <?php
                    ?>
                    <input type="text" value="<?php echo htmlspecialchars($compte[0]['numero_voie'] . ' ' . $compte[0]['voie']); ?>" readonly>
                </div>
            </div>

            <div class="container-ligne-compte">
                <div class="container-info-compte">
                    <label>Code Postal</label>
                    <input type="text" value=<?php echo $compte[0]['code_postal']; ?> readonly>
                </div>
                <div class="container-info-compte">
                    <label>Ville</label>
                    <input type="text" value=<?php echo $compte[0]['ville']; ?> readonly>
                </div>
            </div>
            <?php if ($_COOKIE['type_compte'] == "pro_public") { ?>
            <hr class="hr-compte">
            <br><br>
            <div class="container-ligne-compte">
                <div class="container-info-compte">
                    <label>Raison sociale</label>
                    <input type="text" value=<?php echo $compte[0]['denomination_sociale']; ?> readonly>
                </div>
            </div>
            <?php } ?>
            <?php if ($_COOKIE['type_compte'] == "pro_prive") { ?>
            <hr class="hr-compte">
            <br><br>
            <div class="container-ligne-compte">
                <div class="container-info-compte">
                    <label>Dénomination sociale</label>
                    <input type="text" value=<?php echo $compte[0]['raison_sociale']; ?> readonly>
                </div>
                <div class="container-info-compte">
                    <label>Numéro SIREN</label>
                    <input type="text" value=<?php echo $compte[0]['siren']; ?> readonly>
                </div>
            </div>
            <hr class="hr-compte">
            <br><br>
            <div class="container-ligne-compte">
                <div class="container-info-compte">
                    <label>IBAN</label>
                    <input type="text" name="iban" value=<?php echo $compte[0]['iban']; ?> readonly>
                </div>
                <div class="container-info-compte">
                    <label>BIC</label>
                    <input type="text" name="bic" value=<?php echo $compte[0]['bic']; ?> readonly>
                </div>
            </div>
            <?php } ?>
            <div class="container-ligne-compte">
                <form method="POST" action="modifInfo.php">
                    <button type="submit" class="edit-btn-compte">Modifier les informations</button>
                </form>
                <div>
                    <button class="deco-btn-compte" onclick="deconnexion()">Se déconnecter</button>
                </div>
                <button id="delete-btn-compte">
                    Supprimer le compte
                </button>
            </div>
            <div id="overlay">
                <div id="popup_suppr_compte">
                    <div id="group">
                        <div id="text">
                            <p>Voulez-vous vraiment supprimer votre compte ?</p>
                        </div>
                        <form method="POST" action="infoCompte.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="delete" value="oui">
                            <button type="submit" class="confirm-delete-btn-compte">Supprimer le compte</button>
                        </form>
                </form>
                    </div>
                    <img id="croix_small" src="../images/croix.png" alt="" class="close-popup">
                </div>
            </div>
        </div>
    </div>

    <footer class="content-compte">
        <?php include_once 'footer.php'; ?>
    </footer>
    <footer class="phone-element">
        <?php include_once 'footerNav.php'; ?>
    </footer>
</body>
</html>
