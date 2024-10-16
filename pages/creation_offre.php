<?php
include_once'nav.php';
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Création d'offre</title>
        <link rel="stylesheet" href="../css/styleOffre.css">
        <link rel="stylesheet" href="../css/styleGeneral.css">
        
        
    </head>
    <body>
        <div class="main-content"> 
            <h1 class="TS-bold">Créez votre offre</h1>            
            <form action="#" method="post" enctype="multipart/form-data">
                <div id="form-content" class="FS">
                    <div id="left-part">
                        <div id="left-part-content">
                            <div id="title-categorie">
                                <!-- Champ "Titre" -->
                                <div class="container" id="titre-container">
                                    <label for="titre">Titre de l'offre*</label>
                                    <input type="text" id="titre" name="titre" placeholder="Saisir" required />
                                </div>
                                <!-- Champ "Catégorie" -->
                                <div class="container" id="categorie-container">
                                    <label for="categorie">Catégorie de l'offre*</label>
                                    <select id="categorie" name="categorie" required>
                                        <option value="" disabled selected hidden id="first-option">Catégorie de l'offre</option>
                                        <option value="activite">Activité</option>
                                        <option value="visite">Visite</option>
                                        <option value="spectacle">Spectacle</option>
                                        <option value="parcAttraction">Parc d'attraction</option>
                                        <option value="restauration">Restauration</option>
                                    </select>
                                </div>
                            </div>
                            <div id="commune-type">
                                <!-- Champ "Commune" -->
                                <div class="container" id="commune-container">
                                    <label for="commune">Commune*</label>
                                    <input type="text" id="commune" name="commune" placeholder="Saisir" required />
                                </div>
                                <!-- Champ "Type" -->
                                <div id="type-container">
                                    <label>Type d'offre</label>
                                    <div id="standard-premium">
                                        <div id="standard">
                                            <input type="radio" id="standard" name="offre" value="standard" />
                                            <label for="standard">Standard</label>
                                        </div>
                                        <div id="premium">
                                            <input type="radio" id="premium" name="offre" value="premium" />
                                            <label for="premium">Premium</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Champ "Résumé" -->
                            <div class="container" id="resume-container">
                                <label for="resume">Résumé*</label>
                                <input type="text" id="resume" name="resume" placeholder="Saisir" required />
                            </div>
                            <!-- Champ "Description" -->
                            <div class="container" id="description-container">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" rows="12" cols="60"></textarea>
                            </div>
                            <!-- Champ "Tags" -->
                            <div id="tag-container">
                                <label>Tags</label>
                                <div id="tags-items-container">
                                    <button class="tag" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Culturel</p>
                                    </button>
                                    <button class="tag" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Patrimoine</p>
                                    </button>
                                    <button class="tag" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Histoire</p>
                                    </button>
                                    <button class="tag" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Urbain</p>
                                    </button>
                                    <button class="tag" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Nature</p>
                                    </button>
                                    <button class="tag" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Plein air</p>
                                    </button>
                                    <button class="tag" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Sport</p>
                                    </button>
                                    <button class="tag" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Nautique</p>
                                    </button>
                                    <button class="tag" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Gastronomie</p>
                                    </button>
                                    <button class="tag" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Musée</p>
                                    </button>
                                    <button class="tag" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Atelier</p>
                                    </button>
                                    <button class="tag" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Musique</p>
                                    </button>
                                    <button class="tag" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Famille</p>
                                    </button>
                                    <button class="tag" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Cinéma</p>
                                    </button>
                                    <button class="tag" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Cirque</p>
                                    </button>
                                    <button class="tag" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Son et lumière</p>
                                    </button>
                                    <button class="tag" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Humour</p>
                                    </button>
                                </div>
                            </div>
                            <!-- Bouton de soumission -->
                            <div id="publier-retour">
                                <input type="submit" value="Publier" />
                                <button>
                                    <img src="../icons/arrow-left-o.svg" alt="Bouton Image">
                                    Retour
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="right-part">
                        <div id="right-part-content">
                            <!-- Champ "Adresse" -->
                            <div class="container" id="adresse-container">
                                <label for="adresse">Adresse</label>
                                <input type="text" id="adresse" name="adresse" placeholder="Saisir" required />
                            </div>
                            <!-- Champ "Accesibilité" -->
                            <div class="container" id="accessibilite-container">
                                <label for="accessibilite">Accessibilité</label>
                                <input type="text" id="accessibilite" name="accessibilite" placeholder="Saisir" required />
                            </div>
                            <!-- Champ "prix minimum" -->
                            <div class="container" id="prix-container">
                                <label for="prix">Prix minimum (€)</label>
                                <input type="text" id="prix" name="prix" placeholder="Saisir" required />
                            </div>
                            <!-- Champ "Options" -->
                            <div id="option-container">
                                <label>Options</label>
                                <div id="une-relief">
                                    <div id="une">
                                        <input type="radio" id="une" name="option" value="une" />
                                        <label for="une">À la Une </label>
                                    </div>
                                    <div id="relief">
                                        <input type="radio" id="relief" name="option" value="relief" />
                                        <label for="relief">En relief</label>
                                    </div>
                                </div>
                            </div>
                            <!---- Champs ajout image --->
                            <div id="file-container">
                                <label for="file-upload" id="custom-file-upload">
                                    <img src="../icons/plus.svg" alt="Bouton Image">
                                    Ajouter une image
                                </label>
                                <input type="file" id="file-upload" accept=".png"/>
                                <button id="file-delete" type="button">
                                    <img src="../icons/moins.svg" alt="Bouton Image">
                                    Supprimer une image
                                </button>
                            </div>
                            <p id="error-message" style="color: red; display: none;">Aucune image sélectionnée pour suppression !</p>
                            <!-- Éléments pour afficher les images importées -->
                            <div id="image-container">
                                <img class="selected-image" src="" alt="Image sélectionnée" />
                                <img class="selected-image" src="" alt="Image sélectionnée" />
                                <img class="selected-image" src="" alt="Image sélectionnée" />
                            </div>
                        </div>
                    </div>
                </div>      
            </form>
        </div>

        <script>
            // Récupérer tous les éléments avec la classe 'tag'
            const tags = document.getElementsByClassName('tag');
            // Sélectionne les éléments nécessaires
            const fileInput = document.getElementById('file-upload');
            const deleteButton = document.getElementById('file-delete');
            const imageContainer = document.getElementById('image-container');
            const selectedImages = document.querySelectorAll('.selected-image'); // Récupère toutes les images

            const errorMessage = document.getElementById('error-message');


            let currentImageCount = 0; // Compte le nombre d'images actuellement affichées
            let selectedImageIndex = -1; // Index de l'image actuellement sélectionnée pour la suppression 

            // Transformer la collection en tableau et ajouter un écouteur d'événements à chaque élément
            Array.from(tags).forEach(tag => {
                tag.addEventListener('click', function() {
                    this.classList.toggle('selectionne');  // Ajoute/enlève la classe 'selectionne'
                });
            });
            
            // Écoute l'événement de changement de l'input de fichier
            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0 && currentImageCount < selectedImages.length) {
                    const file = fileInput.files[0]; // Prendre le premier fichier
                    const reader = new FileReader(); // Créer un nouvel objet FileReader

                    reader.onload = function(e) {
                        const img = selectedImages[currentImageCount]; // Récupérer l'image à l'index actuel
                        img.src = e.target.result; // Mettre à jour la source de l'image
                        img.style.display = 'block'; // Afficher l'image
                        currentImageCount++; // Incrémenter le compteur d'images
                        deleteButton.style.display = 'block'; // Affiche le bouton de suppression si une image est présente
                    }

                    reader.readAsDataURL(file);
                    fileInput.value = ''; // Réinitialiser l'input pour permettre la sélection de la même image
                }
            });

            // Gérer le clic sur les images pour les sélectionner
            imageContainer.addEventListener('click', function(e) {
                const target = e.target;

                if (target.classList.contains('selected-image')) {
                    // Trouver l'index de l'image cliquée
                    const clickedIndex = Array.from(selectedImages).indexOf(target);

                    if (clickedIndex === selectedImageIndex) {
                        // Si l'image cliquée est déjà sélectionnée, la désélectionner
                        target.classList.remove('selected');
                        selectedImageIndex = -1; // Réinitialiser l'index (aucune image sélectionnée)
                    } else {
                        // Si une autre image est sélectionnée, réinitialiser la sélection de toutes les images
                        selectedImages.forEach(img => img.classList.remove('selected'));

                        // Sélectionner la nouvelle image
                        target.classList.add('selected');
                        selectedImageIndex = clickedIndex; // Mettre à jour l'index de l'image sélectionnée

                        // Cacher le message d'erreur dès qu'une image est sélectionnée
                        errorMessage.style.display = 'none'; // Cache le message d'erreur
                    }
                }
            });

            // Écoute l'événement de clic sur le bouton de suppression
            deleteButton.addEventListener('click', function() {
                // Vérifie s'il y a une image sélectionnée
                if (selectedImageIndex === -1) {
                    // Si aucune image n'est sélectionnée, affiche le message d'erreur
                    errorMessage.style.display = 'block'; // Affiche le message d'erreur
                } else {
                    // Supprimer l'image sélectionnée
                    const img = selectedImages[selectedImageIndex]; // Récupérer l'image à l'index actuel
                    img.src = ''; // Effacer la source de l'image
                    img.style.display = 'none'; // Masquer l'image
                    currentImageCount--; // Décrémenter le compteur d'images
                    selectedImageIndex = -1; // Réinitialiser l'index de sélection

                    // Réinitialiser la sélection de toutes les images
                    selectedImages.forEach(img => {
                        img.parentNode.classList.remove('selected'); // Retire la classe "selected" de toutes les images
                    });

                    // Cacher le bouton de suppression si toutes les images ont été supprimées
                    if (currentImageCount === 0) {
                        deleteButton.style.display = 'none'; // Cache le bouton à nouveau
                    }

                    // Cacher le message d'erreur si l'image a été supprimée avec succès
                    errorMessage.style.display = 'none';
                }
            });







