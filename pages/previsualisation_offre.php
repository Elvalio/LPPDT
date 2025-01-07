<?php
include('../sql/connect_params.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

// echo '<pre>';
    // print_r($_POST);
    // echo '<pre>';


$idC = $_COOKIE['user'];
$categorie = $_POST['categorie'];


$temp = explode(' ',trim(addslashes($_POST["adresse"])));
$numero_voie = $temp[0];
array_shift($temp);
$voie = implode(' ', $temp);

if(isset($_POST['site'])){
    if ($_POST['site'] !== ''){
        $site = $_POST['site'];
    }else {
        $site = 'Non disponible';
    }
} else {
    $site = 'Non disponible';
}

if (isset($_POST['validation'])){
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

    
}

try{
    $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname",
        $user, $pass); 
        
    // pour telephone
    $stmt = $dbh->prepare(
        "select telephone from pact.professionnel where idc = :user;"
    );
    $stmt->execute([
        'user' => $idC
    ]);
    $telephone = $stmt->fetchColumn();

    if ($telephone === null){
        $telephone = 'Non disponible';
    }



        //pour l'insertion des 3 images
        $stmt = $dbh->prepare(
            "select max(ido)
            from pact.offre;"
        );
        $stmt->execute();
        $idOffre = $stmt->fetchColumn() + 1; //id de l'offre qui a été crée avant 
        // $idOffre = $db->lastInsertId(); //a faire après avoir créer l'offre !!!


    if (isset($_POST['validation'])){

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

                if (isset($_POST['pinclus'])){
                    $prestation_incluse = $_POST['pinclus'];
                } else {
                    $prestation_incluse = '';
                }
                
                if (isset($_POST['pexclus'])){
                    $prestation_excluse = $_POST['pexclus'];
                } else {
                    $prestation_excluse = '';
                }

                $ville = $_POST['ville'];
                $code_postal= $_POST['codeP'];
    
                $stmt = $dbh->prepare(
                    "insert into pact.activite 
                    (titre, resume, \"type\", description, site_web, prix_min, accessibilite, date_creation, date_publication, duree, age_min, prestation_incluse, prestation_excluse, ville, numero_voie, voie, code_postal, complement, idC) values 
                    ('$titre', '$resume', '$type', '$description', '$site', $prix_min, '$accessibilite', now(), now(), interval '$duree', $age_min, '$prestation_incluse', '$prestation_excluse', '$ville', $numero_voie, '$voie', $code_postal, '', $idC);"
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
                $code_postal= $_POST['codeP'];
    
                $stmt = $dbh->prepare(
                    "insert into pact.spectacle 
                    (titre, resume, \"type\", description, site_web, prix_min, accessibilite, date_creation, date_publication, duree, capacite, ville, numero_voie, voie, code_postal, complement, idC) values 
                    ('$titre', '$resume', '$type', '$description', '$site', $prix_min, '$accessibilite', now(), now(), interval '$duree', $capacite, '$ville', $numero_voie, '$voie', $code_postal, '', $idC);"
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
                if (isset($_POST['langue'])){
                    $langues = $_POST['langue'];
                } else {
                    $langues = '';
                }
                $ville = $_POST['ville'];
                $code_postal= $_POST['codeP'];
                
                $stmt = $dbh->prepare(
                    "insert into pact.visite 
                    (titre, resume, \"type\", description, site_web, prix_min, accessibilite, date_creation, date_publication, duree, langues, ville, numero_voie, voie, code_postal, complement, idC) values 
                    ('$titre', '$resume', '$type', '$description', '$site', $prix_min, '$accessibilite', now(), now(), interval '$duree', '$langues', '$ville', $numero_voie, '$voie', $code_postal, '', $idC);"
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
                $petit_dejeuner = (isset($_POST['petit-dejeuner']) && ($_POST['petit-dejeuner'] == 'petit-dejeuner')) ? 'true' : 'false';
                $brunch = (isset($_POST['brunch']) && ($_POST['brunch'] == 'brunch')) ? 'true' : 'false';
                $dejeuner = (isset($_POST['dejeuner']) && ($_POST['dejeuner'] == 'dejeuner')) ? 'true' : 'false';
                $diner = (isset($_POST['diner']) && ($_POST['diner'] == 'diner')) ? 'true' : 'false';
                $boissons = (isset($_POST['boissons']) && ($_POST['boissons'] == 'boissons')) ? 'true' : 'false';
                $ville = $_POST['ville'];
                $code_postal= $_POST['codeP'];
                
                $stmt = $dbh->prepare(
                    "insert into pact.restauration 
                    (titre, resume, \"type\", description, site_web, prix_min, accessibilite, date_creation, date_publication, src_image, gamme_prix, ville, petit_dejeuner, brunch, dejeuner, diner, boissons, numero_voie, voie, code_postal, complement, idC) values 
                    ('$titre', '$resume', '$type', '$description', '$site', $prix_min, '$accessibilite', now(), now(), '$src_image', '$gamme_prix', '$ville', $petit_dejeuner, $brunch, $dejeuner, $diner, $boissons, $numero_voie, '$voie', $code_postal, '', $idC);"
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
                $code_postal= $_POST['codeP'];
                
                $stmt = $dbh->prepare(
                    "insert into pact.parc_d_attraction 
                    (titre, resume, \"type\", description, site_web, prix_min, accessibilite, date_creation, date_publication, src_image, nbr_attractions, age_min, ville, numero_voie, voie, code_postal, complement, idC) values 
                    ('$titre', '$resume', '$type', '$description', '$site', $prix_min, '$accessibilite', now(), now(), '$src_image', $nbr_attractions, $age_min, '$ville', $numero_voie, '$voie', $code_postal, '', $idC);"
                );
                break;
    
            default:
                # code...
                break;
        } 
        $stmt->execute();


        $idOffre;
        for ($i = 0; $i < 3; $i++) { //pour chaque images
            if(isset($_POST['image'.$i])){
                $img = $_POST['image'.$i];
                $stmt = $dbh->prepare(
                    "insert into pact.photo_offre 
                    (src_image, idO) values 
                    ('$img', '$idOffre');"
                );   
                $stmt->execute();
            }
        }

        // insertion de la map
        if (isset($_POST['mapPhoto'])){
            $img = $_POST['mapPhoto'];
            if ($categorie === 'parcAttraction'){
                $stmt = $dbh->prepare(
                    "UPDATE pact.parc_d_attraction SET src_image = '$img'
                    WHERE ido = $idOffre;"
                );
            } else if ($categorie === 'restauration'){
                $stmt = $dbh->prepare(
                    "UPDATE pact.restauration SET src_image = '$img'
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


        //insertion de l'option :
        $option = option_offre($_POST);
        $stmt = $dbh->prepare(
            "insert into pact._option_offre 
                (idOption, idO) values ($option, $idOffre);"
        );
        $stmt->execute();

        // Redirection vers /accueil.php
        header('Location: tableau_de_bord.php');
        exit(); // Important : Terminer le script pour éviter des exécutions non voulues


    } // fin de vérif si clic sur bouton


} catch (PDOException $e) {
    echo "<pre>";
    print "Erreur !: " . $e->getMessage() . "<br/>";
    echo "</pre>";
    die();
}


$photos = [];
for ($i = 1; $i < 4; $i++) { //pour chaque images
    if (!empty($_FILES['file-upload'.$i]['name'])){
        $extention = pathinfo($_FILES['file-upload'.$i]['name'])['extension'];
        move_uploaded_file($_FILES['file-upload'.$i]['tmp_name'], '../images/image_offre/'.$idOffre.'-'.$i.'.'.$extention);
        $photos[] = 'image_offre/'.$idOffre.'-'.$i.'.'.$extention;
    } else {
        $img = glob("../images/image_offre/$idOffre-$i.*");
        if (!empty($img)){
            unlink($img[0]);
        }
    }
}

// insertion de la map
$mapPhoto = '';
if (!empty($_FILES['map-file-upload']['name'])){

    $fileInfo = pathinfo($_FILES['map-file-upload']['name']);

    if (isset($fileInfo['extension'])){
        $extention = $fileInfo['extension'];

        if ($categorie === 'parcAttraction'){
            $mapPhoto = 'image_offre/'.$idOffre.'-plan.'.$extention;
            move_uploaded_file($_FILES['map-file-upload']['tmp_name'], '../images/image_offre/'.$idOffre.'-plan.'.$extention);
            
        } else if ($categorie === 'restauration'){
            $mapPhoto = 'image_offre/'.$idOffre.'-menu.'.$extention;
            move_uploaded_file($_FILES['map-file-upload']['tmp_name'], '../images/image_offre/'.$idOffre.'-menu.'.$extention);
            
        }
    }

} else {
    $menu = glob("../images/image_offre/$idOffre-menu.*");
    $parc = glob("../images/image_offre/$idOffre-plan.*");
    if(!empty($menu)){
        unlink($menu[0]);
    } else if (!empty($parc)){
        unlink($parc[0]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prévisualisation</title>
    <link rel="stylesheet" href="../css/samStyles.css">
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <link rel="stylesheet" href="../css/styleLisa.css">
    <script src="../js/previsualisation.js"></script>
    <script src="../detail-offre.js" async></script>
    
</head>
<body class="body main-content <?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'BO' : 'FO'; ?>" >
<?php include_once 'nav.php';?>
<section class="section-page part-annonce">
    <header> 
        <h1 class="titre-rouge">
            <?php echo htmlspecialchars($_POST['titre']); ?>
        </h1>
        <h2 class="sous-titre">
            <?php echo htmlspecialchars($_POST['ville']); ?> |
            <?php echo $telephone ?>
            <?php if ($categorie === 'spectacle' || $categorie === 'activite' || $categorie === 'visite') echo " | Durée : " . htmlspecialchars($_POST['duree']); ?>

            <?php if ($categorie === 'parcAttraction' || $categorie === 'activite') echo " | Âge : " . $_POST['age'] . " ans"; ?>

            <?php   if ($categorie === 'restauration') {echo " | Prix : " . $_POST['categorie-prix'];}
                    elseif (!empty($_POST['prix'])) {echo " | Prix : " . htmlspecialchars($_POST['prix']) . " €";} 
            ?>
        </h2>

        

        <!-- Carrousel -->
        <div class="container NoSelect">
            <div class="carousel">
                <div class="carousel-inner">
                    
                    
                    <?php
                    if (!empty($photos)){
                        foreach ($photos as $index => $photo): ?>
                            <div class="slide">
                                <img src="<?php echo "../images/" . htmlspecialchars($photo); ?>"
                                    alt="Image <?php echo $index + 1; ?>">
                            </div>
                        <?php endforeach; 
                    } else { ?>
                        <div class="slide">
                            <img src="../images/imagesReferences/placeholder.jpg" alt="Image">
                        </div>
                    <?php } ?>
                    
                </div>
                
                <div class="carousel-controls NoSelect">
                    <?php if (!empty($photos) && sizeof($photos) >= 2){ ?>
                        <button id="prev"><img src="../images/fleche.png" alt="Précédent"></button>
                        <button id="next"><img src="../images/fleche.png" alt="Suivant"></button>
                    <?php } ?>  
                    
                </div>
                <?php if (!empty($photos) && sizeof($photos) >= 2){ ?>
                    <div class="carousel-dots NoSelect"></div>
                <?php } ?>
                
            </div>
        </div>

        <!-- Informations -->
        <div class="infos-offre">
            <div class="etoiles">
                <?php 
                $nbrAvis = 0;
                $moyNote = 0;
                $fullStars = (int) $moyNote;
                $emptyStars = 5 - $fullStars;

                for ($i = 0; $i < $fullStars; $i++): ?>
                <img src="../icons/<?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'etoile_rouge' : 'etoile_bleue'; ?>.png"
                    alt="Étoile">
                <?php endfor; ?>
                <?php for ($i = 0; $i < $emptyStars; $i++): ?>
                <img src="../icons/<?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'etoile_rouge_vide' : 'etoile_bleue_vide'; ?>.png"
                    alt="Étoile Vide">
                <?php endfor; ?>
            </div>
            <p class="nb-avis-info-offre">
                <?php echo $nbrAvis . " Avis |"; ?>
            </p>
            <img src="../images/Wheelchair.png" alt="Accessibilité">
            <p>
                <?php echo htmlspecialchars($_POST['accessibilite']); ?>
            </p>
        </div>
    </header>

    <!-- Description -->
    <article class="description-offre">
        <h3>Description :</h3>
        <p>
            <?php echo nl2br(htmlspecialchars($_POST['description'])); ?>
        </p>
    </article>

    <article class="part-contact">
        <div class="side-contact">
            <div>
                <br>
                <h3>Contact :</h3>
                <div>
                    <?php 
                    $address = $numero_voie . $voie . $_POST['ville'] . $_POST['codeP'];
                    ?>
                    <a href="https://www.google.com/maps/dir// <?php echo $address ?>">
                        <img src="../images/maison.png" alt="icon maison (localisation)">
                        <p>
                            <?php
                            echo $numero_voie;
                            echo " ";
                            echo $voie;
                            echo " ";
                            echo $_POST['ville'];
                            echo " ";
                            echo $_POST['codeP'];

                        ?>
                        </p>
                    </a>
                </div>
                <div>
                   <?php if ($telephone !== 'Non disponible'){ ?>
                        <a href="tel:<?php 
                            echo $telephone;
                                ?> ">
                            <img src="../images/telephone.png" alt="icon telephone">
                            <p>
                                <?php 
                                        echo $telephone;
                                    ?>
                            </p>
                        </a>
                   <?php } else { ?>
                        <img src="../images/telephone.png" alt="icon telephone">
                        <p>
                            <?php 
                                    echo $telephone;
                                ?>
                        </p>
                   <?php } ?>
                    
                </div>

                
                <div>
                    <?php if ($site !== 'Non disponible'){ ?>
                        <a href=" <?php echo $site; ?>" target="_blank">
                            <img src="../images/pc.png" alt="icon pc (lien vers le site)">
                            <p>
                                <?php echo $site; ?>
                            </p>
                        </a>
                    <?php } else { ?>
                        <img src="../images/pc.png" alt="icon pc (lien vers le site)">
                            <p>
                                <?php echo $site; ?>
                            </p>
                    <?php } ?>
                    
                </div>
            </div>
        </div>
        <!--<div class="horaires">
                    <h3>Horaires et tarifs :</h3>
                    <div>
                        <img src="../images/Delivery Time.png" alt="icon heure">
                        <p>8h - 13h et 14h30 - 18h du lundi au vendredi</p>
                    </div>
                    <div>
                        <img src="../images/Stack of Coins.png" alt="icon argent">
                        <p>12 € par adulte, gratuit pour les enfants (-12 ans)</p>
                    </div>
                </div>-->
        </div>
        
        <?php 
            if ($categorie === 'parcAttraction' && $mapPhoto !== '') { ?>
        <div>
            <br><br>
            <h3>Plan du parc : </h3>
            <img class="carte" src="<?php echo "../images/" . htmlspecialchars($mapPhoto); ?>" alt="plan">
        </div>
        <?php
            } elseif ($categorie === 'restauration' && $mapPhoto !== '') { ?>
        <div>
            <br><br>
            <h3>Menu : </h3>
            <img class="carte" src="<?php echo "../images/" . htmlspecialchars($mapPhoto); ?>" alt="carte">
        </div>
        <?php
                }
            ?>


    </article>
    <form method="post" action="previsualisation_offre.php">
    <?php 
        foreach ($_POST as $key => $value) {
            // Si la valeur est un tableau (cas des champs checkbox ou similaires)
            if ($value !== ''){
                ?><input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>"><?php
            }
            
        }
        
        foreach ($photos as $key => $value) {
            // Si la valeur est un tableau (cas des champs checkbox ou similaires)
            if ($value !== ''){
                ?><input type="hidden" name="<?php echo"image". $key; ?>" value="<?php echo $value; ?>"><?php
            }
            
        }?>
        <?php if (isset($mapPhoto) && $mapPhoto !== ''){?>
            <input type="hidden" name="mapPhoto" value="<?php echo $mapPhoto; ?>">
        <?php } ?>
        <input type="hidden" name="validation" value="true">

        



    <div class="Boutons">
            <button class="FS bouton-valider" type="submit">
                Valider
            </button>
    </form>
    <form method="post" action="creation_offre.php">
    <?php 
        foreach ($_POST as $key => $value) {
            // Si la valeur est un tableau (cas des champs checkbox ou similaires)
            if ($value !== ''){
                ?><input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>"><?php
            }
            
        }
        
        foreach ($photos as $key => $value) {
            // Si la valeur est un tableau (cas des champs checkbox ou similaires)
            if ($value !== ''){
                ?><input type="hidden" name="<?php echo"image". $key; ?>" value="<?php echo $value; ?>"><?php
            }
            
        }
        
        if (isset($mapPhoto) && $mapPhoto !== ''){?>
            <input type="hidden" name="mapPhoto" value="<?php echo $mapPhoto; ?>">
        <?php } 
        ?>

        <button class="bouton-retour NoSelect" type="submit">
                <img src="../icons/arrow-left-o.svg" alt="Retour">
                Retour
        </button>
    </form>
            
    </div>
    
    
</section>

<!-- Avis -->
<section class="section-page part-avis">
    <header class="header-avis">
        <h3>Avis :
            <?php echo $nbrAvis; ?>
        </h3>
    </header>
    
</section>
</body>
</html>

