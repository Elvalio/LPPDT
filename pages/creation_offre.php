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
                                    <input type="text" id="titre" class="FS" name="titre" placeholder="Saisir" required />
                                </div>
                                <!-- Champ "Catégorie" -->
                                <div class="container" id="categorie-container">
                                    <label for="categorie">Catégorie de l'offre*</label>
                                    <select id="categorie" name="categorie" required class="FS">
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
                                    <input type="text" id="commune" class="FS" name="commune" placeholder="Saisir" required />
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
                                <input type="text" id="resume" class="FS" name="resume" placeholder="Saisir" required />
                            </div>
                            <!-- Champ "Description" -->
                            <div class="container" id="description-container">
                                <label for="description">Description</label>
                                <textarea id="description" class="FS" name="description" rows="12" cols="60"></textarea>
                            </div>
                            <!-- Champ "Tags" -->
                            <div id="tag-container">
                                <label>Tags</label>
                                <div id="tags-items-container">
                                    <button class="tag FS" type="button" >
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Culturel</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Patrimoine</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Histoire</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Urbain</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Nature</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Plein air</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Sport</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Nautique</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Gastronomie</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Musée</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Atelier</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Musique</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Famille</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Cinéma</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Cirque</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Son et lumière</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <img src="../icons/check.svg" alt="Icone">
                                        <p>Humour</p>
                                    </button>
                                </div>
                            </div>
                            <!-- Bouton de soumission -->
                            <div id="publier-retour">
                                <input type="submit" class="FS" value="Publier" />
                                <button class="FS">
                                    <img src="../icons/arrow-left-o.svg" alt="Bouton Image">
                                    Retour
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="right-part">
                        <div id="right-part-content">
                            <div id="top-right-part-content">
                                <!-- Champ "Adresse" -->
                                <div class="container" id="adresse-container">
                                    <label for="adresse">Adresse</label>
                                    <input type="text" id="adresse" class="FS" name="adresse" placeholder="Saisir" required />
                                </div>
                                <!-- Champ "Accesibilité" -->
                                <div class="container" id="accessibilite-container">
                                    <label for="accessibilite">Accessibilité</label>
                                    <input type="text" id="accessibilite" class="FS" name="accessibilite" placeholder="Saisir" required />
                                </div>
                                <!-- Champ "prix minimum" -->
                                <div id="duree-prix-age">
                                    <div class="container" id="duree-container">
                                        <label for="duree">Durée</label>
                                        <input type="text" id="duree" class="FS" name="duree" placeholder="Saisir" required />
                                    </div>
                                    <div class="container" id="prix-container">
                                        <label for="prix">Prix minimum (€)</label>
                                        <input type="text" id="prix" class="FS" name="prix" placeholder="Saisir" required />
                                    </div>
                                    <div class="container" id="age-container">
                                        <label for="age">Âge minimum</label>
                                        <input type="text" id="age" class="FS" name="age" placeholder="Saisir" required />
                                    </div>
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
                            </div>
                            <div id="bottom-right-part-content">
                                <!---- Champs ajout image --->
                                <div id="file-container">
                                    <label for="file-upload" id="custom-file-upload">
                                        <img src="../icons/plus.svg" alt="Bouton Image">
                                        <p id="upload-text">Ajouter une image </p>
                                    </label>
                                    <input type="file" id="file-upload" accept=".png"/>
                                    <button id="file-delete" type="button">
                                        <img src="../icons/moins.svg" alt="Bouton Image">
                                        Supprimer une image
                                    </button>
                                </div>
                                <p id="error-message" style="color: red; display: none;">Aucune image sélectionnée à supprimer !</p>
                                <!-- Éléments pour afficher les images importées -->
                                <div id="image-container">
                                    <img class="selected-image" src="../images/rien.png" alt="Image sélectionnée" />
                                    <img class="selected-image" src="../images/rien.png" alt="Image sélectionnée" />
                                    <img class="selected-image" src="../images/rien.png" alt="Image sélectionnée" />
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>      
            </form>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Gestion de la catégorie et de l'affichage des champs "Durée" et "Âge"
                const categorieSelect = document.getElementById('categorie');
                const dureeContainer = document.getElementById('duree-container');
                const ageContainer = document.getElementById('age-container');

                // Récupérer tous les éléments avec la classe 'tag'
                const tags = document.getElementsByClassName('tag');

                // Sélectionne les éléments nécessaires pour les images
                const fileInput = document.getElementById('file-upload');
                const deleteButton = document.getElementById('file-delete');
                const customFileUpload = document.getElementById('custom-file-upload'); // Le label d'ajout d'image
                const customFileUploadIcon = document.querySelector('#custom-file-upload img'); // Sélectionne l'image dans le label
                const selectedImages = document.querySelectorAll('.selected-image'); // Récupère toutes les images
                const uploadText = document.getElementById('upload-text'); // Le texte du bouton
                const errorMessage = document.getElementById('error-message');

                let currentImageCount = 0; // Compte le nombre d'images actuellement affichées
                let selectedImageIndex = -1; // Index de l'image actuellement sélectionnée pour la suppression
                
                ////////////////////////////////////////////////////////////////////////////////////////
                ///////////////////////////////// GESTION DES CHAMPS DUREE ET AGE //////////////////////
                ////////////////////////////////////////////////////////////////////////////////////////

                // Fonction pour gérer l'affichage des champs
                function handleCategorieChange() {
                    const selectedCategorie = categorieSelect.value;

                    if (selectedCategorie === 'activite') {
                        // Afficher les champs "Durée" et "Âge minimum" si "Activité" est sélectionné
                        dureeContainer.style.display = 'flex';
                        ageContainer.style.display = 'flex';
                    } else {
                        // Masquer les champs sinon
                        dureeContainer.style.display = 'none';
                        ageContainer.style.display = 'none';
                    }
                }

                // Attacher l'événement 'change' à la sélection de catégorie
                categorieSelect.addEventListener('change', handleCategorieChange);

                // Appeler la fonction au chargement initial pour gérer l'état par défaut
                handleCategorieChange();

                ////////////////////////////////////////////////////////////////////////////////
                ///////////////////////// GESTION DES TAGS /////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////////////

                // Transformer la collection en tableau et ajouter un écouteur d'événements à chaque élément
                Array.from(tags).forEach(tag => {
                    tag.addEventListener('click', function() {
                        this.classList.toggle('selectionne');  // Ajoute/enlève la classe 'selectionne'
                    });
                });

                //////////////////////////////////////////////////////////////////////////////////
                //////////////////////////// GESTION DES IMAGES //////////////////////////////////
                //////////////////////////////////////////////////////////////////////////////////

                // Fonction pour afficher/masquer le bouton d'ajout d'image
                function toggleFileUpload() {
                    if (selectedImageIndex !== -1) {
                        // Si une image est sélectionnée, afficher le bouton "Modifier l'image"
                        customFileUpload.style.display = 'flex';
                    } else {
                        if (currentImageCount >= 3) {
                            // Masquer le bouton si le nombre d'images est >= 3 et aucune image n'est sélectionnée
                            customFileUpload.style.display = 'none';
                        } else {
                            // Sinon, afficher le bouton d'ajout d'image
                            customFileUpload.style.display = 'flex';
                        }
                    }
                }

                // Fonction pour mettre à jour le texte de la balise <p> et changer l'icône
                function updateLabel(text, iconSrc) {
                    uploadText.textContent = text; // Mettre à jour le texte de la balise <p>
                    customFileUploadIcon.src = iconSrc; // Mettre à jour la source de l'image
                }

                // Fonction pour afficher une image dans la première case vide
                fileInput.addEventListener('change', function() {
                    if (fileInput.files.length > 0) {
                        
                        const file = fileInput.files[0]; // Prendre le premier fichier
                        const reader = new FileReader(); // Créer un nouvel objet FileReader

                        reader.onload = function(e) {
                            if (selectedImageIndex >= 0) {
                                // Si une image est sélectionnée, remplacer cette image
                                if(selectedImages[selectedImageIndex].getAttribute('src') === '../images/rien.png'){
                                    currentImageCount++;
                                    deleteButton.style.display = 'block';
                                }
                                selectedImages[selectedImageIndex].src = e.target.result;
                                
                                
                            }else{

                        
                                let foundEmptySlot = false;
                        
                                // Trouver la première case vide et y insérer l'image
                                for (let i = 0; i < selectedImages.length; i++) {
                                    if (!foundEmptySlot && selectedImages[i].getAttribute('src') === '../images/rien.png') {
                                        selectedImages[i].src = e.target.result; // Mettre à jour la source de l'image
                                        selectedImages[i].style.display = 'block'; // Afficher l'image
                                        foundEmptySlot = true;
                                        currentImageCount++;
                                    }
                                }

                                // Afficher le bouton de suppression si une image est présente
                                if (foundEmptySlot) {
                                    deleteButton.style.display = 'block';
                                }
                            }
                            console.log(currentImageCount >=3 + currentImageCount);
                            console.log(currentImageCount);
                            toggleFileUpload(); // Vérifier si on doit masquer le bouton d'ajout
                        };
                    

                        reader.readAsDataURL(file); // Lire l'image sous forme de base64
                        fileInput.value = ''; // Réinitialiser l'input pour permettre la sélection de la même image plus tard
                    }
                });

                // Gérer la sélection des images en cliquant dessus
                document.getElementById('image-container').addEventListener('click', function(e) {
                    if (e.target.classList.contains('selected-image')) {
                        const clickedIndex = Array.from(selectedImages).indexOf(e.target);

                        if (clickedIndex === selectedImageIndex) {
                            // Désélectionner l'image si elle est déjà sélectionnée
                            e.target.classList.remove('selected');
                            selectedImageIndex = -1;
                            updateLabel('Ajouter une image', '../icons/plus.svg'); // Remettre "Ajouter une image"
                        } else {
                            // Désélectionner toutes les images et sélectionner la nouvelle
                            selectedImages.forEach(img => img.classList.remove('selected'));
                            e.target.classList.add('selected');
                            selectedImageIndex = clickedIndex;
                            updateLabel('Modifier l\'image', '../icons/changer.svg'); // Changer le texte du bouton
                            errorMessage.style.display = 'none'; // Cacher le message d'erreur
                        }

                        // Appeler toggleFileUpload() après la sélection/désélection
                        toggleFileUpload();
                    }
                });

                // Gérer la suppression des images
                deleteButton.addEventListener('click', function() {
                    if (selectedImageIndex === -1) {
                        errorMessage.style.display = 'block'; // Afficher un message d'erreur si aucune image n'est sélectionnée
                    } else {
                        // Supprimer l'image sélectionnée
                        let img = selectedImages[selectedImageIndex];
                        img.src = '../images/rien.png'; // Effacer la source de l'image
                        img.classList.remove('selected'); // Désélectionner l'image
                        selectedImageIndex = -1;
                        currentImageCount--;
                        
                        // Masquer le bouton de suppression s'il n'y a plus d'images
                        if (currentImageCount === 0) {
                            deleteButton.style.display = 'none';
                        }
                        updateLabel('Ajouter une image', '../icons/plus.svg'); // Remettre le texte à "Ajouter une image"
                        toggleFileUpload(); // Vérifier si on doit afficher le bouton d'ajout après suppression

                        errorMessage.style.display = 'none'; // Cacher le message d'erreur
                    }
                });
            });
        </script>
    </body>
</html>