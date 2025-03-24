(function () {
    "use strict"; // Correction de la faute de frappe
    const slideTimeout = 3500; // Temps d'affichage de chaque slide
    const prev = document.querySelector('#prev');
    const next = document.querySelector('#next');
    const $slides = document.querySelectorAll('.slide');
    let $dots;
    let intervalId;
    let currentSlide = 0; // Index de la première slide (commence à 0)
    const totalSlides = $slides.length; // Nombre total de slides
    // Fonction pour afficher un slide spécifique
    function slideTo(index) {
        currentSlide = (index + totalSlides) % totalSlides; // Gestion des dépassements
        $slides.forEach(($elt, idx) => {
            $elt.style.transform = `translateX(-${currentSlide * 100}%)`;
        });
        $dots.forEach(($dot, idx) => {
            $dot.classList.toggle('active', idx === currentSlide);
            $dot.classList.toggle('inactive', idx !== currentSlide);
        });
    }
    // Fonction pour passer au slide suivant
    function showSlide() {
        slideTo(currentSlide + 1);
    }
    // Création des "dots" (indicateurs de pagination) en fonction du nombre de slides
    for (let i = 0; i < totalSlides; i++) {
        let dotClass = i === currentSlide ? 'active' : 'inactive';
        let $dot = document.createElement('span');
        $dot.dataset.slideId = i;
        $dot.className = `dot ${dotClass}`;
        document.querySelector('.carousel-dots').appendChild($dot);
    }
    $dots = document.querySelectorAll('.dot');

    // Ajout d'événements "click" sur les dots pour naviguer
    $dots.forEach(($dot, idx) => {
        $dot.addEventListener('click', () => {
            clearInterval(intervalId); // Stop l'intervalle temporairement
            slideTo(idx);
            intervalId = setInterval(showSlide, slideTimeout); // Redémarre l'intervalle
        });
    });
    // Ajout d'événements sur les boutons "prev" et "next"
    prev.addEventListener('click', () => {
        clearInterval(intervalId);
        slideTo(currentSlide - 1);
        intervalId = setInterval(showSlide, slideTimeout);
    });
    next.addEventListener('click', () => {
        clearInterval(intervalId);
        slideTo(currentSlide + 1);
        intervalId = setInterval(showSlide, slideTimeout);
    });
    // Initialisation de l'intervalle de défilement automatique
    intervalId = setInterval(showSlide, slideTimeout);
    // Ajout de gestion des interactions par la souris et le toucher (swipe)
    $slides.forEach($slide => {
        let startX, endX;
        // Stop le défilement auto lors d'un survol
        $slide.addEventListener('mouseover', () => clearInterval(intervalId), false);
        $slide.addEventListener('mouseout', () => intervalId = setInterval(showSlide, slideTimeout), false);
        // Gestion du swipe
        $slide.addEventListener('touchstart', (event) => {
            startX = event.touches[0].clientX;
        });
        $slide.addEventListener('touchend', (event) => {
            endX = event.changedTouches[0].clientX;
            if (startX > endX) {
                slideTo(currentSlide + 1);
            } else if (startX < endX) {
                slideTo(currentSlide - 1);
            }
            clearInterval(intervalId);
            intervalId = setInterval(showSlide, slideTimeout); // Redémarre après swipe
        });
    });
})();

document.addEventListener('DOMContentLoaded', function () {
    // Code pour changer les images en fonction de la taille de l'écran
    function updateImageSources() {
        const etoiles = document.querySelectorAll('img[alt="Etoile"], img[alt="Etoile Vide"]');
        const body = document.querySelector('body');
        console.log(etoiles);
        etoiles.forEach(etoile => {
            if (body.classList.contains('BO')) {
                etoile.src = etoile.src.replace("etoile_bleue", "etoile_rouge");
            } else {
                etoile.src = etoile.src.replace("etoile_rouge", "etoile_bleue");
            }
        });
    }

    updateImageSources();

    const overlay = document.getElementById('overlay');
    const popup = document.getElementById('popup_avis');
    const logo = document.getElementById("logo");
    const group = document.getElementById("group");
    const debutTitre = document.getElementById("debut");
    const finTitre = document.getElementById("fin");
    const groupFormulaire = document.querySelectorAll(".form-group");
    const connexionBouton = document.getElementById("connexion_popup");
    const croix = document.getElementById('croix');
    const boutonPublier = document.getElementById("bouton_publier");

    function updateBodyClass() {
        // const body = document.body;
        
        if (window.innerWidth > 800) {
            popup.classList.add('desktop');
            popup.classList.remove('mobile');

            logo.classList.add('desktop');
            logo.classList.remove('mobile');


            group.classList.add('desktop');
            group.classList.remove('mobile');

            debutTitre.classList.add('desktop');
            debutTitre.classList.remove('mobile');

            finTitre.classList.add('desktop');
            finTitre.classList.remove('mobile');

            groupFormulaire.forEach(groupF => {
                // Action à réaliser pour chaque élément avec la classe 'group'
                groupF.classList.add('desktop');
                groupF.classList.remove('mobile');
            });

            connexionBouton.classList.add('desktop');
            connexionBouton.classList.remove('mobile');

            croix.classList.add('desktop');
            croix.classList.remove('mobile');
        } else {
            popup.classList.add('mobile');
            popup.classList.remove('desktop');

            logo.classList.add('mobile');
            logo.classList.remove('desktop');

            group.classList.add('mobile');
            group.classList.remove('desktop');

            debutTitre.classList.add('mobile');
            debutTitre.classList.remove('desktop');

            finTitre.classList.add('mobile');
            finTitre.classList.remove('desktop');

            groupFormulaire.forEach(groupF => {
                // Action à réaliser pour chaque élément avec la classe 'group'
                groupF.classList.add('mobile');
                groupF.classList.remove('desktop');
            });

            connexionBouton.classList.add('mobile');
            connexionBouton.classList.remove('desktop');

            croix.classList.add('mobile');
            croix.classList.remove('desktop');
        }
    }

    // Initialisation au chargement de la page
    updateBodyClass();

    boutonPublier.addEventListener('click', function() {
        popup.classList.add("montrer");
        overlay.classList.add("montrer");
    });
    
    document.getElementById('croix').addEventListener('click', function() {
        popup.classList.remove("montrer"); // Désactive l'effet
        overlay.classList.remove("montrer");
    });
    
    overlay.addEventListener('click', function () {
        popup.classList.remove("montrer"); // Désactive l'effet
        overlay.classList.remove("montrer");
    });

    // Récupérer le formulaire
    const form = document.getElementById('formConnexion');
    const nbr_etoile = document.getElementById("nbr_etoile");
    const titreAvisRedige = document.getElementById('titre_avis');
    const contenuAvisRedige = document.getElementById('ecrire_avis');
    const contextAvisRedige = document.getElementById('options-contexte');

    const etoile = document.getElementById('etoile');
    const titreAvisRecu = document.getElementById('titreAvis');
    const contenuAvisRecu = document.getElementById('contenuAvis');
    const contextAvisRecu = document.getElementById('contextAvis');



    // Ajouter un gestionnaire pour l'événement submit
    form.addEventListener('submit', function(event) {
        titreAvisRecu.value = titreAvisRedige.value;
        contenuAvisRecu.value = contenuAvisRedige.value;
        contextAvisRecu.value = contextAvisRedige.value;
        if(nbr_etoile.value !== ''){
            etoile.value = nbr_etoile.value;
        } else {
            nbr_etoile.value = '1';
        }
        
        
    });

    // Écoute des changements de taille de la fenêtre
    window.addEventListener('resize', updateBodyClass);
});




