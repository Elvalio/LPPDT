<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Avertissement Option</title>
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <link rel="stylesheet" href="../css/styleEthan.css">

    <style>
        .modal{
            position: fixed;
            top: 50%;
            left: 50%;
            padding: 25px;
            background: white;
            transform: translate(-50%, -50%);
            border: solid black 1px;
            border-radius: 5px;
        }
        .modal > form{
            display: flex;
            flex-direction: column;
        }

        #option-modal{
            display: flex;
            flex-direction: column;
            padding: 1em;
            justify-content: space-between;
        }

        #option-modal > div, #option-modal > h3{
            padding: 0.3em 0em;
        }

        #error{
            color: red;
        }
    </style>
</head>

<body>
    <div class="modal" id="modal">
        <form action="" method="post">
            <div>
                <h2>TEST</h2>
                <p>Tarif</p>
            </div>
            <div id='option-modal'>
                <h3>Lancement Option</h2>
                <p>Vous avez choisit l'option X, avec un tarif hebdomadaire de x€</p>
                <div>
                    <label for="date_lancement">Date de lancement (choisir un lundi): </label>
                    <input type="date" name="date_lancement" id="date_lancement" value="">
                    <div>
                        <span id="error"></span>
                    </div>
                </div>

                <div>
                    <label for="semaine">Nombre de semaine(s) : </label>
                    <select name="semaine" id="semaine">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
            
                <div>
                    <a href="conditions_legales.php">Nos conditions légales</a>
                </div>

                <div>
                    <input id="submit-button" type="submit" value="Valider"/>
                    <input type="button" id="modal-close" value="Annuler">
                </div>
            </div>
            
        
        </form>
    </div>

    <script>
        document.getElementById('modal').style.display = 'block';

        document.getElementById('modal-close').addEventListener('click', function(e) {
            document.getElementById('modal').style.display = 'none'
        });

        var date_lancement = document.getElementById("date_lancement");
        var error = document.getElementById('error');

        window.onload = function() {
            date_lancement.addEventListener("input", function() {
                console.log(date_lancement.value);
                d = new Date(date_lancement.value);
                //returns true if monday
                console.log()
                if (d.getDay()!==1) {
                    error.textContent = "Date de lancement doit être un Lundi";
                }else{
                    error.textContent = "";
                }
            });
        }
    </script>
</body>