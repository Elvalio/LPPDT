<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link rel="stylesheet" href="./cssHarry/stylesHarry.css">
</head>

<body>
    <div class="container">
        <button class="back-button"> <img src="./cssHarry/icons/arrow-left-o.svg" alt="">Retour</button>

        <div class="logo-container">
            <img src="cssHarry/img/logo_vert.png" alt="Logo Vert" class="logo">
        </div>

        <form action="POST" class="login-form">
            <div class="form-group">
                <label for="email">Adresse E-Mail</label>
                <input type="email" id="email" name="email" placeholder="e-mail" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="mot de passe" required>
            </div>

            <button type="submit" class="submit-button">Se connecter</button>

            <div class="links">
                <a href="#">Mot de passe oublié ?</a>
                <a href="#">S'inscrire</a>
            </div>
        </form>
    </div>
</body>

</html>