// // Sélectionne les éléments nécessaires
// const fileInput = document.getElementById('file-upload');
// const deleteButton = document.getElementById('file-delete');
// const imageContainer = document.getElementById('image-container');
// const selectedImages = document.querySelectorAll('.selected-image'); // Récupère toutes les images

// let currentImageCount = 0; // Compte le nombre d'images actuellement affichées
// let selectedImageIndex = -1; // Index de l'image actuellement sélectionnée pour la suppression        

// // Écoute l'événement de changement de l'input de fichier
// fileInput.addEventListener('change', function() {
//     // Vérifie si des fichiers sont sélectionnés
//     if (fileInput.files.length > 0 && currentImageCount < selectedImages.length) {
//         const file = fileInput.files[0]; // Prendre le premier fichier
//         const reader = new FileReader(); // Créer un nouvel objet FileReader

//         // Fonction à exécuter une fois que le fichier est chargé
//         reader.onload = function(e) {
//             const img = Array.from(selectedImages).find(image => image.style.display === 'none');
            
//             if (img) {
//                 img.src = e.target.result; // Met à jour la source de l'image
//                 img.style.display = 'block'; // Affiche l'image
//                 currentImageCount++; // Incrémenter le compteur d'images
//                 deleteButton.style.display = 'block'; // Affiche le bouton de suppression
//             }
//         }

