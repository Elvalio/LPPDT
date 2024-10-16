<!DOCTYPE html>
<html lang="fr">
    <?php
    include_once'nav.php';
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tableau de Bord</title>
        <link rel="stylesheet" href="../css/tableau_bord.css">
    </head>
    <header>
        <h1>Vos offres</h1>
        <h2>Gérez vos offres ici</h2>
    </header>
    <body>
        <section>
            <img src="../images/offre.webp" alt="offre" title="offre">
            <div>
                <p><strong>Balade à vélo de Tonquédec à Pluzunet</strong></p>
                <p>Balade à vélo pour toute la famille d'une distance d'environ 15 km</p>
                <div>
                    <button>Voir les détails</button>
                    <button>Modifier les informations</button>
                </div>
                <div class="hors_ligne">
                    <button><img src="../icons/slash.svg" id="icon_delete"> Mise hors ligne</button>
                </div>
            </div>
        </section>
        <section>
            <img src="../images/offre.webp" alt="offre" title="offre">
            <div>
                <p><strong>Balade à vélo de Tonquédec à Pluzunet</strong></p>
                <p>Balade à vélo pour toute la famille d'une distance d'environ 15 km</p>
                <div>
                    <button>Voir les détails</button>
                    <button>Modifier les informations</button>
                </div>
                <div class="hors_ligne">
                    <button><img src="../icons/slash.svg" id="icon_delete"> Mise hors ligne</button>
                </div>
            </div>
        </section>
        <section>
            <img src="../images/offre.webp" alt="offre" title="offre">
            <div>
                <p><strong>Balade à vélo de Tonquédec à Pluzunet</strong></p>
                <p>Balade à vélo pour toute la famille d'une distance d'environ 15 km</p>
                <div>
                    <button>Voir les détails</button>
                    <button>Modifier les informations</button>
                </div>
                <div class="hors_ligne">
                    <button><img src="../icons/slash.svg" id="icon_delete"> Mise hors ligne</button>
                </div>
            </div>
        </section>
        <button>Créer une nouvelle offre</button>
        <?php
        include_once'footer.php';
        ?>
    </body>
</html>