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
                    $nbrAvis = $offre['nbravis'];
                    $moyNote = $offre['moy_note'];
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

        <article class="part-contact">
                <div class="side-contact">
                    <div>
                        <h3>Contact :</h3>
                        <div>
                            <?php 
                        $address = $offre['numero_voie'] . $offre['voie'] . $offre['ville'] . $offre['code_postal'];
                        ?>
                            <a href="https://www.google.com/maps/dir// <?php echo $address ?>">
                                <img src="../images/maison.png" alt="icon maison (localisation)">
                                <p>
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
                        <div>
                            <a href="tel:<?php 
                            echo htmlspecialchars($telephone);
                                ?> ">
                                <img src="../images/telephone.png" alt="icon telephone">
                                <p>
                                    <?php 
                                        echo htmlspecialchars($telephone);
                                    ?>
                                </p>
                            </a>
                        </div>

                        <?php
                        if (!empty($offre['site_web'])) { ?>
                        <div>
                            <a href=" <?php echo $offre['site_web']; ?>">
                                <img src="../images/pc.png" alt="icon pc (lien vers le site)">
                                <p>
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
                </div>
                <?php 
                    if (!empty($offre['carte'])) { ?>
                <div>
                    <img class="carte" src="../images/ <?php $offre['carte'] ?>" alt="carte géolocalisation">
                </div>
                <?php
                    } elseif (!empty($offre['src_image'])) { ?>
                <div>
                    <img class="carte" src="../images/ <?php $offre['src_image'] ?>" alt="carte">
                </div>
                <?php
                    }
                ?>
                </div>

            </article>
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
        
        <?php if ($nbrAvis > 0){ foreach ($avis as $avisIndividuel): ?>
            <div>
                <div class="header-avis-profil">
                    <div class="profil">
                        <img src="../images/image4.png" alt="Photo de profil" width="40" height="40">
                        <p><?php echo htmlspecialchars($avisIndividuel['titre_avis']); ?></p>
                    </div>
                    <div class = "etoile-avis-detail-offre">
                        <?php
                        $full = (int) $avisIndividuel['note'];
                        $empty = 5 - $full;
    
                        for ($i = 0; $i < $fullStars; $i++): ?>
                            <img src="../icons/<?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'etoile_rouge' : 'etoile_bleue'; ?>.png" width="20px" height="20px" alt="Étoile">
                        <?php endfor; ?>
                        <?php for ($i = 0; $i < $emptyStars; $i++): ?>
                            <img src="../icons/<?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'etoile_rouge_vide' : 'etoile_bleue_vide'; ?>.png" width="20px" height="20px" alt="Étoile Vide">
                        <?php endfor;
                        ?>
                    </div>
                </div>
                <div class="commentaire-consulte">
                    <p><?php echo nl2br(htmlspecialchars($avisIndividuel['corps'])); ?></p>
                </div>
            </div>
        <?php endforeach; }?> <!-- Ensure this is properly placed -->

        </article>
    </section>
    
</body>
</html>