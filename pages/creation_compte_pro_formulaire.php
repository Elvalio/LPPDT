<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <link rel="stylesheet" href="../css/creation_compte.css">
    <script src="../js/creation_compte_pro.js" defer></script>
</head>

<body>
    <!-- Bouton de retour -->
    <a href="connexion.php" style="text-decoration: none;">
        <div class="bouton-retour-page-création">
            <button class="FS">
                <img src="../icons/arrow-left-o.svg" alt="Bouton Image" width="15" height="15"> Retour
            </button>
        </div>
    </a>

    <!-- Liens de navigation pour choisir le formulaire -->
    <div class="container-page-creation-compte">
        <div class="menu-links">
            <div class="inscription-pro-prive TS-bold" id="link-pro-privee">
                Inscription professionnelle privée
            </div>
            <div class="inscription-pro-public TS-bold" id="link-pro-public">
                Inscription professionnelle publique
            </div>
        </div>

        <?php error_reporting(0); if (empty($_POST)) { ?>
        <!-- Formulaire pour l'inscription professionnelle publique -->
        <div class="form-container-page-creation-compte" id="form-pro-public">
            <form name="publique" action="creation_compte_formulaire.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" value="pro_public">
                <div class="form-group">
                    <div class="left-column">
                        <label for="nom" class="FS">Nom<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="Polo" id="nom-pro" name="nom" required>
                        
                        <label for="prenom" class="FS">Prénom<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="Marco" id="prenom-pro" name="prenom" required>

                        <label for="denomination-sociale-pro" class="FS">Dénomination Sociale<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="Les voyages de Marco Polo" id="denomination-sociale-pro" name="denomination" required>

                        <label for="email" class="FS">E-mail<span class="required">*</span></label>
                        <input type="email" class="FS" placeholder="marco.polo@gmail.com" id="email-pro" name="email" required>

                        <div class="checkbox">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms" class="FS">Accepter les conditions générales d'utilisations de PACT<span class="required">*</span></label>
                        </div>

                    </div>

                    <div class="right-column">
                        <label for="telephone" class="FS">Téléphone<span class="required">*</span></label>
                        <input type="tel" class="FS" placeholder="0637816458" id="telephone-pro" name="telephone" required> 

                        <label for="adresse" class="FS">Adresse postale<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="5 rue de la gare" id="adresse-pro" name="adresse" required>
                        
                        <div class="row">
                            <div class="input-wrapper">
                                <label for="codepostal" class="FS">Code postal<span class="required">*</span></label>
                                <input type="text" class="FS" placeholder="22300" id="codepostal-pro" name="codepostal" required>
                            </div>

                            <div class="input-wrapper">
                                <label for="ville" class="FS">Ville<span class="required">*</span></label>
                                <input type="text" class="FS" placeholder="Lannion" id="ville-pro" name="ville" required>
                            </div>
                        </div>

                        <label for="password" class="FS">Mot de passe<span class="required">*</span></label>
                        <input type="password" class="FS" placeholder="Entrez votre mot de passe" id="password-pro" name="password" required>

                        <label for="confirm_password" class="FS">Confirmer le Mot de passe<span class="required">*</span></label>
                        <input type="password" class="FS" placeholder="Confirmez votre mot de passe" id="confirm_password-pro" name="confirm_password" required>

                        
                    </div>
                </div>

                <button type="submit" class="bouton-envoi-formulaire-crea-compte-page-pro TS-bold">S'inscrire</button>
            </form>

            <a href="connexion.php" style="text-decoration: none;">
                <div class="login">
                    <button type="button" class="connexion-page-pro TS-bold">Déjà inscrit ? Connectez-vous.</button>
                </div>
            </a>
        </div>

        <!-- Formulaire pour l'inscription professionnelle privée -->
        <div class="form-container-page-creation-compte" id="form-pro-privee">
            <form name="privee" action="creation_compte_formulaire.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" value="pro_prive">
                <div class="form-group">
                    <div class="left-column">
                        <label for="nom" class="FS">Nom<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="Polo" id="nom-pro" name="nom" required>
                        
                        <label for="prenom" class="FS">Prénom<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="Marco" id="prenom-pro" name="prenom" required>

                        <label for="denomination-sociale-pro" class="FS">Dénomination Sociale<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="Les voyages de Marco Polo" id="denomination-sociale-pro" name="denomination" required>

                        <label for="raison-sociale-pro" class="FS">Raison Sociale<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="Les grandes aventures de Marco Polo" id="raison-sociale-pro" name="raison" required>

                        <label for="email" class="FS">E-mail<span class="required">*</span></label>
                        <input type="email" placeholder="marco.polo@gmail.com" id="email-pro" name="email" required>
                        
                        <label for="num_SIREN" class="FS">Numéro de SIREN<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="ex : 362 521 879" id="num_SIREN-pro" name="num_SIREN" required>

                        <div class="spacer"></div>

                        <label for="iban" class="FS">IBAN :</label>
                        <input type="text" id="iban" name="iban" placeholder="FRXX XXXX XXXX XXXX XXXX XXXX XXX" required>

                    </div>

                    <div class="right-column">
                        <label for="telephone-pro" class="FS">Téléphone<span class="required">*</span></label>
                        <input type="tel" class="FS" placeholder="0637816458" id="telephone-pro" name="telephone" required>

                        <label for="adresse" class="FS">Adresse postale<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="5 rue de la gare" id="adresse-pro" name="adresse" required>

                        <div class="row">
                            <div class="input-wrapper">
                                <label for="codepostal" class="FS">Code postal<span class="required">*</span></label>
                                <input type="text" class="FS" placeholder="22300" id="codepostal-pro" name="codepostal" required>
                            </div>

                            <div class="input-wrapper">
                                <label for="ville" class="FS">Ville<span class="required">*</span></label>
                                <input type="text" class="FS" placeholder="Lannion" id="ville-pro" name="ville" required>
                            </div>
                        </div>

                        <label for="password" class="FS">Mot de passe<span class="required">*</span></label>
                        <input type="password" class="FS" placeholder="Entrez votre mot de passe" id="password-pro" name="password" required>

                        <label for="confirm_password" class="FS">Confirmer le Mot de passe<span class="required">*</span></label>
                        <input type="password" class="FS" placeholder="Confirmer votre mot de passe" id="confirm_password-pro" name="confirm_password" required>



                        <div class="spacer-privee"></div>                        
                        
                    
                        <label for="bic" class="FS">BIC :</label>
                        <input type="text" id="bic" name="bic" placeholder="ABCDFRPPXXX" required>

                        <div class="form-info">
                            <p class="FS">Cette étape n'est pas obligatoire pour poursuivre. Vous pourrez les ajouter ou modifier ultérieurement dans votre espace personnel.</p>
                        </div>

                        
                    </div>
                </div>
                <div class="checkbox">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms" class="FS">Accepter les conditions générales d'utilisations de PACT<span class="required">*</span></label>
                </div>

                <button type="submit" class="bouton-envoi-formulaire-crea-compte-page-pro TS-bold">S'inscrire</button>
            </form>
            
            <a href="connexion.php" style="text-decoration: none;">
                <div class="login">
                    <button type="button" class="connexion-page-pro TS-bold">Déjà inscrit ? Connectez-vous.</button>
                </div>
            </a>
        </div>
    </div>

    <?php } else { ?>

        <?php

        include("../sql/connect_params.php");

        $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);

        if($_POST["type"]=="membre"){

            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $pseudo = $_POST["pseudo"];
            $email = $_POST["email"];
            $telephone = $_POST["telephone"];
            $code_postal = $_POST["codepostal"];
            $ville = $_POST["ville"];
            $temp = explode(" ",$_POST["adresse"]);     //On explode l'adresse
            $num_adresse = $temp[0];                    //On récupère le numéro de la voie qui sera toujours la premier valeur
            array_shift($temp);                         //On supprime le numéro de la voie
            $adresse = implode(" ", $temp);             //On implode le reste de l'adresse (combine un array en string)
            $mdp = $_POST["password"];

            $stmt = $dbh->prepare("INSERT INTO pact.membre(pseudo, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) VALUES ('$pseudo', '$nom', '$prenom', '$email', $telephone, '$mdp', '$ville', $num_adresse, '$adresse', $code_postal, '')");



        } else if($_POST["type"]=="pro_public"){


            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $denomination = $_POST["denomination"];
            $email = $_POST["email"];
            $telephone = $_POST["telephone"];
            $code_postal = $_POST["codepostal"];
            $ville = $_POST["ville"];
            $temp = explode(" ",$_POST["adresse"]);     //On explode l'adresse
            $num_adresse = $temp[0];                    //On récupère le numéro de la voie qui sera toujours la premier valeur
            array_shift($temp);                         //On supprime le numéro de la voie
            $adresse = implode(" ", $temp);             //On implode le reste de l'adresse (combine un array en string)
            $mdp = $_POST["password"];
            $codePro = time();

            $stmt = $dbh->prepare("INSERT INTO pact.secteur_public(codePro, denomination_sociale, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) VALUES ($codePro, '$denomination', '$nom', '$prenom', '$email', $telephone, '$mdp', '$ville', $num_adresse, '$adresse', $code_postal, '')");

        } else if($_POST["type"]=="pro_prive"){

            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $denomination = $_POST["denomination"];
            $raison_sociale = $_POST["raison"];
            $email = $_POST["email"];
            $telephone = $_POST["telephone"];
            $code_postal = $_POST["codepostal"];
            $ville = $_POST["ville"];
            $temp = explode(" ",$_POST["adresse"]);     //On explode l'adresse
            $num_adresse = $temp[0];                    //On récupère le numéro de la voie qui sera toujours la premier valeur
            array_shift($temp);                         //On supprime le numéro de la voie
            $adresse = implode(" ", $temp);             //On implode le reste de l'adresse (combine un array en string)
            $siren = $_POST["num_SIREN"];
            $siren = preg_replace('/\s+/', '', $siren);  // Supprime tous les espaces, tabulations, sauts de ligne, etc.
            $mdp = $_POST["password"];
            $iban = $_POST["iban"];
            $bic = $_POST["bic"];
            $codePro = time();

            if (!empty($POST["iban"])) {
                $stmt = $dbh->prepare("INSERT INTO pact.secteur_prive(codePro, denomination_sociale, iban, bic, siren, raison_sociale, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) VALUES ($codePro, '$denomination', '$iban', '$bic', '$siren', '$raison_sociale', '$nom', '$prenom', '$email', $telephone, '$mdp', '$ville', $num_adresse, '$adresse', $code_postal, '')");
            }
            else {
                $stmt = $dbh->prepare("INSERT INTO pact.secteur_prive(codePro, denomination_sociale, iban, bic, siren, raison_sociale, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) VALUES ($codePro, '$denomination', '', '', '$siren', '$raison_sociale', '$nom', '$prenom', '$email', $telephone, '$mdp', '$ville', $num_adresse, '$adresse', $code_postal, '')");
            }
        }
        $stmt->execute();
        $dbh = null;
        ?>
    <?php } ?>

    <script>
        document.getElementById('link-pro-public').addEventListener('click', function () {
            showForm('form-pro-public');
        });
        document.getElementById('link-pro-privee').addEventListener('click', function () {
            showForm('form-pro-privee');
        });

        function showForm(formId) {
            // Masquer tous les formulaires
            const forms = document.querySelectorAll('.form-container-page-creation-compte');
            forms.forEach(form => form.classList.remove('active'));

            // Afficher le formulaire correspondant
            const activeForm = document.getElementById(formId);
            activeForm.classList.add('active');
        }

        //Vérification des données avec regex
        function validateFormMembre() {
            let check = true;
            let checkNom = true;
            let checkPrenom = true;
            let checkPseudo = true;
            let checkCodeP = true;
            let checkVille = true;
            let checkAdresse = true;
            let checkEmail = true;
            let checkTelephone = true;
            let checkMDP = true;
            let checkConMDP = true;

            if (!/^[a-z]{2,20}$/i.test(document.forms["membre"]["nom"].value)) { 
                document.getElementById('erreurnom').innerHTML="Minimum 2 caractère et max 20 caractère";
                checkNom = false;
            }
            else {
                document.getElementById('erreurnom').innerHTML="";
                checkNom = true;
            }
            if (!/^[a-z]{2,20}$/i.test(document.forms["membre"]["prenom"].value)) {
                document.getElementById('erreurprenom').innerHTML="Minimum 2 caractère et max 20 caractère";
                checkPrenom = false;
            }
            else {
                document.getElementById('erreurprenom').innerHTML="";
                checkPrenom = true;
            }
            if (!/^[a-z]{2,20}$/i.test(document.forms["membre"]["pseudo"].value)) { 
                document.getElementById('erreurpseudo').innerHTML="Minimum 2 caractère et max 20 caractère et pas de caractères spéciaux";
                checkPseudo = false;
            }
            else {
                document.getElementById('erreurpseudo').innerHTML="";
                checkPseudo = true;
            }
            if (!/^[0-9]{5}$/i.test(document.forms["membre"]["codepostal"].value)) { 
                document.getElementById('erreurcodep').innerHTML="5 chiffre requis";
                checkCodeP = false;
            }
            else {
                document.getElementById('erreurcodep').innerHTML="";
                checkCodeP = true;
            }
            if (!/^[a-z]{2,20}$/i.test(document.forms["membre"]["ville"].value)) { 
                document.getElementById('erreurville').innerHTML="Minimum 2 caractère et max 20 caractère";
                checkVille = false;
            }
            else {
                document.getElementById('erreurville').innerHTML="";
                checkVille = true;
            }
            if (!/^.{2,30}$/i.test(document.forms["membre"]["adresse"].value)) { 
                document.getElementById('erreuradresse').innerHTML="Minimum 2 caractère et max 30 caractère";
                checkAdresse = false;
            }
            else {
                document.getElementById('erreuradresse').innerHTML="";
                checkAdresse = true;
            }
            if (!/^.{5,50}$/i.test(document.forms["membre"]["email"].value)) { 
                document.getElementById('erreuremail').innerHTML="Minimum 5 caractère et max 50 caractère";
                checkEmail = false;
            }
            else {
                document.getElementById('erreuremail').innerHTML="";
                checkEmail = true;
            }
            if (!/^0[0-9]{9}$/i.test(document.forms["membre"]["telephone"].value)) { 
                document.getElementById('erreurtelephone').innerHTML="Minimum 10 chiffre requis et commence par un 0";
                checkTelephone = false;
            }
            else {
                document.getElementById('erreurtelephone').innerHTML="";
                checkTelephone = true;
            }
            if (!/^.{5,25}$/i.test(document.forms["membre"]["password"].value)) { 
                document.getElementById('erreurmdp').innerHTML="Minimum 5 caractère et max 25 caractère";
                checkMDP = false;
            }
            else {
                document.getElementById('erreurmdp').innerHTML="";
                checkMDP = true;
            }
            if (!/^.{5,25}$/i.test(document.forms["membre"]["confirm_password"].value)) { 
                document.getElementById('erreurconmdp').innerHTML="Minimum 5 caractère et max 25 caractère";
                checkConMDP = false;
            }
            else {
                document.getElementById('erreurconmdp').innerHTML="";
                checkConMDP = true;
            }
            if (checkNom == true && checkPrenom == true && checkPseudo == true && checkCodeP == true && checkVille == true && checkAdresse == true && checkEmail == true && checkTelephone == true && checkMDP == true && checkConMDP == true) {
                return true;
            }
            else {
                return false;
            }
        }

        //Empêche l'envoie des données si le form possède des erreurs
        document.forms["pro-public"].addEventListener('submit', function (event) {
            if (!validateFormMembre()) {
                event.preventDefault();
            }
        });

        // Afficher par défaut le premier formulaire
        showForm('form-pro-public');
    </script>
</body>
</html>
