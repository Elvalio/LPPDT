<?php
require '../vendor/autoload.php'; // Inclure l'autoloader de Composer
use Dompdf\Dompdf;
use Dompdf\Options;

// Connexion à la base de données
include('../sql/connect_params.php'); // Ce fichier contient vos paramètres de connexion

// Vérifier si les paramètres GET sont présents
if (isset($_GET['ido'])) {
    try {
        // Connexion à la base de données
        $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $ido = filter_var($_GET['ido'], FILTER_VALIDATE_INT);
        $userID = filter_var($_COOKIE['user'], FILTER_VALIDATE_INT);

        if (!$ido || !$userID) {
            die("Paramètres manquants ou invalides.");
        }

        // Préparer les données nécessaires pour `facturation_template.php`
        // (À personnaliser en fonction des données nécessaires dans votre template)
        $stmt = $dbh->prepare("
            SELECT 
                f.nbrjours,
                f.numfacture AS numero_facture,
                f.date_facture AS date_emission,
                c.nom AS pro_nom,
                a.numero_voie || ' ' || a.voie AS pro_adresse,
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
                op.cout_ht AS total_options_ht,
                op.cout_ttc AS total_options_ttc,
                pact.nbSemaines(f.idO, f.numFacture) AS nbSemaines
            FROM pact.facturation f
            INNER JOIN pact.option_offre op ON f.idO = op.idO
            INNER JOIN pact.offre o ON f.idC = o.idC
            INNER JOIN pact._compte c ON o.idC = c.idC
            INNER JOIN pact._adresse a ON c.idAdresse = a.idAdresse
            INNER JOIN pact._type_offre t ON o.type = t.idT
            WHERE o.idO = :ido AND f.idC = :userId;
        ");
        $stmt->bindParam(':ido', $ido, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userID, PDO::PARAM_INT);
        $stmt->execute();
        $facture_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$facture_data) {
            throw new Exception("Aucune donnée trouvée pour l'offre ID: $ido");
        }

        // Calculs
        $jours_publication = $facture_data['nbrjours'];
        $abonnement_ht = $jours_publication * $facture_data['abonnement_ht_unitaire'];
        $abonnement_ttc = $jours_publication * $facture_data['abonnement_ttc_unitaire'];
        $total_ht = $abonnement_ht + $facture_data['total_options_ht'];
        $total_ttc = $abonnement_ttc + $facture_data['total_options_ttc'];
        
        // Capture du contenu de `facturation_template.php` dans $html
        ob_start();
        include('facturation_template.php'); // Assurez-vous que ce fichier utilise les données nécessaires
        $html = ob_get_clean();

        // Configurer Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Envoyer le fichier PDF au navigateur pour téléchargement
        $dompdf->stream("Facture_Offre_$ido.pdf", ["Attachment" => true]);
    } catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
    }
} else {
    die("Paramètre 'ido' manquant.");
}
?>

