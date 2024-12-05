    <!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styleGeneral.css">
    </head>
    <body>
        <header class = "header">
            <div class="logo_recherche">
                <img src="../images/logo_vert.png" alt="logo_vert" title="logo_vert" width="122px" height="80px" id="logo">
                <div>
                    <img src="../icons/search_icon.png" id="rechercheOffreIMGmobile">    
                    <input type="text" name="search" id="rechercheOffreMobile" placeholder="Recherche" class="FS">
                </div>
            </div>
            <?php
            if ($_SERVER['SCRIPT_NAME'] != '/pages/connexion.php' && $_SERVER['SCRIPT_NAME'] != '/pages/creation_compte_formulaire.php') { ?>
            <div class="boutonALaUne NoSelect">
                <p>À la Une</p>
            </div>
            <?php } ?>
            <hr>
        </header>
    </body>
</html>