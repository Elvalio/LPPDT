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
            border: solid var(--bleu-rouge) 1px;
            border-radius: 5px;
        }
        .modal > form{
            display: flex;
            flex-direction: column;
        }

        #option-modal{
            display: flex;
            flex-direction: column;
            padding-top: 1em;
            justify-content: space-between;
        }

        #boutons-modal{
            padding-top: 2em !important;
        }

        #option-modal > div, #option-modal > h3{
            padding: 0.5em 0em;
        }

        #modal-footer{
            padding-top: 1em;
        }

        #modal-footer > div{
            padding-top: 0.5em;
        }

        #error{
            color: red;
        }

        .btn-notif {
            margin-right: 30px;
            padding: 10px 20px;
            background-color: var(--bleu-rouge);
            color: var(--blanc);
            font-family: 'TripSansBold', Arial, sans-serif;
            text-align: center;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .modal > select {
            border-radius: 4px;
            border-width: 1.5px;
            border-color: lightslategray;
            color: rgb(150, 150, 150);
        }

        #date_lancement {
            border-style: solid;
            border-radius: 4px;
            border-width: 1.5px;
            border-color: lightslategray;
        }

        .titre-modal {
            color: var(--bleu-rouge);
            font-size:40px;
            margin-bottom: 10px;
            margin-left: 0px;
        }

        .texte-modal {
            margin-bottom: 10px;
        }
</style>
</head>

<body class='BO FS'>
    <div class="modal" id="modal">
        <form action="" method="post">
            <div id='tarif-modal'>
                <h2 class="titre-modal">Tarifs de votre offre.</h2>
                <div>
                    <p>Tarif mensuel : X/HT X/TTC</p>
                    <p>Tarif prévisonnel : X</p>
                </div>
            </div>
            <div id='option-modal' style="display: block;">
                <h2 class="titre-modal">Lancement Option</h2>
                <p class="texte-modal">Vous avez choisit l'option X, avec un tarif hebdomadaire de x€</p>
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
                        <option value="null" disabled selected value hidden></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
            </div>
            <div id="modal-footer" class="texte-modal">
                <div>
                    <a href="conditions_legales.php" >Nos conditions légales</a>
                </div>
                <div>
                    <input type="checkbox" id="condition1" name="condition1" value="condition1">
                    <label for="conditions"> Vous avez lu et accepté les conditions légales.*</label><br>
                    <input type="checkbox" id="condition2" name="condition2" value="condition2">
                    <label for="conditions"> Vous êtes concient que la validation est un acte financièrement engageant.*</label><br>
                </div>
                <div id="boutons-modal">
                    <input type="button" class="btn-notif" id="modal-submit-button" value="Valider"/>
                    <input type="button" class="btn-notif" id="modal-close" value="Annuler">
                </div>
            </div>
            
            
        
        </form>
    </div>

    <script>
        //TEST DES DONNES DU FORMULAIRE
        function check_actif() {
            var valide = true;
            if (!document.getElementById('condition1').checked) {
                valide = false;
            }
            if (!document.getElementById('condition2').checked) {
                valide = false;
            }
            if (document.getElementById('semaine') == null) {
                valide = false;
            }
            var check_date = document.getElementById('date_lancement').value;
            if (!check_date_option()) {
                valide = false;
            }
            return valide;
        }

        document.getElementById('modal').style.display = 'block';

        document.getElementById('modal-close').addEventListener('click', function(e) {
            document.getElementById('modal').style.display = 'none'
        });

        document.getElementById('modal-submit-button').addEventListener('click', function(e) {
            console.log(check_actif());
        });

        //MODAL DATEs

        var date_lancement = document.getElementById("date_lancement");
        var error = document.getElementById('error');
        date_lancement.addEventListener("input", function() {
            var d = new Date(date_lancement.value);
            //returns true if monday
            if (d.getDay()!==1) {
                error.textContent = "Date de lancement doit être un Lundi";
            }else{
                error.textContent = "";
            }
        });

        function check_date_option(){
            var date_lancement = document.getElementById("date_lancement");
            var res;

            var d = new Date(date_lancement.value);
            //returns true if monday
            if (d.getDay()!==1) {
                res = false;
            }else{
                res = true;
            }
            return res;
        }
    </script>
</body>