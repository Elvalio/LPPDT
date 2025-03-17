<!DOCTYPE html>
<html lang="fr">
    <?php
    include_once'nav.php';


    include('../sql/connect_params.php');


try{
    $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname",
        $user, $pass);
        
        $stmt = $dbh->prepare(
            "SELECT DISTINCT ON (o.ido)
    o.en_ligne, 
    o.titre, 
    o.prix_min, 
    o.moy_note, 
    o.nbravis, 
    o.resume, 
    a.ville, 
    p.src_image, 
    o.ido, 
    o.categorie, 
    o.date_publication, 
    o.option, 
    o.description, 
    h.heureOuverture, 
    h.heureFermeture,
    h.ouvertWeekend,
    o.numero_voie,
    o.voie,
    o.ville,
    o.code_postal,
    pact.toStringDate(o.ido) AS adresse
    FROM 
        pact.offre o
    JOIN 
        pact._adresse a ON o.idAdresse = a.idAdresse
    LEFT JOIN 
        pact.photo_offre p ON o.idO = p.idO
    LEFT JOIN 
        pact._horaire h ON o.idO = h.idO;
    "
    );
    
    $stmt->execute();

    
    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
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
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tableau de Bord</title>
        <link rel="stylesheet" href="../css/styleGeneral.css">
    </head>
    
    <?php
    if(isset($_COOKIE['type_compte'])){
        if ($_COOKIE['type_compte'] == "pro_public" || $_COOKIE['type_compte'] == "pro_prive") { ?>
            <body class="BO"> <?php   
            $etoile = "rouge";
        }  else { ?>
            <body class="FO"> <?php
            $etoile = "bleue";
        }
    } else { ?>
        <body class="FO"> <?php
        $etoile = "bleue";

    }?>
        <div class="main-content">
            <header>
                <h1>Historique</h1>
            </header>
            <main id="historique">

            <!-- <?php
            foreach ($resultat as $key => $value) { 
                if ($value["en_ligne"]) { ?>
                <div class="offre_historique_container">
                    <div class="infoText">
                        <h2><?php echo $value["titre"] ?></h2>
                        <p><?php echo $value["description"] ?></p>
                        <p><?php echo $value["adresse"] ?> - <?php echo $value["prix_min"]; ?>€</p>
                    </div>
                    <div class="infoIMG">
                        <div class="etoiles">
                            <?php 
                            if ($value["moy_note"] != null && $value["nbravis"] != 0) {
                                for ($i = 0; $i < floor($value["moy_note"]); $i++) { ?>
                                    <img src="../icons/etoile_<?php echo $etoile; ?>.png" alt="Etoile">
                                <?php }

                                if ($value["moy_note"] - floor($value["moy_note"]) >= 0.5) { ?>
                                    <img src="../icons/demi_etoile_<?php echo $etoile; ?>.png" alt="Demi Etoile">
                                <?php 
                                    $i++;
                                }

                                for (; $i < 5; $i++) { ?>
                                    <img src="../icons/etoile_<?php echo $etoile; ?>_vide.png" alt="Etoile Vide">
                            <?php }} ?>
                            <?php if ($value["moy_note"] != null && $value["nbravis"] != 0) { ?>
                                <p class="textAvis">(<?php echo $value["nbravis"] ?>)</p> 
                            <?php } ?>
                        </div>
                        <?php if ($value['src_image']) { ?>
                                <img src="../images/<?php echo $value['src_image']; ?>" alt="Photo offre">
                            <?php } else { ?>
                                <img src="../images/imagesReferences/placeholder.jpg" alt="Image par défaut">
                            <?php } ?>
                    </div>
                </div>
                <?php } } ?> -->
                <div id="historique_container"></div>
                
                
                <?php

                include_once'footer.php';

                ?>  
            </main>
        </div>

    </body>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        let historique = JSON.parse(localStorage.getItem("historique_offres")) || [];
        console.log(historique);
        let container = document.getElementById("historique_container");

        if (historique.length === 0) {
            container.innerHTML = "<p>Aucune offre consultée récemment.</p>";
            return;
        }

        historique.forEach(offre => {
            let offreDiv = document.createElement("div");
            offreDiv.classList.add("offre_historique_container");

            offreDiv.innerHTML = `
                <div class="infoText">
                    <h2>${offre.titre}</h2>
                    <p>${offre.desc}</p>
                    <p>${offre.adresse} - ${offre.prix}€</p>
                </div>
                <div class="infoIMG">
                    <div class="etoiles">
                        ${genererEtoiles(offre.note)}
                        <p class="textAvis"> (${offre.nbrAvis})</p>
                    </div>
                    <img src="../images/${offre.image || 'imagesReferences/placeholder.jpg'}" alt="Photo offre">
                </div>
            `;

            container.appendChild(offreDiv);
        });
    });

    // Générer les étoiles en fonction de la note
    function genererEtoiles(note) {
        if (!note) return "";

        let body = document.querySelector("body");

        let etoiles = "";
        if (body.classList.contains("BO")) {
            etoiles += "rouge"
        } else {
            etoiles += "bleue";
        }
        
        let html = "";
        let noteInt = Math.floor(note);
        
        for (let i = 0; i < noteInt; i++) {
            html += `<img src="../icons/etoile_${etoiles}.png" alt="Etoile">`;
        }
        if (note - noteInt >= 0.5) {
            html += `<img src="../icons/demi_etoile_${etoiles}.png" alt="Demi Etoile">`;
        }
        while (html.split("img").length - 1 < 5) {
            html += `<img src="../icons/etoile_${etoiles}_vide.png" alt="Etoile Vide">`;
        }
        return html;
    }
    </script>

</html>
