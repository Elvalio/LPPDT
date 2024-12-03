<?php

// Connexion à la base de données
include('../sql/connect_params.php'); // Ce fichier contient vos paramètres de connexion (host, dbname, user, pass)

try {
    
    $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname",
        $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ID de l'offre à rechercher

    $idOffre = $_GET["Offre"];

    // Requête pour récupérer les données
    $sql = "
        SELECT 
            f.numfacture AS numero_facture,
            f.date_facture AS date_emission,
            c.nom AS pro_nom,
            a.voie || ' ' || a.numero_voie AS pro_adresse,
            a.code_postal AS pro_code_postal,
            a.ville AS pro_ville,
            c.telephone AS pro_telephone,
            c.email AS pro_email,
            EXTRACT(DAY FROM AGE(o.date_hors_ligne, o.date_publication)) AS jours_publication,
            t.nom_type AS abonnement_type,
            o.option AS options,
            o.titre AS titre_offre,
            t.cout_HT AS abonnement_ht_unitaire,
            t.cout_TTC AS abonnement_ttc_unitaire,
            pact.prix_option_offre_HT(o.idO, f.numfacture) AS total_options_ht,
            pact.prix_option_offre_TTC(o.idO, f.numfacture) AS total_options_ttc
        FROM pact.facturation f
        INNER JOIN pact.offre o ON f.idC = o.idC
        INNER JOIN pact._compte c ON o.idC = c.idC
        INNER JOIN pact._adresse a ON c.idAdresse = a.idAdresse
        INNER JOIN pact._type_offre t ON o.type = t.idT
        WHERE o.idO = :idOffre;

    ";

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':idOffre', $idOffre, PDO::PARAM_INT);
    $stmt->execute();
    $facture_data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$facture_data) {
        throw new Exception("Aucune donnée trouvée pour l'offre ID: $idOffre");
    }

    // Calculs
    $jours_publication = $facture_data['jours_publication'];
    $abonnement_type = $facture_data['abonnement_type'];
    $abonnement_ht_unitaire = $facture_data['abonnement_ht_unitaire'];
    $abonnement_ttc_unitaire = $facture_data['abonnement_ttc_unitaire'];

    $abonnement_ht = $jours_publication * $abonnement_ht_unitaire;
    $abonnement_ttc = $jours_publication * $abonnement_ttc_unitaire;

    // Options (simule les données en fonction des constantes définies)
    $options = [];
    $total_option_ht = $facture_data['total_options_ht'];
    $total_option_ttc = $facture_data['total_options_ttc'];

    // Totaux
    $total_ht = $abonnement_ht + $total_option_ht;
    $total_ttc = $abonnement_ttc + $total_option_ttc;

} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        table th, table td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        .header, .footer { text-align: center; }
        .total { font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Facture N°<?= $facture_data['numero_facture'] ?></h1>
        <p>Date d’émission : <?= date('d/m/Y', strtotime($facture_data['date_emission'])) ?></p>
    </div>

    <!-- Informations des parties -->
    <h2>Émetteur : PACT</h2>
    <p>
        Plateforme<br>
        1 Place du Chai<br>
        22000 Saint-Brieuc<br>
        Email : PACT-TripEnArmor@proton.me
    </p>

    <h2>Destinataire : <?= $facture_data['pro_nom'] ?></h2>
    <p>
        <?= $facture_data['pro_adresse'] ?><br>
        <?= $facture_data['pro_code_postal'] ?> <?= $facture_data['pro_ville'] ?><br>
        Téléphone : <?= $facture_data['pro_telephone'] ?><br>
        Email : <?= $facture_data['pro_email'] ?>
    </p>

    <!-- Détails de la facture -->
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Quantité</th>
                <th>Prix unitaire HT</th>
                <th>Total HT</th>
                <th>Total TTC</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Abonnement <?= $abonnement_type ?></td>
                <td><?= $jours_publication ?> jours</td>
                <td><?= number_format($abonnement_ht_unitaire, 2, ',', ' ') ?> €</td>
                <td><?= number_format($abonnement_ht, 2, ',', ' ') ?> €</td>
                <td><?= number_format($abonnement_ttc, 2, ',', ' ') ?> €</td>
            </tr>
            <?php foreach ($options as $option): ?>
                <tr>
                    <td>Option « <?= $option['nom'] ?> »</td>
                    <td><?= $option['date_creation'] ?> au <?= date('d/m/Y') ?></td>
                    <td><?= number_format($option['ht'], 2, ',', ' ') ?> €</td>
                    <td><?= number_format($option['ht'], 2, ',', ' ') ?> €</td>
                    <td><?= number_format($option['ttc'], 2, ',', ' ') ?> €</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="total">
                <td colspan="3">Total</td>
                <td><?= number_format($total_ht, 2, ',', ' ') ?> €</td>
                <td><?= number_format($total_ttc, 2, ',', ' ') ?> €</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Merci pour votre confiance.</p>
    </div>
</body>
</html>
