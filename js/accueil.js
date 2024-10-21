document.addEventListener('DOMContentLoaded', function () {
    // Variables existantes
    const boutons = document.querySelectorAll('.NouveauALaUne > div');
    const dropdownToggle = document.querySelector('.dropdown-toggle');
    const dropdown = document.querySelector('.dropdown');
    const fleche = document.querySelector('.dropdown-toggle > img');
    const dropdownMenu = document.querySelector('.dropdown-menu');
    const menuItems = dropdownMenu.querySelectorAll('li');
    const bouton_filtre = document.querySelector('.filtrer-bouton');
    const filtres = document.querySelector('.all-filter');
    const items_filters = document.querySelectorAll('.filter');
    const fleche_filtre = document.querySelector('.filtrer-bouton > img');
    const main = document.querySelector('main');

    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    function closeDropdown() {
        if (dropdown.classList.contains('active')) {
            dropdown.classList.remove('active');
            dropdownMenu.classList.remove('show');
            menuItems.forEach((item) => {
                item.classList.remove('show');
            });
            fleche.classList.remove('rotate-180');
        }
    }

    function closeFilterMenu() {
        if (filtres.classList.contains('active')) {
            filtres.classList.remove('active');
            items_filters.forEach((item) => {
                item.classList.remove('show');
            });
            fleche_filtre.classList.remove('rotate-180');
            main.classList.remove('active_filter');
        }
    }

    // Gestion des boutons "Nouveau" et "À la une"
    boutons.forEach(bouton => {
        bouton.addEventListener('click', function () {
            this.classList.toggle('active');

            const img = this.querySelector('img');
            img.classList.toggle('show');

            if (this.classList.contains('active')) {
                this.style.backgroundColor = '#2C2C2C';
                this.querySelector('p').style.color = '#F5F5F5';
            } else {
                this.style.backgroundColor = '#F5F5F5';
                this.querySelector('p').style.color = '#757575';
            }
        });
    });

    // Gestion du menu Filtres
    bouton_filtre.addEventListener('click', async function (event) {
        event.preventDefault();
        closeDropdown(); // Ferme le menu "Trier par"

        if (filtres.classList.contains('active')) {
            main.classList.toggle('active_filter');
        } else {
            main.classList.toggle('active_filter');
            await sleep(250);
        }

        filtres.classList.toggle('active');
        fleche_filtre.classList.toggle('rotate-180');

        if (filtres.classList.contains('active')) {
            main.classList.toggle('active_filter');
            items_filters.forEach((item) => {
                item.classList.add('show');
            });
        } else {
            items_filters.forEach((item) => {
                item.classList.remove('show');
            });
            main.classList.toggle('active_filter');
        }
    });

    // Gestion du menu déroulant "Trier par"
    dropdownToggle.addEventListener('click', function (event) {
        event.preventDefault();
        closeFilterMenu(); // Ferme le menu "Filtrer par"

        dropdown.classList.toggle('active');
        fleche.classList.toggle('rotate-180');

        if (dropdown.classList.contains('active')) {
            dropdownMenu.classList.add('show');
            menuItems.forEach((item, index) => {
                setTimeout(() => {
                    item.classList.add('show');
                }, index * 100);
            });
        } else {
            menuItems.forEach((item) => {
                item.classList.remove('show');
            });
            dropdownMenu.classList.remove('show');
        }
    });

    // Ferme le menu si on clique en dehors
    document.addEventListener('click', function (event) {
        if (!dropdown.contains(event.target) && event.target !== dropdownToggle) {
            closeDropdown();
        }
        // if (!filtres.contains(event.target) && event.target !== bouton_filtre) {
        //     closeFilterMenu();
        // }
    });

    // Code du slider double
    const sliderLeft = document.getElementById('slider-left');
    const sliderRight = document.getElementById('slider-right');
    const valueLeft = document.getElementById('value-left');
    const valueRight = document.getElementById('value-right');
    const rangeActive = document.createElement('div'); // Crée un élément pour la plage active
    rangeActive.classList.add('range-active');
    document.querySelector('.slider-container').appendChild(rangeActive);
    const validerPrix = document.querySelector('#valider-prix');

    const minGap = 50; // Espace minimum entre les deux sliders

    // Fonction pour mettre à jour la plage active et les positions des valeurs
    function updateSliderValues() {
        const leftValue = parseInt(sliderLeft.value);
        const rightValue = parseInt(sliderRight.value);

        // Mise à jour des positions des curseurs
        valueLeft.textContent = leftValue + "€";
        valueRight.textContent = rightValue + "€";

        // Calcul des positions de la plage active
        const percentLeft = (leftValue / sliderLeft.max) * 100;
        const percentRight = (rightValue / sliderRight.max) * 100;

        // Met à jour la largeur et la position de la plage active
        rangeActive.style.left = percentLeft + '%';
        rangeActive.style.width = (percentRight - percentLeft) + '%';

        // Met à jour dynamiquement la position des valeurs sous les curseurs
        valueLeft.style.left = `calc(${percentLeft}% - 20px)`;  // Centrer sous le curseur
        valueRight.style.left = `calc(${percentRight}% - 20px)`;  // Centrer sous le curseur
    }

    // Empêcher les sliders de se chevaucher
    sliderLeft.addEventListener('input', function () {
        if (parseInt(sliderLeft.value) > parseInt(sliderRight.value) - minGap) {
            sliderLeft.value = parseInt(sliderRight.value) - minGap;
        }
        updateSliderValues();
        validerPrix.classList.add('active');
    });

    sliderRight.addEventListener('input', function () {
        if (parseInt(sliderRight.value) < parseInt(sliderLeft.value) + minGap) {
            sliderRight.value = parseInt(sliderLeft.value) + minGap;
        }
        updateSliderValues();
        validerPrix.classList.add('active');
    });

    // Initialisation
    updateSliderValues();
});
