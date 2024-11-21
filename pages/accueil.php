<?php


include('../sql/connect_params.php');

try{
    $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname",
        $user, $pass);
        
        $stmt = $dbh->prepare(
            "SELECT o.en_ligne, o.titre, o.prix_min, o.moy_note, o.nbravis, o.resume, a.ville, p.src_image, o.ido, o.categorie, o.date_publication
             FROM pact.offre o
             JOIN pact._adresse a ON o.idAdresse = a.idAdresse
             LEFT JOIN pact.photo_offre p ON o.idO = p.idO"
        );
    
    $stmt->execute();

    
    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
// ido, titre, resume, type, nom_type, cout, description, prix_min, moy_note, nbravis, accessibilitev, categorie, date_creation, date_publication, idadresse, ville, numero_voie, voie, code_postal, complement, idc


    function toInteger($value) {
        return intval($value);
    }

    if (isset($_GET['trie'])) {
        $resultat = trie($_GET['trie'], $resultat);
    }
    $sorted_resultat = $resultat;
    usort($sorted_resultat, function($a, $b) {
        return $a["prix_min"] - $b["prix_min"];
    });

    $prix_min = $sorted_resultat[0]["prix_min"];
    $prix_max = $sorted_resultat[count($sorted_resultat)-1]["prix_min"];
    $step = ($prix_max > 1000) ? 10 : 1;

} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}




?>
<head>
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <link rel="stylesheet" href="../css/accueilBO.css">
    <link rel="stylesheet" type="text/css" href="../css/styleHarry.css">
    <script src="../js/accueil.js"></script>
    <script type="module" src="../js/filtres.js"></script>


</head>

