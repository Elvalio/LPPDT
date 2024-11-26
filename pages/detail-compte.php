<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mon Compte</title>
        <link rel="stylesheet" href="../css/detail-compte.css">
        <link rel="stylesheet" href="../css/styleGeneral.css">
    </head>
    <body>
        <?php
        include_once 'nav.php';
        ?>

        <div class="main-content">
            <h1>
                Paramètres de compte
            </h1>
            <div>
                <img src="../images/59.png" width="5%" heigth="5%">
                <div>
                    <p>ElDiablo</p>
                    <button>Voir mes avis</button>
                </div>
            </div>
            <section class="detail-compte-donnees">
                <article class="ligne-info">
                    <div>
                        <p>Prénom</p>
                        <textarea placeholder=""></textarea>
                    </div>
                    <div>
                        <p>Nom</p>
                        <textarea placeholder=""></textarea>
                    </div>
                </article>
                <article class="ligne-info">
                    <div>
                        <p>Téléphone</p>
                        <textarea placeholder=""></textarea>
                    </div>
                    <div>
                        <p>Adresse</p>
                        <textarea placeholder=""></textarea>
                    </div>
                </article>
                <article class="ligne-info">
                    <div>
                        <p>Code Postal</p>
                        <textarea placeholder=""></textarea>
                    </div>
                    <div>
                        <p>Ville</p>
                        <textarea placeholder=""></textarea>
                    </div>
                </article>
                <button id="modif-infos">Modifier les informations</button>
            </section>
        </div>
    </body>
</html>