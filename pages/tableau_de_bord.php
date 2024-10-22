<!DOCTYPE html>
<html lang="fr">
    <?php
    include_once'nav.php';

    include('../sql/connect_params.php');

    $dbh = new PDO("$driver:host=$server; port=$port; dbname=$dbname", $user, $pass);


    try{

    $stmt=$dbh->prepare("SELECT titre, resume FROM pact.offre");
    
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
    </head>
    <body class="main-content">
        <header>
            <h1>Vos offres</h1>
            <h2>Gérez vos offres ici</h2>
        </header>
        <main>
            <?php
            foreach($stmt as $key => $valeur){
            ?>
            <section>
                <img src="../images/<?php?>offre.webp" alt="offre" title="offre">
                <div>
                    <p><strong><?php echo $valeur["titre"] ?></strong></p>
                    <p><?php echo $valeur["resume"] ?></p>
                    <div class="detail_modif">
                        <form action="http://localhost:8888/pages/detail-offre.php">
                            <input type="submit" value="Voir les détails"/>
                        </form>
                        <form>
                            <input type="submit" value="Modifier les informations"/>
                        </form>
                    </div>
                    <div class="hors_ligne">
                        <button id="button_hors_ligne"><img src="../icons/interdit_rouge.png" id="icon_delete"> Mise hors ligne</button>
                    </div>
                </div>
            </section>
            <?php
            }
            ?>
            <form action="http://localhost:8888/pages/creation_offre.php">
                <input type="submit" value="Créer une nouvelle offre" id="creer_offre"/>
            </form>
        </main>
        <footer>
        <?php
            include_once'footer.php';
        ?>
        </footer>
    </body>
</html>