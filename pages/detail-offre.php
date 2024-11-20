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
                <div>
                    <div class="header-avis-profil">
                        <div class="profil">
                            <img src="../images/image4.png" alt="Photo de profil" width="40" height="40">
                            <p><?php echo htmlspecialchars($avisIndividuel['nom']); ?></p>
                        </div>
                        <div>
                            <p><?php echo htmlspecialchars($avisIndividuel['note']); ?></p>
                        </div>
                    </div>
                    <div class="commentaire-consulte">
                        <p><?php echo nl2br(htmlspecialchars($avisIndividuel['commentaire'])); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </article>
    </section>
    
</body>
</html>