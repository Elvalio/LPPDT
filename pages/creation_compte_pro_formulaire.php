<?php ini_set('display_errors', 1);
error_reporting(E_ALL); 
error_reporting(0); if (!empty($_POST)) {


        include("../sql/connect_params.php");

        $dbh = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);

        if (isset($_POST["type-entreprise"])) {
            $form = $_POST["type-entreprise"];
        }

        if ($form == "privee") {
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $denomination = $_POST["denomination"];
            $raison_sociale = $_POST["denomination"];
            $email = $_POST["email"];
            $telephone = $_POST["telephone"];
            $code_postal = $_POST["codepostal"];
            $ville = $_POST["ville"];
            $temp = explode(" ",$_POST["adresse"]);     //On explode l'adresse
            $num_adresse = $temp[0];                                       //On récupère le numéro de la voie qui sera toujours la premiere valeur
            array_shift($temp);                                    //On supprime le numéro de la voie
            $adresse = implode(" ", $temp);              //On implode le reste de l'adresse (combine un array en string)
            $siren = $_POST["num_SIREN"];
            $siren = preg_replace('/\s+/', '', $siren);  // Supprime tous les espaces, tabulations, sauts de ligne, etc.
            $mdp = $_POST["password"];
            $iban = $_POST["iban"];
            $bic = $_POST["bic"];
            $codePro = time();

            if (!empty($_POST["iban"])) {
                $stmt = $dbh->prepare("INSERT INTO pact.secteur_prive(codePro, denomination_sociale, iban, bic, siren, raison_sociale, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) VALUES ($codePro, '$denomination', '$iban', '$bic', '$siren', '$raison_sociale', '$nom', '$prenom', '$email', $telephone, '$mdp', '$ville', $num_adresse, '$adresse', $code_postal, '')");
            } else {
                $stmt = $dbh->prepare("INSERT INTO pact.secteur_prive(codePro, denomination_sociale, iban, bic, siren, raison_sociale, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) VALUES ($codePro, '$denomination', '', '', '$siren', '$raison_sociale', '$nom', '$prenom', '$email', $telephone, '$mdp', '$ville', $num_adresse, '$adresse', $code_postal, '')");
            }

        } else if ($form == "publique") {
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $denomination = $_POST["denomination"];
            $email = $_POST["email"];
            $telephone = $_POST["telephone"];
            $code_postal = $_POST["codepostal"];
            $ville = $_POST["ville"];
            $temp = explode(" ",$_POST["adresse"]);
            $num_adresse = $temp[0];
            array_shift($temp);
            $adresse = implode(" ", $temp);
            $mdp = $_POST["password"];
            $codePro = time();

            $stmt = $dbh->prepare("INSERT INTO pact.secteur_public(codePro, denomination_sociale, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) VALUES (1002, '$denomination', '$nom', '$prenom', '$email', $telephone, '$mdp', '$ville', $num_adresse, '$adresse', $code_postal, '')");
        }


        $stmt->execute();
        header("Location: connexion.php");
        $dbh = null;
        ?>
    <?php } ?>

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
    <a href="creation_compte_formulaire.php">
        <div class="bouton-retour-page-création">
            <button class="FS">
                <img src="../icons/arrow-left-o.svg" alt="Bouton Image" width="15" height="15"> Retour
            </button>
        </div>
    </a>

    <!-- Liens de navigation pour choisir le formulaire -->
    <div class="container-page-creation-compte">
        <div class="menu-links">
            <div class="inscription-pro TS-bold" id="link-pro">
                <h1 class="TS-bold">Création d'un compte pro</h1>
            </div>
        </div>

        <!-- Formulaire pour l'inscription professionnelle privée -->
        <div class="form-container-page-creation-compte" id="form-pro-privee">
            <form name="privee" action="creation_compte_pro_formulaire.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" value="pro_prive">
                <div class="form-group">
                    <div class="left-column">
                        <label for="nom" class="FS">Nom<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="Polo" id="nom-pro" name="nom" required>
                        
                        <label for="prenom" class="FS">Prénom<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="Marco" id="prenom-pro" name="prenom" required>

                        <label for="denomination" class="FS">Dénomination Sociale<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="Les voyages de Marco Polo" id="denomination" name="denomination" required>

                        <label for="email" class="FS">E-mail<span class="required">*</span></label>
                        <input type="email" placeholder="marco.polo@gmail.com" id="email-pro" name="email" required>
                        
                        <label for="num_SIREN" class="FS">Numéro de SIREN<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="ex : 362 521 879" id="num_SIREN-pro" name="num_SIREN" required>

                        <div class="choix_entreprise">
                            <label for="type-entreprise">
                                Type d'entreprise :
                            </label>
                            <div id="type-entreprise" class="radio-group">
                                <input type="radio" name="type-entreprise" value="publique" class="radio-button">
                                <span class="radio-label">Entreprise publique</span>

                                <input type="radio" name="type-entreprise" value="privee" checked class="radio-button">
                                <span class="radio-label">Entreprise privée
                            </div>
                        </div>

                        <div class="spacer"></div>

                        <div class="element_prive1" id="elements-privee1">
                            <label for="iban" class="FS">IBAN :</label>
                            <input type="text" id="iban" name="iban" placeholder="FRXX XXXX XXXX XXXX XXXX XXXX XXX">
                        </div>
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

                        <div class="element_prive2" id="elements-privee2">
                            <label for="bic" class="FS">BIC :</label>
                            <input type="text" id="bic" name="bic" placeholder="ABCDFRPPXXX">
                        </div>

                        
                    </div>
                </div>
                <div class="form-info">
                    <p class="FS">Le BIC et l'IBAN ne sont pas obligatoire pour poursuivre. Vous pourrez les ajouter ou les modifier ultérieurement dans votre espace personnel.</p>
                </div>
                <div class="checkbox">
                    <input type="checkbox" id="terms" name="terms" required>
                    <span class="FS-bold">
                        Accepter les 
                        <a href="conditions_d_utilisation.php" target="_blank">conditions générales d'utilisation de PACT</a>
                        <span class="required">*</span>
                    </span>
                </div>


                <button type="submit" class="bouton-envoi-formulaire-crea-compte-page-pro TS-bold">Créer un compte</button>
            </form>
            
            <div class="redirection-links">
                <a href="connexion.php" class="Connexion">Déjà inscrit ? Connectez-vous.</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialisation : afficher le formulaire privé par défaut
            showForm('form-pro-privee');

            // Ajouter l'événement de basculement pour le formulaire privé
            document.getElementById('link-pro-privee').addEventListener('click', function () {
                showForm('form-pro-privee');
            });
        });

        function showForm(formId) {
            // Masquer tous les formulaires
            const forms = document.querySelectorAll('.form-container-page-creation-compte');
            forms.forEach(form => form.classList.remove('active'));

            // Afficher le formulaire correspondant
            const activeForm = document.getElementById(formId);
            if (activeForm) {
                activeForm.classList.add('active');
            }
        }


        //Vérification des données avec regex
        function validateFormMembre() {
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
        document.forms["pro-privee"].addEventListener('submit', function (event) {
            if (!validateFormMembre()) {
                event.preventDefault();
            }
        });

        // Afficher le formulaire
        showForm('form-pro-privee');
    </script>
</body>
</html>
