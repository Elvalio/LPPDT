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
                    <div class="privee-page-privee TS-bold">
                        Privée
                    </div>
                </a>
                <a href="creation_compte_pro_public.php" style="text-decoration: none;">
                <div class="public-page-privee TS-bold">
                    Public
                </div>
                </a>
            </div>

            <form>
                <div class="form-group">
                    <div class="left-column">
                        <label for="nom" class="FS">Nom<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="Nom" id="nom-pro" name="nom" required>
                        
                        <label for="prenom" class="FS">Prénom<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="Prénom" id="prenom-pro" name="prenom" required>

                        <label for="pseudo" class="FS">Pseudonyme<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="Pseudonyme" id="pseudo-pro" name="pseudo" required>



                        <label for="email" class="FS">E-mail<span class="required">*</span></label>
                        <input type="email" placeholder="E-mail" id="email-pro" name="email" required>
                        
                        <label for="num_SIREN" class="FS">Numéro de SIREN<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="Numéro de SIREN" id="num_SIREN-pro" name="num_SIREN" required>

                        <div class="spacer"></div>

                        <label for="cardholder_name" class="FS">Prénom et Nom du titulaire de la carte</label>
                        <input type="text" class="FS" placeholder="Titulaire de la carte" id="cardholder_name-pro" name="cardholder_name">


                    </div>

                    <div class="right-column">
                        <label for="telephone" class="FS">Téléphone<span class="required">*</span></label>
                        <input type="tel" class="FS" placeholder="Téléphone" id="telephone-pro" name="telephone" required>

                        <label for="adresse" class="FS">Adresse postale<span class="required">*</span></label>
                        <input type="text" class="FS" placeholder="Adresse postale" id="adresse-pro" name="adresse" required>

                        <div class="row">
                            <div class="input-wrapper">
                                <label for="codepostal" class="FS">Code postal<span class="required">*</span></label>
                                <input type="text" class="FS" placeholder="Code Postal" id="codepostal-pro" name="codepostal" required>
                            </div>

                            <div class="input-wrapper">
                                <label for="ville" class="FS">Ville<span class="required">*</span></label>
                                <input type="text" class="FS" placeholder="Ville" id="ville-pro" name="ville" required>
                            </div>
                        </div>

                        <label for="password" class="FS">Mot de passe<span class="required">*</span></label>
                        <input type="password" class="FS" placeholder="Mot de passe" id="password-pro" name="password" required>

                        <label for="confirm_password" class="FS">Confirmer le Mot de passe<span class="required">*</span></label>
                        <input type="password" class="FS" placeholder="Confirmer le mot de passe" id="confirm_password-pro" name="confirm_password" required>



                        <div class="spacer"></div>                        
                        
                        <div class="row">
                            <div class="input-wrapper">
                                <label for="cvv" class="FS">Code de sécurité (CVV)</label>
                                <input type="text" class="FS" placeholder="CVV" id="cvv-pro" name="cvv">
                            </div>
                            <div class="input-wrapper">
                                <label for="expiration" class="FS">MM/AA</label>
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
