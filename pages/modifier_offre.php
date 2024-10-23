<?php
//include_once 'nav.php';

include('../sql/connect_params.php');

var_dump($_POST);
//TODO prestations
$idO = 4;
$isResto = false; // to see what tags to set
$tags_location =''; // to check activated tags
try{
    $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname",
        $user, $pass);
        
        $stmt = $dbh->prepare(
            "SELECT *
             FROM pact.offre
             WHERE ido = $idO;"
        );

        $stmt->execute();
    
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $categorie = trim($resultat[0]["categorie"]);

        switch ($categorie) {
            case 'Activite':
                $stmt = $dbh->prepare(
                    "SELECT *
                     FROM pact.activite
                     WHERE ido = $idO;"
                );
                $tags_location = '_tags_activite';
                break;
            case 'Visite':
                $stmt = $dbh->prepare(
                    "SELECT *
                     FROM pact.visite
                     WHERE ido = $idO;"
                );
                $tags_location = '_tags_visite';
                break;
            case 'Spectacle':
                $stmt = $dbh->prepare(
                    "SELECT *
                     FROM pact.spectacle
                     WHERE ido = $idO;"
                );
                $tags_location = '_tags_spectacle';
                break;
            case "Parc d'attraction":
                $stmt = $dbh->prepare(
                    "SELECT *
                     FROM pact.parc_d_attraction
                     WHERE ido = $idO;"
                );
                $tags_location = '_tags_parc_d_attraction';
                break;
            case "Restauration":
                $stmt = $dbh->prepare(
                    "SELECT *
                     FROM pact.restauration
                     WHERE ido = $idO;" 
                );
                $tags_location = '_tags_restauration';
                $isResto = true;
                break;
        }

        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $stmt->execute();
    
    
    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $categorie = trim($resultat[0]["categorie"]);

    if ($isResto) {
        $stmt = $dbh->prepare(
            "SELECT *
             FROM pact.tag_resto" 
        );
    }else{
        $stmt = $dbh->prepare(
            "SELECT *
             FROM pact.tag_default;" 
        );
    }
    
    $stmt->execute();
    $tag_names = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo '<pre>';
    // print_r($tag_names);
    // echo '</pre>';

    $stmt = $dbh->prepare(
        "SELECT *
         FROM pact.$tags_location natural join pact._tag where idO = $idO ;" 
    );


    $stmt->execute();
    $tags_offre = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo '<pre>';
    // print_r($tags_offre);
    // echo '</pre>';


} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modification d'offre</title>
        <link rel="stylesheet" href="../css/styleOffre.css">
        <link rel="stylesheet" href="../css/styleGeneral.css">
        
        
    </head>
    <body>
        <div class="main-content"> 
            <h1 class="TS-bold">Modifiez votre offre</h1>            
            <form action="modifier_offre.php" method="post" enctype="multipart/form-data">
                <div id="form-content" class="FS">
                    <div id="left-part">
                        <div id="left-part-content">
                            <div id="title-categorie">
                                <!-- Champ "Titre" -->
                                <div class="container" id="titre-container">
                                    <label for="titre">Titre de l'offre*</label>
                                    <input type="text" id="titre" class="FS" name="titre" placeholder="Roméo et Juliette" required  value="<?php echo $resultat[0]["titre"];?>"/>
                                </div>
                                <!-- Champ "Catégorie" -->
                                <div class="container categorie-container">
                                    <label for="categorie-offre">Catégorie de l'offre</label>
                                    <select id="categorie-offre" name="categorie" required class="FS" disabled>
                                    <?php switch ($categorie) {
                                        case 'Activite':
                                            ?>
                                            <option value="activite" <?php echo 'selected id="first-option"'?>>Activité</option>
                                            <?php
                                            break;
                                        case 'Visite':
                                             ?>
                                            <option value="visite" <?php echo 'selected id="first-option"'?>>Visite</option>
                                            <?php
                                            break;
                                        case 'Spectacle':
                                            ?>
                                            <option value="spectacle" <?php echo 'selected id="first-option"'?>>Spectacle</option>
                                            <?php
                                            break;
                                        case "Parc d'attraction":
                                                ?>
                                                <option value="parcAttraction" <?php echo 'selected id="first-option"'?>>Parc d'attraction</option>
                                                <?php
                                                break;
                                        case "Restauration":
                                            ?>
                                            <option value="restauration" <?php echo 'selected id="first-option"'?>>Restauration</option>
                                            <?php
                                            break;
                                        default:
                                            # code...
                                            break;
                                    }?>
                                    </select>
                                </div>
                            </div>
                            <!-- Champ "Résumé" -->
                            <div class="container" id="resume-container">
                                <label for="resume">Résumé*</label>
                                <textarea id="resume" class="FS" name="resume" placeholder="L'histoire d'amour et tragique de..." required><?php echo $resultat[0]["resume"];?></textarea>
                            </div>
                            <!-- Champ "Description" -->
                            <div class="container" id="description-container">
                                <label for="description">Description</label>
                                <textarea id="description" class="FS" name="description" placeholder="Spectacle se déroulant au théatre du..."><?php echo $resultat[0]["description"];?></textarea>
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
                                    <label for="adresse">Adresse*</label>
                                    <input type="text" id="adresse" class="FS" name="adresse" placeholder="5 rue de l'exemple" required value="<?php echo $resultat[0]["numero_voie"] . " " . $resultat[0]["voie"];?>" />
                                </div>
                                <div id="codeP-ville">
                                    <!-- Champ Code postal -->
                                    <div class="container" id="codeP-container">
                                        <label for="codeP">Code Postal*</label>
                                        <input type="text" id="codeP" class="FS" name="codeP" placeholder="22100" required value="<?php echo $resultat[0]["code_postal"] ?>"/>
                                    </div>
                                    <!-- Champ "ville" -->
                                    <div class="container" id="ville-container">
                                        <label for="ville">Ville*</label>
                                        <input type="text" id="ville" class="FS" name="ville" placeholder="Lannion" required value="<?php echo $resultat[0]["ville"] ?>"/>
                                    </div>
                                </div>
                                
                                <!-- Champ "Accesibilité" -->
                                <div class="container" id="accessibilite-container">
                                    <label for="accessibilite">Accessibilité*</label>
                                    <textarea id="accessibilite" class="FS" name="accessibilite" placeholder="Entrée du théatre accessible en fauteuil roulant et amménagé pour.." required><?php echo $resultat[0]["accessibilite"] ?></textarea>
                                </div>
                                <!-- Champ "prix minimum" -->
                                <div id="duree-prix-age">
                                    <div class="container" id="duree-container">
                                        <label for="duree">Durée</label>
                                        <input type="text" id="duree" class="FS" name="duree" placeholder="80" required value="<?php echo $resultat[0]["duree"] ?>"/>
                                    </div>
                                    <div class="container" id="nbattraction-container">
                                        <label for="nbattraction">Nombre d'attractions</label>
                                        <input type="text" id="nbattraction" class="FS" name="nbattraction" placeholder="25" required value="<?php echo $resultat[0]["nbr_attractions"] ?>" />
                                    </div>
                                    <div class="container" id="prix-container">
                                        <label for="prix">Prix minimum (€)</label>
                                        <input type="text" id="prix" class="FS" name="prix" placeholder="25" required value="<?php echo $resultat[0]["prix_min"] ?>"/>
                                    </div>
                                    <div class="container" id="age-container">
                                        <label for="age">Âge minimum</label>
                                        <input type="text" id="age" class="FS" name="age" placeholder="8" required value="<?php echo $resultat[0]["age_min"] ?>"/>
                                    </div>
                                    <div class="container" id="capacite-container">
                                        <label for="capacite">Capacité</label>
                                        <input type="text" id="capacite" class="FS" name="capacite" placeholder="230" required value="<?php echo $resultat[0]["capacite"] ?>"/>
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
                                    <input type="text" id="langue" class="FS" name="langue" placeholder="Saisir" required value="<?php echo $resultat[0]["langues"] ?>"/>
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
                                                <input type="checkbox" id="une" name="option" value="une" onclick="checkOnlyOne(this)" <?php echo ($resultat[0]["option"] == 'À la Une') ? "checked" : ""?>/>
                                                <label for="une">À la Une </label>
                                            </div>
                                            <div id="relief">
                                                <input type="checkbox" id="relief" name="option" value="relief" onclick="checkOnlyOne(this)" <?php echo ($resultat[0]["option"] == 'En relief') ? "checked" : ""?>/>
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

