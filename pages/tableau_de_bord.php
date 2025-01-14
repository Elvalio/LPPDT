<!DOCTYPE html>
<html lang="fr">
    <?php
    include_once'nav.php';

use function PHPSTORM_META\type;

    include('../sql/connect_params.php');

    //Récupère tous les avis
    try {
        $dbh = new PDO("$driver:host=$server; port=$port; dbname=$dbname", $user, $pass);
    
        $stmt = $dbh->prepare("SELECT * FROM pact.experience");
        $stmt->execute();
        $avis = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    
    
    //Récupère toutes les réponses
    try {
        $dbh = new PDO("$driver:host=$server; port=$port; dbname=$dbname", $user, $pass);
    
        $stmt = $dbh->prepare("SELECT * FROM pact._reponse");
        $stmt->execute();
        $reponse = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        if (isset($_POST['offre_id']) && isset($_POST['status'])) {
            
            try{
            $dbh = new PDO("$driver:host=$server; port=$port; dbname=$dbname", $user, $pass);
    
            
            $offre_id = $_POST['offre_id'];
            $status = $_POST['status'] === 'checked' ? 'false' : 'true';

            if($status === 'true'){
                $stmt = $dbh->prepare("UPDATE pact._offre SET en_ligne = $status, date_publication = now()  WHERE idO = $offre_id");
                $stmt->execute();
            }else{
                $stmt = $dbh->prepare("UPDATE pact._offre SET en_ligne = $status, date_hors_ligne = now() WHERE idO = $offre_id");
                $stmt->execute();
            }

            
            } catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>";
                die();
            }
    
            
             
        } else {
            echo "<p>Erreur : les données du formulaire ne sont pas valides.</p>";
        }
    }

    $dbh = new PDO("$driver:host=$server; port=$port; dbname=$dbname", $user, $pass);

    $user_cookie = $_COOKIE['user'];

    try{

    $stmt=$dbh->prepare("SELECT o.idO, o.titre, o.resume, o.idC, o.en_ligne, MIN(p.src_image) AS src_image FROM pact.offre o
    LEFT OUTER JOIN pact.photo_offre p ON o.idO = p.idO
    WHERE o.idC = $user_cookie
    GROUP BY o.idO, o.titre, o.resume, o.idC, o.en_ligne");
    
    $stmt->execute();

    $iban_bic_incomplets = false;
    
    // Vérification si le type de compte est 'pro_prive'
    if (isset($_COOKIE['type_compte']) && $_COOKIE['type_compte'] === 'pro_prive') {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!isset($_COOKIE['user'])) {
                die("Erreur : ID du compte introuvable dans les cookies.");
            }
        }
        $idc = $_COOKIE['user'];
            
    
        // Requête pour vérifier si l'IBAN et le BIC existent pour l'idC donné et ne sont pas null
        $query = "SELECT iban, bic FROM pact._secteur_prive WHERE idC = :idC AND iban IS NOT NULL AND bic IS NOT NULL";
        $stmt2 = $dbh->prepare($query);
        $stmt2->bindParam(':idC', $idc, PDO::PARAM_INT);
        $stmt2->execute();

        $result = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result) || $result[0]['iban'] == null || $result[0]['bic'] == null) {
            $iban_bic_incomplets = true;
        }
    }

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    $dbh = null;
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tableau de Bord</title>
        <link rel="stylesheet" href="../css/tableau_bord.css">
        <link rel="stylesheet" href="../css/styleGeneral.css">
    </head>
    <body class="BO">
        <div class="main-content">
            <header>
                <h1>Vos offres</h1>
                <h2>Gérez vos offres ici</h2>
            </header>
            <main>
                <?php
                foreach($result as $key => $valeur){
                ?>
                <section class="section_offre">
                    <img src="../images/<?php echo !is_null($valeur["src_image"]) ?  $valeur["src_image"] : '../images/rien.png'?>" alt="<?php echo $valeur["titre"]; ?>" title="<?php echo $valeur["titre"]; ?>" placeholder="../images/imagesReferences/placeholder.php">
                    <div class="infos_offre">
                        <div class="titre_switch">
                            <p class="titre_offre"><strong><?php echo $valeur["titre"]; ?></strong></p>
                        </div>
                        <p class="description"><?php echo $valeur["resume"]; ?></p>
                        <div class="detail_modif">
                            <a href="detail-offre.php?value=<?php echo $valeur["ido"];?>">Voir les détails</a>
                            <a href="modifier_offre.php?value=<?php echo $valeur["ido"];?>">Modifier les informations</a>
                        </div>
                        <div class="hors_ligne">
                            <form method="POST" action="tableau_de_bord.php" onsubmit="validateAndSubmitForm(this)">
                            <input type="hidden" name="status" value="checked" iban-bic-data=<?=$iban_bic_incomplets ?>>
                                <label class="switch">
                                    <input type="checkbox" name="status" value="unchecked" <?php if ($valeur["en_ligne"] == 'false') echo 'checked'; ?>>
                                    <span class="slider round"></span>
                                </label>
                                <input type="hidden" name="offre_id" value="<?php echo $valeur["ido"]; ?>">
                            </form>
                        </div>
                        <div class="avis_non_rep">
                            <?php
                            $nbr_avis_non_rep = 0;
                            foreach($avis as $av) {
                                if ($av['ido'] == $valeur['ido']) {
                                    $check = true;
                                    foreach($reponse as $rep) {
                                        if ($av['ida'] == $rep['ida']) {
                                            $check = false;
                                        }
                                    }
                                    if ($check) {
                                        $nbr_avis_non_rep++;
                                    }
                                }
                            }
                            if ($nbr_avis_non_rep > 0) { ?>
                                <p class="FS">Vous avez <?php echo (string)$nbr_avis_non_rep ?> avis non répondu</p>
                            <?php } ?>
                        </div>
                    </div>
                </section>
                <?php
                }
                ?>
                <form action="creation_offre.php">
                    <input type="submit" value="Créer une nouvelle offre" id="creer_offre"/>
                </form>
                <script src="../js/tableau_de_bord.js"></script>
                <script src="../js/popup.js"></script>
                <?php

                include_once'footer.php';

                ?>  
            </main>
        </div>
    </body>
</html>
