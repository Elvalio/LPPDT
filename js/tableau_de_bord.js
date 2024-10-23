let toggles = document.querySelectorAll('input[type="checkbox"]');

function appuieToggle(event) {

    let toggle = event.target;
    let section = toggle.closest('section');
    // Vérifie si le toggle est activé (coché)
    if (toggle.checked) {
        
        // Si la checkbox est cochée
        let confirmation = confirm("Êtes-vous sûr de vouloir passer cette offre hors ligne ?");
        if (confirmation) {
            toggle.checked = true;
            section.style.opacity = "0.5";

        } else {
            // Si l'utilisateur annule, on remet la checkbox à son état initial
            toggle.checked = false;
        }
    } else {
        // Si la checkbox est décochée
        let confirmation = confirm("Êtes-vous sûr de vouloir passer cette offre en ligne ?");
        if (confirmation) {
            toggle.checked = false;
            section.style.opacity = "1";
        } else {
            // Si l'utilisateur annule, on remet la checkbox à son état initial
            toggle.checked = true;
        }
    }
}

// Ajoute l'événement au clic sur le toggle
toggles.forEach(toggle => {
    toggle.addEventListener("click", appuieToggle);
});