const overlay = document.getElementById('overlay');
const popup = document.getElementById('popup_suppr_compte');
const group = document.getElementById("group");
const croix = document.getElementById('croix_small');
const boutonSupprimer = document.getElementById("delete-btn-compte");


function updateBodyClass() {
    const body = document.body;
    
    if (window.innerWidth > 800) {
        popup.classList.add('desktop');
        popup.classList.remove('mobile');


        group.classList.add('desktop');
        group.classList.remove('mobile');



        croix.classList.add('desktop');
        croix.classList.remove('mobile');
    } else {
        popup.classList.add('mobile');
        popup.classList.remove('desktop');


        group.classList.add('mobile');
        group.classList.remove('desktop');



        croix.classList.add('mobile');
        croix.classList.remove('desktop');
    }
}


updateBodyClass();


boutonSupprimer.addEventListener('click', function() {
    popup.classList.add("montrer");
    overlay.classList.add("montrer");
});

document.getElementById('croix_small').addEventListener('click', function() {
    popup.classList.remove("montrer"); // Désactive l'effet
    overlay.classList.remove("montrer");
});

overlay.addEventListener('click', function () {
    popup.classList.remove("montrer"); // Désactive l'effet
    overlay.classList.remove("montrer");
});
