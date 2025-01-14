<?php
// Connexion à la base de données
include("../sql/connect_params.php");

try {
    $pdo = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$iban_bic_incomplets = false;

// Vérification si le type de compte est 'pro_prive'
if (isset($_COOKIE['type_compte']) && $_COOKIE['type_compte'] === 'pro_prive') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_COOKIE['user'])) {
            die("Erreur : ID du compte introuvable dans les cookies.");
        }
        
        $idc = $_COOKIE['user'];

        // Requête pour vérifier si l'IBAN et le BIC existent pour l'idC donné et ne sont pas null
        $query = "SELECT iban, bic FROM pact._secteur_prive WHERE idC = :idC AND iban IS NOT NULL AND bic IS NOT NULL";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':idC', $idc, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            $iban_bic_incomplets = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Simple</title>
    <link rel="stylesheet" href="../css/popup.css" type="text/css">
</head>
<body>

    <button onclick="togglePopup()">Activer le popup</button>

    <div id="popup-overlay" <?php if (!$iban_bic_incomplets) echo 'style="display:none;"'; ?>>
        <div class="popup-content">
            <h2>Veuillez remplir vos coordonnées bancaires (IBAN et BIC) avant de mettre en ligne votre offre.</h2>
            <a href="infoCompte.php" class="popup-link">Modifier mes infos</a>
            <a href="javascript:void(0)" onclick="togglePopup()" class="popup-exit">Fermer</a>
        </div>
    </div>

    <script src="../js/popup.js"></script>

</body>
</html>
