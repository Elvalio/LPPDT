document.addEventListener('DOMContentLoaded', function () {
    const trie_text = document.querySelector('.dropdown-toggle > p');
    const rechercheOffre = document.getElementById('rechercheOffre');
    const rechercheIMG = document.getElementById('rechercheLieuIMG');

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
        let resultats = Array.from(offres).filter(offre => {
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
    
        // Tri par défaut (priorité aux offres "aLaUne")
        resultats.sort((a, b) => b.classList.contains('aLaUne') - a.classList.contains('aLaUne'));
        return resultats;
    }
    

    function trie(offresVisibles) {
        if (menuItems[0].classList.contains('active')) { // Tri par prix croissant
            offresVisibles.sort((a, b) => {
                return a.getAttribute('data-prix') - b.getAttribute('data-prix') ||
                       b.classList.contains('aLaUne') - a.classList.contains('aLaUne');
            });
        }
        if (menuItems[1].classList.contains('active')) { // Tri par prix décroissant
            offresVisibles.sort((a, b) => {
                return b.getAttribute('data-prix') - a.getAttribute('data-prix') ||
                       b.classList.contains('aLaUne') - a.classList.contains('aLaUne');
            });
        }
        if (menuItems[2].classList.contains('active')) { // Tri par note croissante
            offresVisibles.sort((a, b) => {
            return a.getAttribute('data-note') - b.getAttribute('data-note') ||
                   b.classList.contains('aLaUne') - a.classList.contains('aLaUne');
            });
        }
        if (menuItems[3].classList.contains('active')) { // Tri par note décroissante
            offresVisibles.sort((a, b) => {
            return b.getAttribute('data-note') - a.getAttribute('data-note') ||
                   b.classList.contains('aLaUne') - a.classList.contains('aLaUne');
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
            closeDropdown();
            afficherResultats(filtrage());
        });
    }

    rechercheOffre.addEventListener('input', function () {

        let rechercheIMG = document.getElementById('rechercheOffreIMG');
        if (rechercheOffre.value != '') {
            rechercheIMG.src = '../images/croix-noire.png';
            rechercheIMG.style.cursor = 'pointer';
        } else {
            rechercheIMG.src = '../images/search_icon.png';
            rechercheIMG.style.cursor = 'default';
        }
        afficherResultats(filtrage());

        rechercheIMG.addEventListener('click', function () {
            rechercheOffre.value = '';
            rechercheIMG.src = '../images/search_icon.png';
            rechercheIMG.style.cursor = 'default';

            afficherResultats(filtrage());
        });
    });

    // Fonction pour afficher uniquement les offres filtrées
    function afficherResultats(offresVisibles) {
        trie(offresVisibles);
    
        const rechercheTexte = rechercheOffre.value.toLowerCase();
        offresVisibles = offresVisibles.filter(offre => {
            const offreTexte = offre.textContent.toLowerCase();
            return offreTexte.includes(rechercheTexte);
        });
    
        offresVisibles.sort((a, b) => b.classList.contains('aLaUne') - a.classList.contains('aLaUne'));
    
        Array.from(offres).forEach(offre => {
            offre.style.display = offresVisibles.includes(offre) ? 'block' : 'none';
            offresVisibles.forEach((offreVisible, index) => {
                offreVisible.style.order = index;
            });
        });
    }
    

    // Initialisation
    ajouterEcouteursCheckbox();
    ajouterEcouteursTemps();
    ajouterEcouteursPrix();

    const rechercheLieu = document.getElementById('rechercheLieu');
    const lieux = document.getElementsByClassName('lieu');

    rechercheLieu.addEventListener('input', function () {
        const rechercheTexte = rechercheLieu.value.toLowerCase();

        if (rechercheLieu.value != '') {
            rechercheIMG.src = '../images/croix-noire.png';
            rechercheIMG.style.cursor = 'pointer';

            rechercheIMG.addEventListener('click', function () {
                rechercheLieu.value = '';
                rechercheIMG.src = '../images/search_icon.png';
                rechercheIMG.style.cursor = 'default';

                Array.from(lieux).forEach(lieu => {
                    lieu.style.display = 'block';
                });
            });

            Array.from(lieux).forEach(lieu => {
                const lieuTexte = lieu.textContent.toLowerCase();
                if (lieuTexte.includes(rechercheTexte)) {
                    lieu.style.display = 'block';
                    lieu.classList.remove('hidden');
                } else {
                    lieu.style.display = 'none';
                    lieu.classList.add('hidden');
                }
            });

        } else {
            Array.from(lieux).forEach(lieu => {
                lieu.style.display = 'block';
            });

            rechercheIMG.src = '../images/search_icon.png';
            rechercheIMG.style.cursor = 'default';
        }
    });

    const boutonNouveau = document.getElementsByClassName('boutonNouveau');
    const boutonALaUne = document.getElementsByClassName('boutonALaUne');
    console.log(boutonNouveau);
    // boutons <p> Nouveau et A la une

    function filtrerParBouton() {
        const offresVisibles = filtrage();
        const offresFiltrees = offresVisibles.filter(offre => {
            const estNouveaute = Array.from(boutonNouveau).some(bouton => bouton.classList.contains('active')) && offre.classList.contains('Nouveaute');
            const estALaUne = Array.from(boutonALaUne).some(bouton => bouton.classList.contains('active')) && offre.classList.contains('aLaUne');
            return estNouveaute || estALaUne || (!Array.from(boutonNouveau).some(bouton => bouton.classList.contains('active')) && !Array.from(boutonALaUne).some(bouton => bouton.classList.contains('active')));
        });
        afficherResultats(offresFiltrees);
    }

    Array.from(boutonNouveau).forEach(bouton => {
        bouton.addEventListener('click', function () {
            bouton.classList.toggle('active');
            if (this.classList.contains('active')) {
                this.style.backgroundColor = '#2C2C2C';
                this.querySelector('p').style.color = '#F5F5F5';
                
            } else {
                this.style.backgroundColor = '#F5F5F5';
                this.querySelector('p').style.color = '#757575';
            }
            filtrerParBouton();
        });
    });

    Array.from(boutonALaUne).forEach(bouton => {
        bouton.addEventListener('click', function () {
            bouton.classList.toggle('active');
            if (this.classList.contains('active')) {
                this.style.backgroundColor = '#2C2C2C';
                this.querySelector('p').style.color = '#F5F5F5';
                
            } else {
                this.style.backgroundColor = '#F5F5F5';
                this.querySelector('p').style.color = '#757575';
            }
            filtrerParBouton();
        });
    });

    afficherResultats(filtrage());

});
