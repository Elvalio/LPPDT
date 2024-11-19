<?php
include_once 'nav.php';
include('../sql/connect_params.php');

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
    $stmtActivite = $bdh->prepare("SELECT a.*, o.* FROM pact.activite a INNER JOIN pact.offre o ON a.idO = o.ido WHERE o.ido = :idAnnonce");
    $stmtActivite->execute([':idAnnonce' => $idAnnonce]);
    $activite = $stmtActivite->fetchAll(PDO::FETCH_ASSOC);


    // Requête pour récupérer les images associées
    $stmtPhotos = $bdh->prepare("SELECT src_image FROM pact.photo_offre WHERE idO = :idAnnonce");
    $stmtPhotos->execute([':idAnnonce' => $idAnnonce]);
    $photos = $stmtPhotos->fetchAll(PDO::FETCH_ASSOC);

    // Requête pour récupérer les avis associés à l'offre
    $stmtAvis = $bdh->prepare("SELECT * FROM pact.avis WHERE ida = :idAnnonce");
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
    <title><?php echo htmlspecialchars($offre['titre'] ?? 'Détails de l\'offre'); ?></title>
    <link rel="stylesheet" href="../css/samStyles.css">
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <script src="../detail-offre.js" async></script>
</head>

<body class="main-content <?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'BO' : 'FO'; ?>">

    <section class="section-page part-annonce">
        <header>
            <h1 class="titre-rouge"><?php echo htmlspecialchars($offre['titre']); ?></h1>
            <h2 class="sous-titre">
                <?php echo htmlspecialchars($offre['ville']); ?> | 
                <?php echo htmlspecialchars($telephone); ?>
                <?php if (!empty($offre['duree'])) echo " | Durée : " . htmlspecialchars($offre['duree']); ?>
                <?php if (!empty($offre['age_min'])) echo " | Âge : " . htmlspecialchars($offre['age_min']) . " ans"; ?>
                <?php if (!empty($offre['prix_min'])) echo " | Prix : " . htmlspecialchars($offre['prix_min']) . " €"; ?>
                <?php echo htmlspecialchars($offre['gamme_prix'] ?? ''); ?>
            </h2>

            <!-- Carrousel -->
            <div class="container NoSelect">
                <div class="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($photos as $index => $photo): ?>
                            <div class="slide">
                                <img src="../images/<?php echo htmlspecialchars($photo['src_image']); ?>" alt="Image <?php echo $index + 1; ?>">
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
                <div class="etoiles">
                    <?php 
                    $nbrAvis = $offre['nbravis'] ?? 0;
                    $moyNote = $offre['moy_note'] ?? 0;
                    $fullStars = (int) $moyNote;
                    $emptyStars = 5 - $fullStars;

                    for ($i = 0; $i < $fullStars; $i++): ?>
                        <img src="../icons/<?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'etoile_rouge' : 'etoile_bleue'; ?>.png" alt="Étoile">
                    <?php endfor; ?>
                    <?php for ($i = 0; $i < $emptyStars; $i++): ?>
                        <img src="../icons/<?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'etoile_rouge_vide' : 'etoile_bleue_vide'; ?>.png" alt="Étoile Vide">
                    <?php endfor; ?>
                </div>
                <p class="nb-avis-info-offre"><?php echo $nbrAvis . " Avis |"; ?></p>
                <img src="../images/Wheelchair.png" alt="Accessibilité">
                <p><?php echo htmlspecialchars($offre['accessibilite']); ?></p>
            </div>
        </header>

        <!-- Description -->
        <article class="description-offre">
            <h3>Description :</h3>
            <p><?php echo nl2br(htmlspecialchars($offre['description'])); ?></p>
        </article>

        <!-- Bouton de retour -->
        <button class="bouton-retour NoSelect">
        <a href="./accueil.php">
            <img src="../icons/arrow-left-o.svg" alt="Retour">
            Retour
        </a>
    </button>
    </section>

    <!-- Avis -->
    <section class="section-page part-avis">
        <header class="header-avis">
            <h3>Avis : <?php echo $nbrAvis; ?></h3>
        </header>
        <article class="article-avis">
            <?php foreach ($avis as $avisIndividuel): ?>
                <div class="infos-offre">
                    <div class="etoiles">
                        <?php 
                        $i;
                        if ($stmt[0]['nbravis'] > 0) {
                            for ($i = 0; $i < $stmt[0]['moy_note']; $i++) { 
                                if ($_COOKIE['type_compte'] == "pro_public" || $_COOKIE['type_compte'] == "pro_prive") { ?>
                                    <img class="NoSelect" src="../icons/etoile_rouge.png" alt="Etoile">
                                <?php } 
                             
                                else { ?>
                                    <img class="NoSelect" src="../icons/etoile_bleue.png" alt="Etoile">
                                <?php } 
                            }
                            foreach (range($i, 4) as $j) { 
                                if ($_COOKIE['type_compte'] == "pro_public" || $_COOKIE['type_compte'] == "pro_prive") { ?>
                                    <img class="NoSelect" src="../icons/etoile_rouge_vide.png" alt="Etoile Vide">
                                <?php } 
                                
                                else { ?>
                                    <img class="NoSelect" src="../icons/etoile_bleue_vide.png" alt="Etoile Vide">
                                <?php } 
                            }
                        }
                        
                    ?>
                    </div>
                    <p class="nb-avis-info-offre">
                        <?php 
                    if ($stmt[0]['nbravis'] == 0) {
                        echo "0" ." " . "Avis" . " " . "|";
                    }
                    else {
                        echo $stmt[0]['nbravis'];
                        echo " " . "Avis" . " |";
                    }
                    ?>
                    </p>
                    <img src="../images/Wheelchair.png" alt="fauteil roulant">
                    <p>
                        <?php 
                        echo $stmt[0]['accessibilite'];
                    ?>
                    </p>
                </div>
            </header>
            <article class="description-offre">
                <h3>Description :</h3>
                <p>
                    <?php 
                    echo $stmt[0]['description'];
                ?>
                </p>
            </article>
            <article class="part-contact">
                <div class="side-contact">
                    <div>
                        <h3>Contact :</h3>
                        <div>
                            <?php 
                        $address = $stmt[0]['numero_voie'] . $stmt[0]['voie'] . $stmt[0]['ville'] . $stmt[0]['code_postal'];
                        ?>
                            <a href="https://www.google.com/maps/dir// <?php echo $address ?>">
                                <img src="../images/maison.png" alt="icon maison (localisation)">
                                <p>
                                    <?php
                                echo $stmt[0]['numero_voie'];
                                echo " ";
                                echo $stmt[0]['voie'];
                                echo " ";
                                echo $stmt[0]['ville'];
                                echo " ";
                                echo $stmt[0]['code_postal'];

                            ?>
                                </p>
                            </a>
                        </div>
                        <div>
                            <a href="tel:<?php 
                    $idC = (int)$stmt[0]['idc'];
                    $stmt2 = $bdh->prepare(" SELECT telephone FROM pact.professionnel p INNER JOIN pact.offre o ON
                                p.idC=o.idC WHERE o.idC=$idC;"); $stmt2->execute();
                                $stmt2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                                echo $stmt2[0]['telephone'];
                                ?> ">
                                <img src="../images/telephone.png" alt="icon telephone">
                                <p>
                                    <?php 
                    $idC = (int)$stmt[0]['idc'];
                    $stmt2 = $bdh->prepare("SELECT telephone FROM pact.professionnel p INNER JOIN pact.offre o ON p.idC = o.idC WHERE o.idC = $idC;");
                    $stmt2->execute();
                    $stmt2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    echo $stmt2[0]['telephone'];
                ?>
                                </p>
                            </a>
                        </div>

                        <?php
                        if ($stmt[0]['site_web']) { ?>
                        <div>
                            <a href=" <?php echo $stmt[0]['site_web']; ?>">
                                <img src="../images/pc.png" alt="icon pc (lien vers le site)">
                                <p>
                                    <?php
                            echo $stmt[0]['site_web']; ?>
                                </p>
                            </a>
                        </div>
                    </div>
                    <?php

                        } else { ?>
                </div>
                <?php
                        }
                    ?>
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
                </div>
                <?php 
                    if ($stmt[0]['carte']) { ?>
                <div>
                    <img class="carte" src="../images/ <?php $stmt[0]['carte'] ?>" alt="carte géolocalisation">
                </div>
                <?php
                    } elseif ($stmt[0]['src_image']) { ?>
                <div>
                    <img class="carte" src="../images/ <?php $stmt[0]['src_image'] ?>" alt="carte">
                </div>
                <?php
                    }
                    else { ?>
                </div>
                <?php
                    }
                ?>

            </article>
            <button class="bouton-retour NoSelect">
                <a href="./accueil.php">

                    <img class="NoSelect" src="../icons/arrow-left-o.svg" alt="">
                    Retour
                </a>

            </button>
        </section>
        <section class="section-page part-avis">
            <header class="header-avis">
                <h3>Avis :
                    <?php 
                    if ($stmt[0]['nbravis'] == 0) {
                        echo "0" . " " . "Avis";
                    }
                    else {
                        echo $stmt[0]['nbravis'];
                        echo " " . "Avis";
                    }
                    ?>
                </h3>
                <?php 
                    $stmt3 = $bdh->prepare("SELECT * FROM pact.avis WHERE ido = $idAnnonce;");
                    $stmt3->execute();
                    $stmt3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($stmt3 as $avis) {
                        if ($avis['consulte'] == False) {
                            $nonConsultes++;
                        }
                        if ($avis['consulte'] == False) {
                            $nonRepondus++;
                        }
                    }
                    if ( $nonConsultes > 0) { ?>
                <h3>Non Consultés :
                    <?php echo $nonConsultes; ?>
                </h3>

                <?php }
                    $nonRepondus = 0;
                    $nonRepondus++;
                    if ($nonRepondus > 0) { ?>
                <h3>Non répondus :
                    <?php echo $nonRepondus;?>
                </h3>;
                <?php }
                    ?>
            </header>
            <article class="article-avis">
                <?php 
                $stmt = $bdh->prepare("SELECT * FROM pact.avis WHERE ido = $idAnnonce;");
                $stmt->execute();
                $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($stmt as $key => $avis) { ?>
                <div>
                    <div class="header-avis-profil">
                        <div class="profil">
                            <img src="../images/image4.png" alt="Photo de profil" width="40" height="40">
                            <p><?php echo htmlspecialchars($avisIndividuel['nom']); ?></p>
                            <img src="../images/image 4.png" alt="photo de profil" width="40px" height="40px">
                            <p>
                                <?php
                    echo $avis['titre']; ?>
                            </p>
                        </div>
                        <div>
                            <p><?php echo htmlspecialchars($avisIndividuel['note']); ?></p>
                        </div>
                    </div>
                    <div class="commentaire-consulte">
                        <p><?php echo nl2br(htmlspecialchars($avisIndividuel['commentaire'])); ?></p>
                        <p>
                            <?php
                    echo $avis['corps']; ?>
                        </p>
                    </div>
                    <div>
                        <p class="reponse">Ajouter une réponse</p>
                    </div>
                </div>
            <?php endforeach; ?>
        </article>
    </section>

</body>
</html>
