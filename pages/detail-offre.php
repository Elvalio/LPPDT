if(document.getElementById("etoile_note1") !== null){

    const etoile_plein = "../icons/etoile_bleue.png";
    const etoile_vide= "../icons/etoile_bleue_vide.png";
    let etoile1 = document.getElementById("etoile_note1");
    let etoile2 = document.getElementById("etoile_note2");
    let etoile3 = document.getElementById("etoile_note3");
    let etoile4 = document.getElementById("etoile_note4");
    let etoile5 = document.getElementById("etoile_note5");

    let nbr_etoile = document.getElementById("nbr_etoile");

    // initialisation étoile
    let initNote = document.getElementById("nbr_etoile");
    if(initNote.value === ''){
        etoile1.src=(etoile_vide);
        etoile2.src=(etoile_vide);
        etoile3.src=(etoile_vide);
        etoile4.src=(etoile_vide);
        etoile5.src=(etoile_vide);

        etoile1.addEventListener("mouseover", modif_etoile);
        etoile2.addEventListener("mouseover", modif_etoile);
        etoile3.addEventListener("mouseover", modif_etoile);
        etoile4.addEventListener("mouseover", modif_etoile);
        etoile5.addEventListener("mouseover", modif_etoile);

        etoile1.addEventListener("mouseout", modif_etoile);
        etoile2.addEventListener("mouseout", modif_etoile);
        etoile3.addEventListener("mouseout", modif_etoile);
        etoile4.addEventListener("mouseout", modif_etoile);
        etoile5.addEventListener("mouseout", modif_etoile);
    }else if(initNote.value === "1"){
        etoile1.src=(etoile_plein);
        etoile2.src=(etoile_vide);
        etoile3.src=(etoile_vide);
        etoile4.src=(etoile_vide);
        etoile5.src=(etoile_vide);
    }else if(initNote.value === "2"){
        etoile1.src=(etoile_plein);
        etoile2.src=(etoile_plein);
        etoile3.src=(etoile_vide);
        etoile4.src=(etoile_vide);
        etoile5.src=(etoile_vide);
    }else if(initNote.value === "3"){
        console.log(3);
        etoile1.src=(etoile_plein);
        etoile2.src=(etoile_plein);
        etoile3.src=(etoile_plein);
        etoile4.src=(etoile_vide);
        etoile5.src=(etoile_vide);
    }else if(initNote.value === "4"){
        etoile1.src=(etoile_plein);
        etoile2.src=(etoile_plein);
        etoile3.src=(etoile_plein);
        etoile4.src=(etoile_plein);
        etoile5.src=(etoile_vide);
    }else{
        etoile1.src=(etoile_plein);
        etoile2.src=(etoile_plein);
        etoile3.src=(etoile_plein);
        etoile4.src=(etoile_plein);
        etoile5.src=(etoile_plein);
    }


    etoile1.addEventListener("click", modif_etoile);
    etoile2.addEventListener("click", modif_etoile);
    etoile3.addEventListener("click", modif_etoile);
    etoile4.addEventListener("click", modif_etoile);
    etoile5.addEventListener("click", modif_etoile);


    function modif_etoile(event){
        let etoileid = event.target.id;
        
        if(event.type === "mouseover"){
            if(etoileid === "etoile_note1"){
                etoile1.src=(etoile_plein);
            }else if(etoileid === "etoile_note2"){
                etoile1.src=(etoile_plein);
                etoile2.src=(etoile_plein);
            }else if(etoileid === "etoile_note3"){
                etoile1.src=(etoile_plein);
                etoile2.src=(etoile_plein);
                etoile3.src=(etoile_plein);
            }else if(etoileid === "etoile_note4"){
                etoile1.src=(etoile_plein);
                etoile2.src=(etoile_plein);
                etoile3.src=(etoile_plein);
                etoile4.src=(etoile_plein);
            }else{
                etoile1.src=(etoile_plein);
                etoile2.src=(etoile_plein);
                etoile3.src=(etoile_plein);
                etoile4.src=(etoile_plein);
                etoile5.src=(etoile_plein);
            }
        }else if(event.type==="mouseout"){
            if(etoileid === "etoile_note1"){
                etoile1.src=(etoile_vide);
            }else if(etoileid === "etoile_note2"){
                etoile1.src=(etoile_vide);
                etoile2.src=(etoile_vide);
            }else if(etoileid === "etoile_note3"){
                etoile1.src=(etoile_vide);
                etoile2.src=(etoile_vide);
                etoile3.src=(etoile_vide);
            }else if(etoileid === "etoile_note4"){
                etoile1.src=(etoile_vide);
                etoile2.src=(etoile_vide);
                etoile3.src=(etoile_vide);
                etoile4.src=(etoile_vide);
            }else{
                etoile1.src=(etoile_vide);
                etoile2.src=(etoile_vide);
                etoile3.src=(etoile_vide);
                etoile4.src=(etoile_vide);
                etoile5.src=(etoile_vide);
            }
        }else{
            if(etoileid === "etoile_note1"){
                etoile1.src=(etoile_plein);
                etoile2.src=(etoile_vide);
                etoile3.src=(etoile_vide);
                etoile4.src=(etoile_vide);
                etoile5.src=(etoile_vide);
                nbr_etoile.value = 1;
            }else if(etoileid === "etoile_note2"){
                etoile1.src=(etoile_plein);
                etoile2.src=(etoile_plein);
                etoile3.src=(etoile_vide);
                etoile4.src=(etoile_vide);
                etoile5.src=(etoile_vide);
                nbr_etoile.value = 2;
            }else if(etoileid === "etoile_note3"){
                etoile1.src=(etoile_plein);
                etoile2.src=(etoile_plein);
                etoile3.src=(etoile_plein);
                etoile4.src=(etoile_vide);
                etoile5.src=(etoile_vide);
                nbr_etoile.value = 3;
            }else if(etoileid === "etoile_note4"){
                etoile1.src=(etoile_plein);
                etoile2.src=(etoile_plein);
                etoile3.src=(etoile_plein);
                etoile4.src=(etoile_plein);
                etoile5.src=(etoile_vide);
                nbr_etoile.value = 4;
            }else{
                etoile1.src=(etoile_plein);
                etoile2.src=(etoile_plein);
                etoile3.src=(etoile_plein);
                etoile4.src=(etoile_plein);
                etoile5.src=(etoile_plein);
                nbr_etoile.value = 5;
            }

            etoile1.removeEventListener("mouseover", modif_etoile);
            etoile2.removeEventListener("mouseover", modif_etoile);
            etoile3.removeEventListener("mouseover", modif_etoile);
            etoile4.removeEventListener("mouseover", modif_etoile);
            etoile5.removeEventListener("mouseover", modif_etoile);

            etoile1.removeEventListener("mouseout", modif_etoile);
            etoile2.removeEventListener("mouseout", modif_etoile);
            etoile3.removeEventListener("mouseout", modif_etoile);
            etoile4.removeEventListener("mouseout", modif_etoile);
            etoile5.removeEventListener("mouseout", modif_etoile);
        }
    }
}

