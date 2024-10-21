<?php

include_once'nav.php';


?>
<head>
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <link rel="stylesheet" href="../css/accueilBO.css">
    <script src="../js/accueil.js"></script>
    <script>
    window.addEventListener("resize", getTemplate);

    function getTemplate() {
        const screenWidth = window.innerWidth;  // Utilisez window.innerWidth au lieu de screen.width
        if (screenWidth >= 800) {
            // Si l'écran est large et que vous êtes sur la page mobile, redirigez vers la page desktop
            if (window.location.pathname.includes("listeOffre.php")) {
                window.location.replace("accueil.php");
            }
        } else {
            // Si l'écran est étroit et que vous êtes sur la page desktop, redirigez vers la page mobile
            if (!window.location.pathname.includes("listeOffre.php")) {
                window.location.replace("listeOffre.php");
            }
        }
    }

    getTemplate();  // Vérifiez la taille de l'écran lors du chargement initial
    </script>

</head>

<html>
    <body>
        <div class="main-content">
            <!-- Contenu principal de la page -->
            <header>
                <h1>Accueil</h1>
            </header>
            <nav>
                <div class="nav_space">
                    <div class="search">
                        <input type="text" name="search" id="search" placeholder="Search">
                        <img src="../images/search_icon.png" alt="Search" title="Search">
                    </div>

                    <div class="filtrer-trier"> 
                        <div class="filtrer-bouton NoSelect">
                            <p>Filtrer par</p>
                            <img src="../images/fleche.png" alt="Fleche" title="Fleche">
                        </div>

                        <div class="dropdown NoSelect">
                            <div class="dropdown-toggle trier">
                                <p>Trier par</p>
                                <img src="../images/fleche.png" alt="Fleche" title="Fleche">
                            </div>
                            <ul class="dropdown-menu">
                                <li><a href="#0">Prix croissant</a></li>
                                <li><a href="#0">Prix décroissant</a></li>
                                <li><a href="#0">Notes croissantes</a></li>
                                <li><a href="#0">Notes décroissantes</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="NouveauALaUne">
                    <div class="boutonNouveau NoSelect">
                        <p>Nouveau</p>
                        <img src="../images/croix.png" alt="croix" title="croix">
                    </div>
                    <div class="boutonALaUne NoSelect">
                        <p>A la une</p>
                        <img src="../images/croix.png" alt="croix" title="croix">
                    </div>
                </div>
            </nav>

            <div class="all-filter">
                <div class="filter filtre-type">
                    <div class="filtre-case">
                        <input type="checkbox" id="visite" name="visite" />
                        <label for="visite">Visite</label>
                    </div>
                    <div class="filtre-case">
                        <input type="checkbox" id="spectacle" name="spectacle" />
                        <label for="spectacle">Spectacle</label>
                    </div>
                    <div class="filtre-case">
                        <input type="checkbox" id="Pattractions" name="Pattractions" />
                        <label for="Pattractions">Parc d'attractions</label>
                    </div>
                    <div class="filtre-case">
                        <input type="checkbox" id="restauration" name="restauration" />
                        <label for="restauration">Restauration</label>
                    </div>
                </div>
                <div class="filter filtre-lieu">
                    <div class="search-filter">
                        <input type="text" name="search" id="search" placeholder="Search">
                        <img src="../images/search_icon.png" alt="Search" title="Search">
                    </div>
                    <div class="filtre-case">
                        <input type="checkbox" id="sb" name="sb" />
                        <label for="sb">Saint-Brieuc</label>
                    </div>
                    <div class="filtre-case">
                        <input type="checkbox" id="lannion" name="lannion" />
                        <label for="lannion">Lannion</label>
                    </div>
                    <div class="filtre-case">
                        <input type="checkbox" id="plérin" name="plérin" />
                        <label for="plérin">Plérin</label>
                    </div>
                </div>
                <div class="filter filtre-temps">
                    <div id="calendar-start">
                        <label for="calendar-start">
                            Date de début
                        </label>
                        <input type="date" name="date-start" id="date-start">
                    </div>
                    
                    <div id="calendar-end">
                        <label for="calendar-end">
                            Date de Fin
                        </label>
                        <input type="date" name="date-end" id="date-end">
                    </div>
                </div>
                <div class="filter filtre-prix">
                    <div class="slider-container">
                        <input type="range" id="slider-left" min="0" max="1000" value="0" step="10">
                        <input type="range" id="slider-right" min="0" max="1000" value="1000" step="10">
                        <div class="value-container">
                            <span id="value-left">0€</span>
                            <span id="value-right">1000€</span>
                        </div>
                    </div>
                    <button type="submit" id="valider-prix" class="NoSelect">Valider</button>
                </div>
                <div class="filter filtre-note">
                    <div class="note">
                        <input type="checkbox" id="lannion" name="lannion" />
                        <div class="etoileNoteFiltre">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                        </div>
                    </div>

                    <div class="note">
                        <input type="checkbox" id="lannion" name="lannion" />
                        <div class="etoileNoteFiltre">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile_vide.png" alt="Etoile Vide" title="Etoile Vide">
                        </div>
                    </div>

                    <div class="note">
                        <input type="checkbox" id="lannion" name="lannion" />
                        <div class="etoileNoteFiltre">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile_vide.png" alt="Etoile Vide" title="Etoile Vide">
                            <img src="../images/etoile_vide.png" alt="Etoile Vide" title="Etoile Vide">
                        </div>
                    </div>

                    <div class="note">
                        <input type="checkbox" id="lannion" name="lannion" />
                        <div class="etoileNoteFiltre">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile_vide.png" alt="Etoile Vide" title="Etoile Vide">
                            <img src="../images/etoile_vide.png" alt="Etoile Vide" title="Etoile Vide">
                            <img src="../images/etoile_vide.png" alt="Etoile Vide" title="Etoile Vide">
                        </div>
                    </div>

                    <div class="note">
                        <input type="checkbox" id="lannion" name="lannion" />
                        <div class="etoileNoteFiltre">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile_vide.png" alt="Etoile Vide" title="Etoile Vide">
                            <img src="../images/etoile_vide.png" alt="Etoile Vide" title="Etoile Vide">
                            <img src="../images/etoile_vide.png" alt="Etoile Vide" title="Etoile Vide">
                            <img src="../images/etoile_vide.png" alt="Etoile Vide" title="Etoile Vide">
                        </div>
                    </div>
                </div>
            </div>

            <main>

                <div class="carte_offre">

                    <img src="../images/offre.webp" alt="Photo offre" title="Photo offre">
                    <p class="titreAnnonce">Ibis Hotel Lannion</p>
                    
                    <div class="infoAnnonce">
                        <p>79€</p>
                    
                        <div class="etoileNote">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile_vide.png" alt="Etoile Vide" title="Etoile Vide">
        
                        </div>
                    </div>
                </div>



                <div class="carte_offre">

                    <img src="../images/offre.webp" alt="Photo offre" title="Photo offre">
                    <p class="titreAnnonce">Ibis Hotel Lannion</p>
                    
                    <div class="infoAnnonce">
                        <p>79€</p>
                    
                        <div class="etoileNote">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile_vide.png" alt="Etoile Vide" title="Etoile Vide">
                    
                        </div>
                    </div>
                </div>



                <div class="carte_offre">

                    <img src="../images/offre.webp" alt="Photo offre" title="Photo offre">
                    <p class="titreAnnonce">Ibis Hotel Lannion</p>
                    
                    <div class="infoAnnonce">
                        <p>79€</p>
                    
                        <div class="etoileNote">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile_vide.png" alt="Etoile Vide" title="Etoile Vide">
                    
                        </div>
                    </div>
                </div>

                <div class="carte_offre">

                    <img src="../images/offre.webp" alt="Photo offre" title="Photo offre">
                    <p class="titreAnnonce">Ibis Hotel Lannion</p>
                    
                    <div class="infoAnnonce">
                        <p>79€</p>
                    
                        <div class="etoileNote">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile_vide.png" alt="Etoile Vide" title="Etoile Vide">
                    
                        </div>
                    </div>
                </div>

                <div class="carte_offre">

                    <img src="../images/offre.webp" alt="Photo offre" title="Photo offre">
                    <p class="titreAnnonce">Ibis Hotel Lannion</p>
                    
                    <div class="infoAnnonce">
                        <p>79€</p>
                    
                        <div class="etoileNote">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile_vide.png" alt="Etoile Vide" title="Etoile Vide">
                    
                        </div>
                    </div>
                </div>

                <div class="carte_offre">

                    <img src="../images/offre.webp" alt="Photo offre" title="Photo offre">
                    <p class="titreAnnonce">Ibis Hotel Lannion</p>
                    
                    <div class="infoAnnonce">
                        <p>79€</p>
                    
                        <div class="etoileNote">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile_vide.png" alt="Etoile Vide" title="Etoile Vide">
                    
                        </div>
                    </div>
                </div>

                <div class="carte_offre">

                    <img src="../images/offre.webp" alt="Photo offre" title="Photo offre">
                    <p class="titreAnnonce">Ibis Hotel Lannion</p>
                    
                    <div class="infoAnnonce">
                        <p>79€</p>
                    
                        <div class="etoileNote">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile.png" alt="Etoile" title="Etoile">
                            <img src="../images/etoile_vide.png" alt="Etoile Vide" title="Etoile Vide">
                    
                        </div>
                    </div>
                </div>

            </main>
        </div>

    </body>
</html>