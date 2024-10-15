document.addEventListener('DOMContentLoaded', function () {
    const boutons = document.querySelectorAll('.NouveauALaUne > div');

    boutons.forEach(bouton => {
        bouton.addEventListener('click', function () {
            // Ajouter la classe 'active' au bouton cliqué
            this.classList.toggle('active');

            // Récupérer toutes les images dans la même div
            const img = this.querySelector('img');
            // Afficher ou masquer l'image
            img.classList.toggle('show');

            // Changer le style du fond et du texte
            if (this.classList.contains('active')) {
                this.style.backgroundColor = '#2C2C2C'; // Couleur de fond
                this.querySelector('p').style.color = '#F5F5F5'; // Couleur du texte
            } else {
                this.style.backgroundColor = '#F5F5F5'; // Couleur de fond par défaut
                this.querySelector('p').style.color = '#757575'; // Couleur du texte par défaut
            }
        });
    });
});
