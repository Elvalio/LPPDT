<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <link rel="stylesheet" href="../css/creation_compte.css">
</head>
<body>
    <div class="bouton-retour-page-création">
        <button class="TS">
            <img src="../icons/arrow-left-o.svg" alt="Bouton Image" width="15" height="15">
            Retour
        </button>
    </div>
    <div class="container-page-creation-compte">
        <div class="form-container-page-creation-compte">
            <div class="form-header-page-creation-compte">
                <a href="creation_compte_pro_public.php" style="text-decoration: none;">
                    <div class="inscription-pro-page-pro FS-bold">
                        Inscription Professionnelle
                    </div>
                </a>
                <a href="creation_compte_membre.php" style="text-decoration: none;">
                    <div class="inscription-membre-page-pro FS-bold">
                        Inscription Membre
                    </div>
                </a>
            </div>

            <div class="pro-public-privee">
                <a href="creation_compte_pro_privee.php" style="text-decoration: none;">
                    <div class="privee-page-privee FS-bold">
                        Privée
                    </div>
                </a>
                <a href="creation_compte_pro_public.php" style="text-decoration: none;">
                <div class="public-page-privee FS-bold">
                    Public
                </div>
                </a>
            </div>

            <form>
                <div class="form-group">
                    <div class="left-column">
                        <label for="nom">Nom<span class="required">*</span></label>
                        <input type="text-pro" placeholder="Nom" id="nom" name="nom" required>
                        
                        <label for="prenom">Prénom<span class="required">*</span></label>
                        <input type="text-pro" placeholder="Prénom" id="prenom" name="prenom" required>

                        <label for="pseudo">Pseudonyme<span class="required">*</span></label>
                        <input type="text-pro" placeholder="Pseudonyme" id="pseudo" name="pseudo" required>



                        <label for="email">E-mail<span class="required">*</span></label>
                        <input type="email-pro" placeholder="E-mail" id="email" name="email" required>
                        
                        <label for="num_SIREN">Numéro de SIREN<span class="required">*</span></label>
                        <input type="text-pro" placeholder="Numéro de SIREN" id="num_SIREN" name="num_SIREN" required>

                        <div class="spacer"></div>

                        <label for="cardholder_name">Prénom et Nom du titulaire de la carte</label>
                        <input type="text-pro" placeholder="Titulaire de la carte" id="cardholder_name" name="cardholder_name">


                    </div>

                    <div class="right-column">
                        <label for="telephone">Téléphone<span class="required">*</span></label>
                        <input type="tel-pro" placeholder="Téléphone" id="telephone" name="telephone" required>

                        <label for="adresse">Adresse postale<span class="required">*</span></label>
                        <input type="text-pro" placeholder="Adresse postale" id="adresse" name="adresse" required>

                        <div class="row">
                            <div class="input-wrapper">
                                <label for="ville">Ville<span class="required">*</span></label>
                                <input type="text-pro" placeholder="Ville" id="ville" name="ville" required>
                            </div>

                            <div class="input-wrapper">
                                <label for="codepostal">Code postal<span class="required">*</span></label>
                                <input type="text-pro" placeholder="Code Postal" id="codepostal" name="codepostal" required>
                            </div>
                        </div>

                        <label for="password">Mot de passe<span class="required">*</span></label>
                        <input type="password-pro" placeholder="Mot de passe" id="password" name="password" required>

                        <label for="confirm_password">Confirmer le Mot de passe<span class="required">*</span></label>
                        <input type="password-pro" placeholder="Confirmer le mot de passe" id="confirm_password" name="confirm_password" required>



                        <div class="spacer"></div>                        
                        
                        <div class="row">
                            <div class="input-wrapper">
                                <label for="cvv">Code de sécurité (CVV)</label>
                                <input type="text-pro" placeholder="CVV" id="cvv" name="cvv" required>
                            </div>
                            <div class="input-wrapper">
                                <label for="expiration">MM/AA</label>
                                <input type="text-pro" placeholder="MM/AA" id="expiration" name="expiration" required>
                            </div>
                        </div>
                        <div class="form-info">
                            <p class="TS">Cette étape n'est pas obligatoire pour poursuivre. Vous pourrez les ajouter ou modifier ultérieurement dans votre espace personnel.</p>
                        </div>

                        
                    </div>
                </div>
                <div class="checkbox">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">Accepter les conditions générales d'utilisations de PACT<span class="required">*</span></label>
                </div>

                <button type="submit" class="bouton-envoi-formulaire-crea-compte-page-pro TS">S'inscrire</button>
            </form>
            
            <a href="connexion.php" style="text-decoration: none;">
                <div class="login">
                    <button type="submit" class="connexion-page-pro TS">Déjà inscrit ? Connectez-vous.</button>
                </div>
            </a>
        </div>
    </div>
</body>
</html>
