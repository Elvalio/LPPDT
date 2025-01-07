<?php
include('../sql/connect_params.php');

if($_SERVER['REQUEST_METHOD']==='POST'){


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

    }catch(PDOException $e){
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
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
    $stmtAvis = $bdh->prepare("SELECT * FROM pact.experience WHERE idO = :idAnnonce");
    $stmtAvis->execute([':idAnnonce' => $idAnnonce]);
    $avis = $stmtAvis->fetchAll(PDO::FETCH_ASSOC);

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
    <script src="../detail-offre.js" async></script>
</head>

<div class="desktop-element">
<?php include_once 'nav.php';?>
</div>

<body
    class="main-content <?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'BO' : 'FO'; ?>">
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
                        <?php echo $nbrAvis . " Avis |"; ?>
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
                        <input type="hidden" id="nbr_etoile" name="nbr_etoile" value="1">
                        <textarea maxlength="50" type="text" name="titre_avis" id="titre_avis" placeholder="Titre de l'avis"
                            required="required"></textarea>
                        <textarea minlength="50" maxlength="750" type="text" name="zone_avis" id="ecrire_avis"
                            placeholder="Veuillez écrire dans cette zone pour pouvoir déposer un avis sur cette offre."></textarea>
                        <!--<input type="file" accept=".png, .jpeg, .svg, .webp" id="image_avis" name="image_avis">-->
                        <label for="options" id="titre-contexte">Contexte de la visite :</label>
                        <select id="options-contexte" name="options">
                            <option value="Affaires">Affaires</option>
                            <option value="Couple">Couple</option>
                            <option value="Famille">Famille</option>
                            <option value="Amis">Amis</option>
                            <option value="Seul">Seul</option>
                        </select>
                        <input type="submit" id="bouton_publier" value="Publier">
                        </form>
                <?php }
                }else{ ?>
                <h3>Poster un avis :</h3>
                <div class="notes_avis">
                    <?php for($i = 1; $i<6; $i++):?>
                        <img src="../icons/etoile_bleue_vide.png" width="35px" height="35px"
                            id="etoile_note<?php echo $i?>">
                    <?php endfor;?>
                </div>
                <input type="hidden" id="nbr_etoile" name="nbr_etoile" value="1">
                <textarea maxlength="30" type="text" name="titre_avis" id="titre_avis" placeholder="Titre de l'avis"
                    required="required"></textarea>
                <textarea minlength="30" maxlength="255" type="text" name="zone_avis" id="ecrire_avis"
                    placeholder="Veuillez écrire dans cette zone pour pouvoir déposer un avis sur cette offre."></textarea>
                <!--<input type="file" accept=".png, .jpeg, .svg, .webp" id="image_avis" name="image_avis">-->
                <label for="options" id="titre-contexte">Contexte de la visite :</label>
                    <select id="options-contexte" name="options">
                        <option value="Affaires">Affaires</option>
                        <option value="Couple">Couple</option>
                        <option value="Famille">Famille</option>
                        <option value="Amis">Amis</option>
                        <option value="Seul">Seul</option>
                    </select>
                <form method="POST" action="connexion.php" class="zone-btn-publier">
                    <input type="submit" id="bouton_publier" value="Publier">
                </form>
                <?php } ?>
            </article>
            <?php   } ?>
            <?php if ($nbrAvis > 0){ foreach ($avis as $avisIndividuel): 
                
                $stmtCompte = $bdh->prepare("SELECT * FROM pact.membre WHERE idC = :idC");
                $stmtCompte->execute([':idC' => $avisIndividuel['idc']]);
                $compte = $stmtCompte->fetch(PDO::FETCH_ASSOC);                
                ?>
            <div class="alignement-conteneur-avis">
                <div class="header-avis-profil">
                    <div class="profil">
                        <img src="../images/1 2.png" alt="Photo de profil" width="40px" height="40px">
                        <div>
                            <div class="titre-date">
                                <h4>
                                    <?php echo htmlspecialchars($avisIndividuel['titre_avis']); ?>
                                </h4>
                                <p><?php echo htmlspecialchars($avisIndividuel['date_visite']); ?></p>
                            </div>
                            <div class="pseudo-contexte">
                                <p><?php echo htmlspecialchars($avisIndividuel['pseudo']); ?></p>
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
                <div class="commentaire-consulte">
                    <p>
                        <?php echo nl2br(htmlspecialchars($avisIndividuel['corps'])); ?>
                    </p>
                </div>
            </div>
            <?php endforeach; }?>
            <!-- Ensure this is properly placed -->
        </article>
    </section>
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