//         // Lire le fichier comme une URL de données
//         reader.readAsDataURL(file);
//         fileInput.value = ''; // Réinitialiser l'input pour permettre la sélection de la même image
//     }
// });

// // Gérer le clic sur les images pour les sélectionner
// imageContainer.addEventListener('click', function(e) {
//     const target = e.target;
//     if (target.classList.contains('selected-image')) {
//         // Trouver l'index de l'image cliquée
//         selectedImageIndex = Array.from(selectedImages).indexOf(target);
        
//         // Réinitialiser la sélection de toutes les images
//         selectedImages.forEach((img, index) => {
//             const wrapper = img.parentNode;
//             if (index === selectedImageIndex) {
//                 wrapper.classList.add('selected'); // Ajoute la classe "selected" à l'image sélectionnée
//             } else {
//                 wrapper.classList.remove('selected'); // Retire la classe "selected" des autres images
//             }
//         });
//     }
// });

// // Écoute l'événement de clic sur le bouton de suppression
// deleteButton.addEventListener('click', function() {
//     // Supprimer l'image sélectionnée
//     if (selectedImageIndex !== -1) { // S'il y a une image sélectionnée
//         const img = selectedImages[selectedImageIndex]; // Récupérer l'image à l'index actuel
//         img.src = ''; // Effacer la source de l'image
//         img.style.display = 'none'; // Masquer l'image
//         currentImageCount--; // Décrémenter le compteur d'images
//         selectedImageIndex = -1; // Réinitialiser l'index de sélection
        
