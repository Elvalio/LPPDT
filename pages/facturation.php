<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/samStyles.css">
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <title>Facturation</title>
</head>

<body class="BO">
    <div>
        <?php include_once 'nav.php' ?>
    </div>
    <div class="main-content">
        <header>
            <h1 class="titre-rouge">Facturation</h1>
            <p class="facture-tri">Plus recent</p>
        </header>
        <div>
            <article class="facture-composant-liste">
                <div class="facture-liste-facture">
                    <div>
                    <p>Date :</p>
                    <p>10/11/2024</p>
                </div>
                <div>
                    <p>Numéro de facture :</p>
                    <p>123456</p>
                </div>
                <div>
                    <p>Total à payer :</p>
                    <p>100€</p>
                </div>
                <div>
                    <p>Nombre d'offres :</p>
                    <p>2</p>
                </div>
                <button class="voir-plus">Voir plus +</button>
                </div>
                
                <div class="facture-details" style="display: none;">
                    <p>Détails supplémentaires :</p>
                    <ul>
                        <li>Produit 1 : 50€</li>
                        <li>Produit 2 : 50€</li>
                    </ul>
                </div>
                <script>
                // Sélectionner tous les boutons "Voir plus"
const buttons = document.querySelectorAll('.voir-plus');

// Ajouter un gestionnaire d'événement pour chaque bouton
buttons.forEach(button => {
    button.addEventListener('click', () => {
        // Trouver la section des détails correspondante
        const details = button.parentElement.nextElementSibling;

        // Basculer l'affichage avec une transition fluide
        if (details.classList.contains('active')) {
            details.classList.remove('active'); // Masquer les détails
            button.textContent = 'Voir plus +'; // Restaurer le texte du bouton
        } else {
            details.classList.add('active'); // Afficher les détails
            button.textContent = 'Voir moins -'; // Changer le texte du bouton
        }
    });
});


            </script>
            </article>
            

        </div>
    </div>

</body>

</html>