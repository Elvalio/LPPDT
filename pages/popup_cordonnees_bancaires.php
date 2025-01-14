<?php
// Connexion à la base de données
include("../sql/connect_params.php");

try {
    $pdo = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}



////////////////////////////////////////////////////////////////////////////
/////////// A PARTIR D'ICI CODE A METTRE DANS LA PARTIE DE LISA ////////////
////////////////////////////////////////////////////////////////////////////


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
    <title>Test Popup</title>
    <link rel="stylesheet" href="../css/popup.css" type="text/css">
    <script>
        // Cette fonction sera appelée lors du clic sur le bouton
        function showPopup() {
            alert("Popup fonctionne !");
        }

        // Vérification de l'IBAN et BIC avant la soumission du formulaire
        function checkBankDetails() {
            var ibanBicIncomplets = true;  // Modifiez selon votre logique
            var typeCompte = 'pro_prive';  // Modifiez selon votre logique
            

            console.log("iban_bic_incomplets : " + ibanBicIncomplets); // Vérifiez la valeur
            console.log("type_compte : " + typeCompte); // Vérifiez la valeur

            // Si le type de compte est 'pro_prive' et que l'IBAN/BIC sont incomplets
            if (typeCompte === 'pro_prive' && ibanBicIncomplets) {
                alert("Veuillez remplir vos coordonnées bancaires (IBAN et BIC) pour valider les informations.");
                return false; // Empêche la soumission du formulaire
            }
            return true; // Autorise la soumission du formulaire
        }
    </script>
</head>
<body>

    <!-- Bouton de test pour vérifier que le popup fonctionne -->
    <button onclick="showPopup()">Test Popup</button>

    <!-- Formulaire avec une vérification JS avant la soumission -->
    <form method="POST" action="" onsubmit="return checkBankDetails()">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" required><br>

        <input type="submit" value="Envoyer">
    </form>

</body>
</html>
