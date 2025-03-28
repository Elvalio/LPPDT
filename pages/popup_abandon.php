<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/styleGeneral.css">

    <style>
       #popup_abandon{
            position: fixed;
            width: fit-content;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-around;
            background-color: var(--gris-clair);
            top: 50%; /* Place le centre de la popup au milieu de l'écran verticalement */
            left: 50%;
            transform: translate(-50%, -50%); /* Ajuste pour centrer */
            border-radius: 12px;
            width: 50vw;
            height: 45vh;
            padding: 25px;
            z-index: 10;
        }

        #croix{
            width: 20px;
            height: 20px;
            object-fit: cover;
            cursor: pointer;
            position: absolute;
            bottom: 94.5%;
            left: 96.5%;
            padding: 1.5px;
            background-color: var(--bleuFonce-rougeFonce);
            border: 1px solid var(--blanc);
            border-radius: 25px;
        }

        #logo{
            display: none;
            width: 300px;
        }

        #group{
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 100%;
            height: 95%;
        }
        #text{
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 100%;
            height: 60%;
        }

        #debut{
            text-align: center;
            color: var(--bleu-rouge);
            margin: 0;
            font-size: 2em;
            font-family: "TripSansBold";
            display: block;

        }

        #fin{
            text-align: center;
            color: var(--bleuFonce-rougeFonce);
            margin: 0;
            font-size: 1.2em;
            font-family: "TripSansRegular";
        }

        .links a{
            font-family: 'TripSansRegular';
            margin-top: 5px;
            text-decoration: none;
        }

        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Noir semi-transparent */
            z-index: 9; /* Derrière la popup */
            display: flex; /* Caché par défaut */
            backdrop-filter: blur(5px); /* Effet de flou */
        }

        #boutons_popupAbandon{
            display: flex;
            justify-content: space-between;
        }

        button{
            padding: 10px 30px;
            margin-bottom: 20px;
            cursor: pointer;
            border: none;
            border-radius: 8px;
            background-color: var(--bleu-rouge);
            width: 40%;
            font-size: 16px;
            margin-top: 10px;
            color: white;
        }
    </style>
</head>

<body class="FO">

<div id="overlay"></div>
       
       <div id="popup_abandon" class="FS">

           <img id="logo" src="../logo/logo_reduit_vert.png">
           <div id="group">
               <div id="text">
                   <p id="debut">Etes-vous sur de vouloir quitter ?</p>
                   <p id="fin">Vos modifications ne seront pas enregistrés.</p>
               </div>
                <div id="boutons_popupAbandon">
                    <button>Continuer</button>
                    <button>Annuler</button>
                </div>  
           </div>
              
           <img id="croix" src="../images/croix.png" alt="" class="close-popup">
       </div>
</body>
</html>