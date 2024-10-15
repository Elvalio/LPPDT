<?php
include_once'nav.php';
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Création d'offre</title>
        <link rel="stylesheet" href="cssLisa/styleOffre.css">
        <link rel="stylesheet" href="styleGeneral.css">
    </head>
    <body>
        <div id="form-container">
            <form action="#" method="post" enctype="multipart/form-data">
                <div id="left-part">
                    <div id="title-categorie">
                        <!-- Champ "Titre" -->
                        <div class="container">
                            <label for="titre">Titre de l'offre*</label>
                            <input type="text" id="titre" name="titre" placeholder="Saisir" required />
                        </div>
                        <!-- Champ "Catégorie" -->
                        <div class="container">
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
                        <div class="container">
                            <label for="commune">Commune*</label>
                            <input type="text" id="commune" name="commune" placeholder="Saisir" required />
                        </div>
                        <!-- Champ "Type" -->
                        <div class="container" id="type">
                            <label>Type d'offre</label>
                            <div id="type-container">
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
                    <div class="container">
                        <label for="resume">Résumé*</label>
                        <input type="text" id="resume" name="resume" placeholder="Saisir" required />
                    </div>
                    <!-- Champ "Description" -->
                    <div class="container">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="12" cols="60"></textarea>
                    </div>
                    <!-- Champ "Tags" -->
                    <div class="container">
                        <label for="tags">Tags</label>
                        <div id="tags-item-container">
                            <input type="button" id="tags" value="bouton1">
                            <input type="button" id="tags" value="bouton2">
                        </div>
                    </div>
                    <!-- Bouton de soumission -->
                <input type="submit" value="Publier" />
                <input type="reset" value="Retour" />
                </div>
                
            </form>
        </div>
    </body>
</html>