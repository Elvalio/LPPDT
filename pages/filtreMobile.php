<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Filtre</title>
    <link rel="stylesheet" href="../css/styleFilter.css">
</head>
<body>
    <button id="menuButton">
        <span>filtrer</span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
            <path d="M10 18h4v-2h-4v2zm-7-7v2h14v-2h-14zm17-5h-20v2h20v-2z" />
        </svg>
    </button>
    <div id="menu">
        <div class="menu-header">
            <span>filtrer</span>
            <button id="closeButton">×</button>
        </div>
        <div class="menu-content">
            <section>
                <h3>Catégorie</h3>
                <label><input type="checkbox"> Visite</label>
                <label><input type="checkbox"> Spectacle</label>
                <label><input type="checkbox"> Parc d'attractions</label>
                <label><input type="checkbox"> Restauration</label>
            </section>
            <section>
                <h3>Lieu</h3>
                <label><input type="checkbox"> Paris</label>
                <label><input type="checkbox"> Brest</label>
                <label><input type="checkbox"> Nantes</label>
            </section>
            <section>
                <h3>Calendrier</h3>
                <input type="text" placeholder="06/24/2021 - 06/24/2021">
            </section>
        </div>
    </div>

    <script src="../js/scriptFilter.js"></script>
</body>
</html>
