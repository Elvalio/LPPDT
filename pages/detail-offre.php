<?php
include('../sql/connect_params.php');

if($_SERVER['REQUEST_METHOD']==='POST'){

    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    // connexion

    $identifiant = trim($_POST['identifiant']);
    $message_erreur = '';
    $trouve = false;
    try{
        $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname",
            $user, $pass);

        //verifie si membre

        $stmt = $dbh->prepare(
            "SELECT idC, pseudo, mdp FROM pact.membre WHERE pseudo = :pseudo;"
        );
        $stmt->bindParam(':pseudo', $identifiant, PDO::PARAM_STR);
        
            
        $stmt->execute();
        $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
        if ($stmt!=[]) {
            if ($stmt[0]['mdp'] == $_POST['password']) {
                $idC = strval($stmt[0]['idc']);
                setcookie("user", $idC, time() + 3600, '/');
                setcookie("type_compte", 'membre', time() + 3600, '/');

                $_COOKIE['user'] = $idC;
                $_COOKIE['type_compte'] = 'membre';
                $trouve = true;
            }
        }
        
        //verifie si professionnel

        $identifiant = (int)$identifiant;

        $stmt = $dbh->prepare(
            "SELECT idC, codePro, mdp FROM pact.professionnel WHERE codePro = :codePro;"
        );
        $stmt->bindParam(':codePro', $identifiant, PDO::PARAM_INT);

        $stmt->execute();
        $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($stmt!=[]) {
            if ($stmt[0]['mdp'] == $_POST['password']) {
                $idC = strval($stmt[0]['idc']);
                setcookie("user", $idC, time() + 3600, '/');

                $_COOKIE['user'] = $idC;

                $stmt = $dbh->prepare(
                    "select * from pact.professionnel where idC in (select idC from pact.secteur_prive where idC = $idC);"
                );
        
                $stmt->execute();
                $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($stmt!=[]) {
                    setcookie("type_compte", 'pro_prive', time() + 3600, '/');

                    $_COOKIE['type_compte'] = 'pro_prive';
                }else{
                    setcookie("type_compte", 'pro_public', time() + 3600, '/');

                    $_COOKIE['type_compte'] = 'pro_public';
                }
                $trouve = true;
            }
        }

        if (!$trouve){
            $message_erreur = "Nom d'utilisateur ou mot de passe incorrect, veuillez réessayer";
        }

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }

    if($_POST['type_form'] == 'supp-avis'){
        try{

            $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);
            $stmt = $dbh->prepare("DELETE FROM pact.avis WHERE idA = :ida");        
            $stmt->bindParam(':ida', $_POST['id_avis']);
            $stmt->execute();

            $dbh=null;

            header("Location: detail-offre.php?value=$_GET[value]");
            exit;

        }catch(PDOException $e){

            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();

        }

    }else if($_POST['type_form'] == 'poste-avis'){

        try{

            $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);
            $note = (int)$_POST['nbr_etoile'];
            $titre = $_POST['titre_avis'];
            $com = $_POST['zone_avis'];
            $ido = (int)$_GET['value'];
            $idc = (int)$_COOKIE['user'];
            $contexte = $_POST['options'];


            $stmt = $dbh->prepare("INSERT INTO pact.experience(idC, idO, titre_avis, note, corps, date_visite, contexte)
            VALUES (:idc, :ido, :titre, :note, :corps, NOW(), :contexte);
            ");
            $stmt->execute([
                ':idc' => $idc,
                ':ido' => $ido,
                ':titre' => $titre,
                ':note' => $note,
                ':corps' => $com,
                ':contexte' => $contexte
            ]);

            $dbh=null;

            header("Location: detail-offre.php?value=$ido");
            exit;

        }catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    } else if($_POST['type_form'] == 'poste-reponse') {
        try {
            $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);
            $ida = (int)$_POST['avis'];
            $idc = (int)$_COOKIE['user'];
            $corps = $_POST['zone_reponse'];

            $stmt = $dbh->prepare("INSERT INTO pact._reponse(idA, idC, corps) VALUES (:ida, :idc, :corps)");
            $stmt->execute([
                ':ida' => $ida,
                ':idc' => $idc,
                ':corps' => $corps
            ]);

            $dbh=null;
            $refresh = "Location: detail-offre.php?value=". $_POST['ido'];
            header($refresh);
            exit;

        }catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

}


// Sécurisation de l'ID d'annonce
$idAnnonce = isset($_GET['value']) ? (int)$_GET['value'] : 0;
if ($idAnnonce === 0) {
    die("ID d'annonce invalide.");
}

