document.addEventListener('DOMContentLoaded', function () {
    const boutons = document.querySelectorAll('.NouveauALaUne > div');
    const dropdownToggle = document.querySelector('.dropdown-toggle');
    const dropdown = document.querySelector('.dropdown');
    const fleche = document.querySelector('.dropdown-toggle > img')

    // Gestion des boutons "Nouveau" et "À la une"
    boutons.forEach(bouton => {
        bouton.addEventListener('click', function () {
            this.classList.toggle('active');

            // Affiche ou masque l'image de croix
            const img = this.querySelector('img');
            img.classList.toggle('show');

            // Change le style du fond et du texte
            if (this.classList.contains('active')) {
                this.style.backgroundColor = '#2C2C2C';
                this.querySelector('p').style.color = '#F5F5F5';
            } else {
                this.style.backgroundColor = '#F5F5F5';
                this.querySelector('p').style.color = '#757575';
            }
        });
    });

    // Gestion du menu déroulant "Trier par"
    dropdownToggle.addEventListener('click', function (event) {
        event.preventDefault(); // Empêche le comportement par défaut du lien
        dropdown.classList.toggle('active'); // Bascule la classe 'active'
        fleche.classList.toggle('rotate-180')
    });

    // Ferme le menu si on clique en dehors
    document.addEventListener('click', function (event) {
        if (!dropdown.contains(event.target) && event.target !== dropdownToggle) {
            dropdown.classList.remove('active');
        }
    });
});
