<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styleNavBar.css">
    </head>
    <body>
    <?php

        if (isset($_COOKIE['type_compte']) && ($_COOKIE['type_compte'] == "pro_public" || $_COOKIE['type_compte'] == "pro_prive")) { ?>
            <div class="TS-bold BO" id="sidebar"> <?php
        } else { ?>
            <div class="TS-bold FO" id="sidebar"> <?php
            
        } ?>
            <nav>
                <?php
                    $estMembre = true;
                    if (isset($_COOKIE['type_compte'])) {
                        if (($_COOKIE['type_compte'] != "membre")){
                            $estMembre = false;
                        }
                    }
                ?>
                <a href="accueil.php" id="pact-item">
                    <img src="../images/logo_reduit_rouge.png" alt="Image par défaut" class="image image-default">
                    <img src="../images/logo_rouge.png" alt="Image au survol" class="image image-hover">        
                </a>
                <div id="items">
                    <div id="top-items" class=" <?php if ($estMembre) {?> BO <?php } ?>">
                        <a href="accueil.php" class="nav-item" data-icon="accueil">
                            <img src="../icons/icons-gris/icon-accueil-gris.svg" alt="Logo accueil" class="logo-nav">
                            <p>Accueil</p>
                        </a>

                        <a href="tableau_de_bord.php" class="nav-item <?php if ($estMembre) {?> BO <?php } ?>" data-icon="tableau-de-bord">
                            <img src="../icons/icons-gris/icon-tableau-de-bord-gris.svg" alt="Logo tableau de bord" class="logo-nav">
                            <p>Tableau de bord</p>
                        </a>
                                                
                        <a href="en-construction.php" class="nav-item" data-icon="favoris">
                            <img src="../icons/icons-gris/icon-favoris-gris.svg" alt="Logo favoris" class="logo-nav">
                            <p>Favoris</p>
                        </a>
                        <a href="en-construction.php" class="nav-item" data-icon="historique">
                            <img src="../icons/icons-gris/icon-historique-gris.svg" alt="Logo historique" class="logo-nav">
                            <p>Historique</p>
                        </a>

                            <a href="facturation.php" class="nav-item <?php if ($estMembre) {?> BO <?php } ?>" data-icon="facturation">
                                <img src="../icons/icons-gris/icon-facturation-gris.svg" alt="Logo Facturation" class="logo-nav">
                                <p>Facturation</p>
                            </a>

                            <a href="creation_offre.php" class="nav-item <?php if ($estMembre) {?> BO <?php } ?>" data-icon="creation">
                                <img src="../icons/icons-gris/icon-creation-gris.svg" alt="Logo création offre" class="logo-nav">
                                <p>Créer une offre</p>
                            </a>
                        </a>

                    </div>
                    <div id="bottom-items">
                            <a href="tableau_de_bord.php" class="nav-item" data-icon="tableau-de-bord">
                             
                                
                                <div id="top-of-bottom-items">
                                    <a href="en-construction.php" class="nav-item <?php if ($estMembre) {?> BO <?php } ?>" data-icon="notification-avec-notif">
                                        <div class="notification-container">
                                            <p>Notifications</p>
                                            <div class="notification-badge">2</div>
                                        </div>
                                        
                                    </a>
                                    <a href="en-construction.php" class="nav-item <?php if ($estMembre) {?> BO <?php } ?>" data-icon="parametre">
                                        <img src="../icons/icons-gris/icon-parametre-gris.svg" alt="Logo paramètres" class="logo-nav">
                                        <p>Paramètres</p>
                                    </a>
                                    <?php if (isset($_COOKIE['type_compte'])) { ?>
                                        <script>
                                            function deconnexion() {
                                                document.cookie = "user=; expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;";
                                                document.cookie = "type_compte=; expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;";
                                                location.assign("accueil.php");
                                            }
                                        </script>
                                        <a href="#" class="nav-item" data-icon="deconnection" onclick="deconnexion()">

                                            <img src="../icons/icons-gris/icon-deconnection-gris.svg" alt="Logo déconnecter" class="logo-nav">
                                            <p>Se déconnecter</p>
                                        </a>
                                    <?php } else { ?>
                                        <a href="creation_compte_formulaire.php" class="nav-item" data-icon="connection">
                                            <img src="../icons/icons-gris/icon-deconnection-gris.svg" alt="Logo Inscription" class="logo-nav">
                                            <p>S'inscrire</p>
                                        </a>
                                    <?php } ?>
                        </div>

                        <?php if (isset($_COOKIE['type_compte'])) {?>
                            
                            <a href="en-construction.php" class="nav-item">
                                <img src="../images/IconProfilConnecte.png" alt="Logo déconnecter" class="logo-nav" id="img-profile">
                                <div id="infoProfile">
                                    <p id="prenom" class="TS">Michael Smith</p>
                                    <p id="email" class="TS">michaelsmith12@gmail.com</p>
                                </div>
                            </a>
                        <?php } else { ?>
                            <a href="connexion.php" class="nav-item">
                                <img src="../icons/utilisateur.png" alt="Logo connexion" class="logo-nav" id="img-profile">
                                <div id="infoProfile">
                                    <p id="connexion" class="TS">Se connecter</p>
                                </div>
                            </a>
                        <?php } ?>

                    </div>
                </div>
            </nav>
        </div>
        <script src="../nav.js"></script>
    </body>
</html>


        <!-- IMPORTANT: rajouter le code ci-dessous pour que la nav fonctionne correctement -->


        <!--
                <div class="main-content"> VOTRE CODE </div>     
        -->
