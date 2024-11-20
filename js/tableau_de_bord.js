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
        let confirmation = confirm("Êtes-vous sûr de vouloir passer cette offre hors ligne ?");
        if (confirmation) {
            toggle.checked = true;
            section.style.setProperty("opacity", 0.5);
            form.submit();  // Soumettre le formulaire si confirmé
            window.location.reload();  // Recharger la page pour mettre à jour les données
        } else {
            toggle.checked = false;
            section.style.setProperty("opacity", 1);
        }
    } else {
        let confirmation = confirm("Êtes-vous sûr de vouloir passer cette offre en ligne ?");
        if (confirmation) {
            toggle.checked = false;
            section.style.setProperty("opacity", 1);
            form.submit();  // Soumettre le formulaire si confirmé
            window.location.reload();  // Recharger la page pour mettre à jour les données
        } else {
            toggle.checked = true;
            section.style.setProperty("opacity", 0.5);
        }
    }
}

// Associer l'événement à chaque toggle
toggles.forEach(toggle => {
    toggle.addEventListener("click", appuieToggle);
});
