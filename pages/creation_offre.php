<?php


include('../sql/connect_params.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

function type_offre($nom_type){
    $resultat = 1; //type offre gratuite par défaut

    if ($nom_type == "standard"){
        $resultat = 2;
    }else if ($nom_type == "premium"){
        $resultat = 3;
    }
    return $resultat;
}

function option_offre($arr){
    $res = null;

    if (isset($arr['une']) && $arr['une'] != ''){
        $res = 2;
    }else if (isset($arr['relief']) && $arr['relief'] != ''){
        $res = 1;
    }
    return $res;
}

function tag_offre($arr){
    $resultat = []; //aucun tag par défaut

    if (isset($_POST['culturel'])){
        $resultat[] = $arr['culturel'];
    } 
    if (isset($_POST['patrimoine'])){
        $resultat[] = $arr['patrimoine'];
    } 
    if (isset($_POST['histoire'])){
        $resultat[] = $arr['histoire'];
    } 
    if (isset($_POST['urbain'])){
        $resultat[] = $arr['urbain'];
    } 
    if (isset($_POST['nature'])){
        $resultat[] = $arr['nature'];
    } 
    if (isset($_POST['plein-air'])){
        $resultat[] = $arr['plein-air'];
    } 
    if (isset($_POST['sport'])){
        $resultat[] = $arr['sport'];
    } 
    if (isset($_POST['nautique'])){
        $resultat[] = $arr['nautique'];
    } 
    if (isset($_POST['gastronomie'])){
        $resultat[] = $arr['gastronomie'];
    } 
    if (isset($_POST['musee'])){
        $resultat[] = $arr['musee'];
    } 
    if (isset($_POST['atelier'])){
        $resultat[] = $arr['atelier'];
    } 
    if (isset($_POST['musique'])){
        $resultat[] = $arr['musique'];
    } 
    if (isset($_POST['famille'])){
        $resultat[] = $arr['famille'];
    } 
    if (isset($_POST['cinema'])){
        $resultat[] = $arr['cinema'];
    } 
    if (isset($_POST['cirque'])){
        $resultat[] = $arr['cirque'];
    } 
    if (isset($_POST['son-et-lumiere'])){
        $resultat[] = $arr['son-et-lumiere'];
    } 
    if (isset($_POST['humour'])){
        $resultat[] = $arr['humour'];
    } 
    if (isset($_POST['francais'])){
        $resultat[] = $arr['francais'];
    } 
    if (isset($_POST['fruit-de-mer'])){
        $resultat[] = $arr['fruit-de-mer'];
    } 
    if (isset($_POST['asiatique'])){
        $resultat[] = $arr['asiatique'];
    } 
    if (isset($_POST['indienne'])){
        $resultat[] = $arr['indienne'];
    } 
    if (isset($_POST['italienne'])){
        $resultat[] = $arr['italienne'];
    } 
    if (isset($_POST['gastronomique'])){
        $resultat[] = $arr['gastronomique'];
    } 
    if (isset($_POST['restauration-rapide'])){
        $resultat[] = $arr['restauration-rapide'];
    } 
    if (isset($_POST['creperie'])){
        $resultat[] = $arr['creperie'];
    } 
    if (isset($_POST['vegetarienne'])){
        $resultat[] = $arr['vegetarienne'];
    } 
    if (isset($_POST['vegetalienne'])){
        $resultat[] = $arr['vegetalienne'];
    } 
    if (isset($_POST['kebab'])){
        $resultat[] = $arr['kebab'];
    }
    return $resultat;
}

//PDO BDD
if ($_POST != null) {
    $idC = $_COOKIE['user'];
    if ($_POST['categorie'] != '') {
        try{
            $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname",
                $user, $pass);   
            // var_dump($_POST); //pour voir ce que contient $_POST
            $categorie = $_POST['categorie'];

            switch ($categorie) {
                case 'activite':
                    $titre = $_POST['titre'];
                    $resume = $_POST['resume'];
                    $type = type_offre($_POST['offre']);
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
                        (titre, resume, \"type\", description, prix_min, accessibilite, date_creation, date_publication, duree, age_min, prestation_incluse, prestation_excluse, ville, numero_voie, voie, code_postal, complement, idC) values 
                        ('$titre', '$resume', '$type', '$description', $prix_min, '$accessibilite', now(), now(), interval '$duree', $age_min, '$prestation_incluse', '$prestation_excluse', '$ville', $numero_voie, '$voie', $code_postal, '', $idC);"
                    );
                    break;

                case 'spectacle':
                    $titre = $_POST['titre'];
                    $resume = $_POST['resume'];
                    $type = type_offre($_POST['offre']);
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
                        (titre, resume, \"type\", description, prix_min, accessibilite, date_creation, date_publication, duree, capacite, ville, numero_voie, voie, code_postal, complement, idC) values 
                        ('$titre', '$resume', '$type', '$description', $prix_min, '$accessibilite', now(), now(), interval '$duree', $capacite, '$ville', $numero_voie, '$voie', $code_postal, '', $idC);"
                    );
                    break;
                    
                case 'visite':
                    $titre = $_POST['titre'];
                    $resume = $_POST['resume'];
                    $type = type_offre($_POST['offre']);
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
                        (titre, resume, \"type\", description, prix_min, accessibilite, date_creation, date_publication, duree, langues, ville, numero_voie, voie, code_postal, complement, idC) values 
                        ('$titre', '$resume', '$type', '$description', $prix_min, '$accessibilite', now(), now(), interval '$duree', '$langues', '$ville', $numero_voie, '$voie', $code_postal, '', $idC);"
                    );
                    break;

                case 'restauration':
                    $titre = $_POST['titre'];
                    $resume = $_POST['resume'];
                    $type = type_offre($_POST['offre']);
                    $description = $_POST['description'];
                    $prix_min = $_POST['prix'];
                    $accessibilite = $_POST['accessibilite'];
                    $src_image = time();
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
                        (titre, resume, \"type\", description, prix_min, accessibilite, date_creation, date_publication, src_image, gamme_prix, ville, petit_dejeuner, brunch, dejeuner, diner, boissons, numero_voie, voie, code_postal, complement, idC) values 
                        ('$titre', '$resume', '$type', '$description', $prix_min, '$accessibilite', now(), now(), '$src_image', '$gamme_prix', '$ville', $petit_dejeuner, $brunch, $dejeuner, $diner, $boissons, $numero_voie, '$voie', $code_postal, '', $idC);"
                    );
                    break;

                case 'parcAttraction':
                    $titre = $_POST['titre'];
                    $resume = $_POST['resume'];
                    $type = type_offre($_POST['offre']);
                    $description = $_POST['description'];
                    $prix_min = $_POST['prix'];

                    $accessibilite = $_POST['accessibilite'];
                    $src_image = time();
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
                        (titre, resume, \"type\", description, prix_min, accessibilite, date_creation, date_publication, src_image, nbr_attractions, age_min, ville, numero_voie, voie, code_postal, complement, idC) values 
                        ('$titre', '$resume', '$type', '$description', $prix_min, '$accessibilite', now(), now(), '$src_image', $nbr_attractions, $age_min, '$ville', $numero_voie, '$voie', $code_postal, '', $idC);"
                    );
                    break;

                default:
                    # code...
                    break;
            } 
            $stmt->execute();

            $idOffre = $db->lastInsertId();
            for ($i = 1; $i < 4; $i++) { //pour chaque images
                if (!empty($_FILES['file-upload'.$i]['name'])){
                    $extention = pathinfo($_FILES['file-upload'.$i]['name'])['extension'];
                        move_uploaded_file($_FILES['file-upload'.$i]['tmp_name'], '../images/image_offre/'.$idOffre.'-'.$i.'.'.$extention);
                        $stmt = $dbh->prepare(
                            "insert into pact.photo_offre 
                            (src_image, idO) values 
                            ('image_offre/$idOffre-$i.$extention', '$idOffre');"
                        );
                    
                    
                    $stmt->execute();
                }    
            }

            // insertion de la map
            $fileInfo = pathinfo($_FILES['map-file-upload']['name']);
            if (isset($fileInfo['extension'])){
                $extention = $fileInfo['extension'];
                if ($categorie === 'parcAttraction'){
                    move_uploaded_file($_FILES['map-file-upload']['tmp_name'], '../images/image_offre/'.$idOffre.'-plan.'.$extention);
                    $stmt = $dbh->prepare(
                        "UPDATE pact.parc_d_attraction SET src_image = 'image_offre/$idOffre-plan.$extention'
                        WHERE ido = $idOffre;"
                    );
                } else if ($categorie === 'restauration'){
                    move_uploaded_file($_FILES['map-file-upload']['tmp_name'], '../images/image_offre/'.$idOffre.'-menu.'.$extention);
                    $stmt = $dbh->prepare(
                        "UPDATE pact.restauration SET src_image = 'image_offre/$idOffre-menu.$extention'
                        WHERE ido = $idOffre;"
                    );
                }
                $stmt->execute();
            }
            //ajout des tags 

            $tags = tag_offre($_POST);

            for ($i=0; $i < sizeof($tags) ; $i++) { 
                $t = $tags[$i];
                $stmt = $dbh->prepare(
                    //récupération de l'idTag
                    "select idtag from pact._tag where libelle = '$t';"
                );
                $stmt->execute();
                $idtag = $stmt->fetchColumn();


                if ($categorie === 'parcAttraction'){
                    //vérification que le tag n'a pas déjà été inséré
                    $checkStmt = $dbh->prepare("
                        SELECT COUNT(*) FROM pact._tags_parc_d_attraction
                        WHERE idO = :idOffre AND idtag = :idtag;
                    ");
                    $checkStmt->execute([
                        'idOffre' => $idOffre,
                        'idtag' => $idtag
                    ]);
                    if ($checkStmt->fetchColumn() == 0) {
                        $stmt = $dbh->prepare(
                            //insertion    
                            "insert into pact._tags_parc_d_attraction(idO, idtag) values ($idOffre,$idtag);"
                        );

                    }
                } else {
                    //vérification que le tag n'a pas déjà été inséré
                    $checkStmt = $dbh->prepare("
                        SELECT COUNT(*) FROM pact._tags_$categorie
                        WHERE idO = :idOffre AND idtag = :idtag;
                    ");
                    $checkStmt->execute([
                        'idOffre' => $idOffre,
                        'idtag' => $idtag
                    ]);
                    if ($checkStmt->fetchColumn() == 0) {
                        $stmt = $dbh->prepare(
                            //insertion
                            "insert into pact._tags_$categorie(idO, idtag) values ($idOffre,$idtag);"
                        );
                    }
                }
                
                $stmt->execute();
            }

            // Redirection vers /accueil.php
            header('Location: tableau_de_bord.php');
            exit(); // Important : Terminer le script pour éviter des exécutions non voulues


        } catch (PDOException $e) {
            echo "<pre>";
            print "Erreur !: " . $e->getMessage() . "<br/>";
            echo "</pre>";
            die();
        }
    }
}
include_once('nav.php'); 
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
    <body class="BO">
        <div class="main-content"> 
            <h1 class="TS-bold">Créez votre offre</h1>            
            <form action="previsualisation_offre.php" method="post" enctype="multipart/form-data">
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
                                <label for="description">Description*</label>
                                <p id="description-error-message" class="error-message"></p>
                                <textarea id="description" class="FS" name="description" placeholder="Spectacle se déroulant au théatre du..." required></textarea>
                            </div>

                            <!-- Champ "Site web" -->
                            <div class="container" id="site-container">
                                <label for="site">Site web</label>
                                <p id="site-error-message" class="error-message"></p>
                                <input type="text" id="site" class="FS" name="site" placeholder="https://exemple.com"></textarea>
                            </div>


                            <!-- Champ "Tags" -->
                            <div id="tag-container">
                                <label>Tags</label>
                                <div id="tags-items-container">
                                <input type="checkbox" class="hidden" name="culturel" id="culturel" value="Culturel">
                                    <label for="culturel">Culturel</label>

                                    <input type="checkbox" class="hidden" name="patrimoine" id="patrimoine" value="Patrimoine">
                                    <label for="patrimoine">Patrimoine</label>

                                    <input type="checkbox" class="hidden" name="histoire" id="histoire" value="Histoire">
                                    <label for="histoire">Histoire</label>

                                    <input type="checkbox" class="hidden" name="urbain" id="urbain" value="Urbain">
                                    <label for="urbain">Urbain</label>

                                    <input type="checkbox" class="hidden" name="nature" id="nature" value="Nature">
                                    <label for="nature">Nature</label>

                                    <input type="checkbox" class="hidden" name="plein-air" id="plein-air" value="Pleine air">
                                    <label for="plein-air">Pleine air</label>

                                    <input type="checkbox" class="hidden" name="sport" id="sport" value="Sport">
                                    <label for="sport">Sport</label>

                                    <input type="checkbox" class="hidden" name="nautique" id="nautique" value="Nautique">
                                    <label for="nautique">Nautique</label>

                                    <input type="checkbox" class="hidden" name="gastronomie" id="gastronomie" value="Gastronomie">
                                    <label for="gastronomie">Gastronomie</label>

                                    <input type="checkbox" class="hidden" name="musee" id="musee" value="Musée">
                                    <label for="musee">Musée</label>

                                    <input type="checkbox" class="hidden" name="atelier" id="atelier" value="Atelier">
                                    <label for="atelier">Atelier</label>

                                    <input type="checkbox" class="hidden" name="musique" id="musique" value="Musique">
                                    <label for="musique">Musique</label>

                                    <input type="checkbox" class="hidden" name="famille" id="famille" value="Famille">
                                    <label for="famille">Famille</label>

                                    <input type="checkbox" class="hidden" name="cinema" id="cinema" value="Cinéma">
                                    <label for="cinema">Cinéma</label>

                                    <input type="checkbox" class="hidden" name="cirque" id="cirque" value="Cirque">
                                    <label for="cirque">Cirque</label>

                                    <input type="checkbox" class="hidden" name="son-et-lumiere" id="son-et-lumiere" value="Son et lumière">
                                    <label for="son-et-lumiere">Son et lumière</label>

                                    <input type="checkbox" class="hidden" name="humour" id="humour" value="Humour">
                                    <label for="humour">Humour</label>

                                    <input type="checkbox" class="hidden" name="francais" id="francais" value="Français">
                                    <label for="francais">Français</label>

                                    <input type="checkbox" class="hidden" name="fruit-de-mer" id="fruit-de-mer" value="Fruit de mer">
                                    <label for="fruit-de-mer">Fruit de mer</label>

                                    <input type="checkbox" class="hidden" name="asiatique" id="asiatique" value="Asiatique">
                                    <label for="asiatique">Asiatique</label>

                                    <input type="checkbox" class="hidden" name="indienne" id="indienne" value="Indienne">
                                    <label for="indienne">Indienne</label>

                                    <input type="checkbox" class="hidden" name="italienne" id="italienne" value="Italienne">
                                    <label for="italienne">Italienne</label>

                                    <input type="checkbox" class="hidden" name="gastronomique" id="gastronomique" value="Gastronomique">
                                    <label for="gastronomique">Gastronomique</label>

                                    <input type="checkbox" class="hidden" name="restauration-rapide" id="restauration-rapide" value="Restauration rapide">
                                    <label for="restauration-rapide">Restauration rapide</label>

                                    <input type="checkbox" class="hidden" name="creperie" id="creperie" value="Crêperie">
                                    <label for="creperie">Crêperie</label>

                                    <input type="checkbox" class="hidden" name="vegetarienne" id="vegetarienne" value="Végétarienne">
                                    <label for="vegetarienne">Végétarienne</label>

                                    <input type="checkbox" class="hidden" name="vegetalienne" id="vegetalienne" value="Végétalienne">
                                    <label for="vegetalienne">Végétalienne</label>

                                    <input type="checkbox" class="hidden" name="kebab" id="kebab" value="Kebab">
                                    <label for="kebab">Kebab</label>
                                </div>
                            </div>
                            <!-- Bouton de soumission -->
                            <div id="publier-retour">
                                <input id="submit-button" type="submit" class="FS" value="Prévisualiser" />
                                <button class="FS" onclick="history.go(-1)">
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
                                        <input type="text" id="duree" class="FS" name="duree" placeholder="01:15" required />
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
                                        <select id="categorie-prix" name="categorie-prix" class="FS" required>
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
                                            <input type="file" id="map-file-upload" name="map-file-upload" accept=".png"/>
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
                                    <input type="file" id="file-upload1" class="file-upload" name="file-upload1" accept=".png"/>

                                    <!---- Bouton 2 --->
                                    <label for="file-upload2" class="custom-file-upload">
                                        <img src="../icons/plus.svg" alt="Bouton Image">
                                        <p class="upload-text">Ajouter une image 2</p>
                                    </label>
                                    <input type="file" id="file-upload2" class="file-upload" name="file-upload2" accept=".png"/>
                                    <!---- Bouton 3 --->
                                    <label for="file-upload3" class="custom-file-upload">
                                        <img src="../icons/plus.svg" alt="Bouton Image">
                                        <p class="upload-text">Ajouter une image 3</p>
                                    </label>
                                    <input type="file" id="file-upload3" class="file-upload" name="file-upload3" accept=".png"/>
                                    
                                    <button id="file-delete" type="button">
                                        <img src="../icons/moins.svg" alt="Bouton Image">
                                        Supprimer une image
                                    </button>
                                </div>
                                <p id="error-message-supprimer" style="color: red; display: none;">Vous ne pouvez pas supprimer une image inexistante !</p>
                                <p id="message-prevention">Les images ne sont pas essentielles pour la poursuite de la création. <br> Vous pourrez les ajouter ou les modifier plus tard.</p>
                                <!-- Éléments pour afficher les images importées -->
                                <div id="image-container">
                                    <img class="selected-image" src="../images/rien.png" alt="Image sélectionnée1" />
                                    <img class="selected-image" src="../images/rien.png" alt="Image sélectionnée2" />
                                    <img class="selected-image" src="../images/rien.png" alt="Image sélectionnée3" />
                                </div>
                            </div>                     
                        </div>
                    </div>
                </div>      
            </form>
        </div>

        <script src="../js/creation_offre.js">
        </script>
    </body>
</html>