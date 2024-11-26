<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mon Compte</title>
        <link rel="stylesheet" href="../css/detail-compte.css">
        <link rel="stylesheet" href="../css/styleGeneral.css">
    </head>
    <body>
        <?php
        include_once 'nav.php';

        include('../sql/connect_params.php');


        $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);

        $user_cookie = $_COOKIE['user'];


        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['id_avis'])){
                try{
                    $stmt = $dbh->prepare("DELETE FROM pact.avis WHERE idA = :ida");
                    $stmt->bindParam(':ida', $_POST['id_avis']);
                    $stmt->execute();
                }catch(PDOException $e){
                    print "Erreur !: " . $e->getMessage() . "<br/>";
                    die();
                }
            }
        }
    
        try{

        
        $stmt=$dbh->prepare("SELECT * FROM pact.experience WHERE idC = :id_user");
        $stmt->bindParam(':id_user', $user_cookie);
        $stmt->execute();
    
        $avis = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }

        $dbh = null;
        ?>

        <div class="main-content">
            <h1>
                Paramètres de compte
            </h1>
            <div>
                <img src="../images/59.png" width="5%" heigth="5%">
                <div>
                    <p>ElDiablo</p>
                    <button>Voir mes avis</button>
                </div>
            </div>
            <!--<section class="detail-compte-donnees">
                <article class="ligne-info">
                    <div>
                        <p>Prénom</p>
                        <textarea placeholder=""></textarea>
                    </div>
                    <div>
                        <p>Nom</p>
                        <textarea placeholder=""></textarea>
                    </div>
                </article>
                <article class="ligne-info">
                    <div>
                        <p>Téléphone</p>
                        <textarea placeholder=""></textarea>
                    </div>
                    <div>
                        <p>Adresse</p>
                        <textarea placeholder=""></textarea>
                    </div>
                </article>
                <article class="ligne-info">
                    <div>
                        <p>Code Postal</p>
                        <textarea placeholder=""></textarea>
                    </div>
                    <div>
                        <p>Ville</p>
                        <textarea placeholder=""></textarea>
                    </div>
                </article>
                <button id="modif-infos">Modifier les informations</button>
            </section>-->
            <section class="mes-avis">
            <h2>Mes avis</h2>
                <?php
                foreach($avis as $a) { 
                ?>
                <article class="avis">
                    <?php


                    $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);

                    try{


                        $stmt=$dbh->prepare("SELECT * FROM pact.offre WHERE idO = :id_offre");
                        $stmt->bindParam(':id_offre', $a['ido']);
                        $stmt->execute();
                
                        $offre = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                    } catch (PDOException $e) {
                        print "Erreur !: " . $e->getMessage() . "<br/>";
                        die();
                    }

                    $dbh = null;


                    $fullstar = $a['note'];
                    $emptystar = 5-$a['note'];
                    ?>
                    
                    <h3 id="titre-offre"><?php echo $offre['titre']?></h3>
                    <p id="adresse-offre"><?php echo $offre['numero_voie']?> <?php echo $offre['voie']?>, <?php echo $offre['code_postal']?> </p>
                    <div class="note-date-publi">
                        <?php for($i=0; $i<$fullstar;$i++){?>
                            <img src="../icons/etoile_bleue.png" width="20px" height="20px">
                        <?php } ?>
                        <?php for($i=0; $i<$emptystar;$i++){?>
                            <img src="../icons/etoile_bleue_vide.png" width="20px" height="20px">
                        <?php } ?>
                        <p id="date-publi"><?php echo $a['date_publication']?></p>
                    </div>
                    <p id="commentaire"><?php echo $a['corps']?></p>
                    <form method="POST" action="detail-compte.php">
                        <input type="hidden" name="id_avis" value=<?php echo $a['ida']; ?>>
                        <input type="submit" name="bouton_supp" value="Supprimer l'avis">
                    </form>
                </article>
                <?php
                } ?>
            </section>
        </div>
    </body>
</html>