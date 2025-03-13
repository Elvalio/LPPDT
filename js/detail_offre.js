if(document.getElementById("etoile_note1") !== null){

    const etoile_plein = "../icons/etoile_bleue.png";
    const etoile_vide= "../icons/etoile_bleue_vide.png";
    let etoile1 = document.getElementById("etoile_note1");
    let etoile2 = document.getElementById("etoile_note2");
    let etoile3 = document.getElementById("etoile_note3");
    let etoile4 = document.getElementById("etoile_note4");
    let etoile5 = document.getElementById("etoile_note5");

    let nbr_etoile = document.getElementById("nbr_etoile");

    // initialisation étoile
    let initNote = document.getElementById("nbr_etoile");
    if(initNote.value === ''){
        etoile1.src=(etoile_vide);
        etoile2.src=(etoile_vide);
        etoile3.src=(etoile_vide);
        etoile4.src=(etoile_vide);
        etoile5.src=(etoile_vide);

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
    }else if(initNote.value === "1"){
        etoile1.src=(etoile_plein);
        etoile2.src=(etoile_vide);
        etoile3.src=(etoile_vide);
        etoile4.src=(etoile_vide);
        etoile5.src=(etoile_vide);
    }else if(initNote.value === "2"){
        etoile1.src=(etoile_plein);
        etoile2.src=(etoile_plein);
        etoile3.src=(etoile_vide);
        etoile4.src=(etoile_vide);
        etoile5.src=(etoile_vide);
    }else if(initNote.value === "3"){
        console.log(3);
        etoile1.src=(etoile_plein);
        etoile2.src=(etoile_plein);
        etoile3.src=(etoile_plein);
        etoile4.src=(etoile_vide);
        etoile5.src=(etoile_vide);
    }else if(initNote.value === "4"){
        etoile1.src=(etoile_plein);
        etoile2.src=(etoile_plein);
        etoile3.src=(etoile_plein);
        etoile4.src=(etoile_plein);
        etoile5.src=(etoile_vide);
    }else{
        etoile1.src=(etoile_plein);
        etoile2.src=(etoile_plein);
        etoile3.src=(etoile_plein);
        etoile4.src=(etoile_plein);
        etoile5.src=(etoile_plein);
    }


    etoile1.addEventListener("click", modif_etoile);
    etoile2.addEventListener("click", modif_etoile);
    etoile3.addEventListener("click", modif_etoile);
    etoile4.addEventListener("click", modif_etoile);
    etoile5.addEventListener("click", modif_etoile);


    function modif_etoile(event){
        let etoileid = event.target.id;
        
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

// document.addEventListener("DOMContentLoaded", () => {
//     const signalButtons = document.querySelectorAll('.btn-signaler'); // Sélectionne tous les boutons "Signaler"
//     const popup = document.getElementById('popup');
//     const closeBtn = popup.querySelector('.close-btn');
//     const progressBar = popup.querySelector('.progress-bar div');

//     let timeout;

//     signalButtons.forEach((button) => {
//         button.addEventListener('click', () => {
//             // Réinitialiser l'animation de la barre
//             progressBar.style.animation = 'none';
//             progressBar.offsetHeight; // Déclenche un reflow pour redémarrer l'animation
//             progressBar.style.animation = ''; // Restaurer l'animation


//             popup.classList.add('active');
//             clearTimeout(timeout);
//             timeout = setTimeout(() => {
//                 popup.classList.remove('active');
//             }, 4000);
//         });
//     });

//     closeBtn.addEventListener('click', () => {
//         popup.classList.remove('active');
//         clearTimeout(timeout);
//     });
// });


function toggle_reponse() {
    var form = document.getElementById("form_reponse");
    if (form.style.display == "none") {
        form.style.display = "inline";
    }
    else {
        form.style.display = "none";
    }
}



const likeButton = document.querySelectorAll('[id^="likeButton"]');
const dislikeButton = document.querySelectorAll('[id^="dislikeButton"]');
const likesCount = document.querySelectorAll('[id^="likesCount"]');
const dislikesCount = document.querySelectorAll('[id^="dislikesCount"]');

likeButton.forEach(button => {
    button.addEventListener("click", async () => {

        datas = event.target.id.split('_');
        console.log(datas);
        const data = {
            id_compte: datas[1],
            id_avis: datas[2],
        };
    
        try {
            
            const response = await fetch('../pages/update_like.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });
    
            if (response.ok) {
                
                const result = await response.json();
                console.log(result);
                const likesCount = button.closest('.like-dislike').querySelector(`[id^="likesCount_${datas[2]}"]`);
                const dislikesCount = button.closest('.like-dislike').querySelector(`[id^="dislikesCount_${datas[2]}"]`);
                console.log(likesCount);
                if (result.nbr_likes !== undefined) {
                    console.log(result.nbr_likes);
                    likesCount.textContent = result.nbr_likes;
                    dislikesCount.textContent = result.nbr_dislikes;
                }
            } else {
                console.error('Erreur HTTP:', response.status);
            }
        } catch (error) {
            console.error('Erreur réseau:', error);
        }
    });
    }
);

dislikeButton.forEach(button => {
    button.addEventListener("click", async () => {

        datas = event.target.id.split('_');
        console.log(datas);
        const data = {
            id_compte: datas[1],
            id_avis: datas[2],
        };
    
        try {
            
            const response = await fetch('../pages/update_dislike.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });
    
            if (response.ok) {
                
                const result = await response.json();
                console.log(result);
                const dislikesCount = button.closest('.like-dislike').querySelector(`[id^="dislikesCount_${datas[2]}"]`);
                const likesCount = button.closest('.like-dislike').querySelector(`[id^="likesCount_${datas[2]}"]`);
                console.log(dislikesCount);
                if (result.nbr_dislikes !== undefined) {
                    console.log(result.nbr_dislikes);
                    dislikesCount.textContent = result.nbr_dislikes;
                    likesCount.textContent = result.nbr_likes;
                }
            } else {
                console.error('Erreur HTTP:', response.status);
            }
        } catch (error) {
            console.error('Erreur réseau:', error);
        }
    });
    }
);

const signalerAvisBtn = document.querySelectorAll('[id^="btn_signaler_avis"]');
console.log(signalerAvisBtn);
const signalerReponseBtn = document.querySelectorAll('[id^="btn_signaler_reponse"]');

const blacklistBtn = document.querySelectorAll('.btn-blacklist');
const blacklistBtnRev = document.querySelectorAll('.btn-blacklist-rev');
console.log(blacklistBtn);

const popupWarn = document.getElementById('popup');
const closeBtn = popupWarn.querySelector('.close-btn');
const progressBar = popupWarn.querySelector('.progress-bar div');


document.querySelectorAll('.btn-signaler').forEach(button => {
    // Récupérer l'état initial depuis localStorage
    const buttonId = button.id; // Utiliser l'ID unique du bouton pour l'identifier
    const isAlreadySignaled = localStorage.getItem(`signal_${buttonId}`) === 'true';

    if (isAlreadySignaled) {
        // Désactiver le bouton et mettre à jour le style s'il a déjà été signalé
        button.disabled = true;
        button.style.cursor = 'not-allowed';
        button.style.opacity = '0.5';
        button.querySelector('p').textContent = 'Déjà signalé';
    }

    // Ajouter l'écouteur d'événement pour le clic
    button.addEventListener("click", async () => {
        const datas = button.id.split('_');
        console.log(datas);
        console.log(event.target.id);

        const data = {
            id_compte: datas[3],
            id_avis: datas[4],
        };

        try {
            let confirmation = confirm("Voulez-vous signaler cet avis ?");
            if (confirmation) {
                const response = await fetch('../pages/update_signal_avis.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    let timeout;

                    // Désactiver le bouton et mettre à jour le style
                    button.disabled = true;
                    button.style.cursor = 'not-allowed';
                    button.style.opacity = '0.5';
                    button.querySelector('p').textContent = 'Déjà signalé';

                    // Sauvegarder l'état dans localStorage
                    localStorage.setItem(`signal_${buttonId}`, 'true');

                    // Réinitialiser l'animation de la barre
                    progressBar.style.animation = 'none';
                    progressBar.offsetHeight; // Déclenche un reflow pour redémarrer l'animation
                    progressBar.style.animation = ''; // Restaurer l'animation

                    // Afficher le popup de confirmation
                    popupWarn.classList.add('active');
                    clearTimeout(timeout);
                    timeout = setTimeout(() => {
                        popupWarn.classList.remove('active');
                    }, 4000);
                } else {
                    console.error('Erreur HTTP:', response.status);
                }
            }
        } catch (error) {
            console.error('Erreur réseau:', error);
        }
    });
});

// Gestion du bouton de fermeture du popup
if (closeBtn) {
    closeBtn.addEventListener('click', () => {
        popupWarn.classList.remove('active');
    });
}


signalerReponseBtn.forEach(button => {

    
    button.addEventListener("click", async () => {

        datas = button.id.split('_');
        console.log(datas);
        console.log(event.target.id)
        const data = {
            id_compte: datas[3],
            id_avis: datas[4],
        };
    
        try {
            
            const response = await fetch('../pages/update_signal_reponse.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });
    
            if (response.ok) {
                let timeout;

            // Désactiver le bouton et mettre à jour le style
            button.disabled = true;
            button.style.cursor = 'not-allowed';
            button.style.opacity = '0.5';
            button.querySelector('p').textContent = 'Déjà signalé';

            
            // Réinitialiser l'animation de la barre
            progressBar.style.animation = 'none';
            progressBar.offsetHeight; // Déclenche un reflow pour redémarrer l'animation
            progressBar.style.animation = ''; // Restaurer l'animation

            popupWarn.classList.add('active');
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                popupWarn.classList.remove('active');
            }, 4000);
                
                
            } else {
                console.error('Erreur HTTP:', response.status);
            }
        } catch (error) {
            console.error('Erreur réseau:', error);
        }
    });
    },

    closeBtn.addEventListener('click', () => {
        popupWarn.classList.remove('active');
        clearTimeout(timeout);
    })
);

/* popup blacklist*/

var modal = document.getElementById('modal');

//TEST DES DONNES DU FORMULAIRE
function check_actif() {
    var valide = true;
    let semaine = document.getElementById('semaine').value;
    console.log(semaine);
    if (semaine === "" || isNaN(semaine)) {
        console.log("semaine");
        document.getElementById('warning-semaine').innerHTML = 'Saisir un chiffre';
        valide = false;
    }

    return valide;
}

const onClickOutside = (e) => {
    if (!modal.contains(e.target) && modal.style.display == "block") {
        modal.style.display = "none";
        window.removeEventListener("click",onClickOutside);
    }
};

// Bouton pour menu blacklistage
blacklistBtn.forEach(button => {
    var menu = button.nextElementSibling;
    button.addEventListener("click", async () => {
        if (menu.style.display == 'none') {
            menu.style.display = 'flex';
        }else{
            menu.style.display = 'none';
        }
    });
    },
);

// Bouton pour blacklistage temporaire
blacklistBtnRev.forEach(button => {
    button.addEventListener("click", async () => {
        document.getElementById('semaine').value = "";
        document.getElementById('warning-semaine').innerHTML = '';
        
        window.addEventListener("click",onClickOutside, true);
        
        modal.style.display = 'block';
        datas = button.id.split('_');

        button.parentElement.style.display = 'none';
    });
    },
);

// Bouron de soumission de la fenêtre modale
document.getElementById('modal-submit-button').addEventListener('click', async () => {
    if (check_actif()) {
        document.getElementById('warning-semaine').innerHTML = '';
        var data = {
            id_avis: datas[3],
            duree: document.getElementById('semaine').value,
            blacklist: "true"
        };
        console.log(JSON.parse(JSON.stringify(data)));
        console.log(JSON.stringify(data));

        // met à jour la bdd pour blacklister
        const response = await fetch('../pages/update_blacklist_avis.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        if (response.ok) {

            console.log('Réponse reçue!');

        } else {
            console.error('Erreur HTTP:', response.status);
        }
        
        modal.style.display = 'none';

    }
});

// bouton de fermeyture de la fenêtre modale
document.getElementById('modal-close').addEventListener('click', function() {
    modal.style.display = 'none';
});

/*
Popup confirmation signalement
document.addEventListener("DOMContentLoaded", () => {
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
*/