/*
let toggles = document.querySelectorAll('input[type="checkbox"]');

function setCheckboxValue(form) {
    // Si la case est cochée, envoyez 'unchecked', sinon envoyez 'checked'
    var checkbox = form.querySelector('input[name="status"]');
    if (!checkbox.checked) {
        checkbox.value = 'checked'; // Modifiez la valeur si elle est décochée
    } else {
        checkbox.value = 'unchecked'; // Valeur par défaut si elle est cochée
    }
}


function appuieToggle(event) {
    let toggle = event.target;
    let section = toggle.closest('section');
    let form = toggle.closest('form');  // Trouver le formulaire associé

    if (toggle.checked) {
        let confirmation = confirm("Êtes-vous sûr de vouloir passer cette offre en ligne ?");
        if (confirmation) {
            toggle.checked = true;
            section.style.setProperty("opacity", 1);
            form.submit();  // Soumettre le formulaire si confirmé
        } else {
            toggle.checked = false;
            section.style.setProperty("opacity", 0.5);
        }
    } else {
        let confirmation = confirm("Êtes-vous sûr de vouloir passer cette offre hors ligne ?");
        if (confirmation) {
            toggle.checked = false;
            section.style.setProperty("opacity", 0.5);
            form.submit();  // Soumettre le formulaire si confirmé
        } else {
            toggle.checked = true;
            section.style.setProperty("opacity", 1);
        }
    }    
}

// Associer l'événement à chaque toggle
toggles.forEach(toggle => {
    if(!toggle.checked){
        toggle.closest('section').style.setProperty("opacity", 0.5);
    }
    toggle.addEventListener("click", appuieToggle);
});
*/



let toggles = document.querySelectorAll('input[type="checkbox"]');

function validateAndSubmitForm(event) {
    event.preventDefault(); // Empêche la soumission par défaut du formulaire

    let form = event.target.closest('form');
    let toggle = form.querySelector('input[type="checkbox"]');
    let section = toggle.closest('section');

    // Vérification de l'IBAN et BIC avant la soumission du formulaire
    var ibanBicIncomplets = true;  // Modifiez selon votre logique
    var typeCompte = 'pro_prive';  // Modifiez selon votre logique

    console.log("iban_bic_incomplets : " + ibanBicIncomplets);
    console.log("type_compte : " + typeCompte);

    if (typeCompte === 'pro_prive' && ibanBicIncomplets) {
        alert("Veuillez remplir vos coordonnées bancaires (IBAN et BIC) mettre cette offre en ligne.");
        return false; // Empêche la soumission du formulaire
    }

    // Si la case est cochée, envoyez 'unchecked', sinon envoyez 'checked'
    if (!toggle.checked) {
        toggle.value = 'checked'; // Modifiez la valeur si elle est décochée
    } else {
        toggle.value = 'unchecked'; // Valeur par défaut si elle est cochée
    }

    if (toggle.checked) {
        let confirmation = confirm("Êtes-vous sûr de vouloir passer cette offre en ligne ?");
        if (confirmation) {
            toggle.checked = true;
            section.style.setProperty("opacity", 1);
            form.submit();  // Soumettre le formulaire si confirmé
        } else {
            toggle.checked = false;
            section.style.setProperty("opacity", 0.5);
        }
    } else {
        let confirmation = confirm("Êtes-vous sûr de vouloir passer cette offre hors ligne ?");
        if (confirmation) {
            toggle.checked = false;
            section.style.setProperty("opacity", 0.5);
            form.submit();  // Soumettre le formulaire si confirmé
        } else {
            toggle.checked = true;
            section.style.setProperty("opacity", 1);
        }
    }
}

// Associer l'événement à chaque toggle
toggles.forEach(toggle => {
    if(!toggle.checked){
        toggle.closest('section').style.setProperty("opacity", 0.5);
    }
    toggle.addEventListener("click", function(event) {
        event.preventDefault(); // Empêche la soumission par défaut du formulaire
        validateAndSubmitForm(event);
    });
});