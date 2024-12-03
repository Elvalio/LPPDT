document.addEventListener('DOMContentLoaded', function () {
    const boutonALaUne = document.querySelector('.boutonALaUne'); // Bouton "À la Une"
    const offres = document.querySelectorAll('.carte_offre');    // Toutes les offres

    // Fonction pour filtrer les offres "À la Une"
    function filtrerParBouton() {
        const offresFiltrees = Array.from(offres).filter(offre => {
            const estALaUne = boutonALaUne.classList.contains('active') && offre.classList.contains('aLaUne');
            return estALaUne || !boutonALaUne.classList.contains('active');
        });
        afficherResultats(offresFiltrees);
    }

    // Fonction pour afficher les résultats filtrés
    function afficherResultats(offresVisibles) {
        offres.forEach(offre => {
            if (offresVisibles.includes(offre)) {
                offre.style.display = 'block';
            } else {
                offre.style.display = 'none';
            }
        });
    }

    // Gestion de l'état du bouton "À la Une"
    boutonALaUne.addEventListener('click', function () {
        boutonALaUne.classList.toggle('active'); // Alterne entre actif/inactif
        if (this.classList.contains('active')) {
            this.style.backgroundColor = '#2C2C2C';
            this.style.color = '#F5F5F5';
        } else {
            this.style.backgroundColor = '#F5F5F5';
            this.style.color = '#757575';
        }
        filtrerParBouton(); // Applique le filtrage
    });

    // Initialisation : affiche toutes les offres au départ
    afficherResultats(offres);
});


/*const boutonALaUne = document.querySelector('boutonALaUne');

boutonNouv.addEventListener("click", function(){
    if (this.classList.contains('active')) {
        this.style.backgroundColor = '#000000';
        this.classList.remove('active');
        
    } else {
        this.style.backgroundColor = '#9ED4E7';
        this.classList.add('active');
    }
});

function filtrerParBouton() {
    const offresVisibles = filtrage();
    const offresFiltrees = offresVisibles.filter(offre => {
        const estALaUne = Array.from(boutonALaUne).some(bouton => bouton.classList.contains('active')) && offre.classList.contains('aLaUne');
        return estALaUne || (!Array.from(boutonALaUne).some(bouton => bouton.classList.contains('active')));
    });
    afficherResultats(offresFiltrees);
}

function afficherResultats(offresVisibles) {
    offresVisibles.sort((a, b) => b.classList.contains('aLaUne') - a.classList.contains('aLaUne'));
    Array.from(offres).forEach(offre => {
        offre.style.display = offresVisibles.includes(offre) ? 'block' : 'none';
    });
}



let logo = document.getElementById("logo");
let recherche = document.getElementById("recherche");
function agrandirBarre(){
    logo.style.display = "none";
}

function afficheLogo(){
    logo.style.display = "block";
}
recherche.addEventListener("click", agrandirBarre);
recherche.addEventListener("blur", afficheLogo);*/
