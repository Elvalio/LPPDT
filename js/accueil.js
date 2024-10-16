document.addEventListener('DOMContentLoaded', function () {
    const boutons = document.querySelectorAll('.NouveauALaUne > div');
    const dropdownToggle = document.querySelector('.dropdown-toggle');
    const dropdown = document.querySelector('.dropdown');
    const fleche = document.querySelector('.dropdown-toggle > img');
    const dropdownMenu = document.querySelector('.dropdown-menu'); // Sélectionner le menu déroulant
    const menuItems = dropdownMenu.querySelectorAll('li'); // Sélectionner les éléments du menu

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
        fleche.classList.toggle('rotate-180');

        // Gestion de l'animation sur le menu déroulant
        if (dropdown.classList.contains('active')) {
            dropdownMenu.classList.add('show'); // Affiche le menu

            // Affiche chaque élément avec un délai
            menuItems.forEach((item, index) => {
                setTimeout(() => {
                    item.classList.add('show'); // Ajoute la classe 'show' à chaque élément
                }, index * 100); // Délai de 100ms entre chaque élément
            });
        } else {
            // Retire les animations des éléments lorsque le menu se ferme
            menuItems.forEach((item) => {
                item.classList.remove('show'); // Enlève la classe 'show'
            });
            dropdownMenu.classList.remove('show'); // Retire la classe 'show' du menu
        }
    });

    // Ferme le menu si on clique en dehors
    document.addEventListener('click', function (event) {
        if (!dropdown.contains(event.target) && event.target !== dropdownToggle) {
            dropdown.classList.remove('active');
            dropdownMenu.classList.remove('show'); // Retire la classe 'show' du menu
            // Retire les animations des éléments
            menuItems.forEach((item) => {
                item.classList.remove('show');
            });
        }
    });
});