try {
    $bdh = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);

    // Requête pour récupérer les informations de l'offre
    $stmt = $bdh->prepare("SELECT * FROM pact.offre WHERE ido = :idAnnonce");
    $stmt->execute([':idAnnonce' => $idAnnonce]);
    $offre = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$offre) {
        die("Aucune offre trouvée.");
    }

    // Requête pour récupérer les infos optionnel des activités
    $stmtActivite = $bdh->prepare("SELECT * FROM pact.activite WHERE ido = :idAnnonce");
    $stmtActivite->execute([':idAnnonce' => $idAnnonce]);
    $activite = $stmtActivite->fetchAll(PDO::FETCH_ASSOC);

    $stmtParc = $bdh->prepare("SELECT * FROM pact.parc_d_attraction WHERE ido = :idAnnonce");
    $stmtParc->execute([':idAnnonce' => $idAnnonce]);
    $parc_actraction = $stmtParc->fetchAll(PDO::FETCH_ASSOC);

    $stmtSpectacle = $bdh->prepare("SELECT * FROM pact.spectacle WHERE ido = :idAnnonce");
    $stmtSpectacle->execute([':idAnnonce' => $idAnnonce]);
    $spectacle = $stmtSpectacle->fetchAll(PDO::FETCH_ASSOC);

    $stmtRestaurant = $bdh->prepare("SELECT * FROM pact.restauration WHERE ido = :idAnnonce");
    $stmtRestaurant->execute([':idAnnonce' => $idAnnonce]);
    $restaurant = $stmtRestaurant->fetchAll(PDO::FETCH_ASSOC);

    $stmtVisite = $bdh->prepare("SELECT * FROM pact.visite WHERE ido = :idAnnonce");
    $stmtVisite->execute([':idAnnonce' => $idAnnonce]);
    $visite = $stmtVisite->fetchAll(PDO::FETCH_ASSOC);

    // Requête pour récupérer les images associées
    $stmtPhotos = $bdh->prepare("SELECT src_image FROM pact.photo_offre WHERE idO = :idAnnonce");
    $stmtPhotos->execute([':idAnnonce' => $idAnnonce]);
    $photos = $stmtPhotos->fetchAll(PDO::FETCH_ASSOC);

    // Requête pour récupérer les avis associés à l'offre
    if(isset($_COOKIE['user'])){
        $stmtAvis = $bdh->prepare("SELECT * FROM pact.experience WHERE idO = :idAnnonce and idC = :idCompte");
        $stmtAvis->execute([':idAnnonce' => $idAnnonce, ':idCompte' => $_COOKIE['user']]);
        $avis = $stmtAvis->fetchAll(PDO::FETCH_ASSOC);
        $stmtAvis = $bdh->prepare("SELECT * FROM pact.experience WHERE idO = :idAnnonce and idC != :idCompte");
        $stmtAvis->execute([':idAnnonce' => $idAnnonce, ':idCompte' => $_COOKIE['user']]);
        $tab = $stmtAvis->fetchall(PDO::FETCH_ASSOC);
        foreach($tab as $val):
        array_push($avis, $val);
        endforeach;
    }else{
        $stmtAvis = $bdh->prepare("SELECT * FROM pact.experience WHERE idO = :idAnnonce");
        $stmtAvis->execute([':idAnnonce' => $idAnnonce]);
        $avis = $stmtAvis->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    // Requête pour griser tout les avis qui ont déjà été signalé par l'utilisateur
    $idAvis = $avisIndividuel['ida'];
    $idSignaleur = (int)$_COOKIE['user'];

    $bdh = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);
    $stmt = $bdh->prepare("
        SELECT COUNT(*) FROM pact._signal_avis 
        WHERE idA = :idA AND idSignaleur = :idSignaleur
    ");
    $stmt->execute([
        ':idA' => $idAvis,
        ':idSignaleur' => $idSignaleur
    ]);
    $alreadySignaled = $stmt->fetchColumn() > 0;
    */

    // Récupération du téléphone du professionnel
    $stmtTelephone = $bdh->prepare("
        SELECT telephone 
        FROM pact.professionnel p 
        INNER JOIN pact.offre o ON p.idC = o.idC 
        WHERE o.idC = :idC
    ");
    $stmtTelephone->execute([':idC' => $offre['idc']]);
    $telephone = $stmtTelephone->fetch(PDO::FETCH_ASSOC)['telephone'] ?? 'Non disponible';

} catch (PDOException $e) {
    echo "Erreur : " . htmlspecialchars($e->getMessage());
    die();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo htmlspecialchars($offre['categorie'] ?? 'Détails de l\'offre'); ?>
    </title>
    <link rel="stylesheet" href="../css/samStyles.css">
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <script src="../js/detail-offre-offre.js" async></script>
    <link rel="icon" type="image/png" href="../logo/logo_reduit_vert.png">
</head>

<div class="desktop-element">
<?php include_once 'nav.php';?>
</div>

<body class="main-content <?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'BO' : 'FO'; ?>">

    <div class="body">
        <section class="section-page part-annonce">
        <header>
            <h1 class="titre-rouge">
                <?php echo htmlspecialchars($offre['titre']); ?>
            </h1>
            <h2 class="sous-titre">
                <?php echo htmlspecialchars($offre['ville']); ?> |
                <?php echo htmlspecialchars($telephone); ?>
                <?php if (!empty($spectacle[0]['duree'])) echo " | Durée : " . htmlspecialchars(substr($spectacle[0]['duree'], 0, 5)); ?>
                <?php if (!empty($activite[0]['duree'])) echo " | Durée : " . htmlspecialchars(substr($activite[0]['duree'], 0, 5)); ?>
                <?php if (!empty($visite[0]['duree'])) echo " | Durée : " . htmlspecialchars(substr($visite[0]['duree'], 0, 5)); ?>

                <?php if (!empty($activite[0]['age_min'])) echo " | Âge : " . $activite[0]['age_min'] . " ans"; ?>
                <?php if (!empty($parc_actraction[0]['age_min'])) echo " | Âge : " . $parc_actraction[0]['age_min'] . " ans"; ?>

                <?php   if (!empty($restaurant[0]['gamme_prix'])) {echo " | Prix : " . htmlspecialchars($restaurant[0]['gamme_prix']);}
                        elseif (!empty($offre['prix_min'])) {echo " | Prix : " . htmlspecialchars($offre['prix_min']) . " €";} 
                ?>

                <?php echo htmlspecialchars($offre['gamme_prix'] ?? ''); ?>
            </h2>

            <!-- Carrousel -->
            <div class="container NoSelect">
                <div class="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($photos as $index => $photo): ?>
                        <div class="slide">
                            <img src="../images/<?php echo htmlspecialchars($photo['src_image']); ?>"
                                alt="Image <?php echo $index + 1; ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="carousel-controls NoSelect">
                        <button id="prev"><img src="../images/fleche.png" alt="Précédent"></button>
                        <button id="next"><img src="../images/fleche.png" alt="Suivant"></button>
                    </div>
                    <div class="carousel-dots NoSelect"></div>
                </div>
            </div>

            <!-- Informations -->
            <div class="infos-offre">
                <div class="infos-avis">
                    <div class="etoiles">
                        <?php
                            $nbrAvis = $offre['nbravis'];
                            $fullStars = floor($offre["moy_note"]);
                            $halfStar = ($offre["moy_note"] - $fullStars >= 0.5) ? 1 : 0;
                            $emptyStars = 5 - $fullStars - $halfStar;
                        ?>

                        <?php for ($i = 0; $i < $fullStars; $i++): ?>
                            <img src="../icons/<?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'etoile_rouge' : 'etoile_bleue'; ?>.png" alt="Étoile">
                        <?php endfor; ?>

                        <?php if ($halfStar): ?>
                            <img src="../icons/<?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'demi_etoile_rouge' : 'demi_etoile_bleue'; ?>.png" alt="Demi Étoile">
                        <?php endif; ?>

                        <?php for ($i = 0; $i < $emptyStars; $i++): ?>
                            <img src="../icons/<?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'etoile_rouge_vide' : 'etoile_bleue_vide'; ?>.png" alt="Étoile Vide">
                        <?php endfor; ?>

                    </div>
                    <p class="nb-avis-info-offre">
                        <?php echo $nbrAvis?>&#xA0;Avis
                    </p>
                </div>
                <div class="infos-accessibilite">

                    <img src="../images/Wheelchair.png" alt="Accessibilité">
                    <p>
                        <?php echo htmlspecialchars($offre['accessibilite']); ?>
                    </p>
                </div>
            </div>
        </header>

        <!-- Description -->
        <article class="description-offre">
            <h3>Description :</h3>
            <p>
                <?php echo nl2br(htmlspecialchars($offre['description'])); ?>
            </p>
        </article>

        <article class="part-contact">
            <div class="side-contact">
                <div>
                    <h3>Contact :</h3>
                    <div class="element-contact">
                        <?php 
                        $address = $offre['numero_voie'] . $offre['voie'] . $offre['ville'] . $offre['code_postal'];
                        ?>
                        <a href="https://www.google.com/maps/dir// <?php echo $address ?>">
                            <img src="../images/maison.png" alt="icon maison (localisation)">
                            <p class="lien">
                                <?php
                                echo $offre['numero_voie'];
                                echo " ";
                                echo $offre['voie'];
                                echo " ";
                                echo $offre['ville'];
                                echo " ";
                                echo $offre['code_postal'];

                            ?>
                            </p>
                        </a>
                    </div>
                    <div class="element-contact">
                        <a href="tel:<?php 
                            echo htmlspecialchars($telephone);
                                ?> ">
                            <img src="../images/telephone.png" alt="icon telephone">
                            <p class="lien">
                                <?php 
                                        echo htmlspecialchars($telephone);
                                    ?>
                            </p>
                        </a>
                    </div>

                    <?php
                        if (!empty($offre['site_web'])) { ?>
                    <div class="element-contact">
                        <a href=" <?php echo $offre['site_web']; ?>">
                            <img src="../images/pc.png" alt="icon pc (lien vers le site)">
                            <p class="lien">
                                <?php
                            echo $offre['site_web']; ?>
                            </p>
                        </a>
                    </div>
                </div>
                <?php

                        } ?>
            </div>
            <!--<div class="horaires">
                        <h3>Horaires et tarifs :</h3>
                        <div>
                            <img src="../images/Delivery Time.png" alt="icon heure">
                            <p>8h - 13h et 14h30 - 18h du lundi au vendredi</p>
                        </div>
                        <div>
                            <img src="../images/Stack of Coins.png" alt="icon argent">
                            <p>12 € par adulte, gratuit pour les enfants (-12 ans)</p>
                        </div>
                    </div>-->

            <!--
            </div>
            <?php 
                    if (!empty($parc_actraction[0]['src_image'])) { ?>
            <div>
                <img class="carte" src="../images/<?php echo $parc_actraction[0]['carte'] ?>" alt="plan">
            </div>
            <?php
                    } elseif (!empty($restaurant[0]['src_image'])) { ?>
            <div>
                <img class="carte" src="../images/<?php echo $restaurant[0]['src_image'] ?>" alt="carte">
            </div>
            <?php
                    }
                ?>
            </div>
            -->

        </article>
        <button class="desktop-element bouton-retour NoSelect">
            <a href="./accueil.php">
                <img src="../icons/arrow-left-o.svg" alt="Retour">
                Retour
            </a>
        </button>
    </section>

    <!-- Avis -->
    <section class="section-page part-avis">
        <header class="header-avis">
            <h3>Avis :
                <?php echo $nbrAvis; ?>
            </h3>
        </header>
        <article class="article-avis">
            <?php if(!isset($_COOKIE['type_compte']) || $_COOKIE['type_compte'] == "membre"){ 
                    if (isset($_COOKIE['user'])){
                    $avis_publie = false;
                    if ($nbrAvis > 0){ foreach ($avis as $avisIndividuel):
                        if($_COOKIE['user'] == $avisIndividuel['idc']){
                            $avis_publie = true;
                        }
                    endforeach;}
                    if(!$avis_publie){ ?>
            <article class="poster_avis">
                <h3>Poster un avis :</h3>
                <div class="notes_avis">
                    <?php for($i = 1; $i<6; $i++):?>
                        <img src="../icons/etoile_bleue_vide.png" width="35px" height="35px"
                            id="etoile_note<?php echo $i?>">
                    <?php endfor;?>
                </div>
                <form method="POST" action="detail-offre.php?value=<?php echo $offre['ido']?>" class="zone-btn-publier">
                        <input type="hidden" name="type_form" value="poste-avis">
                        <input type="hidden" id="nbr_etoile" name="nbr_etoile" value="<?php echo isset($_POST['etoile']) ? $_POST['etoile'] : ''; ?>">
                        <textarea maxlength="30" type="text" name="titre_avis" id="titre_avis" placeholder="Titre de l'avis"
                            required="required"><?php echo isset($_POST['titreAvis']) ? $_POST['titreAvis'] : ''; ?></textarea>
                        <textarea minlength="30" maxlength="255" type="text" name="zone_avis" id="ecrire_avis"
                            placeholder="Veuillez écrire dans cette zone pour pouvoir déposer un avis sur cette offre."><?php echo isset($_POST['contenuAvis']) ? $_POST['contenuAvis'] : ''; ?></textarea>
                        <!--<input type="file" accept=".png, .jpeg, .svg, .webp" id="image_avis" name="image_avis">-->
                        <label for="options" id="titre-contexte">Contexte de la visite :</label>
                        <select id="options-contexte" name="options">
                            <option value="Affaires" <?= isset($_POST['contextAvis']) && $_POST['contextAvis'] === 'Affaires' ? 'selected' : '' ?>>Affaires</option>
                            <option value="Couple" <?= isset($_POST['contextAvis']) && $_POST['contextAvis'] === 'Couple' ? 'selected' : '' ?>>Couple</option>
                            <option value="Famille" <?= isset($_POST['contextAvis']) && $_POST['contextAvis'] === 'Famille' ? 'selected' : '' ?>>Famille</option>
                            <option value="Amis" <?= isset($_POST['contextAvis']) && $_POST['contextAvis'] === 'Amis' ? 'selected' : '' ?>>Amis</option>
                            <option value="Seul" <?= isset($_POST['contextAvis']) && $_POST['contextAvis'] === 'Seul' ? 'selected' : '' ?>>Seul</option>
                        </select>
                        <input type="submit" id="bouton_publier" value="Publier">
                        </form>
                    <?php
                }
                }else{ ?>
                <h3>Poster un avis :</h3>
                <div class="notes_avis">
                    <?php for($i = 1; $i<6; $i++):?>
                        <img src="../icons/etoile_bleue_vide.png" width="35px" height="35px"
                            id="etoile_note<?php echo $i; ?>">
                    <?php endfor;?>
                </div>
                <input type="hidden" id="nbr_etoile" name="nbr_etoile" value="<?php echo isset($_POST['etoile']) ? $_POST['etoile'] : ''; ?>">
                <textarea maxlength="30" type="text" name="titre_avis" id="titre_avis" placeholder="Titre de l'avis"
                    required="required"><?php echo isset($_POST['titreAvis']) ? $_POST['titreAvis'] : ''; ?></textarea>
                <textarea minlength="30" maxlength="255" type="text" name="zone_avis" id="ecrire_avis"
                    placeholder="Veuillez écrire dans cette zone pour pouvoir déposer un avis sur cette offre."><?php echo isset($_POST['contenuAvis']) ? $_POST['contenuAvis'] : ''; ?></textarea>
                <!--<input type="file" accept=".png, .jpeg, .svg, .webp" id="image_avis" name="image_avis">-->
                <label for="options" id="titre-contexte">Contexte de la visite :</label>
                    <select id="options-contexte" name="options">
                        <option value="Affaires" <?= isset($_POST['contextAvis']) && $_POST['contextAvis'] === 'Affaires' ? 'selected' : '' ?>>Affaires</option>
                        <option value="Couple" <?= isset($_POST['contextAvis']) && $_POST['contextAvis'] === 'Couple' ? 'selected' : '' ?>>Couple</option>
                        <option value="Famille" <?= isset($_POST['contextAvis']) && $_POST['contextAvis'] === 'Famille' ? 'selected' : '' ?>>Famille</option>
                        <option value="Amis" <?= isset($_POST['contextAvis']) && $_POST['contextAvis'] === 'Amis' ? 'selected' : '' ?>>Amis</option>
                        <option value="Seul" <?= isset($_POST['contextAvis']) && $_POST['contextAvis'] === 'Seul' ? 'selected' : '' ?>>Seul</option>
                    </select>

                    <button id="bouton_publier" type="button">
                        Valider
                    </button>
                <?php } ?>
            </article>
            <?php   } ?>
            
            <?php 
            $id_avis = 0;
            if ($nbrAvis > 0){
                foreach ($avis as $avisIndividuel): 
                $stmtCompte = $bdh->prepare("SELECT * FROM pact.membre WHERE idC = :idC");
                $stmtCompte->execute([':idC' => $avisIndividuel['idc']]);
                $compte = $stmtCompte->fetch(PDO::FETCH_ASSOC);      
                
                $stmtReponse = $bdh->prepare("SELECT * FROM pact._reponse WHERE idA = :idA");
                $stmtReponse->execute([':idA' => $avisIndividuel['ida']]);
                $reponse = $stmtReponse->fetch(PDO::FETCH_ASSOC);

                // Vérification avis deja signalé 

                // Vérifier si l'avis a déjà été signalé par l'utilisateur connecté
                /*$idAvis = $avisIndividuel['ida'];
                $idSignaleur = isset($_COOKIE['user']) ? (int)$_COOKIE['user'] : 0; // Récupérer l'utilisateur depuis le cookie

                $stmtSignal = $bdh->prepare("
                    SELECT COUNT(*) FROM pact._signal_avis 
                    WHERE idA = :idA AND idSignaleur = :idSignaleur
                ");
                $stmtSignal->execute([
                    ':idA' => $idAvis,
                    ':idSignaleur' => $idSignaleur
                ]);
                $alreadySignaled = $stmtSignal->fetchColumn() > 0;

                // Vérifier si une réponse  a déjà été signalé par l'utilisateur connecté
                $idAvis = $avisIndividuel['ida'];
                $idSignaleur = isset($_COOKIE['user']) ? (int)$_COOKIE['user'] : 0; // Récupérer l'utilisateur depuis le cookie

                $stmtSignal = $bdh->prepare("
                    SELECT COUNT(*) FROM pact._signal_reponse 
                    WHERE idA = :idA AND idSignaleur = :idSignaleur
                ");
                $stmtSignal->execute([
                    ':idA' => $idAvis,
                    ':idSignaleur' => $idSignaleur
                ]);
                $alreadySignaled = $stmtSignal->fetchColumn() > 0;
                */
                /*
                // Récupérer l'utilisateur depuis le cookie
                $idSignaleur = isset($_COOKIE['user']) ? (int)$_COOKIE['user'] : 0;

                // Vérification si l'avis a déjà été signalé
                $idAvis = $avisIndividuel['ida'];

                $stmtSignalAvis = $bdh->prepare("
                    SELECT COUNT(*) FROM pact._signal_avis 
                    WHERE idA = :idA AND idSignaleur = :idSignaleur
                ");
                $stmtSignalAvis->execute([
                    ':idA' => $idAvis,
                    ':idSignaleur' => $idSignaleur
                ]);
                $alreadySignaledAvis = $stmtSignalAvis->fetchColumn() > 0;

                // Vérification si une réponse liée à l'avis a déjà été signalée
                $stmtSignalReponse = $bdh->prepare("
                    SELECT COUNT(*) FROM pact._signal_reponse 
                    WHERE idA = :idA AND idSignaleur = :idSignaleur
                ");
                $stmtSignalReponse->execute([
                    ':idA' => $idAvis,
                    ':idSignaleur' => $idSignaleur
                ]);
                $alreadySignaledReponse = $stmtSignalReponse->fetchColumn() > 0;
                */
                /*
                // Récupération de l'ID de l'utilisateur (depuis les cookies)
                $idSignaleur = isset($_COOKIE['user']) ? (int)$_COOKIE['user'] : 0;

                // Récupération de l'ID de l'avis
                $idAvis = $avisIndividuel['ida'];

                // Vérification si l'avis a déjà été signalé
                $stmtSignalAvis = $bdh->prepare("
                    SELECT COUNT(*) FROM pact._signal_avis 
                    WHERE idA = :idA AND idSignaleur = :idSignaleur
                ");
                $stmtSignalAvis->execute([
                    ':idA' => $idAvis,
                    ':idSignaleur' => $idSignaleur
                ]);
                $alreadySignaledAvis = $stmtSignalAvis->fetchColumn() > 0;

                // Vérification si une réponse liée à l'avis a déjà été signalée
                $stmtSignalReponse = $bdh->prepare("
                    SELECT COUNT(*) FROM pact._signal_reponse 
                    WHERE idA = :idA AND idSignaleur = :idSignaleur
                ");
                $stmtSignalReponse->execute([
                    ':idA' => $idAvis,
                    ':idSignaleur' => $idSignaleur
                ]);
                $alreadySignaledReponse = $stmtSignalReponse->fetchColumn() > 0;

                // Déterminer l'état du bouton en fonction des résultats
                $buttonDisabled = $alreadySignaledAvis || $alreadySignaledReponse;
                $buttonStyle = $buttonDisabled ? 'cursor: not-allowed; opacity: 0.5;' : '';
                $buttonText = $alreadySignaledAvis ? 'Déjà signalé' : "Signaler l'avis";
                // Vérifier si l'utilisateur a signalé cet avis ou une de ses réponses
                */
                /*
                if ($alreadySignaledAvis) {
                    echo "L'avis a déjà été signalé par cet utilisateur.";
                } elseif ($alreadySignaledReponse) {
                    echo "Une réponse à cet avis a déjà été signalée par cet utilisateur.";
                } else {
                    echo "Cet utilisateur n'a pas encore signalé cet avis ou ses réponses.";
                }
                */

                ?> 
            <div class="alignement-conteneur-avis">
                <div class="header-avis-profil">
                    <div class="profil">
                        <img src="../images/1 2.png" alt="Photo de profil" width="40px" height="40px">
                        <div class="titre-contexte">
                            <div class="titre-date">
                                <h4>
                                    <?php echo htmlspecialchars($avisIndividuel['titre_avis']); ?>
                                </h4>
                                <p><?php echo htmlspecialchars($avisIndividuel['date_visite']); ?></p>
                            </div>
                            <div class="pseudo-contexte">
                                <p class="ligne_sepa_contexte"><?php echo htmlspecialchars($avisIndividuel['pseudo']); ?></p>
                                <p><?php echo htmlspecialchars($avisIndividuel['contexte']); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="etoile-avis-detail-offre">
                        <?php
                        $full = (int) $avisIndividuel['note'];
                        $empty = 5 - $full;
                        for ($i = 0; $i < $full; $i++): ?>
                        <img src="../icons/<?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'etoile_rouge' : 'etoile_bleue'; ?>.png"
                            width="20px" height="20px" alt="Étoile">
                        <?php endfor; ?>
                        <?php for ($i = 0; $i < $empty; $i++): ?>
                        <img src="../icons/<?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'etoile_rouge_vide' : 'etoile_bleue_vide'; ?>.png"
                            width="20px" height="20px" alt="Étoile Vide">
                        <?php endfor;
                        ?>
                    </div>
                </div>
                <?php if (isset($_COOKIE['type_compte']) && ($_COOKIE['type_compte'] == "pro_public" || $_COOKIE['type_compte'] == "pro_prive") && $offre['idc'] == $_COOKIE['user']) { 
                    if (!isset($reponse['ida'])) { ?>
                        <div class="commentaire-consulte exergue">
                            <p>
                                <?php echo nl2br(htmlspecialchars($avisIndividuel['corps'])); ?>
                            </p>
                        </div>
                    <?php } else { ?>
                        <div class="commentaire-consulte">
                            <p>
                                <?php echo nl2br(htmlspecialchars($avisIndividuel['corps'])); ?>
                            </p>
                        </div>
                    <?php } 
                }else{
                    ?>
                        <div class="commentaire-consulte">
                            <p>
                                <?php echo nl2br(htmlspecialchars($avisIndividuel['corps'])); ?>
                            </p>
                        </div>
                    <?php
                } ?>

                <?php
                if(isset($_COOKIE['user']) && $avisIndividuel['idc'] == $_COOKIE['user']){
                    ?>
                    <form method="POST" action="detail-offre.php?value=<?php echo $idAnnonce; ?>" class="form-supp">
                        <input type="hidden" name="type_form" value="supp-avis">
                        <input type="hidden" name="id_avis" value=<?php echo $avisIndividuel['ida']; ?>>
                        <input type="button" name="bouton_supp" class="bouton-supp" value="Supprimer l'avis">
                    </form>
                    <hr>
                    <?php
                }

                ?><div class="signaler-like"><?php
                
                if (isset($_COOKIE['type_compte']) && ($_COOKIE['type_compte'] == "membre" || $_COOKIE['type_compte'] == "pro_public" || $_COOKIE['type_compte'] == "pro_prive") && $avisIndividuel['idc'] != $_COOKIE['user']) : ?>
                        <button type="button"
                            class="btn-signaler"
                            id="btn_signaler_avis_<?php echo $_COOKIE['user']; ?>_<?php echo $avisIndividuel['ida']; ?>">
                            <img src="../icons/warningred.png" alt="Icône signaler" id="icone-signaler">
                            <p>Signaler l'avis</p>
                        </button>
                        <?php
                        if($_COOKIE['type_compte'] == "pro_prive" && $offre['type']==3){
                            ?>
                            <button type="button"
                            class="btn-blacklist"
                            id="btn_blacklist_<?php echo $_COOKIE['user'];?>">
                            <img src="../icons/blacklist.png" alt="Icône Blacklist" id="icone-blacklist">
                            <p>Blacklister l'avis</p>
                            </button>
                        <?php
                        }
                        ?>
                
                <?php endif;

                if(isset($_COOKIE['type_compte']) && $_COOKIE['type_compte'] == "membre" && $avisIndividuel['idc'] != $_COOKIE['user']){
                ?><div class="like-dislike">
                <?php 
                        $stmt = $dbh->prepare("SELECT nbr_likes, nbr_dislikes FROM pact.avis WHERE idA = :idAvis");
                        $stmt->execute([':idAvis'=>$avisIndividuel['ida']]);
                        $like_dislike = $stmt->fetch(PDO::FETCH_ASSOC);
                        ?>

                        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                        <button id="likeButton_<?php echo $_COOKIE['user']?>_<?php echo $avisIndividuel['ida']?>" class="LikeButton" style="border: none; background: none; cursor: pointer;">
                            <dotlottie-player id="likeAnimation_<?php echo $_COOKIE['user']?>_<?php echo $avisIndividuel['ida']?>"
                                src="https://lottie.host/7296a538-6074-4c20-9eb2-fcd9a8494cf7/WYlTqi09st.lottie"
                                background="transparent" speed="1"
                                style="width: 60px; height: 60px"
                                direction="1" playMode="normal">
                            </dotlottie-player>
                        </button>

                        <span id="likesCount_<?php echo $avisIndividuel['ida']?>"><?php
                        echo $like_dislike['nbr_likes'];



                        ?></span>
                        <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.3.0/dist/dotlottie-wc.js" type="module"></script>

<button id="dislikeButton_<?php echo $_COOKIE['user']?>_<?php echo $avisIndividuel['ida']?>" class="DislikeButton" style="border: none; background: none; cursor: pointer;">
    <dotlottie-wc 
        id="dislikeAnimation_<?php echo $_COOKIE['user']?>_<?php echo $avisIndividuel['ida']?>"
        src="https://lottie.host/5df25556-9851-4371-a225-93a7536c8766/3bTi7yuX0T.lottie"
        background="transparent"
        speed="1"
        style="width: 60px; height: 60px">
    </dotlottie-wc>
</button>           
                        <span id="dislikesCount_<?php echo $avisIndividuel['ida']?>">
                        <?php
                        echo $like_dislike['nbr_dislikes'];
                        ?></span>
                </div>
                <?php }?>
                </div>
                <?php

                if (isset($_COOKIE['type_compte'], $_COOKIE['user'])) {
                    if (($_COOKIE['type_compte'] == "pro_public" || $_COOKIE['type_compte'] == "pro_prive") && $offre['idc'] == $_COOKIE['user']) {
                        if (isset($reponse['ida'])) { ?>
                            <div class="commentaire-reponse">
                                <p><?php
                                echo nl2br(htmlspecialchars($reponse['corps'])) ?>
                                </p>
                            </div>
                        <?php 
                        if (isset($_COOKIE['type_compte']) && ($_COOKIE['type_compte'] == "membre" || $_COOKIE['type_compte'] == "pro_public" || $_COOKIE['type_compte'] == "pro_prive") && $avisIndividuel['idc'] != $_COOKIE['user']) : ?>
                            <button type="button" 
                                class="btn-signaler"
                                id="btn_signaler_reponse_<?php echo $_COOKIE['user'] ?>_<?php echo $avisIndividuel['ida'] ?>"
                                style="margin-left : 30px;">
                                <img src="../icons/warningred.png" alt="Icône signaler" id="icone-signaler">
                                <p>Signaler réponse</p>
                            </button>
                        
                        <?php endif;
                        
                        } else { ?>
                            <button type="button" onclick="toggle_reponse(<?php echo $id_avis ?>);" id="btn-reponse">Ajouter une réponse</button>
                            <form method="POST" action="detail-offre.php?value=<?php $offre['ido']?>" class="zone-btn-publier form_reponse" id="form_reponse" style="display: none">
                                <input type="hidden" name="type_form" value="poste-reponse">
                                <input type="hidden" name="avis" value=<?php echo $avisIndividuel['ida']?>>
                                <input type="hidden" name="ido" value=<?php echo $avisIndividuel['ido']?>>
                                <textarea minlength="30" maxlength="255" type="text" name="zone_reponse" id="ecrire_reponse" placeholder="Veuillez écrire dans cette zone pour pouvoir déposer une réponse sur cette avis."></textarea>
                                <input type="submit" id="bouton_publier" value="Publier">
                            </form>
                            <?php
                        }
                    }
                }
                ?>
            </div>
            <?php
            $id_avis++;
            endforeach; }?>
            <!-- Ensure this is properly placed -->
        </article>
    </section>
    <div id="popup">
        <p>Votre signalement a bien été pris en compte.</p>
        <div class="progress-bar">
            <div></div>
        </div>
        <button class="close-btn">Fermer</button>
    </div>

    <?php if(!isset($_COOKIE['user'])){?>
        <div id="overlay"></div>
        <div id="popup_avis">
            
            <img id="logo" src="../logo/logo_reduit_vert.png">
            <div id="group">
                <div id="text">
                    <p id="debut">Vous souhaitez faire part de votre avis ?</p><p id="fin"> Connectez-vous</p>

                </div>
                <form id="formConnexion" action="detail-offre.php?value=<?php echo $offre['ido']?>" method="post">

                    <div class="form-group">
                        <!--Identifiant correspond au pseudo ou codePro, pas à l'idC-->
                        <label for="identifiant">Identifiant compte</label>
                        <input id="identifiant" name="identifiant" placeholder="Identifiant" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                    </div>

                    <input type="hidden" id="etoile" name="etoile">
                    <input type="hidden" id="titreAvis" name="titreAvis">
                    <input type="hidden" id="contenuAvis" name="contenuAvis">
                    <input type="hidden" id="contextAvis" name="contextAvis">

                    <button type="submit" id="connexion_popup" class="submit-button">Se connecter</button>

                    <div class="links">
                        <!--<a href="#" class="mdpOublie">Mot de passe oublié ?</a>-->
                        <a href="creation_compte_formulaire.php" class="inscription">S'inscrire</a>
                    </div>

                </form>
            </div>
            <img id="croix" src="../images/croix.png" alt="" class="close-popup">
        </div>
    <?php } ?>
    <footer class="phone-element">
        <?php include_once 'footerNav.php'; ?>
    </footer>
    </div>
    <footer>
        <?php include_once 'footer.php'; ?>
    </footer>
        
    <script src="../js/detail_offre.js"></script>
</body>

</html>
