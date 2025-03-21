<?php ini_set('display_errors', 1);
error_reporting(E_ALL); 
error_reporting(0); 
include("../sql/connect_params.php");

$Cmembre = False;
$Cpro_public = False;
$Cpro_prive = False;

try{
    $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);

    if($_COOKIE['type_compte'] == "membre") {

        $stmt = $dbh->prepare("SELECT * FROM pact.membre WHERE idC = :idc");
        $stmt->bindParam(':idc', $_COOKIE['user']);
        $stmt->execute();
            
        $compte = $stmt->fetch(PDO::FETCH_ASSOC);
        $Cmembre = True;
    }else if($_COOKIE['type_compte'] == "pro_public"){
        $stmt = $dbh->prepare("SELECT * FROM pact.secteur_public WHERE idC = :idc");
        $stmt->bindParam(':idc', $_COOKIE['user']);
        $stmt->execute();

        $compte = $stmt->fetch(PDO::FETCH_ASSOC);
        $Cpro_public = True;
    }else{
        $stmt = $dbh->prepare("SELECT * FROM pact.secteur_prive WHERE idC = :idc");
        $stmt->bindParam(':idc', $_COOKIE['user']);
        $stmt->execute();

        $compte = $stmt->fetch(PDO::FETCH_ASSOC);
        $Cpro_prive = True;
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
    <link rel="stylesheet" href="../css/test.css">
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

<div class="desktop-element">
    <?php
    include_once'nav.php';
    ?>
</div>

<body class = "<?php if($_COOKIE['type_compte'] == "membre"){echo "FO";}else{echo "BO";}?>">

    <!-- Liens de navigation pour choisir le formulaire -->
    <div class="container-page-info-compte">
            <div class="compte-titre-photo-profil TS-bold" id="link-membre" >
                <h1 class="TS-bold">Paramètre de Compte</h1>
                <img id="photo-profil" class="compte-photo-profil" src="../images/59.png" alt="icone-membre" class="icone-membre" width="160px" height="160px" >
                <input type="file" id="insert-image" accept="image/*" style="display: none;">
            </div>
        <div class="compte-container-main-page" id="form-membre">
                <div class="compte-details-section">
                    <div class="left-column-info-compte">
                        <label for="nom" class="FS">Nom</label>
                        <input type="text" class="FS" value="<?php echo $compte['nom']?>" id="nom-membre" name="nom" readonly>
                        
                        
                        <label for="prenom" class="FS">Prénom</label>
                        <input type="text" class="FS" value="<?php echo $compte['prenom'] ?>" id="prenom-membre" name="prenom" readonly>
                        
                        <?php if($Cmembre){ ?>
                            <label for="pseudo" class="FS">Pseudonyme</label>
                            <input type="text" class="FS" value="<?php echo $compte['pseudo'] ?>" id="pseudo-membre" name="pseudo" readonly>
                        <?php }else if($Cpro_prive){ ?>
                            <label for="codepro" class="BO">Code Professionnel</label>
                            <input type="text" class="BO" value="<?php echo $compte['codepro'] ?>" id="codepro" name="codepro" readonly>
                        <?php } ?>

                        <label for="adresse" class="FS">Adresse postale</label>
                        <input type="text" class="FS" value="<?php echo $compte['numero_voie'] . ' ' . $compte['voie']?>" id="adresse-membre" name="adresse" readonly>

                        <div class="row-info-compte">
                            <div class="input-wrapper-info-compte">
                                <label for="codepostal" class="FS">Code postal</label>
                                <input type="text" class="FS" value="<?php echo $compte['code_postal'] ?>" id="codepostal-membre" name="codepostal" readonly>
                                
                            </div>

                            <div class="input-wrapper-info-compte">
                                <label for="ville" class="FS">Ville</label>
                                <input type="text" class="FS" value="<?php echo $compte['ville'] ?>" id="ville-membre" name="ville" readonly>
                                
                            </div>
                        </div>
                    </div>
                  <div class="right-column-info-compte">
                        <label for="email" class="FS">E-mail</label>
                        <input type="email" class="FS" value="<?php echo $compte['email'] ?>" id="email-membre" name="email" readonly>

                        <label for="telephone" class="FS">Téléphone</label>
                        <input type="tel" class="FS" value="<?php echo $compte['telephone'] ?>" id="telephone-membre" name="telephone" readonly>

                        <?php if(!$Cmembre){?>
                            <label for="denomination" class="BO">Dénomination</label>
                            <input type="text" class="BO" value="<?php echo $compte['denomination_sociale'] ?>" id="denomination" name="denomination" readonly>
                            <?php if($Cpro_prive){ ?>
                                <label for="iban" class="BO">Iban</label>
                                <input type="text" class="BO" value="<?php echo $compte['iban'] ?>" id="iban" name="iban" readonly>

                                <label for="siren" class="BO">Siren</label>
                                <input type="text" class="BO" value="<?php echo $compte['siren'] ?>" id="siren" name="siren" readonly>
                            <?php } ?>
                        <?php } ?>
                    </div>
                  <img id="croix_small" src="../images/croix.png" alt="" class="close-popup">
                </div>
                    <button class="bouton-envoi-formulaire-crea-compte-page-membre TS-bold">Modifier les Informations</button>
                    <?php
                    if($_COOKIE['type_compte'] == "membre"){ ?>
                        <button class="bouton-mes-avis">Voir mes avis</button>
                    <?php } ?>
        </div>
    </div>
</body>

<?php include_once'footerNav.php' ?>
</html>
