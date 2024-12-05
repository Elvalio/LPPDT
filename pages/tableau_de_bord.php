<!DOCTYPE html>
<html lang="fr">
    <?php
    include_once'nav.php';


    include('../sql/connect_params.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        if (isset($_POST['offre_id']) && isset($_POST['status'])) {
            
            try{
            $dbh = new PDO("$driver:host=$server; port=$port; dbname=$dbname", $user, $pass);
    
            
            $offre_id = $_POST['offre_id'];
            $status = $_POST['status'] === 'checked' ? 'false' : 'true';

            if($status){
                $stmt = $dbh->prepare("UPDATE pact._offre SET en_ligne = $status, date_publication = now()  WHERE idO = $offre_id");
                $stmt->execute();
            }else{
                $stmt = $dbh->prepare("UPDATE pact._offre SET en_ligne = $status, date_hors_ligne = now( WHERE idO = $offre_id");
                $stmt->execute();
            }

            
            } catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>";
                die();
            }
    
            
             
        } else {
            echo "<p>Erreur : les données du formulaire ne sont pas valides.</p>";
        }
    }

    $dbh = new PDO("$driver:host=$server; port=$port; dbname=$dbname", $user, $pass);

    $user_cookie = $_COOKIE['user'];

    try{

    $stmt=$dbh->prepare("SELECT o.idO, o.titre, o.resume, o.idC, o.en_ligne, MIN(p.src_image) AS src_image FROM pact.offre o
    JOIN pact.photo_offre p ON o.idO = p.idO
    WHERE o.idC = $user_cookie
    GROUP BY o.idO, o.titre, o.resume, o.idC, o.en_ligne");
    
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    $dbh = null;
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tableau de Bord</title>
        <link rel="stylesheet" href="../css/tableau_bord.css">
        <link rel="stylesheet" href="../css/styleGeneral.css">
    </head>
    <body class="BO">
        <div class="main-content">
            <header>
                <h1>Vos offres</h1>
                <h2>Gérez vos offres ici</h2>
            </header>
            <main>
                <?php
                foreach($result as $key => $valeur){
                ?>
                <section class="section_offre">
                    <img src="../images/<?php echo $valeur["src_image"]; ?>" alt="<?php echo $valeur["titre"]; ?>" title="<?php echo $valeur["titre"]; ?>" placeholder="../images/imagesReferences/placeholder.php">
                    <div class="infos_offre">
                        <div class="titre_switch">
                            <p class="titre_offre"><strong><?php echo $valeur["titre"]; ?></strong></p>
                        </div>
                        <p class="description"><?php echo $valeur["resume"]; ?></p>
                        <div class="detail_modif">
                            <a href="detail-offre.php?value=<?php echo $valeur["ido"];?>">Voir les détails</a>
                            <a href="modifier_offre.php?value=<?php echo $valeur["ido"];?>">Modifier les informations</a>
                        </div>
                        <div class="hors_ligne">
                            <form method="POST" action="tableau_de_bord.php" onsubmit="setCheckboxValue(this);">
                            <input type="hidden" name="status" value="checked">
                                <label class="switch">
                                    <input type="checkbox" name="status" value="unchecked" <?php if ($valeur["en_ligne"] == 'false') echo 'checked'; ?>>
                                    <span class="slider round"></span>
                                </label>
                                <input type="hidden" name="offre_id" value="<?php echo $valeur["ido"]; ?>">
                            </form>
                        </div>
                    </div>
                </section>
                <?php
                }
                ?>
                <form action="creation_offre.php">
                    <input type="submit" value="Créer une nouvelle offre" id="creer_offre"/>
                </form>
                <script src="../js/tableau_de_bord.js">
                </script>
                <?php

                include_once'footer.php';

                ?>  
            </main>
        </div>
    </body>
</html>