<html>
    <?php 
    if(isset($_COOKIE['type_compte'])){
        if ($_COOKIE['type_compte'] == "pro_public" || $_COOKIE['type_compte'] == "pro_prive") { ?>
            <body class="BO"> <?php   
        }  else { ?>
            <body class="FO"> <?php
        }
    } else { ?>
        <body class="FO"> <?php
    }?>
        <nav class="desktop-element">
         <?php include_once'nav.php'; ?>
        </nav>
        <header class="phone-element">
        <?php
            include 'header.php';
        ?>
        </header>
        <div class="main-content">
            <!-- Contenu principal de la page -->
            <header class="desktop-element">
                <h1 class="TS">Accueil</h1>
            </header>
            <nav class="desktop-element">
                <div class="nav_space">
                    <div class="space-button">
                        <div class="search">
                            <input type="text" name="search" id="rechercheOffre" placeholder="Recherche" class="FS">
                            <img src="../images/search_icon.png" alt="Recherche" title="Recherche">
                        </div>

                        <div class="filtrer-trier"> 
                            <div class="filtrer-bouton NoSelect">
                                <p class="FS">Filtrer par</p>
                                <img src="../images/fleche.png" alt="Fleche" title="Fleche">
                            </div>

                            <div class="dropdown NoSelect">
                                <div class="dropdown-toggle trier">
                                    <p class="FS">Trier par</p>
                                    <img src="../images/fleche.png" alt="Fleche" title="Fleche">
                                </div>
                                <ul class="dropdown-menu">
                                    <li><a>Prix croissant</a></li>
                                    <li><a>Prix décroissant</a></li>
                                    <li><a>Notes croissantes</a></li>
                                    <li><a>Notes décroissantes</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="NouveauALaUne">
                        <div class="boutonNouveau NoSelect">
                            <p class="FS">Nouveau</p>
                        </div>
                        <div class="boutonALaUne NoSelect">
                            <p class="FS">A la une</p>
                        </div>
                    </div>
                </div>

            </nav>

            <div class="all-filter">
                <div class="filter filtre-type">
                    <div class="filtre-case">
                        <input type="checkbox" id="visite" name="Visite" />
                        <label for="visite">Visite</label>
                    </div>
                    <div class="filtre-case">
                        <input type="checkbox" id="spectacle" name="Spectacle" />
                        <label for="spectacle">Spectacle</label>
                    </div>
                    <div class="filtre-case">
                        <input type="checkbox" id="Activite" name="Activite" />
                        <label for="Pattractions">Activité</label>
                    </div>
                    <div class="filtre-case">
                        <input type="checkbox" id="restauration" name="Restauration" />
                        <label for="restauration">Restauration</label>
                    </div>
                </div>
                <div class="filter filtre-lieu">
                    <div class="search-filter">
                        <input type="text" name="search" id="search" placeholder="Recherche">
                        <img src="../images/search_icon.png" alt="Recherche" title="Recherche">
                    </div>
                    <div class="filtre-case">
                        <input type="checkbox" id="Perros-Guirec" name="Perros-Guirec" />
                        <label for="Perros-Guirec">Perros-Guirec</label>
                    </div>
                    <div class="filtre-case">
                        <input type="checkbox" id="Lannion" name="Lannion" />
                        <label for="Lannion">Lannion</label>
                    </div>
                    <div class="filtre-case">
                        <input type="checkbox" id="Plemeur-Boudou" name="Plemeur-Boudou" />
                        <label for="Plemeur-Boudou">Plemeur-Boudou</label>
                    </div>
                </div>
                <div class="filter filtre-temps">
                    <div id="calendar-start">
                        <label for="calendar-start">
                            Date de début
                        </label>
                        <input type="date" name="date-start" id="date-start" class="filtre-temps-start">
                    </div>
                    
                    <div id="calendar-end">
                        <label for="calendar-end">
                            Date de Fin
                        </label>
                        <input type="date" name="date-end" id="date-end" class="filtre-temps-end">
                    </div>
                </div>
                <div class="filter filtre-prix">
                    <div class="slider-container">
                        <input type="range" id="slider-left" min="<?php echo $prix_min ?>" max="<?php echo $prix_max ?>" value="<?php echo $prix_min ?>" step="<?php echo $step ?>" class="filtre-prix-min">
                        <input type="range" onchange="change()" id="slider-right" min="<?php echo $prix_min ?>" max="<?php echo $prix_max ?>" value="<?php echo $prix_max ?>" step="<?php echo $step ?>" class="filtre-prix-max">
                        
                        <div class="value-container">
                            <span id="value-left"><?php echo $prix_min ?>€</span>
                            <span id="value-right"><?php echo $prix_max ?>€</span>
                        </div>
                    </div>
                </div>
                <div class="filter filtre-note">
                    <?php
                    $notes = [
                        5 => [true, true, true, true, true],
                        4 => [true, true, true, true, false],
                        3 => [true, true, true, false, false],
                        2 => [true, true, false, false, false],
                        1 => [true, false, false, false, false],
                    ];

                    foreach ($notes as $note => $stars) { ?>
                        <div class="note">
                            <input type="checkbox" id="note-<?php echo $note; ?>" name="note-<?php echo $note; ?>" />
                            <div class="etoileNoteFiltre">
                                <?php foreach ($stars as $star) { ?>
                                    <img src="../icons/<?php echo $star ? 'etoile_rouge' : 'etoile_rouge_vide'; ?>.png" alt="<?php echo $star ? 'Etoile' : 'Etoile Vide'; ?>" title="<?php echo $star ? 'Etoile' : 'Etoile Vide'; ?>">
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <main>
            <?php
            foreach ($resultat as $key => $value) { 
                if ($value["en_ligne"]) { ?>
                    <div class="carte_offre desktop-element <?php echo $value["categorie"] ?> <?php echo $value["ville"] ?> note-<?php echo toInteger($value["moy_note"]) ?>" data-date="<?php echo $value["date_publication"] ?>" data-prix="<?php echo toInteger($value["prix_min"]) ?>" data-note="<?php echo toInteger($value["moy_note"]) ?>">
                        <a href="detail-offre.php?value=<?php echo $value["ido"]; ?>">
                            <?php if ($value['src_image']) { ?>
                                <img src="../images/<?php echo $value['src_image']; ?>" alt="Photo offre">
                            <?php } else { ?>
                                <img src="../images/imagesReferences/placeholder.jpg" alt="Image par défaut">
                            <?php } ?>
                            
                            <p class="titreAnnonce"><?php echo $value["titre"] ?></p>
                            <div class="infoAnnonce">
                                <p><?php echo $value["prix_min"] ?>€</p>
                                
                                <div class="etoileNote">
                                    <?php 
                                    if ($value["moy_note"] != null && $value["nbravis"] != 0) {
                                        for ($i=0; $i < floor($value["moy_note"]); $i++) { ?>
                                            <img src="../icons/etoile_rouge.png" alt="Etoile">
                                        <?php }
                                        for ($i=floor($value["moy_note"]); $i < 5; $i++) { ?>
                                            <img src="../icons/etoile_rouge_vide.png" alt="Etoile Vide">
                                    <?php }} ?>
                                    <?php if ($value["moy_note"] != null && $value["nbravis"] != 0) { ?>
                                        <p>(<?php echo $value["nbravis"] ?>)</p> <?php } ?>
                                </div>

                            </div>
                        </a>
                    </div>

                    <div class="carte_offre phone-element">
                        <a href="detail-offre.php?value=<?php echo $value["ido"]; ?>">

                        <div class="InfoOffreMobile">
                            <p class="titreAnnonce"><?php echo $value["titre"] ?></p>

                            <p class="resumeAnnonce"><?php echo $value["resume"] ?></p>

                            <p class="villeAnnonce"><?php echo $value["ville"] ?></p>
                        </div>
                        <div class="NoteImageOffreMobile">
                            <div class="etoileNote">
                                <?php
                                if ($value["moy_note"] != null && $value["nbravis"] != 0) {
                                    for ($i=0; $i < $value["moy_note"]; $i++) { ?>
                                        <img src="../icons/etoile_rouge.png" alt="Etoile">
                                    <?php }
                                    for ($i=0; $i < 5-$value["moy_note"]; $i++) { ?>
                                    
                                        <img src="../icons/etoile_rouge_vide.png" alt="Etoile Vide">
                                <?php }} ?>
                            </div>
                        
                            <div class="conteneurImage">
                                <?php if ($value['src_image']) { ?>
                                    <img src="../images/<?php echo $value['src_image']; ?>" alt="Photo offre">


                                <?php } else { ?>
                                    <img src="../images/imagesReferences/placeholder.jpg" alt="Image par défaut">
                                <?php } ?>
                            </div>
                        </div>
                        </a>
                    </div>
                <?php } } ?>

                                
            </main>
            <div id="popup" class="popup">
                <img src="../images/croix.png" alt="" class="close-popup">
                <div class="popup-text">
                    <p>Vous aussi, postez votre offre dès maintenant !</p>
                    <p>Devenez professionnel en 1 minute</p>
                </div>
                <a href="creation_compte.php" class="join-button">Nous rejoindre</a>
            </div>
            <footer>
                <?php include_once'footer.php'; ?>
            </footer>
        
        </div>

        <?php include_once'footerNav.php' ?>

            
    </body>
</html>

<?php

$dbh = null;
?>