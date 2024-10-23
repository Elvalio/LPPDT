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
        input.style.border = '2px solid #006B8F';
    });


    const inputs_pro = document.querySelectorAll(
        'input[id="nom-pro"], input[id="prenom-pro"], input[id="denomination-sociale-pro"], input[id="raison-sociale-pro"], input[id="codepostal-pro"], input[id="ville-pro"], input[id="adresse-pro"], input[id="email-pro"], input[id="telephone-pro"], input[id="password-pro"], input[id="confirm_password-pro"], input[id="num_SIREN-pro"], input[id="bic"], input[id="iban"]'
    );

    inputs_pro.forEach(input => {
        // Ajouter les styles personnalisés directement aux inputs de la page pro
        input.style.width = '100%';
        input.style.padding = '10px';
        input.style.marginBottom = '20px';
        input.style.borderRadius = '5px';
        input.style.border = '2px solid #F07605';
    });


// Sélectionner les éléments des liens
const proPublicLink = document.getElementById('link-pro-public');
const proPriveeLink = document.getElementById('link-pro-privee');
const membreLink = document.getElementById('link-membre');

// Couleurs personnalisées
const membreLinkColor = '#006B8F'; // Couleur de fond pour le lien "Inscription Membre"
const boxShadowColor = 'rgba(0, 107, 143, 0.5)'; // Couleur d'ombre correspondante
const defaultBackgroundColor = '#FFF7E1'; // Couleur de fond par défaut
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
    const links = [proPublicLink, proPriveeLink, membreLink];
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

    if (link === membreLink) {
        link.style.backgroundColor = membreLinkColor; // Couleur de fond personnalisée pour Inscription Membre
        link.style.color = activeTextColor; // Couleur de texte personnalisée
        link.style.boxShadow = `0 5px 10px ${boxShadowColor}, 0 -5px 10px ${boxShadowColor}`; // Ombre pour le lien "Inscription Membre"
    } else {
        link.style.backgroundColor = '#A2021F'; // Couleur de fond personnalisée pour les autres
        link.style.color = activeTextColor; // Couleur de texte personnalisée
        link.style.boxShadow = '-5px 0 10px rgba(255, 99, 71, 0.5), 0 5px 10px rgba(255, 99, 71, 0.5), 0 -5px 10px rgba(255, 99, 71, 0.5)'; // Ombre personnalisée pour les autres
    }

    link.style.textAlign = 'center'; // Alignement du texte
}

// Ajouter des événements de clic à chaque lien
proPublicLink.addEventListener('click', () => activateLink(proPublicLink));
proPriveeLink.addEventListener('click', () => activateLink(proPriveeLink));
membreLink.addEventListener('click', () => activateLink(membreLink));

// Optionnel : Activer le premier lien par défaut
activateLink(proPublicLink); // Exemple pour activer "Inscription Professionnelle - Public" par défaut


    const form = document.querySelector('form');
    const password = document.getElementById('password-membre');
    const confirmPassword = document.getElementById('confirm_password-membre');

    form.addEventListener('submit', function(event) {
        if (password.value !== confirmPassword.value) {
            event.preventDefault();
            alert('Les mots de passe ne correspondent pas. Veuillez les vérifier.');
        }
    });
});
