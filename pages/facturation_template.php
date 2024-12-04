<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture N°<?= htmlspecialchars($facture_data['numero_facture']) ?></title>
     <style>
        <?php include_once("../css/creationFacturation.css"); 
        include_once("../css/styleGeneral.css");?>
    </style>
</head>
<body class="BO">
    <header>
        <img src="../logo/logo_rouge.png" alt="PACT" id="logo">
        <div class="titre">
            <h1>Facture N°<?= htmlspecialchars($facture_data['numero_facture']) ?></h1>
            <p>Date d’émission : <?= date('d/m/Y', strtotime($facture_data['date_emission'])) ?></p>
        </div>
    </header>

    <div class="E-D">
        <!-- Informations des parties -->
        <div class="Emetteur"> 
            <h2>Émetteur : PACT</h2>
            <p>Plateforme</p>
            <p>1 Place du Chai</p>
            <p>22000 Saint-Brieuc</p>
            <p>Email : PACT-TripEnArvor@proton.me</p>
        </div>
        <div class="Destinataire">
            <h2>Destinataire : <?= htmlspecialchars($facture_data['pro_nom']) ?></h2>
            <p><?= htmlspecialchars($facture_data['pro_adresse']) ?></p>
            <p><?= htmlspecialchars($facture_data['pro_code_postal']) ?> <?= htmlspecialchars($facture_data['pro_ville']) ?></p>
            <p>Téléphone : <?= htmlspecialchars($facture_data['pro_telephone']) ?></p>
            <p>Email : <?= htmlspecialchars($facture_data['pro_email']) ?></p>
        </div>    
    </div>

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
                <td>Abonnement <?= htmlspecialchars($facture_data['abonnement_type']) ?></td>
                <td><?= htmlspecialchars($facture_data['nbrjours']); if ($facture_data['nbrjours'] == 1) {echo " jour";} else {echo " jours";} ?></td>
                <td><?= number_format($facture_data['abonnement_ht_unitaire'], 2, ',', ' ') ?> €</td>
                <td><?= number_format($abonnement_ht, 2, ',', ' ') ?> €</td>
                <td><?= number_format($abonnement_ttc, 2, ',', ' ') ?> €</td>
            </tr>
            <?php if (isset($facture_data['options'])) ?>
                <tr>
                    <td>Option « <?= htmlspecialchars($facture_data['options']) ?> »</td>
                    <td><?= htmlspecialchars($option['date_creation']) ?> au <?= date('d/m/Y') ?></td>
                    <td><?= number_format($option['ht'], 2, ',', ' ') ?> €</td>
                    <td><?= number_format($option['ht'], 2, ',', ' ') ?> €</td>
                    <td><?= number_format($option['ttc'], 2, ',', ' ') ?> €</td>
                </tr>
            
        </tbody>
        <tfoot>
            <tr class="total">
                <td colspan="3">Total</td>
                <td><?= number_format($total_ht, 2, ',', ' ') ?> €</td>
                <td><?= number_format($total_ttc, 2, ',', ' ') ?> €</td>
            </tr>
        </tfoot>
    </table>

    <footer>
        <p>Merci pour votre confiance.</p>
    </footer>
</body>
</html>
