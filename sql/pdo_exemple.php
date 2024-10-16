<?php
include('connect_params_perso.php');
try{
    $dbh = new PDO("$driver:host=$server;dbname=$dbname",
        $user, $pass);

    $stmt = $dbh->prepare(
        "INSERT INTO pact.secteur_public(codePro, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) 
        VALUES(:codePro, :nom, :prenom, :email, :telephone, :mdp, :ville, :lieu, :code_postal)"
    );
    $stmt->bindParam(":codePro", $codePro);
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":prenom", $prenom);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":telephone", $telephone);
    $stmt->bindParam(":mdp", $mdp);
    $stmt->bindParam(":ville", $ville);
    $stmt->bindParam(":lieu", $lieu);
    $stmt->bindParam(":code_postal", $code_postal);

    $codePro = '5001';
    $nom = "TOE";
    $prenom = "PAOLO";
    $email = "pp.tttoe@etudian";
    $telephone = "0145421011";
    $mdp = "neLi1P4smonM01Depass"; 
    $ville = "Loguivy";
    $lieu = "4 place du lac";
    $code_postal = "22780";
    
    $stmt->execute();

    $codePro = '6001';
    $nom = "Bob";
    $prenom = "Bobbie";
    $email = "Bob.bobbie@et";
    $telephone = "0145421011";
    $mdp = "neLi1P4smonM01Depass"; 
    $ville = "Ballzac";
    $lieu = "4 place du ball";
    $code_postal = "22880";
    
    $stmt->execute();
    $dbh = null;
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>