//         // Réinitialiser la sélection de toutes les images
//         selectedImages.forEach(img => {
//             img.parentNode.classList.remove('selected'); // Retire la classe "selected" de toutes les images
//         });

//         // Cacher le bouton de suppression si toutes les images ont été supprimées
//         if (currentImageCount === 0) {
//             deleteButton.style.display = 'none'; // Cache le bouton à nouveau
//         }
//     }
// });









// // Récupérer tous les éléments avec la classe 'tag'
// const tags = document.getElementsByClassName('tag');

// // Sélectionne les éléments nécessaires
// const fileInput = document.getElementById('file-upload');
// const deleteButton = document.getElementById('file-delete');
// const imageContainer = document.getElementById('image-container');
// const selectedImages = document.querySelectorAll('.selected-image'); // Récupère toutes les images

// let currentImageCount = 0; // Compte le nombre d'images actuellement affichées
// let selectedImageIndex = -1; // Index de l'image actuellement sélectionnée pour la suppression        

// // Transformer la collection en tableau et ajouter un écouteur d'événements à chaque élément
// Array.from(tags).forEach(tag => {
//     tag.addEventListener('click', function() {
//         this.classList.toggle('selectionne');  // Ajoute/enlève la classe 'selectionne'
//     });
// });

// // Écoute l'événement de changement de l'input de fichier
// fileInput.addEventListener('change', function() {
//     // Vérifie si des fichiers sont sélectionnés
//     if (fileInput.files.length > 0 && currentImageCount < selectedImages.length) {
//         const file = fileInput.files[0]; // Prendre le premier fichier
//         const reader = new FileReader(); // Créer un nouvel objet FileReader

//         // Fonction à exécuter une fois que le fichier est chargé
//         reader.onload = function(e) {
//             // Cherche la première image masquée pour y affecter la nouvelle image
//             const img = Array.from(selectedImages).find(image => image.style.display === 'none');
            
//             if (img) {
//                 img.src = e.target.result; // Met à jour la source de l'image
//                 img.style.display = 'block'; // Affiche l'image
//                 currentImageCount++; // Incrémenter le compteur d'images
//                 deleteButton.style.display = 'block'; // Affiche le bouton de suppression si une image est présente
//             }
//         }

//         // Lire le fichier comme une URL de données
//         reader.readAsDataURL(file);
//         fileInput.value = ''; // Réinitialiser l'input pour permettre la sélection de la même image
//     }
// });

// // Gérer le clic sur les images pour les sélectionner
// imageContainer.addEventListener('click', function(e) {
//     const target = e.target;
//     if (target.classList.contains('selected-image')) {
//         // Trouver l'index de l'image cliquée
//         selectedImageIndex = Array.from(selectedImages).indexOf(target);
        
//         // Réinitialiser la sélection de toutes les images
//         selectedImages.forEach((img, index) => {
//             const wrapper = img.parentNode;
//             if (index === selectedImageIndex) {
//                 wrapper.classList.add('selected'); // Ajoute la classe "selected" à l'image sélectionnée
//             } else {
//                 wrapper.classList.remove('selected'); // Retire la classe "selected" des autres images
//             }
//         });
//     }
// });

// // Écoute l'événement de clic sur le bouton de suppression
// deleteButton.addEventListener('click', function() {
//     // Supprimer l'image sélectionnée
//     if (selectedImageIndex !== -1) { // S'il y a une image sélectionnée
//         const img = selectedImages[selectedImageIndex]; // Récupérer l'image à l'index actuel
//         img.src = ''; // Effacer la source de l'image
//         img.style.display = 'none'; // Masquer l'image
//         currentImageCount--; // Décrémenter le compteur d'images
//         selectedImageIndex = -1; // Réinitialiser l'index de sélection
        
//         // Réinitialiser la sélection de toutes les images
//         selectedImages.forEach(img => {
//             img.parentNode.classList.remove('selected'); // Retire la classe "selected" de toutes les images
//         });

//         // Cacher le bouton de suppression si toutes les images ont été supprimées
//         if (currentImageCount === 0) {
//             deleteButton.style.display = 'none'; // Cache le bouton à nouveau
//         }
//     }
// });


        </script>
    </body>
</html>