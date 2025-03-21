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



// test photo profile

document.getElementById("photo-profil").addEventListener("click", function() {
    document.getElementById("insert-image").click();
});

document.getElementById("upload-photo").addEventListener("change", function(event) {
    let file = event.target.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("photo-profil").src = e.target.result;
        };
        reader.readAsDataURL(file);

        // Envoyer l'image au serveur via AJAX
        let formData = new FormData();
        formData.append("image-profil", file);

        fetch("upload.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Image mise à jour avec succès !");
            } else {
                alert("Erreur lors de l'upload !");
            }
        })
        .catch(error => console.error("Erreur:", error));
    }
});