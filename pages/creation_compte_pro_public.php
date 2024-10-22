<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <link rel="stylesheet" href="../css/creation_compte.css">
    <script src="../js/creation_compte.js"></script>
</head>
<body>
    <div class="bouton-retour-page-création">
        <button class="FS">
            <img src="../icons/arrow-left-o.svg" alt="Bouton Image" width="15" height="15">
            Retour
        </button>
    </div>
    <div class="container-page-creation-compte">
        <div class="form-container-page-creation-compte">
            <div class="form-header-page-creation-compte">
                <a href="creation_compte_pro_public.php" style="text-decoration: none;">
                    <div class="inscription-pro-page-pro TS-bold">
                        Inscription Professionnelle
                    </div>
                </a>
                <a href="creation_compte_membre.php" style="text-decoration: none;">
                    <div class="inscription-membre-page-pro TS-bold">
                        Inscription Membre
                    </div>
                </a>
            </div>

            <div class="pro-public-privee">
                <a href="creation_compte_pro_privee.php" style="text-decoration: none;">
                    <div class="privee-page-public TS-bold">
                        Privée
                    </div>
                </a>
                <a href="creation_compte_pro_public.php" style="text-decoration: none;">
                <div class="public-page-public TS-bold">
                    Public
                </div>
                </a>
            </div>

            <form action="creation_compte.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" value="pro_public">
                <div class="form-group">
                    <div class="left-column">
                        <label for="nom" class="FS">Nom<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="Entrez votre nom" id="nom-pro" name="nom" required>
                        
                        <label for="prenom" class="FS">Prénom<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="Entrez votre prénom" id="prenom-pro" name="prenom" required>

                        <label for="denomination-sociale-pro" class="FS">Dénomination Sociale<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="Le nom de votre entreprise" id="denomination-sociale-pro" name="denomination" required>

                        <label for="email" class="FS">E-mail<span class="required">*</span></label>
                        <input type="email" class="FS" placeholder="Entrez votre email" id="email-pro" name="email" required>



                        <div class="spacer-pro-public"></div>

                        <label for="cardholder_name" class="FS">Titulaire de la carte</label>
                        <input type="text" class="FS" placeholder="Prénom et nom du propriétaire" id="cardholder_name-pro" name="cardholder_name">

                    </div>

                    <div class="right-column">
                        <label for="telephone" class="FS">Téléphone<span class="required">*</span></label>
                        <input type="tel" class="FS" placeholder="Entrez votre téléphone" id="telephone-pro" name="telephone" required> 

                        <label for="adresse" class="FS">Adresse postale<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="5 rue de l'exemple" id="adresse-pro" name="adresse" required>
                        
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

                        <div class="spacer"></div>

                        <div class="row">
                            <div class="input-wrapper">
                                <label for="cvv" class="FS">Code de sécurité</label>
                                <input type="text" class="FS" placeholder="CVV" id="cvv-pro" name="cvv">
                            </div>
                            <div class="input-wrapper">
                                <label for="expiration" class="FS">Date d'expiration</label>
                                <input type="text" class="FS" placeholder="MM/AA" id="expiration-pro" name="expiration">
                            </div>
                        </div>


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
                    <button type="submit" class="connexion-page-pro TS-bold">Déjà inscrit ? Connectez-vous.</button>
                </div>
            </a>
        </div>
    </div>
</body>
</html>
