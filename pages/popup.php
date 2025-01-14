<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styleConnexion.css">
    <title>Document</title>
</head>

<style>
    body{
        display: flex;
    }

    #popup{
        width: fit-content;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-around;
        background-color: #e4e4e4;
        align-self: center;
        border-radius: 12px;
        width: 50vw;
        height: 40vh;
        padding: 25px;
    }


    #croix {
        width: 15px;
        height: 15px;
        object-fit: cover;
        cursor: pointer;
        position: absolute;
        top: 27vh; 
        right: 22.5vw;
        padding: 1.5px;
        background-color: var(--noir);
        border: 1px solid var(--blanc);
        border-radius: 25px;
    }

    #logo{
        width: 300px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    #group{
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        width: 50%;
        height: 100%;
    }

    .form-group label {
        display: block;
        text-align: left;
    }

    .form-group input {
        width: 95%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    #debut{
        text-align: center;
        color: #002292;
        margin: 0;
        font-size: 1.3em;
        font-family: "TripSansRegular";

    }
    #fin{
        text-align: center;
        color: #3136ED;
        margin: 0;
        font-size: 2em;
        font-family: "TripSansBold";
    }
    


</style>
<body>
    <div id="popup">
        <img id="croix" src="../images/croix.png" alt="" class="close-popup">
        <img id="logo" src="../logo/logo_reduit_vert.png">
        <div id="group">
            <div id="text">
                <p id="debut">Vous souhaitez faire part de votre avis ?</p><p id="fin"> Connectez-vous</p>

            </div>
            <div id="inputs">
                <div class="form-group">
                    <!--Identifiant correspond au pseudo ou codePro, pas à l'idC-->
                    <label for="identifiant">Identifiant compte</label>
                    <input id="identifiant" name="identifiant" placeholder="Identifiant" required>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>