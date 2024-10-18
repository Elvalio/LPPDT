<!DOCTYPE html>
<html lang="fr">
    <?php
    include_once'nav.php';

    $dbh = new PDO("$driver:host=$server; dbname=$dbname", $user, $pass);
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tableau de Bord</title>
        <link rel="stylesheet" href="../css/tableau_bord.css">
    </head>
    <body>
        <header>
            <h1>Vos offres</h1>
            <h2>Gérez vos offres ici</h2>
        </header>
        <main>
            <section>
                <?php
                foreach($dbh->query("SELECT * from pact._offre WHERE idC = #") as $row){
                ?>
                <img src="../images/<?php?>offre.webp" alt="offre" title="offre">
                <div>
                    <p><strong><?php echo '$row[1]' ?></strong></p>
                    <p><?php echo '$row[2]'?></p>
                    <div class="detail_modif">
                        <form action="http://localhost:8888/pages/detail-offre.php">
                            <input type="submit" value="Voir les détails"/>
                        </form>
                        <form>
                            <input type="submit" value="Modifier les informations"/>
                        </form>
                    </div>
                    <div class="hors_ligne">
                        <button id="button_hors_ligne"><img src="../icons/<?php?>slash.svg" id="icon_delete"> Mise hors ligne</button>
                    </div>
                </div>
                <?php
                }
                ?>
            </section>
            <form action="http://localhost:8888/pages/creation_offre.php">
                <input type="submit" value="Créer une nouvelle offre" id="creer_offre"/>
            </form>
            
        </main>
        <footer>
        <?php
            include_once'footer.php';
        ?>
        </fotter>
    </body>
</html>