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
            <a href="../pages/accueil.php" class="menu-item">
                <img src="../icons/home.png" alt="Home Icon" id="homeIcon">
            </a>
            <a href="#" class="menu-item">
                <img src="../icons/recent.png" alt="Clock Icon" id="clockIcon">
            </a>
            <a href="#" class="menu-item">
                <img src="../icons/notification.png" alt="Bell Icon" id="bellIcon">
            </a>
            <a href="../pages/connexion.php" class="menu-item">
                <img src="../icons/profil.png" alt="Profile Icon" id="profileIcon">
            </a>
        </nav>
    </footer>
    
    <script>
        // Assurer que le DOM est entièrement chargé avant d'exécuter le script
        document.addEventListener("DOMContentLoaded", function() {
            const navBar = document.querySelector(".menu-footer"),
                  allItems = document.querySelectorAll(".menu-item");

            if (navBar && allItems.length > 0) {  // Vérifie si les éléments existent bien
                allItems.forEach((item, index) => {
                    item.addEventListener("click", (e) => {
                        e.preventDefault(); // prevent default behavior (navigation)
                        
                        const activeItem = navBar.querySelector(".active");
                        
                        if (activeItem) {
                            activeItem.classList.remove("active");
                        }
                        
                        // Add 'active' class to the clicked item
                        item.classList.add("active");

                        // Handle the icon image change logic here, e.g.:
                        allItems.forEach((el) => {
                            const img = el.querySelector("img");
                            if (img) {
                                img.src = img.src.replace("Active.png", ".png");
                            }
                        });
                        
                        const icon = item.querySelector("img");
                        if (icon) {
                            icon.src = icon.src.replace(".png", "Active.png");
                        }
                    });
                });
            } else {
                console.error("Navigation elements not found");
            }
        });
    </script>
</body>
</html>
