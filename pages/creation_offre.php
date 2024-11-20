<?php
include_once 'nav.php';

include('../sql/connect_params.php');

function type_offre($str){
    $res = 1;

    if ($str == "standard"){
        $res = 2;
    }else if ($str == "premium"){
        $res = 3;
    }
    return $res;
}

function option_offre($arr){
    $res = '';

    if ($arr['une'] != ''){
        $res = $arr['une'];
    }else if ($arr['relief'] != ''){
        $res = $arr['relief'];
    }
    return $res;
}

//PDO BDD
$idC = $_COOKIE['user'];
if ($_POST['categorie'] != '') {
    try{
        $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname",
            $user, $pass);

        var_dump($_POST);
        $categorie = $_POST['categorie'];

        switch ($categorie) {
            case 'activite':
                $titre = $_POST['titre'];
                $resume = $_POST['resume'];
                $type = type_offre($_POST['offre']);
                $option = option_offre($_POST);
                $description = $_POST['description'];
                $prix_min = $_POST['prix'];
                $accessibilite = $_POST['accessibilite'];
                $duree = $_POST['duree'];
                $age_min = $_POST['age'];
                $prestation_incluse = $_POST['pinclus'];
                $prestation_excluse = $_POST['pexclus'];
                $ville = $_POST['ville'];

                $temp = explode(' ',trim($_POST["adresse"]));
                $numero_voie = $temp[0];
                array_shift($temp);
                $voie = implode(' ', $temp);

                $code_postal= $_POST['codeP'];
                $stmt = $dbh->prepare(
                    "insert into pact.activite 
                    (titre, resume, \"type\", option, description, prix_min, accessibilite, date_creation, date_publication, duree, age_min, prestation_incluse, prestation_excluse, ville, numero_voie, voie, code_postal, complement, idC) values 
                    ('$titre', '$resume', '$type', '$option', '$description', $prix_min, '$accessibilite', now(), now(), interval '$duree', $age_min, '$prestation_incluse', '$prestation_excluse', '$ville', $numero_voie, '$voie', $code_postal, '', $idC);"
                );
                break;

            case 'spectacle':
                $titre = $_POST['titre'];
                $resume = $_POST['resume'];
                $type = type_offre($_POST['offre']);
                $option = option_offre($_POST);
                $description = $_POST['description'];
                $prix_min = $_POST['prix'];
                $accessibilite = $_POST['accessibilite'];
                $duree = $_POST['duree'];
                $capacite = $_POST['capacite'];

                $ville = $_POST['ville'];

                $temp = explode(' ',trim($_POST["adresse"]));
                $numero_voie = $temp[0];
                array_shift($temp);
                $voie = implode(' ', $temp);

                $code_postal= $_POST['codeP'];

                $stmt = $dbh->prepare(
                    "insert into pact.spectacle 
                    (titre, resume, \"type\", option, description, prix_min, accessibilite, date_creation, date_publication, duree, capacite, ville, numero_voie, voie, code_postal, complement, idC) values 
                    ('$titre', '$resume', '$type', '$option', '$description', $prix_min, '$accessibilite', now(), now(), interval '$duree', $capacite, '$ville', $numero_voie, '$voie', $code_postal, '', $idC);"
                );
                break;
                
            case 'visite':
                $titre = $_POST['titre'];
                $resume = $_POST['resume'];
                $type = type_offre($_POST['offre']);
                $option = option_offre($_POST);
                $description = $_POST['description'];
                $prix_min = $_POST['prix'];
                $accessibilite = $_POST['accessibilite'];
                $duree = $_POST['duree'];
                $langues = $_POST['langue'];

                $ville = $_POST['ville'];

                $temp = explode(' ',trim($_POST["adresse"]));
                $numero_voie = $temp[0];
                array_shift($temp);
                $voie = implode(' ', $temp);

                $code_postal= $_POST['codeP'];
                
                $stmt = $dbh->prepare(
                    "insert into pact.visite 
                    (titre, resume, \"type\", option, description, prix_min, accessibilite, date_creation, date_publication, duree, langues, ville, numero_voie, voie, code_postal, complement, idC) values 
                    ('$titre', '$resume', '$type', '$option', '$description', $prix_min, '$accessibilite', now(), now(), interval '$duree', '$langues', '$ville', $numero_voie, '$voie', $code_postal, '', $idC);"
                );
                break;

            case 'restauration':
                $titre = $_POST['titre'];
                $resume = $_POST['resume'];
                $type = type_offre($_POST['offre']);
                $option = option_offre($_POST);
                $description = $_POST['description'];
                $prix_min = $_POST['prix'];
                $accessibilite = $_POST['accessibilite'];

                $src_image = random_int(1, 1000); // need image source
                $gamme_prix = $_POST['categorie-prix'];
                $petit_dejeuner = ($_POST['petit-dejeuner'] == 'petit-dejeuner') ? 'true' : 'false';
                $brunch = ($_POST['brunch'] == 'brunch') ? 'true' : 'false';
                $dejeuner = ($_POST['dejeuner'] == 'dejeuner') ? 'true' : 'false';
                $diner = ($_POST['diner'] == 'diner') ? 'true' : 'false';
                $boissons = ($_POST['boissons'] == 'boissons') ? 'true' : 'false';

                $ville = $_POST['ville'];

                $temp = explode(' ',trim($_POST["adresse"]));
                $numero_voie = $temp[0];
                array_shift($temp);
                $voie = implode(' ', $temp);

                $code_postal= $_POST['codeP'];
                
                $stmt = $dbh->prepare(
                    "insert into pact.restauration 
                    (titre, resume, \"type\", option, description, prix_min, accessibilite, date_creation, date_publication, src_image, gamme_prix, ville, petit_dejeuner, brunch, dejeuner, diner, boissons, numero_voie, voie, code_postal, complement, idC) values 
                    ('$titre', '$resume', '$type', '$option', '$description', $prix_min, '$accessibilite', now(), now(), '$src_image', '$gamme_prix', '$ville', $petit_dejeuner, $brunch, $dejeuner, $diner, $boissons, $numero_voie, '$voie', $code_postal, '', $idC);"
                );
                break;

            case 'parcAttraction':
                $titre = $_POST['titre'];
                $resume = $_POST['resume'];
                $type = type_offre($_POST['offre']);
                $option = option_offre($_POST);
                $description = $_POST['description'];
                $prix_min = $_POST['prix'];
                $accessibilite = $_POST['accessibilite'];
                $src_image = random_int(1, 1000); // need image source
                $nbr_attractions = $_POST['nbattraction'];
                $age_min = $_POST['age'];

                $ville = $_POST['ville'];

                $temp = explode(' ',trim($_POST["adresse"]));
                $numero_voie = $temp[0];
                array_shift($temp);
                $voie = implode(' ', $temp);

                $code_postal= $_POST['codeP'];
                
                $stmt = $dbh->prepare(
                    "insert into pact.parc_d_attraction 
                    (titre, resume, \"type\", option, description, prix_min, accessibilite, date_creation, date_publication, src_image, nbr_attractions, age_min, ville, numero_voie, voie, code_postal, complement, idC) values 
                    ('$titre', '$resume', '$type', '$option', '$description', $prix_min, '$accessibilite', now(), now(), '$src_image', $nbr_attractions, $age_min, '$ville', $numero_voie, '$voie', $code_postal, '', $idC);"
                );
                break;

            default:
                # code...
                break;
        } 
        $stmt->execute();


    } catch (PDOException $e) {
        echo "<pre>";
        print "Erreur !: " . $e->getMessage() . "<br/>";
        echo "</pre>";
        die();
    }
}


// vérifier qu'une catégorie a été sélectionné
// vérifier que les display.none n'ai pas de valeur


?>


<!-- <?php
$targetDir = '../test/'; // Dossier de destination

// Créer le dossier s'il n'existe pas
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

if (isset($_FILES['image'])) {
    $fileName = basename($_FILES['image']['name']);
    $targetFilePath = $targetDir . $fileName;

    // Vérifier si le fichier peut être téléchargé
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
        // Renvoie une réponse JSON avec le nom du fichier
        echo json_encode(['success' => true, 'imageName' => $fileName]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'importation de l\'image.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Aucun fichier reçu.']);
}
?> -->

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Création d'offre</title>
        <link rel="stylesheet" href="../css/styleOffre.css">
        <link rel="stylesheet" href="../css/styleGeneral.css">
        
        
    </head>
    <body class="BO">
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
                                    <p id="error-message-titre" class="error-message"></p>
                                    <input type="text" id="titre" class="FS" name="titre" placeholder="Roméo et Juliette" required />
                                    
                                </div>
                                <!-- Champ "Catégorie" -->
                                <div class="container categorie-container">
                                    <label for="categorie-offre">Catégorie de l'offre*</label>
                                    <select id="categorie-offre" name="categorie" class="FS" required>
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
                                <p id="resume-error-message" class="error-message"></p>
                                <textarea id="resume" class="FS" name="resume" placeholder="L'histoire d'amour et tragique de..." required></textarea>
                            </div>
                            <!-- Champ "Description" -->
                            <div class="container" id="description-container">
                                <label for="description">Description</label>
                                <p id="description-error-message" class="error-message"></p>
                                <textarea id="description" class="FS" name="description" placeholder="Spectacle se déroulant au théatre du..."></textarea>
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
                                <input id="submit-button" type="submit" class="FS" value="Publier" />
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
                                    <label for="adresse">Adresse*</label>
                                    <p id="adresse-error-message" class="error-message"></p>
                                    <input type="text" id="adresse" class="FS" name="adresse" placeholder="5 rue de l'exemple" required />
                                </div>
                                <div id="codeP-ville">
                                    <!-- Champ Code postal -->
                                    <div class="container" id="codeP-container">
                                        <label for="codeP">Code Postal*</label>
                                        <p id="postal-code-error-message" class="error-message"></p>
                                        <input type="text" id="codeP" class="FS" name="codeP" placeholder="22100" required />
                                    </div>
                                    <!-- Champ "ville" -->
                                    <div class="container" id="ville-container">
                                        <label for="ville">Ville*</label>
                                        <p id="city-error-message" class="error-message"></p>
                                        <input type="text" id="ville" class="FS" name="ville" placeholder="Lannion" required />
                                    </div>
                                </div>
                                
                                <!-- Champ "Accesibilité" -->
                                <div class="container" id="accessibilite-container">
                                    <label for="accessibilite">Accessibilité*</label>
                                    <p id="accessibility-error-message" class="error-message"></p>
                                    <textarea id="accessibilite" class="FS" name="accessibilite" placeholder="Entrée du théatre accessible en fauteuil roulant et amménagé pour.." required></textarea>
                                </div>
                                <!-- Champ "prix minimum" -->
                                <div id="duree-prix-age">
                                    <div class="container" id="duree-container">
                                        <label for="duree">Durée*</label>
                                        <p id="duree-error-message" class="error-message"></p>
                                        <input type="text" id="duree" class="FS" name="duree" placeholder="01:10:55" required />
                                    </div>
                                    <div class="container" id="nbattraction-container">
                                        <label for="nbattraction">Nombre d'attractions*</label>
                                        <p id="nbr_attractions-error-message" class="error-message"></p>
                                        <input type="text" id="nbattraction" class="FS" name="nbattraction" placeholder="25" required />
                                    </div>
                                    <div class="container" id="prix-container">
                                        <label for="prix">Prix minimum (€)*</label>
                                        <p id="prix-error-message" class="error-message"></p>
                                        <input type="text" id="prix" class="FS" name="prix" placeholder="25" required />
                                    </div>
                                    <div class="container" id="age-container">
                                        <label for="age">Âge minimum*</label>
                                        <p id="age_min-error-message" class="error-message"></p>
                                        <input type="text" id="age" class="FS" name="age" placeholder="8" required />
                                    </div>
                                    <div class="container" id="capacite-container">
                                        <label for="capacite">Capacité*</label>
                                        <p id="capacite-error-message" class="error-message"></p>
                                        <input type="text" id="capacite" class="FS" name="capacite" placeholder="230" required />
                                    </div>
                                    <div class="container categorie-container" id="categorie-prix-container">
                                        <label for="categorie-prix">Gamme de prix*</label>
                                        <select id="categorie-prix" name="categorie-prix" class="FS">
                                            <option value="" disabled selected hidden id="first-option">Gamme de prix</option>
                                            <option value="€">€</option>
                                            <option value="€€">€€</option>
                                            <option value="€€€">€€€</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="container" id="pinclus-container">
                                    <label for="pinclus">Prestation incluse</label>
                                    <p id="pinclus-error-message" class="error-message"></p>
                                    <textarea id="pinclus" class="FS" name="pinclus" placeholder="Kayak, Pagaie, Gilet de sauvetage.."></textarea>
                                </div>
                                <div class="container" id="pexclus-container">
                                    <label for="pexclus">Prestation excluse</label>
                                    <p id="pexclus-error-message" class="error-message"></p>
                                    <textarea id="pexclus" class="FS" name="pexclus" placeholder="Casque,.."></textarea>
                                </div>
                                <div class="container" id="langue-container">
                                    <label for="langue">Langue</label>
                                    <p id="langue-error-message" class="error-message"></p>
                                    <input type="text" id="langue" class="FS" name="langue" placeholder="Saisir"/>
                                </div>

                                <div id="repas-map">
                                    <div id="repas-container">
                                        <label>Repas servis</label>
                                        <div id="repas-items-container">
                                            <div id="petit-dejeuner">
                                                <input type="checkbox" id="petit-dejeuner" name="petit-dejeuner" value="petit-dejeuner"/>
                                                <label for="petit-dejeuner">Petit-déjeuner</label>
                                            </div>
                                            <div id="brunch">
                                                <input type="checkbox" id="brunch" name="brunch" value="brunch"/>
                                                <label for="brunch">Brunch</label>
                                            </div>
                                            <div id="dejeuner">
                                                <input type="checkbox" id="dejeuner" name="dejeuner" value="dejeuner"/>
                                                <label for="dejeuner">Déjeuner</label>
                                            </div>
                                            <div id="dinner">
                                                <input type="checkbox" id="diner" name="diner" value="diner"/>
                                                <label for="diner">Dîner</label>
                                            </div>
                                            <div id="boissons">
                                                <input type="checkbox" id="boissons" name="boissons" value="boissons"/>
                                                <label for="boissons">Boissons</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!---- Champs ajout carte --->
                                    <div id="map-image">
                                        <label>Plan du parc</label>
                                        <!-- Éléments pour afficher les images importées -->
                                        <div id="map-image-container">
                                            <img id="selected-image" src="../images/rien.png" alt="Image sélectionnée" />
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
                                <div id="type-option"  <?php echo  ((string)$_COOKIE['type_compte'] == 'pro_prive') ?  '' : 'style="display: none;"';?>>
                                    <!-- Champ "Type" -->
                                    <div id="type-container">
                                        <label>Type d'offre</label>
                                        
                                        <div id="gratuit" hidden<?php echo  ((string)$_COOKIE['type_compte'] == 'pro_prive') ?  '' : 'style="display: none;"';?>>
                                            <input type="radio" id="gratuit" name="offre" value="gratuit" <?php echo  ((string)$_COOKIE['type_compte'] == 'pro_public') ?  'checked' : '';?>/>
                                            <label for="gratuit">Gratuit</label>
                                        </div>

                                        <div id="standard-premium">
                                            <div id="standard">
                                                <input type="radio" id="standard" name="offre" value="standard" <?php echo  ((string)$_COOKIE['type_compte'] == 'pro_prive') ?  'checked' : '';?>/>
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
                                                <input type="checkbox" id="une" name="une" value="À la Une" onclick="checkOnlyOne(this)"/>
                                                <label for="une">À la Une </label>
                                            </div>
                                            <div id="relief">
                                                <input type="checkbox" id="relief" name="relief" value="En relief" onclick="checkOnlyOne(this)"/>
                                                <label for="relief">En relief</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div id="bottom-right-part-content">                        
                                <!---- Champs ajout 3 images --->
                                <div id="file-container">
                                    <!---- Bouton 1 --->
                                    <label for="file-upload1" class="custom-file-upload">
                                        <img src="../icons/plus.svg" alt="Bouton Image">
                                        <p class="upload-text">Ajouter une image 1</p>
                                    </label>
                                    <input type="file" id="file-upload1" class="file-upload" accept=".png"/>

                                    <!---- Bouton 2 --->
                                    <label for="file-upload2" class="custom-file-upload">
                                        <img src="../icons/plus.svg" alt="Bouton Image">
                                        <p class="upload-text">Ajouter une image 2</p>
                                    </label>
                                    <input type="file" id="file-upload2" class="file-upload" accept=".png"/>
                                    <!---- Bouton 3 --->
                                    <label for="file-upload3" class="custom-file-upload">
                                        <img src="../icons/plus.svg" alt="Bouton Image">
                                        <p class="upload-text">Ajouter une image 3</p>
                                    </label>
                                    <input type="file" id="file-upload3" class="file-upload" accept=".png"/>

                                    <button id="file-delete" type="button">
                                        <img src="../icons/moins.svg" alt="Bouton Image">
                                        Supprimer une image
                                    </button>
                                </div>
                                <p id="error-message-supprimer" style="color: red; display: none;">Vous ne pouvez pas supprimer une image inexistante !</p>
                                <!-- Éléments pour afficher les images importées -->
                                <div id="image-container">
                                    <img class="selected-image" src="../images/rien.png" alt="Image sélectionnée1" />
                                    <img class="selected-image" src="../images/rien.png" alt="Image sélectionnée2" />
                                    <img class="selected-image" src="../images/rien.png" alt="Image sélectionnée3" />
                                </div>
                            </div>

                            <!-- Formulaire caché pour le téléchargement d'images -->
                            
                        </div>
                    </div>
                </div>      
            </form>
        </div>

        <script src="../js/creation_offre.js">
        </script>
    </body>
</html>