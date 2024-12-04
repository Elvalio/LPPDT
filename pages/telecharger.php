<?php
require '../vendor/autoload.php'; // Inclure l'autoloader de Composer
use Dompdf\Dompdf;
use Dompdf\Options;

include('../sql/connect_params.php');

if (isset($_GET['numFacture']) && isset($_GET['userID'])) {
    try {
        $bdh = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);

        $numFacture = filter_var($_GET['numFacture'], FILTER_SANITIZE_STRING);
        $userID = filter_var($_GET['userID'], FILTER_VALIDATE_INT);

        // Vérification des factures et récupération des informations
        $stmt = $bdh->prepare("SELECT * FROM pact.facturation WHERE idC = :userId AND numFacture = :numFacture");
        $stmt->execute([':userId' => $userID, ':numFacture' => $numFacture]);
        $facture = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$facture) {
            die("Facture introuvable.");
        }

        // Générer le HTML pour le PDF
        $html = "
        <!DOCTYPE html>
        <html lang='fr'>
        <head>
            <meta charset='UTF-8'>
            <title>Facture - {$facture['numfacture']}</title>
        </head>
        <body>
            <h1>Facture - {$facture['numfacture']}</h1>
            <p>Date : {$facture['date_facture']}</p>
            <p>Total TTC : {$facture['prix_ttc']} €</p>
        </body>
        </html>";

        // Configuration Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $dompdf = new Dompdf($options);

        // Charger le contenu HTML
        $dompdf->loadHtml($html);

        // Configuration de la page
        $dompdf->setPaper('A4', 'portrait');

        // Rendu du PDF
        $dompdf->render();

        // Télécharger le PDF
        $dompdf->stream("facture_{$facture['numfacture']}.pdf", ["Attachment" => true]);
    } catch (PDOException $e) {
        echo "Erreur : " . htmlspecialchars($e->getMessage());
    }
} else {
    echo "Paramètres manquants.";
}
?>
