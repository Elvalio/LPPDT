<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <link rel="stylesheet" href="../css/creation_compte.css">
    <script src="../js/creation_compte.js" defer></script>
    <style>
        /* CSS pour la gestion de l'affichage/masquage des formulaires */
        .form-container-page-creation-compte {
            display: none;
        }
        .form-container-page-creation-compte.active {
            display: block;
        }
        .menu-links div {
            cursor: pointer;
        }
        .button-link {
            margin-top: 20px;
            display: inline-block;
            background-color: #007bff; /* couleur de fond */
            color: #ffffff; /* couleur du texte */
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none; /* retirer le soulignement */
            text-align: center; /* centrer le texte */
        }
        .button-link:hover {
            background-color: #0056b3; /* couleur au survol */
        }
    </style>
</head>
<body>
    <!-- Bouton de retour -->
    <div class="bouton-retour-page-création">
        <button class="FS">
            <img src="../icons/arrow-left-o.svg" alt="Bouton Image" width="15" height="15"> Retour
        </button>
    </div>

    <!-- Liens de navigation pour choisir le formulaire -->
    <div class="container-page-creation-compte">
        <div class="menu-links">
            <div class="inscription-pro-public TS-bold" id="link-pro-public">
                Inscription Professionnelle - Public
            </div>
            <div class="inscription-pro-privee TS-bold" id="link-pro-privee">
                Inscription Professionnelle - Privée
            </div>
            <div class="inscription-membre TS-bold" id="link-membre">
                Inscription Membre
            </div>
        </div>

        <!-- Formulaire pour l'inscription professionnelle publique -->
        <div class="form-container-page-creation-compte" id="form-pro-public">
            <form action="creation_compte.php" method="post" enctype="multipart/form-data">
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
            <form action="creation_compte.php" method="post" enctype="multipart/form-data">
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

        <!-- Formulaire pour l'inscription membre -->
        <div class="form-container-page-creation-compte" id="form-membre">
            <form action="creation_compte.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" value="membre">
                <div class="form-group">
                    <div class="left-column">
                        <label for="nom" class="FS">Nom<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="Colomb" id="nom-membre" name="nom" required>
                        
                        <label for="prenom" class="FS">Prénom<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="Christophe" id="prenom-membre" name="prenom" required>

                        <label for="pseudo" class="FS">Pseudonyme<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="Christophorus" id="pseudo-membre" name="pseudo" required>

                        <div class="row">
                            <div class="input-wrapper">
                            <label for="codepostal" class="FS">Code postal<span class="required">*</span></label>
                            <input type="text" class="FS" placeholder="22300" id="codepostal-membre" name="codepostal" required>
                            </div>

                            <div class="input-wrapper">
                                <label for="ville" class="FS">Ville<span class="required">*</span></label>
                                <input type="text" class="FS" placeholder="Lannion" id="ville-membre" name="ville" required>
                            </div>
                        </div>

                        <label for="adresse" class="FS">Adresse postale<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="5 rue de  la gare" id="adresse-membre" name="adresse" required>
                    </div>
                    <div class="right-column">
                        <label for="email" class="FS">E-mail<span class="required">*</span></label>
                        <input type="email" class="FS" placeholder="christophe.colomb@gmail.com" id="email-membre" name="email" required>

                        <label for="telephone" class="FS">Téléphone<span class="required">*</span></label>
                        <input type="tel" class="FS" placeholder="0641379428" id="telephone-membre" name="telephone" required>

                        <label for="password" class="FS">Mot de passe<span class="required">*</span></label>
                        <input type="password" class="FS" placeholder="Entrez votre mot de passe" id="password-membre" name="password" required>

                        <label for="confirm_password" class="FS">Confirmer le Mot de passe<span class="required">*</span></label>
                        <input type="password" class="FS" placeholder="Confirmer votre mot de passe" id="confirm_password-membre" name="confirm_password" required>
                        
                        <div class="checkbox">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms" class="FS-bold">Accepter les conditions générales d'utilisations de PACT<span class="required">*</span></label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="bouton-envoi-formulaire-crea-compte-page-membre TS-bold">S'inscrire</button>
            </form>
            <a href="connexion.php" style="text-decoration: none;">
                <div class="login">
                    <button type="button" class="connexion-page-membre TS-bold">Déjà inscrit ? Connectez-vous.</button>
                </div>
            </a>
        </div>
    </div>

    <script>
        document.getElementById('link-pro-public').addEventListener('click', function () {
            showForm('form-pro-public');
        });
        document.getElementById('link-pro-privee').addEventListener('click', function () {
            showForm('form-pro-privee');
        });
        document.getElementById('link-membre').addEventListener('click', function () {
            showForm('form-membre');
        });

        function showForm(formId) {
            // Masquer tous les formulaires
            const forms = document.querySelectorAll('.form-container-page-creation-compte');
            forms.forEach(form => form.classList.remove('active'));

            // Afficher le formulaire correspondant
            const activeForm = document.getElementById(formId);
            activeForm.classList.add('active');
        }

        // Afficher par défaut le premier formulaire
        showForm('form-pro-public');
    </script>
</body>
</html>
