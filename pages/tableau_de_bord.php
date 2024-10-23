<!DOCTYPE html>
<html lang="fr">
    <?php
    include_once'nav.php';

    include('../sql/connect_params.php');

    $dbh = new PDO("$driver:host=$server; port=$port; dbname=$dbname", $user, $pass);

    $user = $_COOKIE['user'];

    try{

    $stmt=$dbh->prepare("SELECT o.idO, o.titre, o.resume, o.idC, p.src_image FROM pact.offre o
    JOIN pact.photo_offre p ON o.idO = p.idO
    WHERE o.idC = $user");

    /*LEFT JOIN pact._secteur_pro s ON o.idC = s.idC*/
    
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
    <body class="main-content">
        <header>
            <h1>Vos offres</h1>
            <h2>Gérez vos offres ici</h2>
        </header>
        <main>
            <?php
            foreach($stmt as $key => $valeur){
            ?>
            <section class="section_offre">
                <img src="../images/<?php echo $valeur["src_image"]; ?>" alt="<?php echo $valeur["titre"]; ?>" title="<?php echo $valeur["titre"]; ?>">
                <div class="infos_offre">
                    <div class="titre_switch">
                        <p class="titre_offre"><strong><?php echo $valeur["titre"]; ?></strong></p>
                    </div>
                    <p class="description"><?php echo $valeur["resume"]; ?></p>
                    <div class="detail_modif">
                        <form action="http://localhost:8888/pages/detail-offre.php?idO=<?php echo $valeur["idO"]; ?>">
                            <input type="submit" value="Voir les détails"/>
                        </form>
                        <form action="http://localhost:8888/pages/modifier_offre.php?idO=<?php echo $valeur["idO"]; ?>">
                            <input type="submit" value="Modifier les informations"/>
                        </form>
                    </div>
                    <div class="hors_ligne">
                        <label class="switch">
                            <input type="checkbox" id="toggle" name="toggle">
                            <span class="slider round"></span>
                        </label>
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
        <script src="../js/tableau_de_bord.js">
        </script>
    </body>
</html>