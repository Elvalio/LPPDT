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
        'input[id="nom-pro"], input[id="prenom-pro"], input[id="pseudo-pro"], input[id="codepostal-pro"], input[id="ville-pro"], input[id="adresse-pro"], input[id="email-pro"], input[id="telephone-pro"], input[id="password-pro"], input[id="confirm_password-pro"], input[id="cvv-pro"], input[id="expiration-pro"], input[id="num_SIREN-pro"], input[id="cardholder_name-pro"]'
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
