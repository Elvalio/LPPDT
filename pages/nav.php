<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styleNavBar.css">
        <link rel="stylesheet" href="../css/styleGeneral.css">
    </head>
    <body>
        <div class="TS-bold" id="sidebar">
            <nav>
                
                <a href="accueil.php" id="pact-item">
                    <img src="../images/logo_reduit_rouge.png" alt="Image par défaut" class="image image-default">
                    <img src="../images/logo_rouge.png" alt="Image au survol" class="image image-hover">        
                </a>
                <div id="items">
                    <div id="top-items">
                        <a href="accueil.php" class="nav-item" data-icon="accueil">
                            <img src="../css/icons/icons-rouge/icon-accueil-rouge.svg" alt="Logo accueil" class="logo-nav">
                            <p>Accueil</p>
                        </a>
                        <a href="#" class="nav-item" data-icon="tableau-de-bord">
                            <img src="../css/icons/icons-gris/icon-tableau-de-bord-gris.svg" alt="Logo tableau de bord" class="logo-nav">
                            <p>Tableau de bord</p>
                        </a>
                        
                        <a href="#" class="nav-item" data-icon="favoris">
                            <img src="../css/icons/icons-gris/icon-favoris-gris.svg" alt="Logo favoris" class="logo-nav">
                            <p>Favoris</p>
                        </a>
                        <a href="#" class="nav-item" data-icon="historique">
                            <img src="../css/icons/icons-gris/icon-historique-gris.svg" alt="Logo historique" class="logo-nav">
                            <p>Historique</p>
                        </a>
                        <a href="#" class="nav-item" data-icon="facturation">
                            <img src="../css/icons/icons-gris/icon-facturation-gris.svg" alt="Logo Facturation" class="logo-nav">
                            <p>Facturation</p>
                        </a>
                        <a href="creation_offre.php" class="nav-item" data-icon="creation">
                            <img src="../css/icons/icons-gris/icon-creation-gris.svg" alt="Logo création offre" class="logo-nav">
                            <p>Créer une offre</p>
                        </a>
                    </div>
                    <div id="bottom-items">
                        <div id="top-of-bottom-items">
                            <a href="#" class="nav-item" data-icon="notification-avec-notif">
                                <div class="notification-container">
                                    <img src="../css/icons/icons-gris/icon-notification-avec-notif-gris.svg" alt="Logo notification" class="logo-nav">
                                    <p>Notifications</p>
                                    <div class="notification-badge">2</div>
                                </div>
                                
                            </a>
                            <a href="#" class="nav-item" data-icon="parametre">
                                <img src="../css/icons/icons-gris/icon-parametre-gris.svg" alt="Logo paramètres" class="logo-nav">
                                <p>Paramètres</p>
                            </a>
                            <a href="#" class="nav-item" data-icon="deconnection">
                                <img src="../css/icons/icons-gris/icon-deconnection-gris.svg" alt="Logo déconnecter" class="logo-nav">
                                <p>Se déconnecter</p>
                            </a>
                        </div>
                        <a href="#" class="nav-item">
                            <img src="../images/IconProfilConnecte.png" alt="Logo déconnecter" class="logo-nav" id="img-profile">
                            <div id="infoProfile">
                                <p id="prenom" class="TS">Michael Smith</p>
                                <p id="email" class="TS">michaelsmith12@gmail.com</p>
                            </div>
                        </a>
                    </div>
                </div>
                
                

            </nav>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const currentPage = window.location.pathname.split("/").pop();
                const navItems = document.querySelectorAll('.nav-item');

                navItems.forEach(item => {
                    // Récupérer l'image associée à l'élément de navigation
                    const img = item.querySelector('.logo-nav');

                    // Vérifier si c'est l'élément avec l'image spécifique à ne pas changer
                    if (img && img.id === 'img-profile') {
                        // Ne rien faire pour cet élément
                        console.log("Image du profil, ne pas changer.");
                        return;  // Sortir de la boucle pour cet élément
                    }

                    // Récupérer la valeur de data-icon pour les autres éléments
                    const iconName = item.dataset.icon;
                    const page = item.getAttribute('href');

                    // Modifier l'image uniquement si l'élément a un data-icon
                    if (iconName) {
                        if (page === currentPage) {
                            item.classList.add('actuel');
                            img.src = `../css/icons/icons-rouge/icon-${iconName}-rouge.svg`;  // Chemin pour l'icône actif
                        } else {
                            img.src = `../css/icons/icons-gris/icon-${iconName}-gris.svg`;   // Chemin pour l'icône inactif
                        }
                    }
                });
            });
        </script>

    </body>
</html>


        <!-- IMPORTANT: rajouter le code ci-dessous pour que la nav fonctionne correctement -->


        <!--
                <div class="main-content"> VOTRE CODE </div>     
        -->
