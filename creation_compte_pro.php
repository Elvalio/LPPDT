<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="creation_compte_pro.css">
</head>
<body>
    <div class="back-button">
        <button>Retour</button>
    </div>
    <div class="container">
        
        <div class="form-container">
            <div class="form-header">
                <a href="creation_compte_pro.php" style="text-decoration: none;">
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
            <form>
                <div class="form-group">
                    <div class="left-column">
                        <label for="nom">Nom<span class="required">*</span></label>
                        <input type="text" id="nom" name="nom" required>
                        
                        <label for="prenom">Prénom<span class="required">*</span></label>
                        <input type="text" id="prenom" name="prenom" required>

                        <label for="pseudo">Pseudonyme<span class="required">*</span></label>
                        <input type="text" id="pseudo" name="pseudo" required>

                        <label for="codepostal">Code postal<span class="required">*</span></label>
                        <input type="text" id="codepostal" name="codepostal" required>

                        <label for="ville">Ville<span class="required">*</span></label>
                        <input type="text" id="ville" name="ville" required>

                        <label for="adresse">Adresse postale<span class="required">*</span></label>
                        <input type="text" id="adresse" name="adresse" required>
                    </div>
                    <div class="right-column">
                        <label for="email">E-mail<span class="required">*</span></label>
                        <input type="email" id="email" name="email" required>

                        <label for="telephone">Téléphone<span class="required">*</span></label>
                        <input type="tel" id="telephone" name="telephone" required>

                        <label for="password">Mot de passe<span class="required">*</span></label>
                        <input type="password" id="password" name="password" required>

                        <label for="confirm_password">Confirmer le Mot de passe<span class="required">*</span></label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                        
                        <div class="checkbox">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms">Accepter les conditions générales d'utilisations de PACT*</label>
                        </div>
                    </div>
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