let boutons_supp = document.getElementsByName('bouton_supp');

function supp_avis(event) {
    let form = event.target.closest('form');
    let confirmation = confirm("Voulez-vous supprimer votre avis ?");
    if (confirmation) {
        form.submit();
        form.reset();
    }
}

boutons_supp.forEach(bouton => {
    bouton.addEventListener("click", supp_avis);
});

// document.addEventListener("DOMContentLoaded", () => {
//     const signalButtons = document.querySelectorAll('.btn-signaler'); // Sélectionne tous les boutons "Signaler"
//     const popup = document.getElementById('popup');
//     const closeBtn = popup.querySelector('.close-btn');
//     const progressBar = popup.querySelector('.progress-bar div');

//     let timeout;

//     signalButtons.forEach((button) => {
//         button.addEventListener('click', () => {
//             // Réinitialiser l'animation de la barre
//             progressBar.style.animation = 'none';
//             progressBar.offsetHeight; // Déclenche un reflow pour redémarrer l'animation
//             progressBar.style.animation = ''; // Restaurer l'animation


//             popup.classList.add('active');
//             clearTimeout(timeout);
//             timeout = setTimeout(() => {
//                 popup.classList.remove('active');
//             }, 4000);
//         });
//     });

//     closeBtn.addEventListener('click', () => {
//         popup.classList.remove('active');
//         clearTimeout(timeout);
//     });
// });


function toggle_reponse(id) {
    var form = document.getElementById("form_reponse_" + id);
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "inline";
    } else {
        form.style.display = "none";
    }
}




const likeButton = document.querySelectorAll('[id^="likeButton"]');
const dislikeButton = document.querySelectorAll('[id^="dislikeButton"]');
const likesCount = document.querySelectorAll('[id^="likesCount"]');
const dislikesCount = document.querySelectorAll('[id^="dislikesCount"]');

