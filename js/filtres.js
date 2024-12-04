document.addEventListener('DOMContentLoaded', function () {
    const trie_text = document.querySelector('.dropdown-toggle > p');
    const rechercheOffre = document.getElementById('rechercheOffre');
    const rechercheIMG = document.getElementsByClassName('rechercheLieuIMG');
    const SCREEN_MOBILE = 801; // Taille de l'écran pour le changement d'images

    const categoriesFiltres = [
        'filtre-type',
        'filtre-lieu',
        'filtre-note'
    ];

    const filtres_actifs = Array(categoriesFiltres.length).fill().map(() => []);
    const filtres_temps = { start: null, end: null }; // Pour le filtre-temps
    const filtres_prix = { min: null, max: null };   // Pour le filtre-prix
    
    let offres;
    let ecran;
    function updateOffres() {
        if (window.innerWidth > SCREEN_MOBILE) {
            offres = document.getElementsByClassName('carte_offre desktop-element');
        } else {
            offres = document.getElementsByClassName('carte_offre phone-element');
        }

        ecran = window.innerWidth > SCREEN_MOBILE ? 'desktop' : 'mobile';
    }

    // Initial call to set the correct value
    updateOffres();

    // Update the value on window resize
    window.addEventListener('resize', updateOffres);


    const dropdownMenu = document.querySelector('.dropdown-menu');
    const menuItems = dropdownMenu.querySelectorAll('li');


    // Gestion des filtres avec checkboxes
    function ajouterEcouteursCheckbox() {
        categoriesFiltres.forEach((categorie, index) => {
            const inputs = document.querySelectorAll(`.${ecran} .${categorie} input`);
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

    // Gestion des filtres avec radiobuttons pour "filtre-ouvert"
    function ajouterEcouteursRadio() {
        const radios = document.querySelectorAll(`.${ecran} .filtre-ouvert input[type="radio"]`);
        radios.forEach(radio => {
            radio.addEventListener('change', function () {
                afficherResultats(filtrage());
            });
        });
    }

    

    ajouterEcouteursRadio();

    // Gestion des filtres de dates (calendriers)
    function ajouterEcouteursTemps() {
        const startDateInput = document.querySelector(`.${ecran} .filtre-temps-start`);
        const endDateInput = document.querySelector(`.${ecran} .filtre-temps-end`);
    
        startDateInput.addEventListener('change', function () {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);
    
            // Validation des dates
            if (endDateInput.value && startDate > endDate) {
                startDateInput.value = endDateInput.value; // Corrige si nécessaire
            }
            filtres_temps.start = startDate;
            afficherResultats(filtrage());
        });
    
        endDateInput.addEventListener('change', function () {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);
    
            // Validation des dates
            if (startDateInput.value && endDate < startDate) {
                endDateInput.value = startDateInput.value; // Corrige si nécessaire
            }
            filtres_temps.end = endDate;
            afficherResultats(filtrage());
        });
    }
    

    // Gestion des filtres de prix (double-slider)
    function ajouterEcouteursPrix() {
        
        const sliderMin = document.querySelector(`.${ecran} .filtre-prix-min`);
        const sliderMax = document.querySelector(`.${ecran} .filtre-prix-max`);
        const valueLeft = document.querySelector(`.${ecran} #value-left`);
        const valueRight = document.querySelector(`.${ecran} #value-right`);
    
        sliderMin.addEventListener('input', function () {
            const minValue = parseInt(sliderMin.value, 10);
            const maxValue = parseInt(sliderMax.value, 10);
    
            // Empêche que le curseur gauche dépasse le droit
            if (minValue > maxValue) {
                sliderMin.value = maxValue;
            }
            valueLeft.textContent = `${sliderMin.value}€`;
    
            filtres_prix.min = parseInt(sliderMin.value, 10);
            afficherResultats(filtrage());
        });
    
        sliderMax.addEventListener('input', function () {
            const minValue = parseInt(sliderMin.value, 10);
            const maxValue = parseInt(sliderMax.value, 10);
    
            // Empêche que le curseur droit passe en dessous du gauche
            if (maxValue < minValue) {
                sliderMax.value = minValue;
            }
            valueRight.textContent = `${sliderMax.value}€`;
    
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
    
            // Vérification du filtre "ouvert/fermé"
            const ouvertOK = (() => {
                const radioOuvert = document.querySelector(`.${ecran} .filtre-ouvert input[type="radio"]:checked`);
                if (ecran === 'desktop') {
                    if (!radioOuvert || radioOuvert.id === 'tout') return true; // Pas de filtre sélectionné
                    const filtreOuvert = radioOuvert.id;
                    // Appliquer uniquement aux offres de "Restauration"
                    if (offre.classList.contains('Restauration')) {
                        // Vérification du statut "ouvert/fermé"
                        if (filtreOuvert === 'ouvert' && offre.classList.contains('ferme')) return false;
                        if (filtreOuvert === 'ferme' && offre.classList.contains('ouvert')) return false;
                    }
                } else if (ecran === 'mobile') {
                    if (!radioOuvert || radioOuvert.id === 'Tout') return true; // Pas de filtre sélectionné
                    const filtreOuvert = radioOuvert.id;
                    // Appliquer uniquement aux offres de "Restauration"
                    if (offre.classList.contains('Restauration')) {
                        // Vérification du statut "ouvert/fermé"
                        if (filtreOuvert === 'Ouvert' && offre.classList.contains('ferme')) return false;
                        if (filtreOuvert === 'Ferme' && offre.classList.contains('ouvert')) return false;
                    }
                }
                return true;

            })();
    
            // Retourner si l'offre passe tous les filtres
            return checkboxesOK && tempsOK && prixOK && ouvertOK;
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

        Array.from(rechercheIMG).forEach(rechercheIMG => {
            rechercheIMG.addEventListener('click', function () {
                const rechercheOffre = document.querySelector('.rechercheOffre'); // Suppose qu'il y a une seule `rechercheOffre`
                if (rechercheOffre) {
                    rechercheOffre.value = ''; // Vide le champ
                }
                rechercheIMG.src = '../images/search_icon.png';
                rechercheIMG.style.cursor = 'default';
        
                afficherResultats(filtrage()); // Exécution des fonctions
            });
        });
    });

    // Fonction pour afficher uniquement les offres filtrées
    function afficherResultats(offresVisibles) {
        trie(offresVisibles);
    
        const rechercheTexte = rechercheOffre.value.toLowerCase();

        offresVisibles = offresVisibles.filter(offre => {
            const offreTexte = offre.textContent.toLowerCase();
            const offreCategorie = offre.getAttribute('data-categorie').toLowerCase();
            const offreTitre = offre.getAttribute('data-titre').toLowerCase();
            const offreDescription = offre.getAttribute('data-desc').toLowerCase();
            return offreTexte.includes(rechercheTexte) || offreCategorie.includes(rechercheTexte) || offreTitre.includes(rechercheTexte) || offreDescription.includes(rechercheTexte);
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

    const rechercheLieux = Array.from(document.getElementsByClassName('rechercheLieu'));
    const lieux = Array.from(document.getElementsByClassName('lieu'));

    rechercheLieux.forEach(rechercheLieu => {
        rechercheLieu.addEventListener('input', function () {
            const rechercheTexte = rechercheLieu.value.toLowerCase();

            if (rechercheTexte !== '') {
                const rechercheIMG = rechercheLieu.nextElementSibling; // Suppose que l'image est juste après l'input
                rechercheIMG.src = '../images/croix-noire.png';
                rechercheIMG.style.cursor = 'pointer';

                rechercheIMG.addEventListener('click', function () {
                    rechercheLieu.value = '';
                    rechercheIMG.src = '../images/search_icon.png';
                    rechercheIMG.style.cursor = 'default';

                    lieux.forEach(lieu => {
                        lieu.style.display = 'block';
                        lieu.classList.remove('hidden');
                    });
                });

                lieux.forEach(lieu => {
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
                lieux.forEach(lieu => {
                    lieu.style.display = 'block';
                });

                const rechercheIMG = rechercheLieu.nextElementSibling;
                rechercheIMG.src = '../images/search_icon.png';
                rechercheIMG.style.cursor = 'default';
            }
        });
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

    afficherResultats(filtrage()); // Pour afficher les offres au tout début (sans filtres) afin que les offres à la Une soient prioritaires



    // Fonctionnalité de recherche par mots-clés récents
    const suggestionsContainer = document.createElement('ul');
    suggestionsContainer.classList.add('suggestions');
    document.body.appendChild(suggestionsContainer);

    const MAX_MOTS_CLES = 5; // Nombre maximum de mots-clés récents à stocker
    const NB_MAX_LENGTH = 18; // Nombre maximum de caractères pour un mot-clé
    const MOTS_CLES_STORAGE_KEY = 'motsClesRecents'; // Nom de la clé pour localStorage

    // Charger les mots-clés récents depuis localStorage
    function chargerMotsClesRecents() {
        const motsCles = localStorage.getItem(MOTS_CLES_STORAGE_KEY);
        return motsCles ? JSON.parse(motsCles) : [];
    }

    // Sauvegarder les mots-clés récents dans localStorage
    function sauvegarderMotsClesRecents(motsCles) {
        localStorage.setItem(MOTS_CLES_STORAGE_KEY, JSON.stringify(motsCles));
    }

    // Ajouter un mot-clé dans les récents
    function ajouterMotCleRecent(motCle) {
        let motsCles = chargerMotsClesRecents();
        motCle = motCle.trim().toLowerCase();

        if (!motCle || motsCles.includes(motCle)) return;

        // Ajouter le nouveau mot-clé et limiter la taille de la liste
        motsCles.unshift(motCle);
        if (motsCles.length > MAX_MOTS_CLES) {
            motsCles.pop();
        }
        sauvegarderMotsClesRecents(motsCles);
    }

        
    // Écouter les événements de clic sur chaque suggestion (div)
    suggestionsContainer.addEventListener('mousedown', function (event) {
        // Si l'événement provient de la croix
        if (event.target.classList.contains('close-icon')) {
            const suggestionDiv = event.target.closest('li');
            const motCle = suggestionDiv.querySelector('span').textContent;
            
            // Empêcher la propagation de l'événement click au conteneur parent (le <li>)
            event.stopPropagation();

            // Retirer la suggestion de l'historique
            retirerSuggestion(motCle);
        }
    });

    // Modifier la fonction d'affichage des suggestions
    function afficherSuggestions(textRecherche) {
        // Assurez-vous que textRecherche est une chaîne de caractères
        if (typeof textRecherche !== 'string') {
            console.log("textRecherche n'est pas une chaîne valide :", textRecherche);
            textRecherche = '';
        }

        const motsCles = chargerMotsClesRecents(); // Charger les mots-clés récents
        suggestionsContainer.innerHTML = ''; // Réinitialiser le conteneur

        console.log("afficherSuggestions");

        // Filtrer les mots-clés selon la recherche
        let motsFiltres;
        if (textRecherche !== '') {
            motsFiltres = motsCles.filter(motCle =>
                motCle.toLowerCase().includes(textRecherche.toLowerCase())
            );
        } else {
            motsFiltres = motsCles;
        }

        console.log("Mots filtrés :", motsFiltres);

        // Si aucune suggestion, cacher le conteneur
        if (motsFiltres.length === 0) {
            suggestionsContainer.style.display = 'none';
            return;
        }

        // Réafficher le conteneur pour les suggestions
        suggestionsContainer.style.display = 'block';

        // Ajouter chaque mot-clé comme élément de liste
        motsFiltres.forEach(motCle => {
            // Troncature si nécessaire
            let motTemp;
            if (motCle.length > NB_MAX_LENGTH) {
                motTemp = motCle.substring(0, NB_MAX_LENGTH) + '...';
            }

            // Créer un élément <li>
            const li = document.createElement('li');
            
            // Créer un div pour la suggestion
            const suggestionDiv = document.createElement('div');
            suggestionDiv.classList.add('suggestion-item'); // Classe pour la suggestion

            // Créer un élément pour le texte de la suggestion
            const textDiv = document.createElement('span');
            textDiv.textContent = motTemp || motCle; // Utiliser le texte tronqué si nécessaire
            suggestionDiv.appendChild(textDiv);

            // Créer l'élément pour l'image de la croix
            const closeIcon = document.createElement('img');
            closeIcon.src = '../images/croix-noire.png';  // Image de la croix
            closeIcon.alt = 'Supprimer';
            closeIcon.classList.add('close-icon');  // Classe pour le style de la croix
            suggestionDiv.appendChild(closeIcon);

            // Ajouter l'élément div au li
            li.appendChild(suggestionDiv);

            // Attacher un écouteur d'événement pour gérer le clic sur la suggestion
            li.addEventListener('mousedown', function () {
                rechercheOffre.value = motCle; // Mettre le mot-clé dans le champ de recherche
                afficherResultats(filtrage()); // Effectuer la recherche
                suggestionsContainer.style.display = 'none'; // Masquer les suggestions
            });

            // Gestion du clic sur la croix pour supprimer une suggestion
            closeIcon.addEventListener('mousedown', function (e) {
                e.stopPropagation(); // Empêcher le clic de déclencher d'autres actions (comme remplir le champ)
                e.preventDefault(); // Empêcher les comportements par défaut si nécessaires
                retirerSuggestion(motCle); // Supprime le mot clé de l'historique
                afficherSuggestions(rechercheOffre.value); // Met à jour les suggestions
            });


            // Ajouter l'élément <li> au conteneur
            suggestionsContainer.appendChild(li);
        });

        // Positionner dynamiquement le conteneur sous le champ de texte
        const rect = rechercheOffre.getBoundingClientRect();
        suggestionsContainer.style.top = `${rect.bottom}px`;
        suggestionsContainer.style.left = `${rect.left}px`;
        suggestionsContainer.style.width = `${rect.width}px`;
    }

    

    // Fonction pour retirer un mot-clé de l'historique
    function retirerSuggestion(motCle) {
        let motsCles = chargerMotsClesRecents();
        motsCles = motsCles.filter(mot => mot !== motCle); // Retirer le mot de l'historique
        sauvegarderMotsClesRecents(motsCles); // Sauvegarder l'historique mis à jour
    }
        

    // Cacher les suggestions
    function cacherSuggestions() {
        suggestionsContainer.style.display = 'none';
    }

    // Événement pour enregistrer un mot-clé à chaque recherche
    // Fonction pour ajouter le mot-clé lors de différents événements
    function ajouterMotCleDepuisRecherche() {
        let motCle = rechercheOffre.value.trim();

        if (motCle) {
            ajouterMotCleRecent(motCle);
        }
    }

    // Gestion de l'événement "Entrée" dans le champ de recherche
    rechercheOffre.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            ajouterMotCleDepuisRecherche();
            afficherResultats(filtrage());
            cacherSuggestions();
        }
    });

    rechercheOffre.addEventListener('blur', function () {
        // Utiliser un setTimeout pour différer l'exécution après le clic sur une suggestion ou la croix
        setTimeout(() => {
            const activeElement = document.activeElement;
    
            // Vérifiez si l'élément actif est lié aux suggestions (li ou croix)
            if (
                !activeElement.closest('#suggestionsContainer') &&
                !activeElement.classList.contains('close-icon')
            ) {
                // Ajouter la recherche récente seulement si ce n'est pas une suppression
                if (rechercheOffre.value.trim() !== '') {
                    ajouterMotCleDepuisRecherche();
                }
                cacherSuggestions();
            }
        }, 200); // 200 ms suffisent pour gérer les clics
    });
    

    // Gestion du clic sur la croix d'effacement
    const rechercheOffreIMG = document.getElementById('rechercheOffreIMG');
    rechercheOffreIMG.addEventListener('click', function () {
        if (rechercheOffre.value.trim() !== '') {
            ajouterMotCleDepuisRecherche();
        }
        rechercheOffre.value = ''; // Réinitialiser la recherche
        rechercheOffreIMG.src = '../images/search_icon.png'; // Réinitialiser l'icône
        rechercheOffreIMG.style.cursor = 'default';
        afficherResultats(filtrage());
    });

    // Afficher les suggestions lors du focus sur le champ
    rechercheOffre.addEventListener('focus', function () {
        console.log("focus");
        afficherSuggestions(rechercheOffre.value.trim());
    });

    // Mettre à jour les suggestions lors de la saisie
    rechercheOffre.addEventListener('input', function () {
        const textRecherche = rechercheOffre.value.trim();
        afficherSuggestions(textRecherche); // Toujours afficher les suggestions, même si le champ est vide
    });

    // Cacher les suggestions lorsqu'on clique ailleurs
    document.addEventListener('click', function (e) {
        if (!rechercheOffre.contains(e.target) && !suggestionsContainer.contains(e.target)) {
            cacherSuggestions();
        }
    });

    // Initialisation des suggestions au chargement
    cacherSuggestions();
});
