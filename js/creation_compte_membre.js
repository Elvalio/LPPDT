document.addEventListener("DOMContentLoaded", function() {
    // Appliquer du style aux éléments input texte, email, téléphone, mot de passe
    const inputs_membre = document.querySelectorAll(
        'input[id="nom-membre"], input[id="prenom-membre"], input[id="pseudo-membre"], input[id="codepostal-membre"], input[id="ville-membre"], input[id="adresse-membre"], input[id="email-membre"], input[id="telephone-membre"], input[id="password-membre"], input[id="confirm_password-membre"]'
    );


    inputs_membre.forEach(input => {
        // Ajouter les styles personnalisés directement aux inputs de la page membre
        input.style.width = '100%';
        input.style.padding = '10px';
        input.style.marginBottom = '20px';
        input.style.borderRadius = '5px';
        input.style.border = '1px solid #ccc';
    });


    inputs_pro.forEach(input => {
        // Ajouter les styles personnalisés directement aux inputs de la page pro
        input.style.width = '100%';
        input.style.padding = '10px';
        input.style.marginBottom = '20px';
        input.style.borderRadius = '5px';
        input.style.border = '1px solid #ccc';
    });


    // Sélectionner les éléments des liens
    const membreLink = document.getElementById('link-membre');


    // Couleurs personnalisées
    const membreLinkColor = '#006B8F'; // Couleur de fond pour le lien "Inscription Membre"
    const boxShadowColor = 'rgba(0, 107, 143, 0.5)'; // Couleur d'ombre correspondante
    const defaultTextColor = '#006B8F'; // Couleur de texte par défaut
    const activeTextColor = 'white'; // Couleur de texte pour les liens actifs
    const activeFontSize = '24px'; // Taille de police personnalisée
    const activeFontWeight = 'bold'; // Poids de police personnalisé
    const activePadding = '20px'; // Rembourrage personnalisé
    const activeBorderRadius = '30px'; // Rayon de bord personnalisé
    const fixedWidth = '350px'; // Largeur fixe pour tous les liens
    const fixedHeight = '100px'; // Hauteur fixe pour tous les liens (augmenté)


    // Fonction pour réinitialiser le style de tous les liens
    function resetStyles() {
        const links = [membreLink];
        links.forEach(link => {
            link.style.backgroundColor = defaultBackgroundColor; // Rétablir la couleur de fond par défaut
            link.style.color = defaultTextColor; // Couleur de texte par défaut
            link.style.fontSize = activeFontSize; // Taille de police par défaut
            link.style.fontWeight = activeFontWeight; // Poids de police par défaut
            link.style.padding = activePadding; // Rétablir le rembourrage
            link.style.borderRadius = activeBorderRadius; // Rétablir le rayon de bord
            link.style.boxShadow = ''; // Rétablir l'ombre par défaut
            link.style.width = fixedWidth; // Appliquer la largeur fixe
            link.style.height = fixedHeight; // Appliquer la hauteur fixe
        });
    }


    // Fonction pour activer le lien cliqué
    function activateLink(link) {
        resetStyles(); // Réinitialiser les styles
        link.style.backgroundColor = membreLinkColor; // Couleur de fond personnalisée pour Inscription Membre
        link.style.color = activeTextColor; // Couleur de texte personnalisée
        link.style.boxShadow = `0 5px 10px ${boxShadowColor}, 0 -5px 10px ${boxShadowColor}`; // Ombre pour le lien "Inscription Membre"
        link.style.textAlign = 'center'; // Alignement du texte
    }
});