<?php
if (true){
    switch ($_POST['categorie']) {
        case 'activite':
            $stmt = $dbh->prepare(
                "update pact.activite set 
                    titre = '$titre', 
                    resume = '$resume', 
                    \"type\" = $type, 
                    option = '$option', 
                    description = '$description',
                    prix_min = $prix_min, 
                    accessibilite = '$accaccessibilite', 
                    date_publication = now(), 
                    duree = interval '$duree', 
                    age_min = $age_min,
                    prestation_incluse = '$prestation_incluse', 
                    prestation_excluse = '$prestation_excluse', 
                    ville = '$ville', 
                    numero_voie = $numero_voie , 
                    voie = '$voie', 
                    code_postal = $code_postal, 
                    complement =''
                where idO = $idC;"
            );
            break;
        case 'spectacle':
            $stmt = $dbh->prepare(
                "update pact.spectacle set 
                    titre = '$titre', 
                    resume = '$resume', 
                    \"type\" = $type, 
                    option = '$option', 
                    description = '$description',
                    prix_min = $prix_min, 
                    accessibilite = '$accaccessibilite', 
                    date_publication = now(), 
                    duree = interval '$duree', 
                    capacite = $capacite,
                    ville = '$ville', 
                    numero_voie = $numero_voie , 
                    voie = '$voie', 
                    code_postal = $code_postal, 
                    complement =''
                where idO = $idC;"
            );
            break;

        case 'visite':
            $stmt = $dbh->prepare(
                "update pact.visite set 
                    titre = '$titre', 
                    resume = '$resume', 
                    \"type\" = $type, 
                    option = '$option', 
                    description = '$description',
                    prix_min = $prix_min, 
                    accessibilite = '$accaccessibilite', 
                    date_publication = now(), 
                    duree = interval '$duree', 
                    langues = '$langues',
                    ville = '$ville', 
                    numero_voie = $numero_voie , 
                    voie = '$voie', 
                    code_postal = $code_postal, 
                    complement =''
                where idO = $idC;"
            );
            break;

        // don't know if image works for update
        case 'restauration':
            $stmt = $dbh->prepare(
                "update pact.restauration set 
                    titre = '$titre', 
                    resume = '$resume', 
                    \"type\" = $type, 
                    option = '$option', 
                    description = '$description',
                    prix_min = $prix_min, 
                    accessibilite = '$accaccessibilite', 
                    date_publication = now(),
                    src_image = '$src_image',
                    gamme_prix = '$gamme_prix',
                    petit_dejeuner = $petit_dejeuner,
                    brunch = $brunch, 
                    dejeuner = $dejeuner, 
                    diner = $diner, 
                    boissons = $boissons,
                    ville = '$ville', 
                    numero_voie = $numero_voie , 
                    voie = '$voie', 
                    code_postal = $code_postal, 
                    complement =''
                where idO = $idC;"
            );
            break;
        case 'parcAttraction':
            $stmt = $dbh->prepare(
                "update pact.parc_d_attraction set 
                    titre = '$titre', 
                    resume = '$resume', 
                    \"type\" = $type, 
                    option = '$option', 
                    description = '$description',
                    prix_min = $prix_min, 
                    accessibilite = '$accaccessibilite', 
                    date_publication = now(), 
                    duree = interval '$duree', 
                    langues = '$langues',
                    ville = '$ville', 
                    numero_voie = $numero_voie , 
                    voie = '$voie', 
                    code_postal = $code_postal, 
                    complement =''
                where idO = $idC;"
            );
            break;

        default:
            # code...
            break;
    }

    $stmt->execute();

    // $duree = '06:00'
    
}
?>