likeButton.forEach(button => {
    button.addEventListener("click", async () => {

        datas = event.target.id.split('_');
        console.log(datas);
        const data = {
            id_compte: datas[1],
            id_avis: datas[2],
        };
    
        try {
            
            const response = await fetch('../pages/update_like.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });
    
            if (response.ok) {
                
                const result = await response.json();
                console.log(result);
                const likesCount = button.closest('.like-dislike').querySelector(`[id^="likesCount_${datas[2]}"]`);
                const dislikesCount = button.closest('.like-dislike').querySelector(`[id^="dislikesCount_${datas[2]}"]`);
                console.log(likesCount);
                if (result.nbr_likes !== undefined) {
                    console.log(result.nbr_likes);
                    likesCount.textContent = result.nbr_likes;
                    dislikesCount.textContent = result.nbr_dislikes;
                }
            } else {
                console.error('Erreur HTTP:', response.status);
            }
        } catch (error) {
            console.error('Erreur réseau:', error);
        }
    });
    }
);

dislikeButton.forEach(button => {
    button.addEventListener("click", async () => {

        datas = event.target.id.split('_');
        console.log(datas);
        const data = {
            id_compte: datas[1],
            id_avis: datas[2],
        };
    
        try {
            
            const response = await fetch('../pages/update_dislike.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });
    
            if (response.ok) {
                
                const result = await response.json();
                console.log(result);
                const dislikesCount = button.closest('.like-dislike').querySelector(`[id^="dislikesCount_${datas[2]}"]`);
                const likesCount = button.closest('.like-dislike').querySelector(`[id^="likesCount_${datas[2]}"]`);
                console.log(dislikesCount);
                if (result.nbr_dislikes !== undefined) {
                    console.log(result.nbr_dislikes);
                    dislikesCount.textContent = result.nbr_dislikes;
                    likesCount.textContent = result.nbr_likes;
                }
            } else {
                console.error('Erreur HTTP:', response.status);
            }
        } catch (error) {
            console.error('Erreur réseau:', error);
        }
    });
    }
);

const signalerAvisBtn = document.querySelectorAll('[id^="btn_signaler_avis"]');
console.log(signalerAvisBtn);
const signalerReponseBtn = document.querySelectorAll('[id^="btn_signaler_reponse"]');

const popupWarn = document.getElementById('popup');
const closeBtn = popupWarn.querySelector('.close-btn');
const progressBar = popupWarn.querySelector('.progress-bar div');


document.querySelectorAll('.btn-signaler').forEach(button => {
    // Récupérer l'état initial depuis localStorage
    const buttonId = button.id; // Utiliser l'ID unique du bouton pour l'identifier
    const isAlreadySignaled = localStorage.getItem(`signal_${buttonId}`) === 'true';

    if (isAlreadySignaled) {
        // Désactiver le bouton et mettre à jour le style s'il a déjà été signalé
        button.disabled = true;
        button.style.cursor = 'not-allowed';
        button.style.opacity = '0.5';
        button.querySelector('p').textContent = 'Déjà signalé';
    }

    // Ajouter l'écouteur d'événement pour le clic
    button.addEventListener("click", async () => {
        const datas = button.id.split('_');
        console.log(datas);
        console.log(event.target.id);
 const data = {
            id_compte: datas[3],
            id_avis: datas[4],
        };

        try {
            let confirmation = confirm("Voulez-vous signaler cet avis ?");
            if (confirmation) {
                const response = await fetch('../pages/update_signal_avis.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    let timeout;

                    // Désactiver le bouton et mettre à jour le style
                    button.disabled = true;
                    button.style.cursor = 'not-allowed';
                    button.style.opacity = '0.5';
                    button.querySelector('p').textContent = 'Déjà signalé';

                    // Sauvegarder l'état dans localStorage
                    localStorage.setItem(`signal_${buttonId}`, 'true');

                    // Réinitialiser l'animation de la barre
                    progressBar.style.animation = 'none';
                    progressBar.offsetHeight; // Déclenche un reflow pour redémarrer l'animation
                    progressBar.style.animation = ''; // Restaurer l'animation

                    // Afficher le popup de confirmation
                    popupWarn.classList.add('active');
                    clearTimeout(timeout);
                    timeout = setTimeout(() => {
                        popupWarn.classList.remove('active');
                    }, 4000);
                } else {
                    console.error('Erreur HTTP:', response.status);
                }
            }
        } catch (error) {
            console.error('Erreur réseau:', error);
        }
    });
});

// Gestion du bouton de fermeture du popup
if (closeBtn) {
    closeBtn.addEventListener('click', () => {
        popupWarn.classList.remove('active');
    });
}
    /*
    // Requête pour griser tout les avis qui ont déjà été signalé par l'utilisateur
    $idAvis = $avisIndividuel['ida'];
    $idSignaleur = (int)$_COOKIE['user'];

    $bdh = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);
    $stmt = $bdh->prepare("
        SELECT COUNT(*) FROM pact._signal_avis 
        WHERE idA = :idA AND idSignaleur = :idSignaleur
    ");
    $stmt->execute([
        ':idA' => $idAvis,
        ':idSignaleur' => $idSignaleur
    ]);
    $alreadySignaled = $stmt->fetchColumn() > 0;
    */

    // Récupération du téléphone du professionnel
    $stmtTelephone = $bdh->prepare("
        SELECT telephone 
        FROM pact.professionnel p 
        INNER JOIN pact.offre o ON p.idC = o.idC 
        WHERE o.idC = :idC
    ");
    $stmtTelephone->execute([':idC' => $offre['idc']]);
    $telephone = $stmtTelephone->fetch(PDO::FETCH_ASSOC)['telephone'] ?? 'Non disponible';

} catch (PDOException $e) {
    echo "Erreur : " . htmlspecialchars($e->getMessage());
    die();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo htmlspecialchars($offre['categorie'] ?? 'Détails de l\'offre'); ?>
    </title>
    <link rel="stylesheet" href="../css/samStyles.css">
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <script src="../js/detail-offre-offre.js" async></script>
    <?php 
    if(isset($_COOKIE['type_compte'])){
        if ($_COOKIE['type_compte'] == "pro_public" || $_COOKIE['type_compte'] == "pro_prive") { ?>
            <link id="dynamic-favicon" rel="icon" type="image/x-icon" href="../logo/rouge.ico"> <?php   
        }  else { ?>
            <link id="dynamic-favicon" rel="icon" type="image/x-icon" href="../logo/bleu.ico"> <?php
        }
    } else { ?>
        <link id="dynamic-favicon" rel="icon" type="image/x-icon" href="../logo/bleu.ico"> <?php
    }?>
</head>

<div class="desktop-element">
<?php include_once 'nav.php';?>
</div>

<body class="main-content <?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'BO' : 'FO'; ?>">

    <div class="body">
        <section class="section-page part-annonce">
        <header>
            <h1 class="titre-rouge">
                <?php echo htmlspecialchars($offre['titre']); ?>
            </h1>
            <h2 class="sous-titre">
                <?php echo htmlspecialchars($offre['ville']); ?> |
                <?php echo htmlspecialchars($telephone); ?>
                <?php if (!empty($spectacle[0]['duree'])) echo " | Durée : " . htmlspecialchars(substr($spectacle[0]['duree'], 0, 5)); ?>
                <?php if (!empty($activite[0]['duree'])) echo " | Durée : " . htmlspecialchars(substr($activite[0]['duree'], 0, 5)); ?>
                <?php if (!empty($visite[0]['duree'])) echo " | Durée : " . htmlspecialchars(substr($visite[0]['duree'], 0, 5)); ?>

                <?php if (!empty($activite[0]['age_min'])) echo " | Âge : " . $activite[0]['age_min'] . " ans"; ?>
                <?php if (!empty($parc_actraction[0]['age_min'])) echo " | Âge : " . $parc_actraction[0]['age_min'] . " ans"; ?>

                <?php   if (!empty($restaurant[0]['gamme_prix'])) {echo " | Prix : " . htmlspecialchars($restaurant[0]['gamme_prix']);}
                        elseif (!empty($offre['prix_min'])) {echo " | Prix : " . htmlspecialchars($offre['prix_min']) . " €";} 
                ?>

                <?php echo htmlspecialchars($offre['gamme_prix'] ?? ''); ?>
            </h2>

            <!-- Carrousel -->
            <div class="container NoSelect">
                <div class="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($photos as $index => $photo): ?>
                        <div class="slide">
                            <img src="../images/<?php echo htmlspecialchars($photo['src_image']); ?>"
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
                <div class="infos-avis">
                    <div class="etoiles">
                        <?php
                            $nbrAvis = $offre['nbravis'];
                            $fullStars = floor($offre["moy_note"]);
                            $halfStar = ($offre["moy_note"] - $fullStars >= 0.5) ? 1 : 0;
                            $emptyStars = 5 - $fullStars - $halfStar;
                        ?>

                        <?php for ($i = 0; $i < $fullStars; $i++): ?>
                            <img src="../icons/<?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'etoile_rouge' : 'etoile_bleue'; ?>.png" alt="Étoile">
                        <?php endfor; ?>

                        <?php if ($halfStar): ?>
                            <img src="../icons/<?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'demi_etoile_rouge' : 'demi_etoile_bleue'; ?>.png" alt="Demi Étoile">
                        <?php endif; ?>

                        <?php for ($i = 0; $i < $emptyStars; $i++): ?>
                            <img src="../icons/<?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'etoile_rouge_vide' : 'etoile_bleue_vide'; ?>.png" alt="Étoile Vide">
                        <?php endfor; ?>

                    </div>
                    <p class="nb-avis-info-offre">
                        <?php echo $nbrAvis?>&#xA0;Avis
                    </p>
                </div>
                <div class="infos-accessibilite">

                    <img src="../images/Wheelchair.png" alt="Accessibilité">
                    <p>
                        <?php echo htmlspecialchars($offre['accessibilite']); ?>
                    </p>
                </div>
            </div>
        </header>

        <!-- Description -->
        <article class="description-offre">
            <h3>Description :</h3>
            <p>
                <?php echo nl2br(htmlspecialchars($offre['description'])); ?>
            </p>
        </article>

        <article class="part-contact">
            <div class="side-contact">
                <div>
                    <h3>Contact :</h3>
                    <div class="element-contact">
                        <?php 
                        $address = $offre['numero_voie'] . $offre['voie'] . $offre['ville'] . $offre['code_postal'];
                        ?>
                        <a href="https://www.google.com/maps/dir// <?php echo $address ?>">
                            <img src="../images/maison.png" alt="icon maison (localisation)">
                            <p class="lien">
                                <?php
                                echo $offre['numero_voie'];
                                echo " ";
                                echo $offre['voie'];
                                echo " ";
                                echo $offre['ville'];
                                echo " ";
                                echo $offre['code_postal'];

                            ?>
                            </p>
                        </a>
                    </div>
                    <div class="element-contact">
                        <a href="tel:<?php 
                            echo htmlspecialchars($telephone);
                                ?> ">
                            <img src="../images/telephone.png" alt="icon telephone">
                            <p class="lien">
                                <?php 
                                        echo htmlspecialchars($telephone);
                                    ?>
                            </p>
                        </a>
                    </div>

                    <?php
                        if (!empty($offre['site_web'])) { ?>
                    <div class="element-contact">
                        <a href=" <?php echo $offre['site_web']; ?>">
                            <img src="../images/pc.png" alt="icon pc (lien vers le site)">
                            <p class="lien">
                                <?php
                            echo $offre['site_web']; ?>
                            </p>
                        </a>
                    </div>
                </div>
                <?php

                        } ?>
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

            <!--
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
            -->

        </article>
        <button class="desktop-element bouton-retour NoSelect">
            <a href="./accueil.php">
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
        <article class="article-avis">
            <?php if(!isset($_COOKIE['type_compte']) || $_COOKIE['type_compte'] == "membre"){ 
                    if (isset($_COOKIE['user'])){
                    $avis_publie = false;
                    if ($nbrAvis > 0){ foreach ($avis as $avisIndividuel):
                        if($_COOKIE['user'] == $avisIndividuel['idc']){
                            $avis_publie = true;
                        }
                    endforeach;}
                    if(!$avis_publie){ ?>
            <article class="poster_avis">
                <h3>Poster un avis :</h3>
                <div class="notes_avis">
                    <?php for($i = 1; $i<6; $i++):?>
                        <img src="../icons/etoile_bleue_vide.png" width="35px" height="35px"
                            id="etoile_note<?php echo $i?>">
                    <?php endfor;?>
                </div>
                <form method="POST" action="detail-offre.php?value=<?php echo $offre['ido']?>" class="zone-btn-publier">
                        <input type="hidden" name="type_form" value="poste-avis">
                        <input type="hidden" id="nbr_etoile" name="nbr_etoile" value="<?php echo isset($_POST['etoile']) ? $_POST['etoile'] : ''; ?>">
                        <textarea maxlength="30" type="text" name="titre_avis" id="titre_avis" placeholder="Titre de l'avis"
                            required="required"><?php echo isset($_POST['titreAvis']) ? $_POST['titreAvis'] : ''; ?></textarea>
                        <textarea minlength="30" maxlength="255" type="text" name="zone_avis" id="ecrire_avis"
                            placeholder="Veuillez écrire dans cette zone pour pouvoir déposer un avis sur cette offre."><?php echo isset($_POST['contenuAvis']) ? $_POST['contenuAvis'] : ''; ?></textarea>
                        <!--<input type="file" accept=".png, .jpeg, .svg, .webp" id="image_avis" name="image_avis">-->
                        <label for="options" id="titre-contexte">Contexte de la visite :</label>
                        <select id="options-contexte" name="options">
                            <option value="Affaires" <?= isset($_POST['contextAvis']) && $_POST['contextAvis'] === 'Affaires' ? 'selected' : '' ?>>Affaires</option>
                            <option value="Couple" <?= isset($_POST['contextAvis']) && $_POST['contextAvis'] === 'Couple' ? 'selected' : '' ?>>Couple</option>
                            <option value="Famille" <?= isset($_POST['contextAvis']) && $_POST['contextAvis'] === 'Famille' ? 'selected' : '' ?>>Famille</option>
                            <option value="Amis" <?= isset($_POST['contextAvis']) && $_POST['contextAvis'] === 'Amis' ? 'selected' : '' ?>>Amis</option>
                            <option value="Seul" <?= isset($_POST['contextAvis']) && $_POST['contextAvis'] === 'Seul' ? 'selected' : '' ?>>Seul</option>
                        </select>
                        <input type="submit" id="bouton_publier" value="Publier">
                        </form>
                    <?php
                }
                }else{ ?>
                <h3>Poster un avis :</h3>
                <div class="notes_avis">
                    <?php for($i = 1; $i<6; $i++):?>
                        <img src="../icons/etoile_bleue_vide.png" width="35px" height="35px"
                            id="etoile_note<?php echo $i; ?>">
                    <?php endfor;?>
                </div>
                <input type="hidden" id="nbr_etoile" name="nbr_etoile" value="<?php echo isset($_POST['etoile']) ? $_POST['etoile'] : ''; ?>">
                <textarea maxlength="30" type="text" name="titre_avis" id="titre_avis" placeholder="Titre de l'avis"
                    required="required"><?php echo isset($_POST['titreAvis']) ? $_POST['titreAvis'] : ''; ?></textarea>
                <textarea minlength="30" maxlength="255" type="text" name="zone_avis" id="ecrire_avis"
                    placeholder="Veuillez écrire dans cette zone pour pouvoir déposer un avis sur cette offre."><?php echo isset($_POST['contenuAvis']) ? $_POST['contenuAvis'] : ''; ?></textarea>
                <!--<input type="file" accept=".png, .jpeg, .svg, .webp" id="image_avis" name="image_avis">-->
                <label for="options" id="titre-contexte">Contexte de la visite :</label>
                    <select id="options-contexte" name="options">
                        <option value="Affaires" <?= isset($_POST['contextAvis']) && $_POST['contextAvis'] === 'Affaires' ? 'selected' : '' ?>>Affaires</option>
                        <option value="Couple" <?= isset($_POST['contextAvis']) && $_POST['contextAvis'] === 'Couple' ? 'selected' : '' ?>>Couple</option>
                        <option value="Famille" <?= isset($_POST['contextAvis']) && $_POST['contextAvis'] === 'Famille' ? 'selected' : '' ?>>Famille</option>
                        <option value="Amis" <?= isset($_POST['contextAvis']) && $_POST['contextAvis'] === 'Amis' ? 'selected' : '' ?>>Amis</option>
                        <option value="Seul" <?= isset($_POST['contextAvis']) && $_POST['contextAvis'] === 'Seul' ? 'selected' : '' ?>>Seul</option>
                    </select>

                    <button id="bouton_publier" type="button">
                        Valider
                    </button>
                <?php } ?>
            </article>
            <?php   } ?>
            
            <?php 
            $id_avis = 0;
            if ($nbrAvis > 0){
                foreach ($avis as $avisIndividuel): 
                $stmtCompte = $bdh->prepare("SELECT * FROM pact.membre WHERE idC = :idC");
                $stmtCompte->execute([':idC' => $avisIndividuel['idc']]);
                $compte = $stmtCompte->fetch(PDO::FETCH_ASSOC);      
                
                $stmtReponse = $bdh->prepare("SELECT * FROM pact._reponse WHERE idA = :idA");
                $stmtReponse->execute([':idA' => $avisIndividuel['ida']]);
                $reponse = $stmtReponse->fetch(PDO::FETCH_ASSOC);

                // Vérification avis deja signalé 

                // Vérifier si l'avis a déjà été signalé par l'utilisateur connecté
                /*$idAvis = $avisIndividuel['ida'];
                $idSignaleur = isset($_COOKIE['user']) ? (int)$_COOKIE['user'] : 0; // Récupérer l'utilisateur depuis le cookie

                $stmtSignal = $bdh->prepare("
                    SELECT COUNT(*) FROM pact._signal_avis 
                    WHERE idA = :idA AND idSignaleur = :idSignaleur
                ");
                $stmtSignal->execute([
                    ':idA' => $idAvis,
                    ':idSignaleur' => $idSignaleur
                ]);
                $alreadySignaled = $stmtSignal->fetchColumn() > 0;

                // Vérifier si une réponse  a déjà été signalé par l'utilisateur connecté
                $idAvis = $avisIndividuel['ida'];
                $idSignaleur = isset($_COOKIE['user']) ? (int)$_COOKIE['user'] : 0; // Récupérer l'utilisateur depuis le cookie

                $stmtSignal = $bdh->prepare("
                    SELECT COUNT(*) FROM pact._signal_reponse 
                    WHERE idA = :idA AND idSignaleur = :idSignaleur
                ");
                $stmtSignal->execute([
                    ':idA' => $idAvis,
                    ':idSignaleur' => $idSignaleur
                ]);
                $alreadySignaled = $stmtSignal->fetchColumn() > 0;
                */
                /*
                // Récupérer l'utilisateur depuis le cookie
                $idSignaleur = isset($_COOKIE['user']) ? (int)$_COOKIE['user'] : 0;

                // Vérification si l'avis a déjà été signalé
                $idAvis = $avisIndividuel['ida'];

                $stmtSignalAvis = $bdh->prepare("
                    SELECT COUNT(*) FROM pact._signal_avis 
                    WHERE idA = :idA AND idSignaleur = :idSignaleur
                ");
                $stmtSignalAvis->execute([
                    ':idA' => $idAvis,
                    ':idSignaleur' => $idSignaleur
                ]);
                $alreadySignaledAvis = $stmtSignalAvis->fetchColumn() > 0;

                // Vérification si une réponse liée à l'avis a déjà été signalée
                $stmtSignalReponse = $bdh->prepare("
                    SELECT COUNT(*) FROM pact._signal_reponse 
                    WHERE idA = :idA AND idSignaleur = :idSignaleur
                ");
                $stmtSignalReponse->execute([
                    ':idA' => $idAvis,
                    ':idSignaleur' => $idSignaleur
                ]);
                $alreadySignaledReponse = $stmtSignalReponse->fetchColumn() > 0;
                */
                /*
                // Récupération de l'ID de l'utilisateur (depuis les cookies)
                $idSignaleur = isset($_COOKIE['user']) ? (int)$_COOKIE['user'] : 0;

                // Récupération de l'ID de l'avis
                $idAvis = $avisIndividuel['ida'];

                // Vérification si l'avis a déjà été signalé
                $stmtSignalAvis = $bdh->prepare("
                    SELECT COUNT(*) FROM pact._signal_avis 
                    WHERE idA = :idA AND idSignaleur = :idSignaleur
                ");
                $stmtSignalAvis->execute([
                    ':idA' => $idAvis,
                    ':idSignaleur' => $idSignaleur
                ]);
                $alreadySignaledAvis = $stmtSignalAvis->fetchColumn() > 0;

                // Vérification si une réponse liée à l'avis a déjà été signalée
                $stmtSignalReponse = $bdh->prepare("
                    SELECT COUNT(*) FROM pact._signal_reponse 
                    WHERE idA = :idA AND idSignaleur = :idSignaleur
                ");
                $stmtSignalReponse->execute([
                    ':idA' => $idAvis,
                    ':idSignaleur' => $idSignaleur
                ]);
                $alreadySignaledReponse = $stmtSignalReponse->fetchColumn() > 0;

                // Déterminer l'état du bouton en fonction des résultats
                $buttonDisabled = $alreadySignaledAvis || $alreadySignaledReponse;
                $buttonStyle = $buttonDisabled ? 'cursor: not-allowed; opacity: 0.5;' : '';
                $buttonText = $alreadySignaledAvis ? 'Déjà signalé' : "Signaler l'avis";
                // Vérifier si l'utilisateur a signalé cet avis ou une de ses réponses
                */
                /*
                if ($alreadySignaledAvis) {
                    echo "L'avis a déjà été signalé par cet utilisateur.";
                } elseif ($alreadySignaledReponse) {
                    echo "Une réponse à cet avis a déjà été signalée par cet utilisateur.";
                } else {
                    echo "Cet utilisateur n'a pas encore signalé cet avis ou ses réponses.";
                }
                */

                ?> 
            <div class="alignement-conteneur-avis">
                <div class="header-avis-profil">
                    <div class="profil">
                        <img src="../images/1 2.png" alt="Photo de profil" width="40px" height="40px">
                        <div class="titre-contexte">
                            <div class="titre-date">
                                <h4>
                                    <?php echo htmlspecialchars($avisIndividuel['titre_avis']); ?>
                                </h4>
                                <p><?php echo htmlspecialchars($avisIndividuel['date_visite']); ?></p>
                            </div>
                            <div class="pseudo-contexte">
                                <?php if($avisIndividuel['pseudo'] == 'Anonyme') { ?>
                                    <p style="font-style: italic" class="ligne_sepa_contexte">
                                        <?php echo htmlspecialchars($avisIndividuel['pseudo']); ?>
                                    </p>
                                <?php } else { ?>
                                    <p class="ligne_sepa_contexte">
                                        <?php echo htmlspecialchars($avisIndividuel['pseudo']); ?>
                                    </p>
                                <?php } ?>
                                <p><?php echo htmlspecialchars($avisIndividuel['contexte']); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="etoile-avis-detail-offre">
                        <?php
                        $full = (int) $avisIndividuel['note'];
                        $empty = 5 - $full;
                        for ($i = 0; $i < $full; $i++): ?>
                        <img src="../icons/<?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'etoile_rouge' : 'etoile_bleue'; ?>.png"
                            width="20px" height="20px" alt="Étoile">
                        <?php endfor; ?>
                        <?php for ($i = 0; $i < $empty; $i++): ?>
                        <img src="../icons/<?php echo ($_COOKIE['type_compte'] ?? '') === 'pro_public' || ($_COOKIE['type_compte'] ?? '') === 'pro_prive' ? 'etoile_rouge_vide' : 'etoile_bleue_vide'; ?>.png"
                            width="20px" height="20px" alt="Étoile Vide">
                        <?php endfor;
                        ?>
                    </div>
                </div>
                <?php  if (isset($_COOKIE['type_compte']) && ($_COOKIE['type_compte'] == "pro_public" || $_COOKIE['type_compte'] == "pro_prive") && $offre['idc'] == $_COOKIE['user']) { 
                    if (!isset($reponse['ida'])) { ?>
                        <div class="commentaire-consulte exergue">
                            <p>
                                <?php echo nl2br(htmlspecialchars($avisIndividuel['corps'])); ?>
                            </p>
                        </div>
                    <?php } else { ?>
                        <div class="commentaire-consulte">
                            <p>
                                <?php echo nl2br(htmlspecialchars($avisIndividuel['corps'])); ?>
                            </p>
                        </div>
                    <?php } 
                }else{
                    ?>
                        <div class="commentaire-consulte">
                            <p>
                                <?php echo nl2br(htmlspecialchars($avisIndividuel['corps'])); ?>
                            </p>
                        </div>
                    <?php
                } ?>

                <?php
                if(isset($_COOKIE['user']) && $avisIndividuel['idc'] == $_COOKIE['user']){
                    ?>
                    <form method="POST" action="detail-offre.php?value=<?php echo $idAnnonce; ?>" class="form-supp">
                        <input type="hidden" name="type_form" value="supp-avis">
                        <input type="hidden" name="id_avis" value=<?php echo $avisIndividuel['ida']; ?>>
                        <input type="button" name="bouton_supp" class="bouton-supp" value="Supprimer l'avis">
                    </form>
                    <hr>
                    <?php
                }

                ?><div class="signaler-like"><?php
                
                if (isset($_COOKIE['type_compte']) && ($_COOKIE['type_compte'] == "membre" || $_COOKIE['type_compte'] == "pro_public" || $_COOKIE['type_compte'] == "pro_prive") && $avisIndividuel['idc'] != $_COOKIE['user']) : ?>
                        <button type="button"
                            class="btn-signaler"
                            id="btn_signaler_avis_<?php echo $_COOKIE['user']; ?>_<?php echo $avisIndividuel['ida']; ?>">
                            <img src="../icons/warningred.png" alt="Icône signaler" id="icone-signaler">
                            <p>Signaler l'avis</p>
                        </button>
                        <?php
                        if($_COOKIE['type_compte'] == "pro_prive" && $offre['type']==3){
                            ?>
                            <div class="blacklist">
                                <button type="button" class="btn-blacklist">
                                    <img src="../icons/blacklist.png" alt="Icône Blacklist" id="icone-blacklist">
                                    <p>Blacklister l'avis</p>
                                </button>
                                <div class="blacklist-content">
                                    <button type="button" class="btn-blacklist-irr"
                                    id="btn_blacklist_<?php echo $_COOKIE['user'] ?>_<?php echo $avisIndividuel['ida'] ?>"
                                    >Blacklister</button>
                                    <button type="button" 
                                    id="btn_blacklist_<?php echo $_COOKIE['user'] ?>_<?php echo $avisIndividuel['ida'] ?>"
                                    class="btn-blacklist-rev">Blacklister temporairement</button>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                
                <?php endif;

                if(isset($_COOKIE['type_compte']) && $_COOKIE['type_compte'] == "membre" && $avisIndividuel['idc'] != $_COOKIE['user']){
                ?><div class="like-dislike">
                <?php 
                        $stmt = $dbh->prepare("SELECT nbr_likes, nbr_dislikes FROM pact.avis WHERE idA = :idAvis");
                        $stmt->execute([':idAvis'=>$avisIndividuel['ida']]);
                        $like_dislike = $stmt->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <img id="likeButton_<?php echo $_COOKIE['user']?>_<?php echo $avisIndividuel['ida']?>" class="LikeButton" src="../icons/like-plein.png" alt="Like" width="20" height="20" style="cursor: pointer;">
                        <span id="likesCount_<?php echo $avisIndividuel['ida']?>"><?php
                        echo $like_dislike['nbr_likes'];
                        ?></span>
                        <img id="dislikeButton_<?php echo $_COOKIE['user']?>_<?php echo $avisIndividuel['ida']?>" class="DislikeButton" src="../icons/dislike-plein.png" alt="Dislike" width="20" height="20" style="cursor: pointer;">
                        <span id="dislikesCount_<?php echo $avisIndividuel['ida']?>"><?php
                        echo $like_dislike['nbr_dislikes'];
                        ?></span>
                </div>
                <?php }?>
                </div>
                <?php

                if (isset($_COOKIE['type_compte'], $_COOKIE['user'])) {
                    if (($_COOKIE['type_compte'] == "pro_public" || $_COOKIE['type_compte'] == "pro_prive") && $offre['idc'] == $_COOKIE['user']) {
                        
                        
                        
                        if (isset($reponse['ida'])) { ?>
                            <div class="commentaire-reponse">
                                <p><?php
                                echo nl2br(htmlspecialchars($reponse['corps'])) ?>
                                </p>
                            </div>
                        <?php 
                        if (isset($_COOKIE['type_compte']) && ($_COOKIE['type_compte'] == "membre" || $_COOKIE['type_compte'] == "pro_public" || $_COOKIE['type_compte'] == "pro_prive") && $avisIndividuel['idc'] != $_COOKIE['user']) : ?>
                            <button type="button" 
                                class="btn-signaler"
                                id="btn_signaler_reponse_<?php echo $_COOKIE['user'] ?>_<?php echo $avisIndividuel['ida'] ?>"
                                style="margin-left : 30px;">
                                <img src="../icons/warningred.png" alt="Icône signaler" id="icone-signaler">
                                <p>Signaler réponse</p>
                            </button>
                        
                        <?php endif;
                        
                        } else { ?>
                            <button type="button" onclick="toggle_reponse(<?php echo $id_avis ?>);" id="btn-reponse">Ajouter une réponse</button>
                            <form method="POST" action="detail-offre.php?value=<?php $offre['ido']?>" class="zone-btn-publier form_reponse" id="form_reponse" style="display: none">
                                <input type="hidden" name="type_form" value="poste-reponse">
                                <input type="hidden" name="avis" value=<?php echo $avisIndividuel['ida']?>>
                                <input type="hidden" name="ido" value=<?php echo $avisIndividuel['ido']?>>
                                <textarea minlength="30" maxlength="255" type="text" name="zone_reponse" id="ecrire_reponse" placeholder="Veuillez écrire dans cette zone pour pouvoir déposer une réponse sur cette avis."></textarea>
                                <input type="submit" id="bouton_publier" value="Publier">
                            </form>
                            <?php
                        }
                    }
                }
                ?>
            </div>
            <?php
            $id_avis++;
            endforeach; }?>
        </article>
    </section>
    <div id="popup">
        <p>Votre signalement a bien été pris en compte.</p>
        <div class="progress-bar">
            <div></div>
        </div>
        <button class="close-btn">Fermer</button>
    </div>
    <div id="overlay"></div>
    <?php if(!isset($_COOKIE['user'])){?>
        
        <div id="popup_avis">
            
            <img id="logo" src="../logo/logo_reduit_vert.png">
            <div id="group">
                <div id="text">
                    <p id="debut">Vous souhaitez faire part de votre avis ?</p><p id="fin"> Connectez-vous</p>

                </div>
                <form id="formConnexion" action="detail-offre.php?value=<?php echo $offre['ido']?>" method="post">

                    <div class="form-group">
                        <!--Identifiant correspond au pseudo ou codePro, pas à l'idC-->
                        <label for="identifiant">Identifiant compte</label>
                        <input id="identifiant" name="identifiant" placeholder="Identifiant" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                    </div>

                    <input type="hidden" id="etoile" name="etoile">
                    <input type="hidden" id="titreAvis" name="titreAvis">
                    <input type="hidden" id="contenuAvis" name="contenuAvis">
                    <input type="hidden" id="contextAvis" name="contextAvis">

                    <button type="submit" id="connexion_popup" class="submit-button">Se connecter</button>

                    <div class="links">
                        <!--<a href="#" class="mdpOublie">Mot de passe oublié ?</a>-->
                        <a href="creation_compte_formulaire.php" class="inscription">S'inscrire</a>
                    </div>

                </form>
            </div>
            <img id="croix" src="../images/croix.png" alt="" class="close-popup">
        </div>
    <?php } ?>
    <div class="modal" id="modal" style="display: none;">
        <input type="hidden" name="status" value="" id="modal-id">
        <div id='option-modal'>
            <h2 class="titre-modal">Blacklist Options</h2>
            <div>
                <label for="semaine">Nombre de semaine(s) : </label>
                <input id="semaine" type="number" value="1" min="1"/>
                <br>
                <p id="warning-semaine" name="warning-semaine" style="color: red;">Saisir un nombre valide</p>
            </div>
            <div id="boutons-modal">
                <input type="button" class="btn-notif" id="modal-submit-button" value="Valider"/>
                <input type="button" class="btn-notif" id="modal-close" value="Annuler">
            </div>
        </div>
    </div>

    <div class="modal" id="modal-warning" style="display: none;">
        <h2 class="titre-modal">Êtes vous sûr?</h2>
        <div id="boutons-modal">
            <input type="button" class="btn-notif" id="modal-warning-submit-button" value="Valider"/>
            <input type="button" class="btn-notif" id="modal-warning-close" value="Annuler">
        </div>
    </div>

    <footer class="phone-element">
        <?php include_once 'footerNav.php'; ?>
    </footer>
    </div>
    <footer>
        <?php include_once 'footer.php'; ?>
    </footer>
    
    <script src="../js/detail_offre.js"></script>
</body>

</html>