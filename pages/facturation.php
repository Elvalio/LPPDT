<?php
include('../sql/connect_params.php');
try {
    $bdh = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);
    $userID = filter_var($_COOKIE['user'], FILTER_VALIDATE_INT);

    if (!$userID) {
        die("Invalid user ID.");
    }

    $stmt = $bdh->prepare("SELECT * FROM pact.facturation WHERE idC = :userId");
    $stmt->execute([':userId' => $userID]);
    $factures = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$factures) {
        die("Vous n'avez aucune facture.");
    }

} catch (PDOException $e) {
    echo "Erreur : " . htmlspecialchars($e->getMessage());
    die();
}

function offre($numFacture, $userID, $bdh){
    $stmt = $bdh->prepare("SELECT o.*, pact.prix_offre_HT(:userID, o.idO, now()::date), pact.prix_offre_TTC(:userID, o.idO, now()::date) from pact.offre o inner join pact._facturation f on f.idC = o.idC where o.idC = :userID and f.numFacture = :numFacture and 
    EXTRACT(MONTH FROM f.date_facture) = EXTRACT(MONTH FROM o.date_publication)
    and EXTRACT(YEAR FROM f.date_facture) = EXTRACT(YEAR FROM o.date_publication);");
    $stmt->execute([':userID' => $userID, ':numFacture' => $numFacture]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function image($idOffre, $bdh) {
    $stmtPhotos = $bdh->prepare("SELECT src_image FROM pact.photo_offre WHERE idO = :idOffre");
    $stmtPhotos->execute([':idOffre' => $idOffre]);
    $photos = $stmtPhotos->fetchAll(PDO::FETCH_ASSOC);
    return $photos[0]['src_image'] ?? ''; // Assurez-vous que la clé existe
}

function PrixOptionTTC($idOffre, $bdh) {
    try {
        // Préparez et exécutez la requête
        $stmtPrixOption = $bdh->prepare("SELECT pact.prix_option_offre_TTC(:idOffre) AS prix_option_ttc");
        $stmtPrixOption->execute([':idOffre' => $idOffre]);

        // Récupérez le résultat
        $Prix = $stmtPrixOption->fetch(PDO::FETCH_ASSOC);

        // Retournez la valeur ou une valeur par défaut si rien n'est trouvé
        return $Prix['prix_option_ttc'] ?? 0;
    } catch (PDOException $e) {
        // Gérez les erreurs
        echo "Erreur lors de la récupération du prix des options : " . htmlspecialchars($e->getMessage());
        return 0;
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/samStyles.css">
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <title>Facturation</title>

</head>

<body class="BO">
    <div>
        <?php include_once 'nav.php' ?>
    </div>
    <div class="main-content">
    <header>
        <h1 class="titre-rouge">Facturation</h1>
        <p class="facture-tri">Plus recent</p>
    </header>
    <div>
        <?php foreach ($factures as $facture) { ?>
        <article class="facture-composant-liste">
            
                <div class="facture-liste-facture">
                
                    <div>
                        <p>Date :</p>
                        <p><?php echo htmlspecialchars($facture['date_facture']); ?></p>
                    </div>
                    <div>
                        <p>Numéro de facture :</p>
                        <p><?php echo htmlspecialchars($facture['numfacture']); ?></p>
                    </div>
                    <div>
                        <p>Total à payer :</p>
                        <p><?php echo htmlspecialchars($facture['prix_ttc']); ?>€/TTC</p>
                    </div>
                    <div>
                        <p>Nombre d'offres :</p>
                        <p><?php echo htmlspecialchars($facture['nombre_offre']); ?></p>
                    </div>
                    <button class="telecharger">Télécharger</button>
                    <button class="voir-plus" aria-expanded="false">Voir plus +</button>
                </div>
                
                <div class="facture-details">
                <?php foreach (offre($facture['numfacture'], $userID, $bdh) as $offre) { ?>
                    <div class="facture-offre">
                        <img src="../images/<?php echo image($offre['ido'], $bdh) ?>" alt="">
                        <p class="facture-detail-titre"><?php echo htmlspecialchars($offre['titre']) ?></p>
                        <p class="facture-detail-option"><?php if (!empty($offre['option'])) {
                                        echo htmlspecialchars($offre['option']);
                                    } else {
                                echo "Pas d'option";
                                    }
                          ?></p>
                          <div class="facture-total">
                        <p>Prix HT : <?php echo round($offre['prix_offre_ht'],2) ?>€</p>
                    <p>TVA : <?php echo round($offre['prix_offre_ttc'] - $offre['prix_offre_ht'],2) ?>€</p>
                    <p>Montant TTC : <?php echo round($offre['prix_offre_ttc'],2) ?>€</p>   
                    </div>

                    </div>
                    
                        
                    <?php } ?>
                </div>
            
        </article> 
        <?php } ?>
    </div>
</div>

    <script>
    // Sélectionner tous les boutons "Voir plus"
    const buttons = document.querySelectorAll('.voir-plus');

    // Ajouter un gestionnaire d'événement pour chaque bouton
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            // Trouver la section des détails correspondante
            const details = button.parentElement.nextElementSibling;

            // Basculer la classe active
            details.classList.toggle('active');

            // Mettre à jour le texte du bouton en fonction de l'état actif
            const isActive = details.classList.contains('active');
            button.textContent = isActive ? 'Voir moins -' : 'Voir plus +';

            // Mettre à jour l'attribut ARIA pour l'accessibilité
            button.setAttribute('aria-expanded', isActive);
        });
    });
    </script>
</body>

</html>