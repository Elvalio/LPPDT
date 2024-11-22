<?php


include('../sql/connect_params.php');

try{
    $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname",
        $user, $pass);
        
        $stmt = $dbh->prepare(
            "SELECT o.en_ligne, o.titre, o.prix_min, o.moy_note, o.nbravis, o.resume, a.ville, p.src_image, o.ido, o.categorie, o.date_publication, o.option
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

$lieux = array_unique(array_column($resultat, 'ville'), SORT_REGULAR);




?>
<head>
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <link rel="stylesheet" href="../css/accueilBO.css">
    <link rel="stylesheet" type="text/css" href="../css/styleHarry.css">
    <script src="../js/accueil.js"></script>
    <script type="module" src="../js/filtres.js"></script>
    <title>Accueil</title>


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
                            <img src="../images/search_icon.png" alt="Recherche" title="Recherche" id="rechercheOffreIMG">
                        </div>

                        <div class="filtrer-trier"> 
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

                            <div class="filtrer-bouton NoSelect">
                                <p class="FS">Filtrer</p>
                                <img src="../images/filtre.png" alt="filtre" title="filtre">
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
                <div class="filter">
                    <p class="FS">Catégories</p>
                    <div class="filtre-type">
                        <div class="filtre-case">
                            <input type="checkbox" id="visite" name="Visite" />
                            <label for="visite">Visite</label>
                        </div>
                        <div class="filtre-case">
                            <input type="checkbox" id="Spectacle" name="Spectacle" />
                            <label for="Spectacle">Spectacle</label>
                        </div>
                        <div class="filtre-case">
                            <input type="checkbox" id="Activite" name="Activite" />
                            <label for="Activite">Activité</label>
                        </div>
                        <div class="filtre-case">
                            <input type="checkbox" id="Restauration" name="Restauration" />
                            <label for="Restauration">Restauration</label>
                        </div>
                        <div class="filtre-case">
                            <input type="checkbox" id="Parc d'attraction" name="Parc d'attraction" />
                            <label for="Parc d'attraction">Parc d'attraction</label>
                        </div>
                    </div>
                </div>
                <div class="filter">
                    <p class="FS">Lieux</p>
                    <div class="filtre-lieu">
                        <div class="search-filter">
                            <input type="text" name="search" id="rechercheLieu" placeholder="Recherche">
                            <img src="../images/search_icon.png" alt="Recherche" title="Recherche" id="rechercheLieuIMG">
                        </div>
                        <div class="filtre-lieu-case">
                            <?php foreach ($lieux as $lieu) { ?>
                                <div class="filtre-case lieu">
                                    <input type="checkbox" id="<?php echo $lieu; ?>" name="<?php echo $lieu; ?>" />
                                    <label for="<?php echo $lieu; ?>"><?php echo $lieu; ?></label>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="filter">
                    <p class="FS">Date de publication</p>
                    <div class="filtre-temps">
                        <div id="calendar-start">
                            <label for="calendar-start">
                                Au plus tôt
                            </label>
                            <input type="date" name="date-start" id="date-start" class="filtre-temps-start">
                        </div>
                        
                        <div id="calendar-end">
                            <label for="calendar-end">
                                Au plus tard
                            </label>
                            <input type="date" name="date-end" id="date-end" class="filtre-temps-end">
                        </div>
                    </div>
                </div>
                <div class="filter">
                    <p class="FS">Prix</p>
                    <div class="filtre-prix">
                        <div class="slider-container">
                            <input type="range" id="slider-left" min="<?php echo $prix_min ?>" max="<?php echo $prix_max ?>" value="<?php echo $prix_min ?>" step="<?php echo $step ?>" class="filtre-prix-min">
                            <input type="range" onchange="change()" id="slider-right" min="<?php echo $prix_min ?>" max="<?php echo $prix_max ?>" value="<?php echo $prix_max ?>" step="<?php echo $step ?>" class="filtre-prix-max">
                            
                            <div class="value-container">
                                <span id="value-left"><?php echo $prix_min ?>€</span>
                                <span id="value-right"><?php echo $prix_max ?>€</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filter">
                    <p class="FS">Notes</p>
                    <div class="filtre-note">
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
            </div>

            <main>
            <?php
            foreach ($resultat as $key => $value) { 
                if ($value["en_ligne"]) { ?>
                    <div class="carte_offre desktop-element <?php if ($value["option"] == "En relief") {echo "enRelief";} ?> <?php if ($value["option"] == "A la une") {echo "aLaUne enRelief";}?>
                    <?php if (strtotime($value["date_publication"]) >= strtotime('-1 week')) {echo "Nouveaute";} ?> <?php echo $value["categorie"] ?> <?php echo $value["ville"] ?> note-<?php echo toInteger($value["moy_note"]) ?>" data-date="<?php echo $value["date_publication"] ?>" data-prix="<?php echo toInteger($value["prix_min"]) ?>" data-note="<?php echo toInteger($value["moy_note"]) ?>">
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
                                        <p class="textAvis">(<?php echo $value["nbravis"] ?>)</p> <?php } ?>
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