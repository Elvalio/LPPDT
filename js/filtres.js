document.addEventListener('DOMContentLoaded', function () {
    const trie_text = document.querySelector('.dropdown-toggle > p');

    const categoriesFiltres = [
        'filtre-type',
        'filtre-lieu',
        'filtre-note'
    ];

    const filtres_actifs = Array(categoriesFiltres.length).fill().map(() => []);
    const filtres_temps = { start: null, end: null }; // Pour le filtre-temps
    const filtres_prix = { min: null, max: null };   // Pour le filtre-prix

    const offres = document.getElementsByClassName('carte_offre desktop-element');
    const dropdownMenu = document.querySelector('.dropdown-menu');
    const menuItems = dropdownMenu.querySelectorAll('li');
    console.log(menuItems); 

    // Gestion des filtres avec checkboxes
    function ajouterEcouteursCheckbox() {
        categoriesFiltres.forEach((categorie, index) => {
            const inputs = document.querySelectorAll(`.${categorie} input`);
            inputs.forEach(input => {
                input.addEventListener('change', function () {
                    if (input.checked) {
                        filtres_actifs[index].push(input.name);
                    } else {
                        const idx = filtres_actifs[index].indexOf(input.name);
                        if (idx > -1) filtres_actifs[index].splice(idx, 1);
                    }
                    afficherResultats(filtrage());
                });
            });
        });
    }

    // Gestion des filtres de dates (calendriers)
    function ajouterEcouteursTemps() {
        const startDateInput = document.querySelector('.filtre-temps-start');
        const endDateInput = document.querySelector('.filtre-temps-end');

        startDateInput.addEventListener('change', function () {
            filtres_temps.start = new Date(startDateInput.value);
            afficherResultats(filtrage());
        });

        endDateInput.addEventListener('change', function () {
            filtres_temps.end = new Date(endDateInput.value);
            afficherResultats(filtrage());
        });
    }

    // Gestion des filtres de prix (double-slider)
    function ajouterEcouteursPrix() {
        const sliderMin = document.querySelector('.filtre-prix-min');
        const sliderMax = document.querySelector('.filtre-prix-max');

        sliderMin.addEventListener('input', function () {
            filtres_prix.min = parseInt(sliderMin.value, 10);
            afficherResultats(filtrage());
        });

        sliderMax.addEventListener('input', function () {
            filtres_prix.max = parseInt(sliderMax.value, 10);
            afficherResultats(filtrage());
        });
    }

    // Fonction de filtrage
    function filtrage() {
        return Array.from(offres).filter(offre => {
            // Appliquer la logique ET entre catégories
            const checkboxesOK = filtres_actifs.every((filtresCategorie, index) => {
                if (filtresCategorie.length === 0) return true;
                return filtresCategorie.some(filtre => offre.classList.contains(filtre));
            });

            const tempsOK = (() => {
                if (!filtres_temps.start && !filtres_temps.end) return true;
                const offreDate = new Date(offre.getAttribute('data-date'));
                if (filtres_temps.start && offreDate < filtres_temps.start) return false;
                if (filtres_temps.end && offreDate > filtres_temps.end) return false;
                return true;
            })();

            const prixOK = (() => {
                if (filtres_prix.min === null && filtres_prix.max === null) return true;
                const offrePrix = parseInt(offre.getAttribute('data-prix'), 10);
                if (filtres_prix.min !== null && offrePrix < filtres_prix.min) return false;
                if (filtres_prix.max !== null && offrePrix > filtres_prix.max) return false;
                return true;
            })();

            return checkboxesOK && tempsOK && prixOK;
        });
    }

    function trie(offresVisibles) {
        if (menuItems[0].classList.contains('active')) {
            offresVisibles.sort((a, b) => {
                return a.getAttribute('data-prix') - b.getAttribute('data-prix');
            });
        }
        if (menuItems[1].classList.contains('active')) {
            offresVisibles.sort((a, b) => {
                return b.getAttribute('data-prix') - a.getAttribute('data-prix');
            });
        }
        if (menuItems[2].classList.contains('active')) {
            offresVisibles.sort((a, b) => {
                return new Date(a.getAttribute('data-note')) - new Date(b.getAttribute('data-note'));
            });
        }
        if (menuItems[3].classList.contains('active')) {
            offresVisibles.sort((a, b) => {
                return new Date(b.getAttribute('data-note')) - new Date(a.getAttribute('data-note'));
            });
        }
    }

    for (let i = 0; i < menuItems.length; i++) {
        menuItems[i].addEventListener('click', function () {
            const link = menuItems[i].querySelector('a');
            if (menuItems[i].classList.contains('active')) {
                menuItems[i].classList.remove('active');
                
                menuItems[i].style.borderLeft = ''; // Remove left border
                link.style.color = ''; // Remove link color

                trie_text.innerHTML = 'Trier par' // Reset text;
            } else {
                for (let k = 0; k < menuItems.length; k++) {
                    menuItems[k].classList.remove('active');
                    menuItems[k].style.borderLeft = ''; // Remove left border
                    const linkK = menuItems[k].querySelector('a');
                    if (linkK) linkK.style.color = ''; // Remove link color

                }
                menuItems[i].classList.add('active');
                menuItems[i].style.borderLeft = '2px solid var(--bleuFonce-rougeFonce)'; // Add left border
                link.style.color = 'var(--bleuFonce-rougeFonce)'; // Change link color
                trie_text.innerHTML = 'Trier par :' + ' ' + `<span style="color: var(--bleuFonce-rougeFonce); font-size: 0.8em;">${link.innerHTML}</span>`; // Change text with color
            }
            afficherResultats(filtrage());
        });
    }

    // Fonction pour afficher uniquement les offres filtrées
    function afficherResultats(offresVisibles) {
        console.log(offresVisibles);
        trie(offresVisibles);
        console.log(offresVisibles);
        Array.from(offres).forEach(offre => {
            offresVisibles.forEach((offreVisible, index) => {
                offreVisible.style.order = index;
            });
            offre.style.display = offresVisibles.includes(offre) ? 'block' : 'none';
        });
    }

    // Initialisation
    ajouterEcouteursCheckbox();
    ajouterEcouteursTemps();
    ajouterEcouteursPrix();

    
});
