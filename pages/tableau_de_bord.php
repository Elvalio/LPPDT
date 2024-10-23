<!DOCTYPE html>
<html lang="fr">
    <?php
    include_once'nav.php';
    

    include('../sql/connect_params.php');

    $dbh = new PDO("$driver:host=$server; port=$port; dbname=$dbname", $user, $pass);

    $user_cookie = $_COOKIE['user'];

    try{

    $stmt=$dbh->prepare("SELECT o.idO, o.titre, o.resume, o.idC, o.en_ligne, p.src_image FROM pact.offre o
    JOIN pact.photo_offre p ON o.idO = p.idO
    WHERE o.idC = $user_cookie");
    
    $stmt->execute();

    $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $dbh = null;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tableau de Bord</title>
        <link rel="stylesheet" href="../css/tableau_bord.css">
        <link rel="stylesheet" href="../css/styleGeneral.css">
    </head>
    <body>
        <div class="main-content">
            <header>
                <h1>Vos offres</h1>
                <h2>Gérez vos offres ici</h2>
            </header>
            <main>
                <?php
                foreach($stmt as $key => $valeur){
                ?>
                <section class="section_offre">
                    <p><?php echo $valeur["en_ligne"]; ?></p>
                    <img src="../images/<?php echo $valeur["src_image"]; ?>" alt="<?php echo $valeur["titre"]; ?>" title="<?php echo $valeur["titre"]; ?>">
                    <div class="infos_offre">
                        <div class="titre_switch">
                            <p class="titre_offre"><strong><?php echo $valeur["titre"]; ?></strong></p>
                        </div>
                        <p class="description"><?php echo $valeur["resume"]; ?></p>
                        <div class="detail_modif">
                            <form action="detail-offre.php?idO=<?php echo $valeur["ido"]; ?>">
                                <input type="submit" value="Voir les détails"/>
                            </form>
                            <form action="modifier_offre.php?idO=<?php echo $valeur["ido"]; ?>">
                                <input type="submit" value="Modifier les informations"/>
                            </form>
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
                <form action="http://localhost:8888/pages/creation_offre.php">
                    <input type="submit" value="Créer une nouvelle offre" id="creer_offre"/>
                </form>
                <script src="../js/tableau_de_bord.js">
                </script>
                <?php

                include_once'footer.php';

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    print_r($_POST);
                    
                    if (isset($_POST['offre_id']) && isset($_POST['status'])) {
                        
                        
                        echo "<p>Chef, c'est bon, pourquoi tu pleures ?</p>";
                
                        
                        try{
                        $dbh = new PDO("$driver:host=$server; port=$port; dbname=$dbname", $user, $pass);
                
                        
                        $offre_id = $_POST['offre_id'];
                        $status = $_POST['status'] === 'checked' ? 'false' : 'true';
                
                        
                        echo "<p>Offre ID: $offre_id</p>";
                        echo "<p>Status: $status</p>";
                
                        
                        $stmt = $dbh->prepare("UPDATE pact._offre SET en_ligne = $status WHERE idO = $offre_id");
                        $stmt->execute();

                        print "insertion réussie";
                        
                        } catch (PDOException $e) {
                            print "Erreur !: " . $e->getMessage() . "<br/>";
                            die();
                        }
                
                        
                        header("Location: tableau_de_bord.php");
                        exit(); 
                
                
                        $dbh = null;
                    } else {
                        echo "<p>Erreur : les données du formulaire ne sont pas valides.</p>";
                    }
                }
                ?>  
            </main>
        </div>
    </body>
</html>