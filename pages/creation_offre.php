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
                                <div class="container categorie-container">
                                    <label for="categorie-offre">Catégorie de l'offre*</label>
                                    <select id="categorie-offre" name="categorie" required class="FS">
                                        <option value="" disabled selected hidden id="first-option">Catégorie de l'offre</option>
                                        <option value="activite">Activité</option>
                                        <option value="visite">Visite</option>
                                        <option value="spectacle">Spectacle</option>
                                        <option value="parcAttraction">Parc d'attraction</option>
                                        <option value="restauration">Restauration</option>
                                    </select>
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
                                        <p>Culturel</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <p>Patrimoine</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <p>Histoire</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <p>Urbain</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <p>Nature</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <p>Plein air</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <p>Sport</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <p>Nautique</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <p>Gastronomie</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <p>Musée</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <p>Atelier</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <p>Musique</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <p>Famille</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <p>Cinéma</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <p>Cirque</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <p>Son et lumière</p>
                                    </button>
                                    <button class="tag FS" type="button">
                                        <p>Humour</p>
                                    </button>
                                    <button class="tag FS hidden" type="button">
                                        <p>Française</p>
                                    </button>
                                    <button class="tag FS hidden" type="button">
                                        <p>Fruit de mer</p>
                                    </button>
                                    <button class="tag FS hidden" type="button">
                                        <p>Asiatique</p>
                                    </button>
                                    <button class="tag FS hidden" type="button">
                                        <p>Indienne</p>
                                    </button>
                                    <button class="tag FS hidden" type="button">
                                        <p>Italienne</p>
                                    </button>
                                    <button class="tag FS hidden" type="button">
                                        <p>Gastronomique</p>
                                    </button>
                                    <button class="tag FS hidden" type="button">
                                        <p>Restauration rapide</p>
                                    </button>
                                    <button class="tag FS hidden" type="button">
                                        <p>Crêperie</p>
                                    </button>
                                    <button class="tag FS hidden" type="button">
                                        <p>Végétarienne</p>
                                    </button>
                                    <button class="tag FS hidden" type="button">
                                        <p>Végétalienne</p>
                                    </button>
                                    <button class="tag FS hidden" type="button">
                                        <p>Kebab</p>
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
                                <div id="codeP-ville">
                                    <!-- Champ Code postal -->
                                    <div class="container" id="codeP-container">
                                        <label for="codeP">Code Postal*</label>
                                        <input type="text" id="codeP" class="FS" name="codeP" placeholder="22100" required />
                                    </div>
                                    <!-- Champ "ville" -->
                                    <div class="container" id="ville-container">
                                        <label for="ville">Ville*</label>
                                        <input type="text" id="ville" class="FS" name="ville" placeholder="Lannion" required />
                                    </div>
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
                                    <div class="container" id="nbattraction-container">
                                        <label for="nbattraction">Nombre d'attractions</label>
                                        <input type="text" id="nbattraction" class="FS" name="nbattraction" placeholder="Saisir" required />
                                    </div>
                                    <div class="container" id="prix-container">
                                        <label for="prix">Prix minimum (€)</label>
                                        <input type="text" id="prix" class="FS" name="prix" placeholder="Saisir" required />
                                    </div>
                                    <div class="container" id="age-container">
                                        <label for="age">Âge minimum</label>
                                        <input type="text" id="age" class="FS" name="age" placeholder="Saisir" required />
                                    </div>
                                    <div class="container" id="capacite-container">
                                        <label for="capacite">Capacité</label>
                                        <input type="text" id="capacite" class="FS" name="capacite" placeholder="Saisir" required />
                                    </div>
                                    <div class="container categorie-container" id="categorie-prix-container">
                                        <label for="categorie-prix">Gamme de prix*</label>
                                        <select id="categorie-prix" name="categorie" required class="FS">
                                            <option value="" disabled selected hidden id="first-option">Gamme de prix</option>
                                            <option value="€">€</option>
                                            <option value="€€">€€</option>
                                            <option value="€€€">€€€</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="container" id="langue-container">
                                    <label for="langue">Langue</label>
                                    <input type="text" id="langue" class="FS" name="langue" placeholder="Saisir" required />
                                </div>

                                <div id="repas-map">
                                    <div id="repas-container">
                                        <label>Repas servis</label>
                                        <div id="repas-items-container">
                                            <div id="petit-dejeuner">
                                                <input type="checkbox" id="petit-dejeuner" name="option" value="petit-dejeuner"/>
                                                <label for="petit-dejeuner">Petit-déjeuner</label>
                                            </div>
                                            <div id="brunch">
                                                <input type="checkbox" id="brunch" name="option" value="brunch"/>
                                                <label for="brunch">Brunch</label>
                                            </div>
                                            <div id="dejeuner">
                                                <input type="checkbox" id="dejeuner" name="option" value="dejeuner"/>
                                                <label for="dejeuner">Déjeuner</label>
                                            </div>
                                            <div id="dinner">
                                                <input type="checkbox" id="dinner" name="option" value="dinner"/>
                                                <label for="dinner">Dîner</label>
                                            </div>
                                            <div id="boissons">
                                                <input type="checkbox" id="boissons" name="option" value="boissons"/>
                                                <label for="boissons">Boissons</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!---- Champs ajout carte --->
                                    <div id="map-image">
                                        <label>Plan du parc</label>
                                        <!-- Éléments pour afficher les images importées -->
                                        <div id="map-image-container">
                                            <img class="selected-image" src="../images/rien.png" alt="Image sélectionnée" />
                                        </div>
                                        <div id="map-file-container">
                                            <label for="map-file-upload" id="map-custom-file-upload">
                                                <img src="../icons/plus.svg" alt="Bouton Image">
                                                <p id="map-upload-text">Ajouter</p>
                                            </label>
                                            <input type="file" id="map-file-upload" accept=".png"/>
                                            <button id="map-file-delete" type="button">
                                                <img src="../icons/moins.svg" alt="Bouton Image">
                                                Supprimer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div id="type-option">
                                    <!-- Champ "Type" -->
                                    <div id="type-container">
                                        <label>Type d'offre</label>
                                        <div id="standard-premium">
                                            <div id="standard">
                                                <input type="radio" id="standard" name="offre" value="standard" checked/>
                                                <label for="standard">Standard</label>
                                            </div>
                                            <div id="premium">
                                                <input type="radio" id="premium" name="offre" value="premium" />
                                                <label for="premium">Premium</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Champ "Options" -->
                                    <div id="option-container">
                                        <label>Options</label>
                                        <div id="une-relief">
                                            <div id="une">
                                                <input type="checkbox" id="une" name="option" value="une" onclick="checkOnlyOne(this)"/>
                                                <label for="une">À la Une </label>
                                            </div>
                                            <div id="relief">
                                                <input type="checkbox" id="relief" name="option" value="relief" onclick="checkOnlyOne(this)"/>
                                                <label for="relief">En relief</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div id="bottom-right-part-content">
                                
                                
                                <!---- Champs ajout 3 images --->
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

        <script src="../js/creation_offre.js"></script>
    </body>
</html>