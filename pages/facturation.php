<!DOCTYPE html>
<html lang="fr">

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
                    <button class="voir-plus" aria-expanded="false">Voir plus +</button>
                </div>
                <div class="facture-details">
                    <div class="facture-offre">
                        <img src="../images/image_offre/2-1.jpg" alt="">
                        <p>Qui m'aime me suive</p>
                        <p>Pas d'option</p>
                        <p>50€</p>
                    </div>
                    <div class="facture-offre">
                        <img src="../images/image_offre/2-1.jpg" alt="">
                        <p>Qui m'aime me suive</p>
                        <p>Pas d'option</p>
                        <p>50€</p>
                    </div>
                </div>
                


            </article>
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
                    <button class="voir-plus" aria-expanded="false">Voir plus +</button>
                </div>
                <div class="facture-details">
                    <div class="facture-offre">
                        <img src="../images/image_offre/2-1.jpg" alt="">
                        <p>Qui m'aime me suive</p>
                        <p>Pas d'option</p>
                        <p>50€</p>
                    </div>
                </div>
            </article>

        </div>
    </div>
    <script>
    // Sélectionner tous les boutons "Voir plus"
    const buttons = document.querySelectorAll('.voir-plus');

    // Ajouter un gestionnaire d'événement pour chaque bouton
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            // Trouver la section des détails correspondante
            const details = button.parentElement.nextElementSibling;

            // Basculer la classe active
            details.classList.toggle('active');

            // Mettre à jour le texte du bouton en fonction de l'état actif
            const isActive = details.classList.contains('active');
            button.textContent = isActive ? 'Voir moins -' : 'Voir plus +';

            // Mettre à jour l'attribut ARIA pour l'accessibilité
            button.setAttribute('aria-expanded', isActive);
        });
    });
    </script>
</body>

</html>