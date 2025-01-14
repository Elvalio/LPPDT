if(document.getElementById("etoile_note1") !== null){
    let etoile1 = document.getElementById("etoile_note1");
    let etoile2 = document.getElementById("etoile_note2");
    let etoile3 = document.getElementById("etoile_note3");
    let etoile4 = document.getElementById("etoile_note4");
    let etoile5 = document.getElementById("etoile_note5");

    let nbr_etoile = document.getElementById("nbr_etoile");


    etoile1.addEventListener("mouseover", modif_etoile);
    etoile2.addEventListener("mouseover", modif_etoile);
    etoile3.addEventListener("mouseover", modif_etoile);
    etoile4.addEventListener("mouseover", modif_etoile);
    etoile5.addEventListener("mouseover", modif_etoile);

    etoile1.addEventListener("mouseout", modif_etoile);
    etoile2.addEventListener("mouseout", modif_etoile);
    etoile3.addEventListener("mouseout", modif_etoile);
    etoile4.addEventListener("mouseout", modif_etoile);
    etoile5.addEventListener("mouseout", modif_etoile);

    etoile1.addEventListener("click", modif_etoile);
    etoile2.addEventListener("click", modif_etoile);
    etoile3.addEventListener("click", modif_etoile);
    etoile4.addEventListener("click", modif_etoile);
    etoile5.addEventListener("click", modif_etoile);


    function modif_etoile(event){
        let etoileid = event.target.id;
        let etoile_plein = "../icons/etoile_bleue.png";
        let etoile_vide= "../icons/etoile_bleue_vide.png";
        if(event.type === "mouseover"){
            if(etoileid === "etoile_note1"){
                etoile1.src=(etoile_plein);
            }else if(etoileid === "etoile_note2"){
                etoile1.src=(etoile_plein);
                etoile2.src=(etoile_plein);
            }else if(etoileid === "etoile_note3"){
                etoile1.src=(etoile_plein);
                etoile2.src=(etoile_plein);
                etoile3.src=(etoile_plein);
            }else if(etoileid === "etoile_note4"){
                etoile1.src=(etoile_plein);
                etoile2.src=(etoile_plein);
                etoile3.src=(etoile_plein);
                etoile4.src=(etoile_plein);
            }else{
                etoile1.src=(etoile_plein);
                etoile2.src=(etoile_plein);
                etoile3.src=(etoile_plein);
                etoile4.src=(etoile_plein);
                etoile5.src=(etoile_plein);
            }
        }else if(event.type==="mouseout"){
            if(etoileid === "etoile_note1"){
                etoile1.src=(etoile_vide);
            }else if(etoileid === "etoile_note2"){
                etoile1.src=(etoile_vide);
                etoile2.src=(etoile_vide);
            }else if(etoileid === "etoile_note3"){
                etoile1.src=(etoile_vide);
                etoile2.src=(etoile_vide);
                etoile3.src=(etoile_vide);
            }else if(etoileid === "etoile_note4"){
                etoile1.src=(etoile_vide);
                etoile2.src=(etoile_vide);
                etoile3.src=(etoile_vide);
                etoile4.src=(etoile_vide);
            }else{
                etoile1.src=(etoile_vide);
                etoile2.src=(etoile_vide);
                etoile3.src=(etoile_vide);
                etoile4.src=(etoile_vide);
                etoile5.src=(etoile_vide);
            }
        }else{
            if(etoileid === "etoile_note1"){
                etoile1.src=(etoile_plein);
                etoile2.src=(etoile_vide);
                etoile3.src=(etoile_vide);
                etoile4.src=(etoile_vide);
                etoile5.src=(etoile_vide);
                nbr_etoile.value = 1;
            }else if(etoileid === "etoile_note2"){
                etoile1.src=(etoile_plein);
                etoile2.src=(etoile_plein);
                etoile3.src=(etoile_vide);
                etoile4.src=(etoile_vide);
                etoile5.src=(etoile_vide);
                nbr_etoile.value = 2;
            }else if(etoileid === "etoile_note3"){
                etoile1.src=(etoile_plein);
                etoile2.src=(etoile_plein);
                etoile3.src=(etoile_plein);
                etoile4.src=(etoile_vide);
                etoile5.src=(etoile_vide);
                nbr_etoile.value = 3;
            }else if(etoileid === "etoile_note4"){
                etoile1.src=(etoile_plein);
                etoile2.src=(etoile_plein);
                etoile3.src=(etoile_plein);
                etoile4.src=(etoile_plein);
                etoile5.src=(etoile_vide);
                nbr_etoile.value = 4;
            }else{
                etoile1.src=(etoile_plein);
                etoile2.src=(etoile_plein);
                etoile3.src=(etoile_plein);
                etoile4.src=(etoile_plein);
                etoile5.src=(etoile_plein);
                nbr_etoile.value = 5;
            }

            etoile1.removeEventListener("mouseover", modif_etoile);
            etoile2.removeEventListener("mouseover", modif_etoile);
            etoile3.removeEventListener("mouseover", modif_etoile);
            etoile4.removeEventListener("mouseover", modif_etoile);
            etoile5.removeEventListener("mouseover", modif_etoile);

            etoile1.removeEventListener("mouseout", modif_etoile);
            etoile2.removeEventListener("mouseout", modif_etoile);
            etoile3.removeEventListener("mouseout", modif_etoile);
            etoile4.removeEventListener("mouseout", modif_etoile);
            etoile5.removeEventListener("mouseout", modif_etoile);
        }
    }
}

let boutons_supp = document.getElementsByName('bouton_supp');

function supp_avis(event) {
    let form = event.target.closest('form');
    let confirmation = confirm("Voulez-vous supprimer votre avis ?");
    if (confirmation) {
        form.submit();
        form.reset();
    }
}

boutons_supp.forEach(bouton => {
    bouton.addEventListener("click", supp_avis);
});

document.addEventListener("DOMContentLoaded", () => {
    const signalButtons = document.querySelectorAll('.btn-signaler'); // Sélectionne tous les boutons "Signaler"
    const popup = document.getElementById('popup');
    const closeBtn = popup.querySelector('.close-btn');
    const progressBar = popup.querySelector('.progress-bar div');

    let timeout;

    signalButtons.forEach((button) => {
        button.addEventListener('click', () => {
            // Réinitialiser l'animation de la barre
            progressBar.style.animation = 'none';
            progressBar.offsetHeight; // Déclenche un reflow pour redémarrer l'animation
            progressBar.style.animation = ''; // Restaurer l'animation

            popup.classList.add('active');
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                popup.classList.remove('active');
            }, 4000);
        });
    });

    closeBtn.addEventListener('click', () => {
        popup.classList.remove('active');
        clearTimeout(timeout);
    });
});


function toggle_reponse() {
    var form = document.getElementById("form_reponse");
    if (form.style.display == "none") {
        form.style.display = "inline";
    }
    else {
        form.style.display = "none";
    }
}
