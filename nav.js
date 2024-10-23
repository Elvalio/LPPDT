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
            if (page === currentPage && page != "en-construction.php") {
                item.classList.add('actuel');
                img.src = `../icons/icons-rouge/icon-${iconName}-rouge.svg`;  // Chemin pour l'icône actif
            } else {
                img.src = `../icons/icons-gris/icon-${iconName}-gris.svg`;   // Chemin pour l'icône inactif
            }
        }
    });
});