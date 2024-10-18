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
        <button class="FS">
            <img src="../icons/arrow-left-o.svg" alt="Bouton Image" width="15" height="15">
            Retour
        </button>
    </div>
    <div class="container-page-creation-compte">
        <div class="form-container-page-creation-compte">
            <div class="form-header-page-creation-compte">
                <a href="creation_compte_pro_public.php" style="text-decoration: none;">
                    <div class="inscription-pro-page-membre TS-bold">
                        Inscription Professionnelle
                    </div>
                </a>
                <a href="creation_compte_membre.php" style="text-decoration: none;">
                    <div class="inscription-membre-page-membre TS-bold">
                        Inscription Membre
                    </div>
                </a>
            </div>
            <form>
                <div class="form-group">
                    <div class="left-column">
                        <label for="nom" class="FS">Nom<span class="required">*</span></label>
                        <input type="text-membre" class="FS" placeholder="Nom" id="nom" name="nom" required>
                        
                        <label for="prenom" class="FS">Prénom<span class="required">*</span></label>
                        <input type="text-membre" class="FS" placeholder="Prénom" id="prenom" name="prenom" required>

                        <label for="pseudo" class="FS">Pseudonyme<span class="required">*</span></label>
                        <input type="text-membre" class="FS" placeholder="Pseudonyme" id="pseudo" name="pseudo" required>

                        <div class="row">
                            <div class="input-wrapper">
                            <label for="codepostal" class="FS">Code postal<span class="required">*</span></label>
                            <input type="text-membre" class="FS" placeholder="Code Postal" id="codepostal" name="codepostal" required>
                            </div>

                            <div class="input-wrapper">
                                <label for="ville" class="FS">Ville<span class="required">*</span></label>
                                <input type="text-membre" class="FS" placeholder="Ville" id="ville" name="ville" required>
                            </div>
                        </div>

                        <label for="adresse" class="FS">Adresse postale<span class="required">*</span></label>
                        <input type="text-membre" class="FS" placeholder="Adressse postale" id="adresse" name="adresse" required>
                    </div>
                    <div class="right-column">
                        <label for="email" class="FS">E-mail<span class="required">*</span></label>
                        <input type="email-membre" class="FS" placeholder="E-mail" id="email" name="email" required>

                        <label for="telephone" class="FS">Téléphone<span class="required">*</span></label>
                        <input type="tel-membre" class="FS" placeholder="Téléphone" id="telephone" name="telephone" required>

                        <label for="password" class="FS">Mot de passe<span class="required">*</span></label>
                        <input type="password-membre" class="FS" placeholder="Mot de passe" id="password" name="password" required>

                        <label for="confirm_password" class="FS">Confirmer le Mot de passe<span class="required">*</span></label>
                        <input type="password-membre" class="FS" placeholder="Confirmer le mot de passe" id="confirm_password" name="confirm_password" required>
                        
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
                    <button type="submit" class="connexion-page-membre TS-bold">Déjà inscrit ? Connectez-vous.</button>
                </div>
            </a>
        </div>
    </div>
</body>
</html>
