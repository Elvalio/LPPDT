<?php 
    include_once 'nav.php'; 

    include('../sql/connect_params.php');
    $idAnnonce = 7;
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

<body class="main-content">

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
            <div class="container">
                <!-- Élément carrousel -->
                <div class="carousel">
                    <!-- Conteneur interne pour les diapositives -->
                    <div class="carousel-inner">
                        <!-- Première diapositive -->
                        <div class="slide">
                            <!-- Image de la première diapositive -->
                            <img src="../images/offre.webp" alt="Image 1">
                        </div>
                        <!-- Deuxième diapositive -->
                        <div class="slide">
                            <!-- Image de la deuxième diapositive -->
                            <img src="../images/offre.webp" alt="Image 2">
                        </div>
                        <!-- Troisième diapositive -->
                        <div class="slide">
                            <!-- Image de la troisième diapositive -->
                            <img src="../images/offre.webp" alt="Image 3">
                        </div>
                        <!-- Quatrième diapositive -->
                        <div class="slide">
                            <!-- Image de la quatrième diapositive -->
                            <img src="../images/offre.webp" alt="Image 4">
                        </div>
                        <!-- Cinquième diapositive -->
                        <div class="slide">
                            <!-- Image de la cinquième diapositive -->
                            <img src="../images/offre.webp" alt="Image 5">
                        </div>
                    </div>
                    <!-- Conteneur pour les boutons de navigation -->
                    <div class="carousel-controls">
                        <!-- Bouton pour passer à la diapositive précédente -->
                        <button id="prev"><img src="../images/fleche.png" alt="Précédent"></button>
                        <!-- Bouton pour passer à la diapositive suivante -->
                        <button id="next"><img src="../images/fleche.png" alt="Suivant"></button>
                    </div>
                    <!-- Conteneur pour les points de navigation -->
                    <div class="carousel-dots"></div>
                </div>

            </div>
            <div class="infos-offre">
                <div class="etoiles">
                    <?php 
                        for ($i = 0; $i < $stmt[0]['moy_note']; $i++) {
                            echo '<img src="../images/etoile.png" alt="étoile">';
                        }
                        /* A NE PAS OUBLIER */
                    ?> 
                    
                    <img src="../images/etoile_vide.png" alt="étoile">
                </div>
                <p class="nb-avis-info-offre">
                    <?php echo $stmt[0]['nbrAvis'] ?> Avis |
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

                        <a href="https://g.co/kgs/YaDbwRa">
                            <img src="../images/maison.png" alt="icon maison (localisation)">
                            <p><?php
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
                    $stmt2 = $bdh->prepare("SELECT telephone FROM pact.professionnel p INNER JOIN pact.offre o ON p.idC = o.idC WHERE o.idC = $idC;");
                    $stmt2->execute();
                    $stmt2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    echo $stmt2[0]['telephone'];
                ?> ">
                            <img src="../images/telephone.png" alt="icon telephone">
                            <p><?php 
                    $idC = (int)$stmt[0]['idc'];
                    $stmt2 = $bdh->prepare("SELECT telephone FROM pact.professionnel p INNER JOIN pact.offre o ON p.idC = o.idC WHERE o.idC = $idC;");
                    $stmt2->execute();
                    $stmt2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    echo $stmt2[0]['telephone'];
                ?> </p>
                        </a>
                    </div>
                    <?php
                        if ($stmt[0]['site_web']) {
                            echo '<div>
                            <a href="';
                            echo $stmt[0]['site_web'];
                            echo '">
                                <img src="../images/pc.png" alt="icon pc (lien vers le site)">
                                <p>';
                            echo $stmt[0]['site_web'];
                            echo '</p>
                            </a>';
                        }
                    ?>
                <div class="horaires">
                    <h3>Horaires et tarifs :</h3>
                    <div>
                        <img src="../images/Delivery Time.png" alt="icon heure">
                        <p>8h - 13h et 14h30 - 18h du lundi au vendredi</p>
                    </div>
                    <div>
                        <img src="../images/Stack of Coins.png" alt="icon argent">
                        <p>12 € par adulte, gratuit pour les enfants (-12 ans)</p>
                    </div>
                </div>
            </div>
            <div>
                <img class="carte" src="../images/carte.png" alt="carte géolocalisation">
            </div>
        </article>
        <button class="bouton-retour">
            <img src="../icons/arrow-left-o.svg" alt="">
            Retour
        </button>
    </section>
    <section class="section-page part-avis">
        <header class="header-avis">
            <h3>Avis : 4</h3>
            <h3>Non Consultés : 2</h3>
            <h3>Non répondus : 4</h3>
        </header>
        <article class="article-avis">
            <div>
                <div class="header-avis-profil">
                    <div class="profil">
                        <img src="../images/image 4.png" alt="photo de profil" width="40px" height="40px">
                        <p>Nicolas Dupuie</p>
                    </div>
                    <div>
                        <p>★★★★☆</p>
                    </div>
                </div>
                <div class="commentaire-consulte">
                    <p>La balade à vélo était très agréable, avec de beaux paysages à découvrir. Quelques petits détails
                        pourraient être améliorés, mais dans l'ensemble, c'était une belle expérience.</p>
                </div>
                <div>
                    <p class="reponse">Ajouter une réponse</p>
                </div>
            </div>
            <div>
                <div class="header-avis-profil">
                    <div class="profil">
                        <img src="../images/image 4.png" alt="photo de profil" width="40px" height="40px">
                        <p>Archibald Delacroix</p>
                    </div>
                    <div>
                        <p>★☆☆☆☆</p>
                    </div>
                </div>
                <div class="commentaire-consulte">
                    <p>L'organisation de la balade était chaotique et le matériel fourni de mauvaise qualité.
                        L'expérience n'a pas du tout été à la hauteur de ce qui était promis dans l'offre.</p>
                </div>
                <div>
                    <p class="reponse">Ajouter une réponse</p>
                </div>
            </div>
            <div>
                <div class="header-avis-profil">
                    <div class="profil">
                        <img src="../images/image 4.png" alt="photo de profil" width="40px" height="40px">
                        <p>Corélie delavegas</p>
                    </div>
                    <div>
                        <p>★★★☆☆</p>
                    </div>
                </div>
                <div class="commentaire-non-consulte">
                    <p>La balade était sympathique, mais certains aspects manquaient d'organisation. Le parcours était
                        intéressant, mais le matériel et le service pourraient être mieux.</p>
                </div>
                <div>
                    <p class="reponse">Ajouter une réponse</p>
                </div>
            </div>
            <div>
                <div class="header-avis-profil">
                    <div class="profil">
                        <img src="../images/image 4.png" alt="photo de profil" width="40px" height="40px">
                        <p>Michel Palareff</p>
                    </div>
                    <div>
                        <p>★★★★★</p>
                    </div>
                </div>
                <div class="commentaire-non-consulte">
                    <p>Je n'ai pas la référence des vélos, mais la balade était absolument parfaite, avec une
                        organisation fluide et des paysages magnifiques !</p>
                </div>
                <div>
                    <p class="reponse">Ajouter une réponse</p>
                </div>
            </div>
        </article>
    </section>
</body>

</html>

<?php 
$dbh = null;
?>