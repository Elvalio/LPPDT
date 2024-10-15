<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="creation_compte_pro_privee.css">
    <link rel="stylesheet" href="styleGeneral.css">
</head>
<body>
    <div class="back-button">
        <button>
            <img src="images/IconBoutonRetour.png" alt="Bouton Image" width="15" height="15">
            Retour
        </button>
    </div>
    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <a href="creation_compte_pro_public.php" style="text-decoration: none;">
                    <div class="header-professional">
                        Inscription Professionnelle
                    </div>
                </a>
                <a href="creation_compte_membre.php" style="text-decoration: none;">
                    <div class="header-member">
                        Inscription Membre
                    </div>
                </a>
            </div>

            <div class="pro-public">
                <a href="creation_compte_pro_privee.php" style="text-decoration: none;">
                    <div class="privee">
                        Privée
                    </div>
                </a>
                <a href="creation_compte_pro_public.php" style="text-decoration: none;">
                <div class="public">
                    Public
                </div>
                </a>
            </div>

            <form>
                <div class="form-group">
                    <div class="left-column">
                        <label for="nom">Nom<span class="required">*</span></label>
                        <input type="text" placeholder="Nom" id="nom" name="nom" required>
                        
                        <label for="prenom">Prénom<span class="required">*</span></label>
                        <input type="text" placeholder="Prénom" id="prenom" name="prenom" required>

                        <div class="row">
                            <div class="input-wrapper">
                                <label for="pseudo">Pseudonyme<span class="required">*</span></label>
                                <input type="text" placeholder="Pseudonyme" id="pseudo" name="pseudo" required>
                            </div>

                            <div class="input-wrapper">
                                <label for="codepostal">Code postal<span class="required">*</span></label>
                                <input type="text" placeholder="Code Postal" id="codepostal" name="codepostal" required>
                            </div>
                        </div>
                        
                        <label for="ville">Ville<span class="required">*</span></label>
                        <input type="text" placeholder="Ville" id="ville" name="ville" required>

                        <label for="expiration">MM/AA<span class="required">*</span></label>
                        <input type="text" placeholder="MM/AA" id="expiration" name="expiration" required>

                        <label for="cvv">Code de sécurité (CVV)<span class="required">*</span></label>
                        <input type="text" placeholder="CVV" id="cvv" name="cvv" required>
                    </div>

                    <div class="right-column">
                        <label for="adresse">Adresse postale<span class="required">*</span></label>
                        <input type="text" placeholder="Adresse postale" id="adresse" name="adresse" required>

                        <label for="email">E-mail<span class="required">*</span></label>
                        <input type="email" placeholder="E-mail" id="email" name="email" required>

                        <label for="telephone">Téléphone<span class="required">*</span></label>
                        <input type="tel" placeholder="Téléphone" id="telephone" name="telephone" required>

                        <label for="password">Mot de passe<span class="required">*</span></label>
                        <input type="password" placeholder="Mot de passe" id="password" name="password" required>

                        <label for="confirm_password">Confirmer le Mot de passe<span class="required">*</span></label>
                        <input type="password" placeholder="Confirmer le mot de passe" id="confirm_password" name="confirm_password" required>

                        <label for="cardholder_name">Prénom et Nom du titulaire de la carte<span class="required">*</span></label>
                        <input type="text" placeholder="Titulaire de la carte" id="cardholder_name" name="cardholder_name">

                        <div class="form-info">
                            <p>Cette étape n'est pas obligatoire pour poursuivre. Vous pourrez les ajouter ou modifier ultérieurement dans votre espace personnel.</p>
                        </div>

                        
                    </div>
                </div>
                <div class="checkbox">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">Accepter les conditions générales d'utilisations de PACT<span class="required">*</span></label>
                </div>

                <button type="submit" class="submit-btn">S'inscrire</button>
            </form>
            
            <div class="login">
                <button type="submit" class="connexion">Déjà inscrit ? Connectez-vous.</button>
            </div>
        </div>
    </div>
</body>
</html>
