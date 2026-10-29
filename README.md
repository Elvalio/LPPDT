# LPPDT — Plateforme d'Aide et de Conseil Touristique

Application web de référencement et d'avis sur des offres touristiques : activités, visites, spectacles, parcs d'attraction et restauration. Les professionnels publient et gèrent leurs offres, les visiteurs consultent, notent et commentent.

Projet mené dans le cadre du BUT Informatique à l'IUT de Lannion.

## Fonctionnalités

**Côté visiteur**
- Recherche et filtrage des offres par type, tags, options et critères spécifiques à chaque catégorie
- Fiche détaillée par offre : photos, horaires, options, avis
- Dépôt d'avis avec photos, notation, likes et signalement
- Compte membre : historique de consultation, gestion des avis déposés

**Côté professionnel**
- Création et modification d'offres, avec prévisualisation avant publication
- Tableau de bord de suivi
- Réponse aux avis, blacklist et signalement
- Facturation : génération et téléchargement de factures en PDF

**Transverse**
- Authentification à deux facteurs par code TOTP
- Comptes distincts pour les professionnels du secteur public et du secteur privé
- Pages RGPD, conditions d'utilisation et politique de confidentialité

## Architecture

Le projet se compose de deux briques indépendantes.

### Application web

PHP côté serveur, accès à la base via PDO et requêtes préparées. Front en HTML, CSS et JavaScript sans framework. Base de données PostgreSQL, schéma `pact`, une quarantaine de tables.

### Tchatator — serveur de messagerie

Serveur de chat écrit en C, séparé de l'application web. Il écoute sur un port TCP, authentifie les appels par clé d'API associée à un rôle (client, professionnel, administrateur) et persiste les discussions et les messages dans PostgreSQL via `libpq`. Le comportement du serveur (port, backlog, taille de buffer, limites de messages) est paramétré dans `tchatator/config.txt`.

## Stack

| | |
|---|---|
| Back-end | PHP, PDO |
| Front-end | HTML, CSS, JavaScript |
| Base de données | PostgreSQL |
| Messagerie | C, sockets TCP, libpq |
| Dépendances | `spomky-labs/otphp` (2FA), `dompdf/dompdf` (factures PDF) |

## Installation

```bash
git clone https://github.com/Elvalio/LPPDT.git
cd LPPDT
composer install
```

Créer la base et la peupler :

```bash
psql -f sql/crea_bdd.sql
psql -f sql/populate_bdd.sql
psql -f sql/tchatator.sql
```

Les identifiants de connexion à la base se placent dans `sql/connect_params.php`, qui n'est pas versionné.

Compiler et lancer le serveur de messagerie :

```bash
cd tchatator
gcc tchatator.c -o tchatator -lpq
./tchatator
```

## Organisation du dépôt

```
pages/       pages PHP de l'application
js/          scripts front
css/         feuilles de style
sql/         schéma, jeu de données et exemples PDO
tchatator/   serveur de messagerie en C
images/      médias et visuels
```
