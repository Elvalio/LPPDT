<?php 
include('../sql/connect_params.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Paramètres de Compte</title>
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <link rel="stylesheet" href="../css/styleEthan.css">
</head>
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
            <?php 
                include_once'nav.php'; 
            ?>
            </nav>
            <header class="phone-element">
            <!-- <?php
                include 'header.php';
            ?> -->
            </header>

    <div class="content">
        <h1 class="TS titre">Paramètres De Compte</h1>
    
        <div class="profile">
            <img src="../images/image 4.png" alt="Logo déconnecter" class="logo-nav" id="pfp" height="10%" width="10%">
            <div>
                <h2>Michael Smith</h2>
                <p>Membre</p>
            </div>
        </div>

        <form class="main-container" action="infoCompte.php">
            <div class="container-ligne">
                <div class="container-info">
                    <label>Prénom</label>
                    <input type="text" value="Michael">
                </div>
                <div class="container-info">
                    <label>Nom</label>
                    <input type="text" value="Smith">
                </div>
            </div>
            <hr>
            <br><br>
            <div class="container-ligne">
                <div class="container-info">
                    <label>Téléphone</label>
                    <input type="text" value="08 49 37 56 15">
                </div>
                <div class="container-info">
                    <label>Adresse Postale</label>
                    <input type="text" value="3 Rue Des Loutres">
                </div>
            </div>
            <br><br>
            <div class="container-ligne">
                <div class="container-info">
                    <label>Code Postal</label>
                    <input type="text" value="22700">
                </div>
                <div class="container-info">
                    <label>Ville</label>
                    <input type="text" value="Perros-Guirec">
                </div>
            </div>
            <?php if ($_COOKIE['type_compte'] == "pro_public") { ?>
            <hr>
            <br><br>
            <div class="container-ligne">
                <div class="container-info">
                    <label>Raison sociale</label>
                    <input type="text" value="Les voyages de Marco Polo">
                </div>
            </div>
            <?php } ?>
            <?php if ($_COOKIE['type_compte'] == "pro_prive") { ?>
            <hr>
            <br><br>
            <div class="container-ligne">
                <div class="container-info">
                    <label>Dénomination sociale</label>
                    <input type="text" value="Les voyages de Marco Polo">
                </div>
                <div class="container-info">
                    <label>Numéro SIRET</label>
                    <input type="text" value="12345678912345">
                </div>
            </div>
            <?php } ?>
            <button class="edit-btn">Modifier les informations bancaires</button>
            <br><br>
            <div class="container-ligne">
                <div class="container-info">
                    <label>Entrer le mot de passe</label>
                    <input type="password" value="skjosdkkvd">
                </div>
            </div>
            <div class="container-ligne">
                <button type="submit" class="edit-btn">Enregistrer les modifications</button>
                <button type="reset" class="cancel-btn">Annuler les modifications</button>
            </div>
        </form>
    </div>
</body>
</html>
