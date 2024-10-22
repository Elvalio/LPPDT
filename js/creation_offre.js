/////////////////////////////////////////////////////////////////////////////////////////////////////
            ///////////////////////////////// GESTION CHECKBOX //////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////////////////////////////////////

            function checkOnlyOne(checkbox) {
                // Sélectionner toutes les cases à cocher dans le formulaire
                var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                
                // Parcourir chaque case à cocher
                checkboxes.forEach(function(item) {
                    if (item !== checkbox) {
                        // Désélectionner les autres cases à cocher
                        item.checked = false;
                    }
                });
            }

            ////////////////////////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////////////////////////

            document.addEventListener('DOMContentLoaded', function() {
                var typeContainer = document.getElementById('type-container');
                var optionContainer = document.getElementById('option-container');
                // Gestion de la catégorie et de l'affichage des champs en fonction des catégories
                var categorieSelect = document.getElementById('categorie-offre');
                var dureeContainer = document.getElementById('duree-container');
                var ageContainer = document.getElementById('age-container');
                var langueContainer = document.getElementById('langue-container');
                var capaciteContainer = document.getElementById('capacite-container');
                var nbattractionContainer = document.getElementById('nbattraction-container');
                var carteImageContainer = document.getElementById('map-image');
                var categoriePrixContainer = document.getElementById('categorie-prix-container');
                var repasContainer = document.getElementById('repas-container');
                var labelElement = document.querySelector('#map-image label');
                var repasMapContainer = document.getElementById('repas-map');

                // Récupérer tous les éléments avec la classe 'tag'
                var tags = document.getElementsByClassName('tag');
                var tagsToHideRestauration = ['Culturel', 'Patrimoine', 'Histoire', 'Urbain', 'Nature', 'Plein air', 'Sport', 'Nautique', 'Gastronomie', 'Musée', 'Atelier', 'Musique', 'Famille', 'Cinéma', 'Cirque', 'Son et lumière', 'Humour'];
                var tagsToHideOther = ['Française', 'Fruit de mer', 'Asiatique', 'Indienne', 'Italienne', 'Gastronomique', 'Restauration rapide', 'Crêperie', 'Végétarienne', 'Végétalienne', 'Kebab'];
                var tagsItemsContainer = document.getElementById('tags-items-container');
                var tagContainer = document.getElementById('tag-container');

                // Sélectionne les éléments nécessaires pour les 3 images
                var fileInput = document.getElementById('file-upload');
                var deleteButton = document.getElementById('file-delete');
                var customFileUpload = document.getElementById('custom-file-upload'); // Le label d'ajout d'image
                var customFileUploadIcon = document.querySelector('#custom-file-upload img'); // Sélectionne l'image dans le label
                var selectedImages = document.querySelectorAll('.selected-image'); // Récupère toutes les images
                var uploadText = document.getElementById('upload-text'); // Le texte du bouton
                var errorMessage = document.getElementById('error-message');

                var currentImageCount = 0; // Compte le nombre d'images actuellement affichées
                var selectedImageIndex = -1; // Index de l'image actuellement sélectionnée pour la suppression

                // Sélectionne les éléments nécessaires pour la map
                var mapFileUpload = document.getElementById('map-file-upload');
                var mapFileDelete = document.getElementById('map-file-delete');
                var mapImageContainer = document.getElementById('map-image-container').querySelector('img');
                
                ////////////////////////////////////////////////////////////////////////////////////////
                ///////////////////////////////// GESTION DES CHAMPS PAR CATEGORIE /////////////////////
                ////////////////////////////////////////////////////////////////////////////////////////

                // Fonction pour gérer l'affichage des champs
                function handleCategorieChange() {
                    var selectedCategorie = categorieSelect.value;

                    if (selectedCategorie === 'activite') {
                        dureeContainer.style.display = 'flex';
                        nbattractionContainer.style.display = 'none';
                        ageContainer.style.display = 'flex';
                        capaciteContainer.style.display = 'none';
                        langueContainer.style.display = 'none';
                        carteImageContainer.style.display = 'none';
                        repasContainer.style.display = 'none';
                        repasMapContainer.style.marginBottom = '0';
                    }

                    if (selectedCategorie === 'visite') {
                        dureeContainer.style.display = 'flex';
                        nbattractionContainer.style.display = 'none';
                        ageContainer.style.display = 'none';
                        capaciteContainer.style.display = 'none';
                        langueContainer.style.display = 'flex';
                        carteImageContainer.style.display = 'none';
                        repasContainer.style.display = 'none';
                        repasMapContainer.style.marginBottom = '0';
                    }

                    if (selectedCategorie === 'spectacle') {
                        dureeContainer.style.display = 'flex';
                        nbattractionContainer.style.display = 'none';
                        ageContainer.style.display = 'none';
                        capaciteContainer.style.display = 'flex';
                        langueContainer.style.display = 'none';
                        carteImageContainer.style.display = 'none';
                        repasContainer.style.display = 'none';
                        repasMapContainer.style.marginBottom = '0';
                    }

                    if (selectedCategorie === 'parcAttraction') {
                        dureeContainer.style.display = 'none';
                        nbattractionContainer.style.display = 'flex';
                        ageContainer.style.display = 'flex';
                        capaciteContainer.style.display = 'none';
                        langueContainer.style.display = 'none';
                        carteImageContainer.style.display = 'flex';
                        repasMapContainer.style.marginBottom = '40px';
                        labelElement.textContent = 'Plan du parc';
                        repasContainer.style.display = 'none';
                    }

                    //pour la restauration, gestion des tags
                    Array.from(tags).forEach(tag => {
                        var tagText = tag.querySelector('p').textContent;

                        if (selectedCategorie === 'restauration') {
                            if (tagsToHideRestauration.includes(tagText)) {
                                tag.style.display = 'none';
                                
                            } else {
                                tag.style.display = 'flex';
                            }
                            tagsItemsContainer.style.height = '77.3px';
                            tagContainer.style.height = '107.3px';
                            categoriePrixContainer.style.display = 'flex';
                            dureeContainer.style.display = 'none';
                            nbattractionContainer.style.display = 'none';
                            ageContainer.style.display = 'none';
                            capaciteContainer.style.display = 'none';
                            langueContainer.style.display = 'none';
                            carteImageContainer.style.display = 'flex';
                            labelElement.textContent = 'Carte restaurant';
                            repasContainer.style.display = 'flex';
                            repasMapContainer.style.marginBottom = '40px';
                        } else {
                            if (tagsToHideOther.includes(tagText)) {
                                tag.style.display = 'none';
                            } else {
                                tag.style.display = 'flex';
                            }
                            tagsItemsContainer.style.height = '116px';
                            tagContainer.style.height = '146px';
                            categoriePrixContainer.style.display = 'none';
                            repasContainer.style.display = 'none';
                            
                        }
                    });

                    

                    
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
                        
                        var file = fileInput.files[0]; // Prendre le premier fichier
                        var reader = new FileReader(); // Créer un nouvel objet FileReader

                        reader.onload = function(e) {
                            if (selectedImageIndex >= 0) {
                                // Si une image est sélectionnée, remplacer cette image
                                if(selectedImages[selectedImageIndex].getAttribute('src') === '../images/rien.png'){
                                    currentImageCount++;
                                    deleteButton.style.display = 'block';
                                }
                                selectedImages[selectedImageIndex].src = e.target.result;
                            }else{
                                var foundEmptySlot = false;
                                // Trouver la première case vide et y insérer l'image
                                for (var i = 0; i < selectedImages.length; i++) {
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
                            toggleFileUpload(); // Vérifier si on doit masquer le bouton d'ajout
                        };
                    

                        reader.readAsDataURL(file); // Lire l'image sous forme de base64
                        fileInput.value = ''; // Réinitialiser l'input pour permettre la sélection de la même image plus tard
                    }
                });

                // Gérer la sélection des images en cliquant dessus
                document.getElementById('image-container').addEventListener('click', function(e) {
                    if (e.target.classList.contains('selected-image')) {
                        var clickedIndex = Array.from(selectedImages).indexOf(e.target);

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
                        var img = selectedImages[selectedImageIndex];
                        if(img.getAttribute('src') !== '../images/rien.png'){
                            img.src = '../images/rien.png'; // Effacer la source de l'image
                            img.classList.remove('selected'); // Désélectionner l'image
                            selectedImageIndex = -1;
                            currentImageCount--;
                        } else {
                            img.classList.remove('selected'); // Désélectionner l'image
                            selectedImageIndex = -1;
                            errorMessage.style.display = 'block';
                            errorMessage.textContent = 'Vous ne pouvez pas supprimer une image inexistante !';     
                        }
                            
                        // Masquer le bouton de suppression s'il n'y a plus d'images
                        if (currentImageCount === 0) {
                            deleteButton.style.display = 'none';
                        }
                        updateLabel('Ajouter une image', '../icons/plus.svg'); // Remettre le texte à "Ajouter une image"
                        toggleFileUpload(); // Vérifier si on doit afficher le bouton d'ajout après suppression
                    }
                });

                ////////////////////////////////////////////////////////////////////////////////////////////
                ////////////////////////// GESTION MAP /////////////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////////////////////////

                

                // Fonction pour ajouter une image
                mapFileUpload.addEventListener('change', function() {
                    
                    if (mapFileUpload.files.length > 0) {
                        var file = mapFileUpload.files[0];
                        var reader = new FileReader();
                        mapFileDelete.style.display = 'block';
                        

                        reader.onload = function(e) {
                            mapImageContainer.src = e.target.result;
                        };

                        reader.readAsDataURL(file);
                        mapFileUpload.value = ''; // Réinitialiser l'input pour permettre la sélection de la même image plus tard
                    }
                });

                // Fonction pour supprimer une image
                mapFileDelete.addEventListener('click', function() {
                    if (mapImageContainer.src.includes('rien.png')) {
                    } else {
                        mapImageContainer.src = '../images/rien.png'; // Réinitialiser l'image
                        mapFileDelete.style.display = 'none';
                    }
                });
            });