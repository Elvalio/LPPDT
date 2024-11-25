document.addEventListener("DOMContentLoaded", function() {
    // Appliquer du style aux éléments input texte, email, téléphone, mot de passe
    const inputs_pro = document.querySelectorAll(
        'input[id="nom-pro"], input[id="prenom-pro"], input[id="denomination"], input[id="codepostal-pro"], input[id="ville-pro"], input[id="adresse-pro"], input[id="email-pro"], input[id="telephone-pro"], input[id="password-pro"], input[id="confirm_password-pro"], input[id="num_SIREN-pro"], input[id="bic"], input[id="iban"]'
    );

    inputs_pro.forEach(input => {
        // Ajouter les styles personnalisés directement aux inputs de la page pro
        input.style.width = '100%';
        input.style.padding = '10px';
        input.style.marginBottom = '20px';
        input.style.borderRadius = '5px';
        input.style.border = '1px solid #ccc';
    });
});


document.addEventListener('DOMContentLoaded', () => {
    // Sélectionner les boutons radio
    const radioButtons = document.querySelectorAll('input[name="type-entreprise"]');
    const elementsPrivee1 = document.getElementById('elements-privee1');
    const elementsPrivee2 = document.getElementById('elements-privee2');

    // Ajouter un événement pour basculer entre publique et privée
    radioButtons.forEach(radio => {
        radio.addEventListener('change', () => {
            if (radio.value === 'privee') {
                elementsPrivee1.style.display = 'block'; // Afficher les éléments de l'entreprise privée
                elementsPrivee2.style.display = 'block';
            } else {
                elementsPrivee1.style.display = 'none'; // Masquer les éléments de l'entreprise privée
                elementsPrivee2.style.display = 'none';
            }
        });
    });

    // Initialisation : masquer les éléments privés si "publique" est sélectionné
    if (document.querySelector('input[name="type-entreprise"]:checked').value === 'privee') {
        elementsPrivee1.style.display = 'block';
        elementsPrivee2.style.display = 'block';
    } else {
        elementsPrivee1.style.display = 'none';
        elementsPrivee2.style.display = 'none';
    }
});

