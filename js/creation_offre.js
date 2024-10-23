/////////////////////////////////////////////////////////////////////////////////////////////////////
            ///////////////////////////////// GESTION CHECKBOX //////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////////////////////////////////////

            function checkOnlyOne(checkbox) {
                // Sélectionner toutes les cases à cocher dans le formulaire
                var checkboxes = document.querySelectorAll('#une-relief input[type="checkbox"]');
                
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
                var prestationIncluseContainer = document.getElementById('pinclus-container');
                var prestationExcluseContainer = document.getElementById('pexclus-container');

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
                        document.getElementById('duree').required = true;
                        nbattractionContainer.style.display = 'none';
                        document.getElementById('nbattraction').required = false;
                        ageContainer.style.display = 'flex';
                        document.getElementById('age').required = true;
                        capaciteContainer.style.display = 'none';
                        document.getElementById('capacite').required = false;
                        langueContainer.style.display = 'none';
                        carteImageContainer.style.display = 'none';
                        repasContainer.style.display = 'none';
                        repasMapContainer.style.marginBottom = '0';
                        prestationIncluseContainer.style.display = 'flex';
                        prestationExcluseContainer.style.display = 'flex';
                    }

                    if (selectedCategorie === 'visite') {
                        dureeContainer.style.display = 'flex';
                        document.getElementById('duree').required = true;
                        nbattractionContainer.style.display = 'none';
                        document.getElementById('nbattraction').required = false;
                        ageContainer.style.display = 'none';
                        document.getElementById('age').required = false;
                        capaciteContainer.style.display = 'none';
                        document.getElementById('capacite').required = false;
                        langueContainer.style.display = 'flex';
                        carteImageContainer.style.display = 'none';
                        repasContainer.style.display = 'none';
                        repasMapContainer.style.marginBottom = '0';
                        prestationIncluseContainer.style.display = 'none';
                        prestationExcluseContainer.style.display = 'none';
                    }

                    if (selectedCategorie === 'spectacle') {
                        dureeContainer.style.display = 'flex';
                        document.getElementById('duree').required = true;
                        nbattractionContainer.style.display = 'none';
                        document.getElementById('nbattraction').required = false;
                        ageContainer.style.display = 'none';
                        document.getElementById('age').required = false;
                        capaciteContainer.style.display = 'flex';
                        document.getElementById('capacite').required = true;
                        langueContainer.style.display = 'none';
                        carteImageContainer.style.display = 'none';
                        repasContainer.style.display = 'none';
                        repasMapContainer.style.marginBottom = '0';
                        prestationIncluseContainer.style.display = 'none';
                        prestationExcluseContainer.style.display = 'none';
                    }

                    if (selectedCategorie === 'parcAttraction') {
                        dureeContainer.style.display = 'none';
                        document.getElementById('duree').required = false;
                        nbattractionContainer.style.display = 'flex';
                        document.getElementById('nbattraction').required = true;
                        ageContainer.style.display = 'flex';
                        document.getElementById('age').required = true;
                        capaciteContainer.style.display = 'none';
                        document.getElementById('capacite').required = false;
                        langueContainer.style.display = 'none';
                        carteImageContainer.style.display = 'flex';
                        repasMapContainer.style.marginBottom = '40px';
                        labelElement.textContent = 'Plan du parc';
                        repasContainer.style.display = 'none';
                        prestationIncluseContainer.style.display = 'none';
                        prestationExcluseContainer.style.display = 'none';
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
                            //document.getElementById('categorie-prix').required = true;
                            dureeContainer.style.display = 'none';
                            document.getElementById('duree').required = false;
                            nbattractionContainer.style.display = 'none';
                            document.getElementById('nbattraction').required = false;
                            ageContainer.style.display = 'none';
                            document.getElementById('age').required = false;
                            capaciteContainer.style.display = 'none';
                            document.getElementById('capacite').required = false;
                            langueContainer.style.display = 'none';
                            carteImageContainer.style.display = 'flex';
                            labelElement.textContent = 'Menu du restaurant';
                            repasContainer.style.display = 'flex';
                            repasMapContainer.style.marginBottom = '40px';
                            prestationIncluseContainer.style.display = 'none';
                            prestationExcluseContainer.style.display = 'none';
                        } else {
                            if (tagsToHideOther.includes(tagText)) {
                                tag.style.display = 'none';
                            } else {
                                tag.style.display = 'flex';
                            }
                            tagsItemsContainer.style.height = '116px';
                            tagContainer.style.height = '146px';
                            categoriePrixContainer.style.display = 'none';
                            //document.getElementById('categorie-prix').required = false;
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

                document.getElementById('upload-form').addEventListener('submit', function(event) {
                    event.preventDefault(); // Empêche le comportement par défaut du formulaire
                
                    var fileInput = document.getElementById('fileInput');
                    if (fileInput.files.length > 0) {
                        var formData = new FormData();
                        formData.append('image', fileInput.files[0]); // Ajouter l'image au FormData
                
                        // Envoyer l'image via Fetch API
                        fetch('creation_offre.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Traitement en cas de succès
                                console.log('Image importée avec succès:', data.imageName);
                                updateLabel(`Image importée : ${data.imageName}`, '../icons/check.svg'); // Mettre à jour le label
                            } else {
                                // Traitement en cas d'erreur
                                console.error('Erreur lors de l\'importation de l\'image:', data.message);
                            }
                        })
                        .catch(error => console.error('Erreur de réseau:', error));
                    } else {
                        console.error('Aucune image sélectionnée.');
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

            ////////////////////////////////////////////////////////////////////////////////////////////
            ////////////////////////// GESTION DES ERREURS//////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////////////////////////
            const submitButton = document.getElementById('submit-button');
            submitButton.disabled = true; // Désactive le bouton de soumission
            //const forbiddenCodeKeywords = /(function|var|let|const|if|else|while|for|return|console|document|window|alert|eval|script|import|export|async|await|try|catch|finally|class|this|super|new|void|typeof|instanceof|throw|debugger|with|case|switch|default|break|continue|do|try|finally|yield|static|print|def|in|as|from|lambda|class|self|__init__|require|module|exports|package|import|public|private|protected|implements|extends|new|enum|throw|catch|finally|toString|JSON|Promise|Map|Set|WeakMap|WeakSet|Symbol|Math|parseInt|parseFloat|push|pop|shift|unshift|splice|slice|filter|map|reduce|forEach|every|some|indexOf|includes|lastIndexOf|join|sort|reverse|fill|flat|flatMap|Object|Array|Function|Boolean|Number|String|RegExp|Date|Error|Promise|Set|Map|WeakMap|WeakSet|Proxy|Reflect|Intl|eval|setTimeout|setInterval|clearTimeout|clearInterval|requestAnimationFrame|fetch|XMLHttpRequest|localStorage|sessionStorage|documentElement|createElement|createTextNode|getElementById|getElementsByClassName|getElementsByTagName|querySelector|querySelectorAll|print|include|require|namespace|do|try|catch|finally|yield|void|define|global|using|class|interface|method|static|delegate|event|addEventListener|prompt|file|input|document.createElement|document.write|document.getElementById|document.getElementsByClassName|document.getElementsByTagName)/i;
            const forbiddenCodeKeywords = /(<br>)/i;
            function validateTitle() {
                const titreInput = document.getElementById('titre');
                const errorMessageElement = document.getElementById('error-message-titre');
                
                const titre = titreInput.value.trim();
                let errors = [];

                // 1. Vérification de la longueur maximale (50 caractères)
                if (titre.length > 50) {
                    errors.push("Le titre ne doit pas dépasser 50 caractères.");
                }

                if (forbiddenCodeKeywords.test(titre)) {
                    errors.push("Le titre semble contenir du code, ce qui est interdit.");
                }

                // 3. Vérification des caractères spéciaux (<, >)
                const forbiddenCharacters = /[<>]/;
                if (forbiddenCharacters.test(titre)) {
                    errors.push("Le titre contient des caractères spéciaux interdits (ex : <, >).");
                }

                // Affichage des erreurs ou validation
                if (errors.length > 0) {
                    errorMessageElement.textContent = errors.join(" ");
                    submitButton.disabled = true;
                } else {
                    errorMessageElement.textContent = "";
                    submitButton.disabled = false;
                }
                
            }

            // Fonction pour valider le résumé
            function validateResume() {
                const resumeInput = document.getElementById('resume');
                const errorMessageElement = document.getElementById('resume-error-message');
                const resume = resumeInput.value.trim();
                let errors = [];
        
                // 1. Vérification de la longueur maximale (250 caractères)
                if (resume.length > 250) {
                    errors.push("Le résumé ne doit pas dépasser 250 caractères.");
                }
        
                // 3. Vérification des caractères spéciaux interdits (<, >)
                const forbiddenCharacters = /[<>]/;
                if (forbiddenCharacters.test(resume)) {
                    errors.push("Le résumé contient des caractères spéciaux interdits (ex : <, >).");
                }

                if (forbiddenCodeKeywords.test(resume)) {
                    errors.push("Le résumé semble contenir du code, ce qui est interdit.");
                }
        
                // 4. Vérification de la pertinence (au moins un mot significatif)
                const alphanumeric = /[A-Za-z0-9]/;
                if (!alphanumeric.test(resume)) {
                    errors.push("Le résumé doit contenir des caractères alphanumériques valides.");
                }
        
                // Affichage des erreurs ou validation
                if (errors.length > 0) {
                    errorMessageElement.textContent = errors.join(" ");
                    submitButton.disabled = true;
                } else {
                    errorMessageElement.textContent = "";
                    submitButton.disabled = false;
                }
                
            }

            // Fonction pour valider la description
            function validateDescription() {
                const descriptionInput = document.getElementById('description');
                const errorMessageElement = document.getElementById('description-error-message');
                const description = descriptionInput.value.trim();
                let errors = [];

                // 1. Vérification de la longueur maximale (5000 caractères)
                if (description.length > 5000) {
                    errors.push("La description ne doit pas dépasser 5000 caractères.");
                }

                // 2. Vérification que la description n'est pas vide ou composée uniquement d'espaces
                if (description !== '') {
                    if (forbiddenCodeKeywords.test(description)) {
                        errors.push("La description semble contenir du code, ce qui est interdit.");
                    }
    
                    // 4. Vérification de la pertinence (au moins un mot significatif)
                    const alphanumeric = /[A-Za-z0-9]/;
                    if (!alphanumeric.test(description)) {
                        errors.push("La description doit contenir des caractères alphanumériques valides.");
                    }
                }

                

                // Affichage des erreurs ou validation
                if (errors.length > 0) {
                    errorMessageElement.textContent = errors.join(" ");
                    submitButton.disabled = true;
                } else {
                    errorMessageElement.textContent = "";
                    submitButton.disabled = false;
                }
                
            }

            // Fonction pour valider l'adresse
            function validateAdresse() {
                const adresseInput = document.getElementById('adresse');
                const errorMessageElement = document.getElementById('adresse-error-message');
                const adresse = adresseInput.value.trim();
                let errors = [];

                // 1. Vérification de la longueur maximale (200 caractères, selon la colonne de la BDD)
                if (adresse.length > 200) {
                    errors.push("L'adresse ne doit pas dépasser 200 caractères.");
                }

                if (forbiddenCodeKeywords.test(adresse)) {
                    errors.push("L'adresse semble contenir du code, ce qui est interdit.");
                }

                // 3. Vérification des caractères spéciaux interdits (<, >) pour empêcher les balises HTML
                const forbiddenCharacters = /[<>]/;
                if (forbiddenCharacters.test(adresse)) {
                    errors.push("L'adresse contient des caractères spéciaux interdits (ex : <, >).");
                }

                // 5. Vérification des caractères autorisés (alphanumérique + certains caractères courants dans les adresses)
                const allowedCharacters = /^[A-Za-z0-9\s\,\.\-\#\/]*$/;  // Inclut les alphanumériques, espaces, et les caractères , . - # /
                if (!allowedCharacters.test(adresse)) {
                    errors.push("L'adresse contient des caractères non autorisés (seuls les alphanumériques, espaces, , . - # / sont permis).");
                }

                // 6. Vérification que l'adresse commence par un nombre suivi d'un texte
                const startsWithNumberPattern = /^\d+\s+[A-Za-z]/;  // L'adresse doit commencer par un chiffre ou un nombre suivi d'un espace puis d'un texte
                if (!startsWithNumberPattern.test(adresse)) {
                    errors.push("L'adresse doit commencer par un nombre suivi d'un texte (par ex : '12 Rue').");
                }
                

                // Affichage des erreurs ou validation
                if (errors.length > 0) {
                    errorMessageElement.textContent = errors.join(" ");
                    submitButton.disabled = true;
                } else {
                    errorMessageElement.textContent = "";
                    submitButton.disabled = false;
                }
                
            }

            function validatePostalCode() {
                const postalCodeInput = document.getElementById('codeP');
                const errorMessageElement = document.getElementById('postal-code-error-message');
                const postalCode = postalCodeInput.value.trim();
                let errors = [];
                
                // 1. Vérification de la longueur (exactement 5 chiffres)
                if (postalCode.length !== 5) {
                    errors.push("Le code postal doit comporter exactement 5 chiffres.");
                } else{
                    // 2. Vérification de la validité des caractères (seulement des chiffres)
                    const allowedCharacters = /^[0-9]+$/; // Autorise uniquement les chiffres
                    if (!allowedCharacters.test(postalCode)) {
                        errors.push("Le code postal ne peut contenir que des chiffres.");
                    }
                }

        
                // Affichage des erreurs ou validation
                if (errors.length > 0) {
                    errorMessageElement.textContent = errors.join(" ");
                    submitButton.disabled = true;
                } else {
                    errorMessageElement.textContent = "";
                    submitButton.disabled = false;
                }
                
            }
            
            function validateCity() {
                const cityInput = document.getElementById('ville');
                const errorMessageElement = document.getElementById('city-error-message');
                const city = cityInput.value.trim();
                let errors = [];

                if (city.length > 20) {
                    errors.push("Le nom de la ville ne doit pas dépasser 20 caractères.");
                }
        
                // 1. Vérification que la ville n'est pas vide
                
                if (forbiddenCodeKeywords.test(city)) {
                    errors.push("Le nom de ville semble contenir du code, ce qui est interdit.");
                }
        
                // 2. Vérification de la validité des caractères (lettres, espaces, accents, tirets, apostrophes)
                const allowedCharacters = /^[A-Za-zÀ-ÿ\s\-']+$/; // Autorise lettres, espaces, accents, tirets et apostrophes
                if (!allowedCharacters.test(city)) {
                    errors.push("Le nom de la ville ne peut contenir que des lettres, des espaces, des tirets et des apostrophes.");
                }


                
        
                // Affichage des erreurs ou validation
                if (errors.length > 0) {
                    errorMessageElement.textContent = errors.join(" ");
                    submitButton.disabled = true;
                } else {
                    errorMessageElement.textContent = "";
                    submitButton.disabled = false;
                }
                
            }

            function validateAccessibility() {
                const accessibilityInput = document.getElementById('accessibilite');
                const errorMessageElement = document.getElementById('accessibility-error-message');
                const accessibility = accessibilityInput.value.trim();
                let errors = [];

                if (accessibility.length > 200) {
                    errors.push("L'accessibilité' ne doit pas dépasser les 200 caractères.");
                }
        
                
                if (forbiddenCodeKeywords.test(accessibility)) {
                    errors.push("L'accessibilité semble contenir du code, ce qui est interdit.");
                }
        
                // 2. Vérification de la validité des caractères
                const allowedCharacters = /^[A-Za-zÀ-ÿ0-9\s\-.,'()]+$/; // Autorise lettres, chiffres, espaces, accents, tirets, virgules et parenthèses
                if (!allowedCharacters.test(accessibility)) {
                    errors.push("Le champ d'accessibilité ne peut contenir que des lettres, des chiffres, des espaces, des tirets, des virgules et des parenthèses.");
                }
                
        
                // Affichage des erreurs ou validation
                if (errors.length > 0) {
                    errorMessageElement.textContent = errors.join(" ");
                    submitButton.disabled = true;
                } else {
                    errorMessageElement.textContent = "";
                    submitButton.disabled = false;
                }
                
            }

            function validatePrice() {
                const priceInput = document.getElementById('prix');
                const errorMessageElement = document.getElementById('prix-error-message');
                const price = priceInput.value.trim();
                let errors = [];
        
                // 2. Vérification que c'est un nombre valide
                const allowedCharacters = /^[0-9]+(,[0-9]{1,2})?$/; // Autorise les nombres avec une virgule pour les décimales
                if (!allowedCharacters.test(price)) {
                    errors.push("Le prix minimum doit être un nombre valide (ex: 12,99).");
                }
        
                // 3. Vérification que le prix est positif
                const priceValue = parseFloat(price.replace(',', '.')); // Remplace la virgule par un point pour la conversion
                if (priceValue < 0) {
                    errors.push("Le prix minimum ne peut pas être négatif.");
                }
        
                // Affichage des erreurs ou validation
                if (errors.length > 0) {
                    errorMessageElement.textContent = errors.join(" ");
                    submitButton.disabled = true;
                } else {
                    errorMessageElement.textContent = "";
                    submitButton.disabled = false;
                }
                
            }

            function validateDuree() {
                const dureeInput = document.getElementById('duree');
                const errorMessageElement = document.getElementById('duree-error-message'); // Changement de l'ID ici
                const duree = dureeInput.value.trim();
                let errors = [];

                // 2. Vérification du format HH:MM:SS
                const dureePattern = /^([0-1][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/;
                if (!dureePattern.test(duree)) {
                    errors.push("Le format de la durée doit être HH:MM:SS.");
                }

                // 3. Vérification que la durée n'est pas "00:00:00"
                if (duree === "00:00:00") {
                    errors.push("La durée ne peut pas être de 00:00:00.");
                }


                // Affichage des erreurs ou validation
                if (errors.length > 0) {
                    errorMessageElement.textContent = errors.join(" ");
                    submitButton.disabled = true;
                } else {
                    errorMessageElement.textContent = "";
                    submitButton.disabled = false;
                }
                
            }

            function validateAgeMin() {
                const ageMinInput = document.getElementById('age');
                const errorMessageElement = document.getElementById('age_min-error-message'); // ID pour l'erreur d'âge minimum
                const ageMin = ageMinInput.value.trim();
                let errors = [];
        

                const ageValue = Number(ageMin);
    
                // 2. Vérification que c'est un nombre entier valide
                if (isNaN(ageValue) || !Number.isInteger(ageValue)) {
                    errors.push("L'âge minimum doit être un nombre entier valide.");
                }
    
                // 3. Vérification que l'âge est positif et supérieur à 0
                if (ageValue <= 0) {
                    errors.push("L'âge minimum doit être supérieur à 0.");
                }
                
        
                // Affichage des erreurs ou validation
                if (errors.length > 0) {
                    errorMessageElement.textContent = errors.join(" ");
                    submitButton.disabled = true;
                } else {
                    errorMessageElement.textContent = "";
                    submitButton.disabled = false;
                }
                
            }

            function validateNbrAttractions() {
                const nbrAttractionsInput = document.getElementById('nbattraction');
                const errorMessageElement = document.getElementById('nbr_attractions-error-message'); // ID pour l'erreur
                const nbrAttractions = nbrAttractionsInput.value.trim();
                let errors = [];
        
                const attractionsValue = Number(nbrAttractions);
    
                // 2. Vérification que c'est un nombre entier valide
                if (isNaN(attractionsValue) || !Number.isInteger(attractionsValue)) {
                    errors.push("Le nombre d'attractions doit être un entier valide.");
                }
    
                // 3. Vérification que le nombre d'attractions est supérieur à 0
                if (attractionsValue <= 0) {
                    errors.push("Le nombre d'attractions doit être supérieur à 0.");
                }
    
                // 4. (Optionnel) Limite maximale
                if (attractionsValue > 500) {
                    errors.push("Le nombre d'attractions ne peut pas dépasser 500.");
                }

        
                // Affichage des erreurs ou validation
                if (errors.length > 0) {
                    errorMessageElement.textContent = errors.join(" ");
                    submitButton.disabled = true;
                } else {
                    errorMessageElement.textContent = "";
                    submitButton.disabled = false;
                }
                
            }

            function validateCapacite() {
                const capaciteInput = document.getElementById('capacite');
                const errorMessageElement = document.getElementById('capacite-error-message'); // ID pour l'erreur
                const capacite = capaciteInput.value.trim();
                let errors = [];
        

                const capaciteValue = Number(capacite);
    
                // 2. Vérification que c'est un nombre entier valide
                if (isNaN(capaciteValue) || !Number.isInteger(capaciteValue)) {
                    errors.push("La capacité doit être un entier valide.");
                }
    
                // 3. Vérification que la capacité est supérieure à 0
                if (capaciteValue <= 0) {
                    errors.push("La capacité doit être supérieure à 0.");
                }
    
                // 4. (Optionnel) Limite maximale réaliste
                if (capaciteValue > 10000) {
                    errors.push("La capacité ne peut pas dépasser 10 000 places.");
                }
            
        
                // Affichage des erreurs ou validation
                if (errors.length > 0) {
                    errorMessageElement.textContent = errors.join(" ");
                    submitButton.disabled = true;
                } else {
                    errorMessageElement.textContent = "";
                    submitButton.disabled = false;
                }
                
            }

            function validatePrestationIncluse() {
                const pinclusInput = document.getElementById('pinclus');
                const errorMessageElement = document.getElementById('pinclus-error-message'); // ID pour l'erreur
                const prestationI = pinclusInput.value.trim();
                let errors = [];
        

                // 2. Séparer la chaîne en éléments par la virgule et supprimer les espaces
                const prestationsArray = prestationI.split(',').map(item => item.trim());
    
                // 3. Vérification de chaque élément
                prestationsArray.forEach(p => {
                    if (p.length < 2) {
                        errors.push(`"${p}" doit contenir au moins 2 caractères.`);
                    }
    
                    // 4. Vérification des caractères interdits
                    const forbiddenCharacters = /[<>]/;
                    if (forbiddenCharacters.test(p)) {
                        errors.push(`"${p}" contient des caractères interdits (ex : <, >).`);
                    }
                });
    
                // 5. Vérification de la longueur totale (limite de 100 caractères)
                if (prestationI.length > 100) {
                    errors.push("La liste des prestations ne doit pas dépasser 100 caractères.");
                }

        
                // Affichage des erreurs ou validation
                if (errors.length > 0) {
                    errorMessageElement.textContent = errors.join(" ");
                    submitButton.disabled = true;
                } else {
                    errorMessageElement.textContent = "";
                    submitButton.disabled = false;
                }
                
            }

            function validatePrestationExcluse() {
                const pexclusInput = document.getElementById('pexclus');
                const errorMessageElement = document.getElementById('pexclus-error-message'); // ID pour l'erreur
                const prestationE = pexclusInput.value.trim();
                let errors = [];
        
                // 2. Séparer la chaîne en éléments par la virgule et supprimer les espaces
                const prestationsArray = prestationE.split(',').map(item => item.trim());
    
                // 3. Vérification de chaque élément
                prestationsArray.forEach(pe => {
                    if (pe.length < 2) {
                        errors.push(`"${pe}" doit contenir au moins 2 caractères.`);
                    }
    
                    // 4. Vérification des caractères interdits
                    const forbiddenCharacters = /[<>]/;
                    if (forbiddenCharacters.test(pe)) {
                        errors.push(`"${pe}" contient des caractères interdits (ex : <, >).`);
                    }
                });
    
                // 5. Vérification de la longueur totale (limite de 100 caractères)
                if (prestationE.length > 100) {
                    errors.push("La liste des prestations exclues ne doit pas dépasser 100 caractères.");
                }

        
                // Affichage des erreurs ou validation
                if (errors.length > 0) {
                    errorMessageElement.textContent = errors.join(" ");
                    submitButton.disabled = true;
                } else {
                    errorMessageElement.textContent = "";
                    submitButton.disabled = false;
                }
                
            }

            function validateLangue() {
                const langueInput = document.getElementById('langue');
                const errorMessageElement = document.getElementById('langue-error-message'); // ID pour l'erreur
                const langues = langueInput.value.trim();
                let errors = [];
        
                // 2. Séparer la chaîne en éléments par la virgule et supprimer les espaces
                const languesArray = langues.split(',').map(item => item.trim());
    
                // 3. Vérification de chaque élément
                languesArray.forEach(langue => {
                    if (langue.length < 2) {
                        errors.push(`"${langue}" doit contenir au moins 2 caractères.`);
                    }
    
                    // 4. Vérification des caractères interdits
                    const forbiddenCharacters = /[<>]/;
                    if (forbiddenCharacters.test(langue)) {
                        errors.push(`"${langue}" contient des caractères interdits (ex : <, >).`);
                    }
                });
    
                // 5. Vérification de la longueur totale (limite de 30 caractères)
                if (langues.length > 30) {
                    errors.push("La liste des langues ne doit pas dépasser 30 caractères.");
                }
                
        
                // Affichage des erreurs ou validation
                if (errors.length > 0) {
                    errorMessageElement.textContent = errors.join(" ");
                    submitButton.disabled = true;
                } else {
                    errorMessageElement.textContent = "";
                    submitButton.disabled = false;
                }
                
            }

            // Validation lorsque l'utilisateur quitte le champ de saisie (événement blur)
            document.getElementById('titre').addEventListener('blur', validateTitle);
            document.getElementById('resume').addEventListener('blur', validateResume);
            document.getElementById('description').addEventListener('blur', validateDescription);
            document.getElementById('adresse').addEventListener('blur', validateAdresse);
            document.getElementById('codeP').addEventListener('blur', validatePostalCode);
            document.getElementById('ville').addEventListener('blur', validateCity);
            document.getElementById('accessibilite').addEventListener('blur', validateAccessibility);
            document.getElementById('prix').addEventListener('blur', validatePrice);
            document.getElementById('duree').addEventListener('blur', validateDuree);
            document.getElementById('age').addEventListener('blur', validateAgeMin);
            document.getElementById('nbattraction').addEventListener('blur', validateNbrAttractions);
            document.getElementById('capacite').addEventListener('blur', validateCapacite);
            document.getElementById('pinclus').addEventListener('blur', validatePrestationIncluse);
            document.getElementById('pexclus').addEventListener('blur', validatePrestationExcluse);
            document.getElementById('langue').addEventListener('blur', validateLangue);





            