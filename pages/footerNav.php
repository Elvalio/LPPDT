<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/footerNav.css">
    <title>Document</title>
</head>
<body>
    <footer class="mobile-footer">
        <nav class="menu-footer">
            <a href="../pages/accueil.php" class="menu-item-footer">
                <img src="../icons/home.png" alt="Home Icon" id="homeIcon">
            </a>
            <!--
            <a href="../pages/en-construction.php" class="menu-item-footer">
                <img src="../icons/recent.png" alt="Clock Icon" id="clockIcon">
            </a>
            <a href="../pages/en-construction.php" class="menu-item-footer">
                <img src="../icons/notification.png" alt="Bell Icon" id="bellIcon">
            </a>
            -->
            <?php if (isset($_COOKIE['type_compte'])) { ?>
            <a href="../pages/infoCompte.php" class="menu-item-footer">
                <img src="../icons/profil.png" alt="Profile Icon" id="profileIcon">
            </a>
            <?php }
            else { ?>
            <a href="../pages/connexion.php" class="menu-item-footer">
                <img src="../icons/profil.png" alt="Profile Icon" id="profileIcon">
            </a>
            <?php } ?> 
        </nav>
    </footer>

    <script>
        // Fonction pour définir l'icône active en fonction de l'ID
        function setActiveIcon(activeIconId) {
            // Réinitialise toutes les icônes à leur image normale
            document.querySelectorAll('.menu-item-footer img').forEach(img => {
                img.src = img.src.replace('Active', '');  // Enlève 'Active' si présent
            });
            
            // Définit l'icône active
            const activeIcon = document.getElementById(activeIconId);
            if (activeIcon) {
                activeIcon.src = activeIcon.src.replace('.png', 'Active.png');
            }
        }

        // Vérifie si une icône active est enregistrée dans localStorage
        const savedIconId = localStorage.getItem('activeIconId');
        if (savedIconId) {
            setActiveIcon(savedIconId);
        }

        // Ajoute des événements de clic à chaque icône²
        document.querySelectorAll('.menu-item-footer img').forEach(icon => {
            icon.addEventListener('click', function() {
                // Change l'icône cliquée en iconeActive.png
                const iconId = this.id;
                localStorage.setItem('activeIconId', iconId);  // Sauvegarde l'ID dans localStorage
                setActiveIcon(iconId);
            });
        });
    </script>
</body>
</html>
