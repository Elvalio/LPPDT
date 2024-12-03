<?php
// include_once 'nav.php';
include('../sql/connect_params.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

if($_SERVER['REQUEST_METHOD']==='POST'){

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
        $resultat = ''; //aucune option par défaut

        if (isset($_POST['une'])){
            $resultat = $arr['une']; 
        }
        if (isset($_POST['relief'])){
            $resultat = $arr['relief'];
        }
        return $resultat;
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




    $idC = $_COOKIE['user'];

    $categorie = $_POST['categorie'];

    $temp = explode(' ',trim($_POST["adresse"]));
    $numero_voie = $temp[0];
    array_shift($temp);
    $voie = implode(' ', $temp);

    // echo '<pre>';
    // print_r($_POST);
    // echo'</pre>';

    $photos = [];
    try{
        $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname",
            $user, $pass);   

        //pour l'insertion des 3 images
        $stmt = $dbh->prepare(
            "select max(ido)
            from pact.offre;"
        );
        
        $stmt->execute();

        $idOffre = $stmt->fetchColumn(); //id de l'offre qui vient d'être crée (ici offre n°8)
        // $idOffre = $db->lastInsertId(); //a faire après avoir créer l'offre !!!

    } catch (PDOException $e) {
        echo "<pre>";
        print "Erreur !: " . $e->getMessage() . "<br/>";
        echo "</pre>";
        die();
    }


    for ($i = 1; $i < 4; $i++) { //pour chaque images
        if (!empty($_FILES['file-upload'.$i]['name'])){
            $extention = pathinfo($_FILES['file-upload'.$i]['name'])['extension'];
            //move_uploaded_file($_FILES['file-upload'.$i]['tmp_name'], '../images/image_offre/'.$idOffre.'-'.$i.'.'.$extention);
            $photos[] = '../images/image_offre/'.$idOffre.'-'.$i.'.'.$extention;
            //     $stmt = $dbh->prepare(
            //         "insert into pact.photo_offre 
            //         (src_image, idO) values 
            //         ('image_offre/$idOffre-$i.$extention', '$idOffre');"
            //     );
            
            
            // $stmt->execute();
        }    
    }

    

}
?>


    


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prévisualisation</title>
    <link rel="stylesheet" href="../css/styleLisa.css">
    <link rel="stylesheet" href="../css/samStyles.css">
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <script src="../detail-offre.js" async></script>
</head>
<body class="body main-content <?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'BO' : 'FO'; ?>" >

<section class="section-page part-annonce">
    <header> 
        <h1 class="titre-rouge">
            <?php echo htmlspecialchars($_POST['titre']); ?>
        </h1>
        <h2 class="sous-titre">
            <?php echo htmlspecialchars($_POST['ville']); ?> |
            <?php echo 'Non disponible'; ?>
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
                        foreach ($photos as $index => $photo): ?>
                            <div class="slide">
                                <img src="<?php echo htmlspecialchars($photo); ?>"
                                    alt="Image <?php echo $index + 1; ?>">
                            </div>
                        <?php endforeach; ?>
                    
                </div>
                
                <div class="carousel-controls NoSelect">
            
                    <button id="prev"><img src="../images/fleche.png" alt="Précédent"></button>
                    <button id="next"><img src="../images/fleche.png" alt="Suivant"></button>
                </div>
                <div class="carousel-dots NoSelect"></div>

                
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
                    <a href="tel:<?php 
                        echo 'Non disponible';
                            ?> ">
                        <img src="../images/telephone.png" alt="icon telephone">
                        <p>
                            <?php 
                                    echo 'Non disponible';
                                ?>
                        </p>
                    </a>
                </div>

                
                <div>
                    <a href=" <?php echo 'non disponible'; ?>">
                        <img src="../images/pc.png" alt="icon pc (lien vers le site)">
                        <p>
                            <?php
                        echo $_POST['site'] ?>
                        </p>
                    </a>
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
                if (!empty($parc_actraction[0]['src_image'])) { ?>
        <div>
            <img class="carte" src="../images/<?php echo $parc_actraction[0]['carte'] ?>" alt="plan">
        </div>
        <?php
                } elseif (!empty($restaurant[0]['src_image'])) { ?>
        <div>
            <img class="carte" src="../images/<?php echo $restaurant[0]['src_image'] ?>" alt="carte">
        </div>
        <?php
                }
            ?>
        </div>

    </article>
    <button class="FS" onclick="window.location.href='tableau_de_bord.php';">
        Valider
    </button>
    <button class="bouton-retour NoSelect">
        <a href="./creation_offre.php">
            <img src="../icons/arrow-left-o.svg" alt="Retour">
            Retour
        </a>
    </button>
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

