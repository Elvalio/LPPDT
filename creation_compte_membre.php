<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="creation_compte_membre.css">
    <link rel="stylesheet" href="styleGeneral.css">
    <link rel="stylesheet" href="creation_compte.css">
</head>
<body>
    <div class="bouton-retour-page-création">
        <button>
            <img src="images/IconBoutonRetour.png" alt="Bouton Image" width="15" height="15">
            Retour
        </button>
    </div>
    <div class="container-page-creation-compte">
        <div class="form-container-page-creation-compte">
            <div class="form-header-page-creation-compte">
                <a href="creation_compte_pro_public.php" style="text-decoration: none;">
                    <div class="inscription-pro">
                        Inscription Professionnelle
                    </div>
                </a>
                <a href="creation_compte_membre.php" style="text-decoration: none;">
                <div class="inscription-membre">
                    Inscription Membre
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

                        <label for="pseudo">Pseudonyme<span class="required">*</span></label>
                        <input type="text" placeholder="Pseudonyme" id="pseudo" name="pseudo" required>

                        <label for="codepostal">Code postal<span class="required">*</span></label>
                        <input type="text" placeholder="Code Postal" id="codepostal" name="codepostal" required>

                        <label for="ville">Ville<span class="required">*</span></label>
                        <input type="text" placeholder="Ville" id="ville" name="ville" required>

                        <label for="adresse">Adresse postale<span class="required">*</span></label>
                        <input type="text" placeholder="Adressse postale" id="adresse" name="adresse" required>
                    </div>
                    <div class="right-column">
                        <label for="email">E-mail<span class="required">*</span></label>
                        <input type="email" placeholder="E-mail" id="email" name="email" required>

                        <label for="telephone">Téléphone<span class="required">*</span></label>
                        <input type="tel" placeholder="Téléphone" id="telephone" name="telephone" required>

                        <label for="password">Mot de passe<span class="required">*</span></label>
                        <input type="password" placeholder="Mot de passe" id="password" name="password" required>

                        <label for="confirm_password">Confirmer le Mot de passe<span class="required">*</span></label>
                        <input type="password" placeholder="Confirmer le mot de passe" id="confirm_password" name="confirm_password" required>
                        
                        <div class="checkbox">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms">Accepter les conditions générales d'utilisations de PACT<span class="required">*</span></label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="bouton-envoi-formulaire-crea-compte">S'inscrire</button>
            </form>
            <div class="login">
                <button type="submit" class="connexion">Déjà inscrit ? Connectez-vous.</button>
            </div>
        </div>
    </div>
</body>
</html>
