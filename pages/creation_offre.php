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
        <h1>Créez votre offre</h1>
        <div id="form-container">
            <form action="#" method="post" enctype="multipart/form-data">
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
                                <input type="button" id="tags" value="Culturel">
                                <input type="button" id="tags" value="Patrimoine">
                                <input type="button" id="tags" value="Histoire">
                                <input type="button" id="tags" value="Urbain">
                                <input type="button" id="tags" value="Nature">
                                <input type="button" id="tags" value="Plein air">
                                <input type="button" id="tags" value="Sport">
                                <input type="button" id="tags" value="Nautique">
                                <input type="button" id="tags" value="Gastronomie">
                                <input type="button" id="tags" value="Musée">
                                <input type="button" id="tags" value="Atelier">
                                <input type="button" id="tags" value="Musique">
                                <input type="button" id="tags" value="Famille">
                                <input type="button" id="tags" value="Cinéma">
                                <input type="button" id="tags" value="Cirque">
                                <input type="button" id="tags" value="Son et lumière">
                                <input type="button" id="tags" value="Humour">
                            </div>
                        </div>
                        <!-- Bouton de soumission -->
                        <div id="publier-retour">
                            <input type="submit" value="Publier" />
                            <button>
                                <img src="../css/icons/arrow-left-o.svg" alt="Bouton Image" width="15" height="15">
                                Retour
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>