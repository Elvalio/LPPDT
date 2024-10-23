<?php 
    include_once 'nav.php'; 

    include('../sql/connect_params.php');
    $idAnnonce = $_GET['value'];
    try {
        $bdh = new PDO("$driver:host=$server;port=$port;dbname=$dbname", 
        $user, $pass);

        $stmt = $bdh->prepare("SELECT * FROM pact.offre WHERE ido = $idAnnonce;");
        $stmt->execute();

        $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        die();
    }    

    
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balade à vélo</title>
    <link rel="stylesheet" href="../css/samStyles.css">
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <script src="../detail-offre.js" async></script>
</head>

<body class="main-content BO">

    <section class="section-page part-annonce">
        <header>
            <h1 class="titre-rouge">
                <?php 
                echo $stmt[0]['titre'];
                ?>
            </h1>
            <h2 class="sous-titre">
                <?php 
                echo $stmt[0]['ville'];
                ?> |
                <?php 
                    $idC = (int)$stmt[0]['idc'];
                    $stmt2 = $bdh->prepare("SELECT telephone FROM pact.professionnel p INNER JOIN pact.offre o ON p.idC = o.idC WHERE o.idC = $idC;");
                    $stmt2->execute();
                    $stmt2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    echo $stmt2[0]['telephone'];
                ?>
                <?php 
                if ($stmt[0]['duree']) {
                    echo " | Durée : ";
                    echo $stmt[0]['duree'];
                }
                ?>
                <?php 
                if ($stmt[0]['age']) {
                    echo "| Âge :";
                    echo $stmt[0]['age_min'];
                    echo " ans";
                }
                ?>
                <?php 
                if ($stmt[0]['prix_min']) {
                    echo "| Prix : ";
                    echo $stmt[0]['prix_min'];
                    echo " €";
                }
                ?>
                <?php 
                echo $stmt[0]['gamme_prix']
                ?>
            </h2>
            <div class="container NoSelect">
                <!-- Élément carrousel -->
                <div class="carousel">
                    <!-- Conteneur interne pour les diapositives -->
                    <div class="carousel-inner">
                        <?php 
                            $stmt4 = $bdh->prepare("SELECT src_image FROM pact.photo_offre WHERE idO = $idAnnonce;");
                            $stmt4->execute();
                            $stmt4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);
                            $num_image = 1;
                            foreach ($stmt4 as $photo) { ?>
                                <div class="slide">
                                <img src="../images/<?php echo $photo['src_image']; ?>" alt="Image <?php echo $num_image ?> ">
                                </div>
                                
                                <?php $num_image++;
                            }
                        ?>
                    </div>
                    <!-- Conteneur pour les boutons de navigation -->
                    <div class="carousel-controls NoSelect">
                        <!-- Bouton pour passer à la diapositive précédente -->
                        <button class="NoSelect" id="prev"><img src="../images/fleche.png" alt="Précédent"></button>
                        <!-- Bouton pour passer à la diapositive suivante -->
                        <button class="NoSelect" id="next"><img src="../images/fleche.png" alt="Suivant"></button>
                    </div>
                    <!-- Conteneur pour les points de navigation -->
                    <div class="carousel-dots NoSelect"></div>
                </div>

            </div>
            <div class="infos-offre">
                <div class="etoiles">
                    <?php 
                        $i;
                        if ($stmt[0]['nbravis'] > 0) {
                            for ($i = 0; $i < $stmt[0]['moy_note']; $i++) {
                            echo '<img class="NoSelect" src="../icons/etoile_rouge.png" alt="étoile">';
                        }
                        foreach (range($i, 4) as $j) {
                            echo '<img class="NoSelect" src="../icons/etoile_rouge_vide.png" alt="étoile">';
                        }
                        }
                        
                    ?>
                </div>
                <p class="nb-avis-info-offre">
                    <?php 
                    if ($stmt[0]['nbravis'] == 0) {
                        echo "0" ." " . "Avis" . " " . "|";
                    }
                    else {
                        echo $stmt[0]['nbravis'];
                        echo " " . "Avis" . " |";
                    }
                    ?>
                </p>
                <img src="../images/Wheelchair.png" alt="fauteil roulant">
                <p>
                    <?php 
                        echo $stmt[0]['accessibilite'];
                    ?>
                </p>
            </div>
        </header>
        <article class="description-offre">
            <h3>Description :</h3>
            <p>
                <?php 
                    echo $stmt[0]['description'];
                ?>
            </p>
        </article>
        <article class="part-contact">
            <div class="side-contact">
                <div>
                    <h3>Contact :</h3>
                    <div>
                        <?php 
                        $address = $stmt[0]['numero_voie'] . $stmt[0]['voie'] . $stmt[0]['ville'] . $stmt[0]['code_postal'];
                        ?>
                        <a href="https://www.google.com/maps/dir// <?php echo $address ?>">
                            <img src="../images/maison.png" alt="icon maison (localisation)">
                            <p>
                                <?php
                                echo $stmt[0]['numero_voie'];
                                echo " ";
                                echo $stmt[0]['voie'];
                                echo " ";
                                echo $stmt[0]['ville'];
                                echo " ";
                                echo $stmt[0]['code_postal'];

                            ?>
                            </p>
                        </a>
                    </div>
                    <div>
                        <a href="tel:<?php 
                    $idC = (int)$stmt[0]['idc'];
                    $stmt2 = $bdh->prepare(" SELECT telephone FROM pact.professionnel p INNER JOIN pact.offre o ON
                            p.idC=o.idC WHERE o.idC=$idC;"); $stmt2->execute();
                            $stmt2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                            echo $stmt2[0]['telephone'];
                            ?> ">
                            <img src="../images/telephone.png" alt="icon telephone">
                            <p>
                                <?php 
                    $idC = (int)$stmt[0]['idc'];
                    $stmt2 = $bdh->prepare("SELECT telephone FROM pact.professionnel p INNER JOIN pact.offre o ON p.idC = o.idC WHERE o.idC = $idC;");
                    $stmt2->execute();
                    $stmt2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    echo $stmt2[0]['telephone'];
                ?>
                            </p>
                        </a>
                    </div>
                    
                    <?php
                        if ($stmt[0]['site_web']) { ?>
                            <div>
                            <a href=" <?php echo $stmt[0]['site_web']; ?>">
                                <img src="../images/pc.png" alt="icon pc (lien vers le site)">
                                <p>
                                    <?php
                            echo $stmt[0]['site_web']; ?>
                            </p>
                            </a>
                            </div>
                            </div><?php

                        } else { ?>
                            </div>
                            <?php
                        }
                    ?>
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
                    if ($stmt[0]['carte']) { ?>
                        <div>
                            <img class="carte" src="../images/ <?php $stmt[0]['carte'] ?>" alt="carte géolocalisation">
                        </div>
                        <?php
                    } elseif ($stmt[0]['src_image']) { ?>
                        <div>
                            <img class="carte" src="../images/ <?php $stmt[0]['src_image'] ?>" alt="carte">
                        </div>
                        <?php
                    }
                    else { ?>
                        </div>
                        <?php
                    }
                ?>
                
        </article>
        <button class="bouton-retour NoSelect">
            <img class="NoSelect" src="../icons/arrow-left-o.svg" alt="">
            Retour
        </button>
    </section>
    <section class="section-page part-avis">
        <header class="header-avis">
            <h3>Avis : <?php 
                    if ($stmt[0]['nbravis'] == 0) {
                        echo "0" . " " . "Avis";
                    }
                    else {
                        echo $stmt[0]['nbravis'];
                        echo " " . "Avis";
                    }
                    ?></h3>
                    <?php 
                    $stmt3 = $bdh->prepare("SELECT * FROM pact.avis WHERE ido = $idAnnonce;");
                    $stmt3->execute();
                    $stmt3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($stmt3 as $avis) {
                        if ($avis['consulte'] == False) {
                            $nonConsultes++;
                        }
                        if ($avis['consulte'] == False) {
                            $nonRepondus++;
                        }
                    }
                    if ( $nonConsultes > 0) { ?>
                        <h3>Non Consultés :
                        <?php echo $nonConsultes; ?>
                        </h3>
                        
                    <?php }
                    $nonRepondus = 0;
                    $nonRepondus++;
                    if ($nonRepondus > 0) { ?>
                        <h3>Non répondus :
                        <?php echo $nonRepondus;?>
                        </h3>;
                    <?php }
                    ?>
        </header>
        <article class="article-avis">
            <?php 
                $stmt = $bdh->prepare("SELECT * FROM pact.avis WHERE ido = $idAnnonce;");
                $stmt->execute();
                $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($stmt as $avis) { ?>
                    <div>
                    <div class="header-avis-profil">
                        <div class="profil">
                            <img src="../images/image 4.png" alt="photo de profil" width="40px" height="40px">
                            <p>
                                <?php
                    echo $avis['nom']; ?>
                    </p>
                        </div>
                        <div>
                            <p>
                                <?php
                    echo $avis['note']; ?>
                    </p>
                        </div>
                    </div>
                    <div class="commentaire-consulte">
                        <p>
                            <?php
                    echo $avis['commentaire']; ?>
                    </p>
                    </div>
                    <div>
                        <p class="reponse">Ajouter une réponse</p>
                    </div>
                </div>
                <?php
                }            
            ?>
        </article>
    </section>
</body>

</html>

<?php 
$dbh = null;
?>