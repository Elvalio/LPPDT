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
                    <div class="inscription-pro-page-membre">
                        Inscription Professionnelle
                    </div>
                </a>
                <a href="creation_compte_membre.php" style="text-decoration: none;">
                    <div class="inscription-membre-page-membre">
                        Inscription Membre
                    </div>
                </a>
            </div>
            <form>
                <div class="form-group">
                    <div class="left-column">
                        <label for="nom">Nom<span class="required">*</span></label>
                        <input type="text-membre" placeholder="Nom" id="nom" name="nom" required>
                        
                        <label for="prenom">Prénom<span class="required">*</span></label>
                        <input type="text-membre" placeholder="Prénom" id="prenom" name="prenom" required>

                        <label for="pseudo">Pseudonyme<span class="required">*</span></label>
                        <input type="text-membre" placeholder="Pseudonyme" id="pseudo" name="pseudo" required>

                        <div class="row">
                            <div class="input-wrapper">
                            <label for="codepostal">Code postal<span class="required">*</span></label>
                            <input type="text-membre" placeholder="Code Postal" id="codepostal" name="codepostal" required>
                            </div>

                            <div class="input-wrapper">
                                <label for="ville">Ville<span class="required">*</span></label>
                                <input type="text-membre" placeholder="Ville" id="ville" name="ville" required>
                            </div>
                        </div>

                        <label for="adresse">Adresse postale<span class="required">*</span></label>
                        <input type="text-membre" placeholder="Adressse postale" id="adresse" name="adresse" required>
                    </div>
                    <div class="right-column">
                        <label for="email">E-mail<span class="required">*</span></label>
                        <input type="email-membre" placeholder="E-mail" id="email" name="email" required>

                        <label for="telephone">Téléphone<span class="required">*</span></label>
                        <input type="tel-membre" placeholder="Téléphone" id="telephone" name="telephone" required>

                        <label for="password">Mot de passe<span class="required">*</span></label>
                        <input type="password-membre" placeholder="Mot de passe" id="password" name="password" required>

                        <label for="confirm_password">Confirmer le Mot de passe<span class="required">*</span></label>
                        <input type="password-membre" placeholder="Confirmer le mot de passe" id="confirm_password" name="confirm_password" required>
                        
                        <div class="checkbox">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms">Accepter les conditions générales d'utilisations de PACT<span class="required">*</span></label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="bouton-envoi-formulaire-crea-compte-page-membre">S'inscrire</button>
            </form>
            <a href="connexion.php" style="text-decoration: none;">
                <div class="login">
                    <button type="submit" class="connexion-page-membre">Déjà inscrit ? Connectez-vous.</button>
                </div>
            </a>
        </div>
    </div>
</body>
</html>
