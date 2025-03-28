<?php ini_set('display_errors', 1);
error_reporting(E_ALL); 
error_reporting(0); 
include("../sql/connect_params.php");

try{
    $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);
    if($_COOKIE['type_compte'] == "membre") {

        $stmt = $dbh->prepare("SELECT * FROM pact.membre WHERE idC = :idc");
        $stmt->bindParam(':idc', $_COOKIE['user']);
        $stmt->execute();
            
        $compte = $stmt->fetch(PDO::FETCH_ASSOC);
    }else if($_COOKIE['type_compte'] == "pro_public"){
        $stmt = $dbh->prepare("SELECT * FROM pact.secteur_public WHERE idC = :idc");
        $stmt->bindParam(':idc', $_COOKIE['user']);
        $stmt->execute();

        $compte = $stmt->fetch(PDO::FETCH_ASSOC);
    }else{
        $stmt = $dbh->prepare("SELECT * FROM pact.secteur_prive WHERE idC = :idc");
        $stmt->bindParam(':idc', $_COOKIE['user']);
        $stmt->execute();

        $compte = $stmt->fetch(PDO::FETCH_ASSOC);
    }

}catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
    $dbh = null;
    ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code create</title>
    <link rel="stylesheet" href="../css/styleGeneral.css">
<?php 
    if(isset($_COOKIE['type_compte'])){
        if ($_COOKIE['type_compte'] == "pro_public" || $_COOKIE['type_compte'] == "pro_prive") { ?>
            <link id="dynamic-favicon" rel="icon" type="image/x-icon" href="../logo/rouge.ico"> <?php   
        }  else { ?>
            <link id="dynamic-favicon" rel="icon" type="image/x-icon" href="../logo/bleu.ico"> <?php
        }
    } else { ?>
        <link id="dynamic-favicon" rel="icon" type="image/x-icon" href="../logo/bleu.ico"> <?php
    }?>
</head>

<div class="desktop-element">
    <?php
    include_once'nav.php';
    ?>
</div>

<body class = "<?php if($_COOKIE['type_compte'] == "membre"){echo "FO";}else{echo "BO";}?> auth">
    <section>
        <h1 class="TS-bold">QR CODE</h1>
        <article>
            <?php
                require (__DIR__. '/../vendor/autoload.php');

                use OTPHP\TOTP;

                //$clock = new MyClock(); // Your own implementation of a PSR-20 Clock

                // A random secret will be generated from this.
                // You should store the secret with the user for verification.
                $otp = TOTP::generate();
                //echo "The OTP secret is: {$otp->getSecret()}\n";

                // Note: use your own way to load the user secret.
                // The function "load_user_secret" is simply a placeholder.
                //  $secret = load_user_secret();
                $secret = $otp->getSecret(); //should get it from database or create if not set

                $otp = TOTP::createFromSecret($secret);

                //echo "The current OTP is: {$otp->now()}\n";

                $totp = TOTP::createFromSecret($secret); // New TOTP
                $totp->setLabel($compte["email"]); // The label (string)

                $goqr_me = $totp->getQrCodeUri(
                    'https://api.qrserver.com/v1/create-qr-code/?color=000000&bgcolor=FFFFFF&data=[DATA]&qzone=2&margin=0&size=300x300&ecc=M',
                    '[DATA]'
                );
                echo "<img src='{$goqr_me}'>";

                //echo 'Current OTP: ' . $totp->now();

                
                $stmt = $dbh -> prepare("UPDATE pact._compte SET secretOtp = :secretOtp WHERE idC = :idC");

                $stmt -> bindParam(':secretOtp', $secret);
                $stmt -> bindParam(':idC', $_COOKIE['user']);
                $stmt ->execute();

                $dbh = null;
                ?>
        </article>
        <article>
                <button><a href="infoCompte.php" >RETOUR</a></button>
            
                <div class="smallPopup" id="copyDiv">
                    <button id="copy_secret" value="<?php echo $secret?>">Copier code</button>
                    <span class="smallPopupText" id="copyPopup">Code copié dans le presse papier</span>
                </div>
                
        </article>
    </section>
    
<script src="../js/codeCreate.js"></script>
</body>

<?php include_once'footerNav.php' ?>
</html>
