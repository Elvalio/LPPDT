<?php

include_once'nav.php';


?>
<head>
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <link rel="stylesheet" href="../css/accueilBO.css">
    <script src="../js/accueil.js"></script>
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
                        <p>Search</p>
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
                        <p>Search</p>
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
                <div class="filter"></div>
                <div class="filter"></div>
                <div class="filter"></div>
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