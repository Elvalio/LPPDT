<?php ini_set('display_errors', 1);
error_reporting(E_ALL); 
error_reporting(0); 
include("../sql/connect_params.php");

try{ 
    $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);

    if($_COOKIE['type_compte'] == "membre") {

        $stmt = $dbh->prepare("SELECT * FROM pact.membre WHERE idC = :idc");
        $stmt->bindParam(':idc', $_COOKIE['user']);
        $stmt->execute();
            
        $compte = $stmt->fetch(PDO::FETCH_ASSOC);
    }

}catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
    $dbh = null;
    ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres de Compte</title>
    <link rel="stylesheet" href="../css/styleGeneral.css">
</head>

<div class="desktop-element">
    <?php
    include_once'nav.php';
    ?>
</div>

<body>

    <!-- Liens de navigation pour choisir le formulaire -->
    <div class="container-page-creation-compte">
        <div class="menu-links-crea-compte">
            <div class="inscription-membre TS-bold" id="link-membre">
                <h1 class="TS-bold">Paramètre de Compte</h1>
            </div>
        </div>


        <!-- Formulaire pour l'inscription membre -->
        <div class="form-container-page-creation-compte" id="form-membre">
            <!--<form name="membre" action="test_modif_compte.php" method="post" enctype="multipart/form-data">-->
                <input type="hidden" name="type" value="membre">
                <div class="form-group-crea-compte">
                    <div class="left-column-crea-compte">
                        <label for="nom" class="FS">Nom<span class="required"></span></label>
                        <input type="text" class="FS" value="<?php echo $compte['nom']?>" id="nom-membre" name="nom" readonly>
                        
                        
                        <label for="prenom" class="FS">Prénom<span class="required"></span></label>
                        <input type="text" class="FS" value="<?php echo $compte['prenom'] ?>" id="prenom-membre" name="prenom" readonly>
                        
                        
                        <label for="pseudo" class="FS">Pseudonyme<span class="required"></span></label>
                        <input type="text" class="FS" value="<?php echo $compte['pseudo'] ?>" id="pseudo-membre" name="pseudo" readonly>
                        

                        <label for="adresse" class="FS">Adresse postale<span class="required"></span></label>
                        <input type="text" class="FS" value="<?php echo $compte['numero_voie'] . ' ' . $compte['voie']?>" id="adresse-membre" name="adresse" readonly>

                        <div class="row-crea-compte">
                            <div class="input-wrapper-crea-compte">
                                <label for="codepostal" class="FS">Code postal<span class="required"></span></label>
                                <input type="text" class="FS" value="<?php echo $compte['code_postal'] ?>" id="codepostal-membre" name="codepostal" readonly>
                                
                            </div>

                            <div class="input-wrapper-crea-compte">
                                <label for="ville" class="FS">Ville<span class="required"></span></label>
                                <input type="text" class="FS" value="<?php echo $compte['ville'] ?>" id="ville-membre" name="ville" readonly>
                                
                            </div>
                        </div>
                    </div>
                    <div class="right-column-crea-compte">
                        <label for="email" class="FS">E-mail<span class="required"></span></label>
                        <input type="email" class="FS" value="<?php echo $compte['email'] ?>" id="email-membre" name="email" readonly>

                        <label for="telephone" class="FS">Téléphone<span class="required"></span></label>
                        <input type="tel" class="FS" value="<?php echo $compte['telephone'] ?>" id="telephone-membre" name="telephone" readonly>
                    </div>
                </div>
                    <button href="test_modif_compte.php" class="bouton-envoi-formulaire-crea-compte-page-membre TS-bold">Modifier les Informations</button>
            </form>
        </div>
    </div>
</body>

<?php include_once'footerNav.php' ?>
</html>
