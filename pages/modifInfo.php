<?php ini_set('display_errors', 1);
error_reporting(E_ALL); 
error_reporting(0); 
include("../sql/connect_params.php");

$message_erreur = "";

$dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);

if(isset($_POST['password'])){
    if($_POST['password'] == $_POST['password2']){
        try{
            $stmt = $dbh -> prepare("SELECT * FROM pact.membre WHERE idC = :idc AND mdp = :password");
            $stmt -> bindParam(':idc', $_COOKIE['user']);
            $stmt -> bindParam(':password', $_POST['password']);
            $stmt -> execute();
            $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
        if($stmt != []){
            try{
                $stmt = $dbh -> prepare("UPDATE pact.membre SET nom = :nom, prenom = :prenom, 
                pseudo = :pseudo, email = :email, telephone = :telephone, 
                numero_voie = :numero_voie, voie = :voie, code_postal = :code_postal, 
                ville = :ville WHERE idC = :idc");
                $stmt -> bindParam(':nom', $_POST['nom']);
                $stmt -> bindParam(':prenom', $_POST['prenom']);
                $stmt -> bindParam(':pseudo', $_POST['pseudo']);
                $stmt -> bindParam(':email', $_POST['email']);
                $stmt -> bindParam(':telephone', $_POST['telephone']);
                
                $temp = explode(" ",$_POST["adresse"]);
                $num_adresse = $temp[0];
                array_shift($temp);
                $adresse = implode(" ", $temp);

                $stmt->bindParam(':numero_voie', $num_adresse);
                $stmt->bindParam(':voie', $adresse);


                $stmt -> bindParam(':code_postal', $_POST['codepostal']);
                $stmt -> bindParam(':ville', $_POST['ville']);
                $stmt -> bindParam(':idc', $_COOKIE['user']);
                $stmt -> execute();
                header('Location: test_compte.php');
            }catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>";
                die();
            }
        }else{
            $message_erreur = "(Mot de passe incorrect)";
        }
    }else{
        $message_erreur = "(Les mots de passe ne correspondent pas)";
    }

}else{
    $message_erreur = "Veuillez saisir votre mot de passe";
}
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

        $stmt = $dbh->prepare("SELECT image_compte FROM pact._compte WHERE idC = :idc");
        $stmt->bindParam(':idc', $_COOKIE['user']);
        $stmt->execute();

        $image_profil = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $dbh->prepare("SELECT src_image FROM pact._image WHERE idImage = :idimage");
        $stmt->bindParam(':idimage', $image_profil['image_compte']);
        $stmt->execute();

        $image_profil = $stmt->fetch(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="../css/info-compte.css">
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

    <script>
        function annulation() {
            location.assign("infoCompte.php");
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
    <div class="container-page-creation-compte">
        <div class="menu-links-crea-compte">
            <div class="inscription-membre TS-bold" id="link-membre">
                <h1 class="TS-bold">Paramètre de Compte</h1>
                <img id="photo-profil" class="compte-photo-profil" src="../images/<?php echo $image_profil['src_image'] ?>" alt="icone-membre" class="icone-membre" width="160px" height="160px" >
                <input type="file" id="insert-image" accept="image/*" style="display: none;">
            </div>
        </div>


        <!-- Formulaire pour l'inscription membre -->
        <div class="form-container-page-creation-compte" id="form-membre">
            <form name="membre" action="infoCompte.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" value="membre">
                <div class="form-group-crea-compte">
                    <div class="left-column-crea-compte">
                        <label name="nom" class="FS">Nom<span class="required"></span></label>
                        <input type="text" class="FS" value="<?php echo $compte['nom']?>" id="nom-membre" name="nom" >
                        
                        
                        <label name="prenom" class="FS">Prénom<span class="required"></span></label>
                        <input type="text" class="FS" value="<?php echo $compte['prenom'] ?>" id="prenom-membre" name="prenom" >
                        
                        <?php if($Cmembre){ ?>
                            <label name="pseudo" class="FS">Pseudonyme</label>
                            <input type="text" class="FS" value="<?php echo $compte['pseudo'] ?>" id="pseudo-membre" name="pseudo">
                        <?php }else if($Cpro_prive){ ?>
                            <label name="codepro" class="BO">Code Professionnel</label>
                            <input type="text" class="BO" value="<?php echo $compte['codepro'] ?>" id="codepro" name="codepro">
                        <?php } ?>

                        <label name="adresse" class="FS">Adresse postale<span class="required"></span></label>
                        <input type="text" class="FS" value="<?php echo $compte['numero_voie'] . ' ' . $compte['voie']?>" id="adresse-membre" name="adresse" >

                        <div class="row-info-compte">
                            <div class="input-wrapper-crea-compte">
                                <label name="codepostal" class="FS">Code postal<span class="required"></span></label>
                                <input type="text" class="FS" value="<?php echo $compte['code_postal'] ?>" id="codepostal-membre" name="codepostal" >
                                
                            </div>

                            <div class="input-wrapper-crea-compte">
                                <label name="ville" class="FS">Ville<span class="required"></span></label>
                                <input type="text" class="FS" value="<?php echo $compte['ville'] ?>" id="ville-membre" name="ville" >

                            </div>
                        </div>
                    </div>
                    <div class="right-column-crea-compte">
                        <label name="email" class="FS">E-mail<span class="required"></span></label>
                        <input type="email" class="FS" value="<?php echo $compte['email'] ?>" id="email-membre" name="email" >

                        <label name="telephone" class="FS">Téléphone<span class="required"></span></label>
                        <input type="tel" class="FS" value="<?php echo $compte['telephone'] ?>" id="telephone-membre" name="telephone" >

                        <?php if(!$Cmembre){?>
                            <label name="denomination" class="BO">Dénomination</label>
                            <input type="text" class="BO" value="<?php echo $compte['denomination_sociale'] ?>" id="denomination" name="denomination">
                            <?php if($Cpro_prive){ ?>
                                <label name="iban" class="BO">Iban</label>
                                <input type="text" class="BO" value="<?php echo $compte['iban'] ?>" id="iban" name="iban">

                                <label name="siren" class="BO">Siren</label>
                                <input type="text" class="BO" value="<?php echo $compte['siren'] ?>" id="siren" name="siren">
                            <?php } ?>
                        <?php } ?>

                        <label name="password" class="FS">Mot de passe<span class="required"><?php echo "  " . $message_erreur ?></span></label>
                        <input type="password" class="FS" id="password-membre" name="password" >

                        <label name="password2" class="FS">Confirmer le mot de passe<span class="required"><?php echo "  " . $message_erreur ?></span></label>
                        <input type="password" class="FS" id="password2-membre" name="password2" >
                    </div>
                </div>
                    <button id="info-compte-bouton-confirmer" type="submit" class="bouton-envoi-formulaire-modif-compte TS-bold">Confirmer les modifications</button>
            </form>
        </div>
    </div>
</body>

<script src="../js/infoCompte.js" async></script>

<?php include_once'footerNav.php' ?>
</html>
