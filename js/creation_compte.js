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


    // Sélectionner les éléments div à l'intérieur des liens
    const proLink = document.querySelector('.inscription-pro-page-pro');
    const membreLink = document.querySelector('.inscription-membre-page-pro');
    const membrePageMembreLink = document.querySelector('.inscription-membre-page-membre');
    const proPageMembreLink = document.querySelector('.inscription-pro-page-membre');

    // Vérification si les éléments existent
    if (proLink) {
        // Modifier les styles du lien "Inscription Professionnelle"
        proLink.style.backgroundColor = '#A2021F';
        proLink.style.color = 'white';
        proLink.style.fontSize = '24px';
        proLink.style.fontWeight = 'bold';
        proLink.style.padding = '20px';
        proLink.style.borderRadius = '30px';
        proLink.style.boxShadow = '-5px 0 10px rgba(255, 99, 71, 0.5), 0 5px 10px rgba(255, 99, 71, 0.5), 0 -5px 10px rgba(255, 99, 71, 0.5)';
        proLink.style.textAlign = 'center';
        proLink.style.width = '100%';
        proLink.style.height = '100%';
        proLink.style.alignContent = 'center';
    } else {
        console.error("Élément '.inscription-pro-page-pro' introuvable");
    }

    if (membreLink) {
        membreLink.style.backgroundColor = '#FFF7E1';
        membreLink.style.zIndex = '1';
        membreLink.style.color = '#006B8F';
        membreLink.style.fontSize = '24px';
        membreLink.style.fontWeight = 'bold';
        membreLink.style.padding = '20px';
        membreLink.style.borderRadius = '30px';
        membreLink.style.textAlign = 'center';
        membreLink.style.width = '100%';
        membreLink.style.height = '100%';
        membreLink.style.alignContent = 'center';
    } else {
        console.error("Élément '.inscription-membre-page-pro' introuvable");
    }

    if (membrePageMembreLink) {
        // Modifier les styles du lien "Inscription Membre (page membre)"
        membrePageMembreLink.style.backgroundColor = '#006B8F';
        membrePageMembreLink.style.zIndex = '1';
        membrePageMembreLink.style.color = 'white';
        membrePageMembreLink.style.fontSize = '24px';
        membrePageMembreLink.style.fontWeight = 'bold';
        membrePageMembreLink.style.padding = '20px';
        membrePageMembreLink.style.borderRadius = '30px';
        membrePageMembreLink.style.boxShadow = '5px 0 10px rgba(0, 107, 143, 0.5), 0 5px 10px rgba(0, 107, 143, 0.5), 0 -5px 10px rgba(0, 107, 143, 0.5)';
        membrePageMembreLink.style.textAlign = 'center';
        membrePageMembreLink.style.width = '100%';
        membrePageMembreLink.style.height = '100%';
        membrePageMembreLink.style.alignContent = 'center';
    } else {
        console.error("Élément '.inscription-membre-page-membre' introuvable");
    }

    if (proPageMembreLink) {
        // Modifier les styles du lien "Inscription Professionnelle (page membre)"
        proPageMembreLink.style.backgroundColor = '#FFF7E1';
        proPageMembreLink.style.color = 'red';
        proPageMembreLink.style.fontSize = '24px';
        proPageMembreLink.style.fontWeight = 'bold';
        proPageMembreLink.style.padding = '20px';
        proPageMembreLink.style.borderRadius = '30px';
        proPageMembreLink.style.textAlign = 'center';
        proPageMembreLink.style.width = '100%';
    } else {
        console.error("Élément '.inscription-pro-page-membre' introuvable");
    }

});
