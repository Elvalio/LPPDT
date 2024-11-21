document.addEventListener("DOMContentLoaded", function() {
    // Appliquer du style aux éléments input texte, email, téléphone, mot de passe
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
});
