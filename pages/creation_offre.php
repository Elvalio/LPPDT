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
                                <label for="tags">Tags</label>
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
                                    <img src="../icons/arrow-left-o.svg" alt="Bouton Image" width="15" height="15">
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
                            <div class="container" id="accesibilite-container">
                                <label for="accesibilite">Accesibilité</label>
                                <input type="text" id="accesibilite" name="accesibilite" placeholder="Saisir" required />
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
                        </div>
                    </div>
                </div>      
            </form>
        </div>

        <script>
            // Récupérer tous les éléments avec la classe 'tag'
            const tags = document.getElementsByClassName('tag');

            // Transformer la collection en tableau et ajouter un écouteur d'événements à chaque élément
            Array.from(tags).forEach(tag => {
                tag.addEventListener('click', function() {
                    this.classList.toggle('selectionne');  // Ajoute/enlève la classe 'selectionne'
                });
            });

        </script>
    </body>
</html>