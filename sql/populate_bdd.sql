SET SCHEMA 'pact';


-- MEMBRES --

  insert into pact.membre (pseudo, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) values ('Jonnnie', 'Jon', 'Halford', 'jon.hal@gmail.com', '0651101267', 'skjosdkkvd', 'Lannion', 4, 'place du marchal', 22300, '');   
  insert into pact.membre (pseudo, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) values ('Bobbie', 'Jon', 'Halford', 'jon.hal@gmail.com', '0651101267', 'skjosdkkvd', 'Lannion', 4, 'place du marchal', 22300, '');  
  insert into pact.membre (pseudo, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) values ('Zirconium', 'Prigent', 'Richard', 'richard.prigent@wanadoo.fr', '0758124278', 'N5W7mOliROdlXYtRep', 'Saint-Brieuc', 11, 'rue de la gare', 22000, '');
  insert into pact.membre (pseudo, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) values ('HolyCannolee', 'La Vedette', 'Hugo', 'hugo.lavedette@orange', '0652637537', 'hugolemeilleur!', 'Guingamp', 5, 'boulevard clémenceau', 22200, '');
  insert into pact.membre (pseudo, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) values ('Kabibabie', 'Aquecouccou', 'Lillie', 'kabibaie@gmail.com', '0772368545', 'IDontLikeMakingPasswords', 'Lannion', 1, 'rue édouard branly', 22300, '');
  insert into pact.membre (pseudo, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) values ('Aberrington', 'Lacèsvash', 'Guillaume', 'guillaume.lacesvash@wanadoo.fr', '0687783861', 'g7YZk?D:2*q2', 'Saint-Brieuc', 7, 'rue piet mondrian', 22000, '');
  insert into pact.membre (pseudo, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) values ('IcyTerra', 'Chram', 'Ambre', 'ambre.chram@wanadoo.fr', '0754552861', 'LeMDPEstRéel', 'Plouaret', 4, 'rue de l''armorique', 22420, '');

-- TYPE_OFFRE --
  insert into pact._type_offre (nom_type, cout) values ('Gratuit', 0);
  insert into pact._type_offre (nom_type, cout) values ('Standard', 10);
  insert into pact._type_offre (nom_type, cout) values ('Premium', 20);




-- PROFESSIONNEL SECTEUR PUBLIC --
insert into pact.secteur_public (codePro, denomination_sociale, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) values (1002, 'Denom', 'Jon', 'Halford', 'jon.hal@gmail.com', '0651101267', 'skjosdkkvd', 'Lannion', 4, 'place du marchal', 22300, '');
insert into pact.secteur_public (codePro, denomination_sociale, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) values (728, 'MyBuisiness', 'Prigent', 'Richard', 'richard.prigent@wanadoo.fr', '0758124278', 'N5W7mOliROdlXYtRep', 'Saint-Brieuc', 11, 'rue de la gare', 22000, '');
insert into pact.secteur_public (codePro, denomination_sociale, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) values (5642, 'Waw L''entreprise','Glichton', 'Carter', 'theglitchton@gmail.com', '0610254122', 'exTraSpiCYhitBox', 'Dinan', 1, 'résidence la conninais', 22100, '');




-- PROFESSIONNEL SECTEUR PRIVE --
insert into pact.secteur_prive (codePro, denomination_sociale, iban, bic, siren, raison_sociale, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) values (1003, 'Denom', 'iban', 'bic', '125475842', 'Raison sociale', 'Jon', 'Halford', 'jon.hal@gmail.com', '0651101267', 'skjosdkkvd', 'Lannion', 4, 'place du marchal', 22300, ''); 
insert into pact.secteur_prive (codePro, denomination_sociale, iban, bic, siren, raison_sociale, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) values (212, 'Youpi Land', 'iban', 'bic', '144365479', 'Raison sociale', 'Portimao', 'Jean-Jacques', 'jeanjacsques.portimao@orange.fr', '0654620539', 'lQ6Jm896GfAz', 'Paimpol', 13, 'rue salvador allende', 22500, '');
insert into pact.secteur_prive (codePro, denomination_sociale, iban, bic, siren, raison_sociale, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) values (18, 'Sparadra', 'iban', 'bic', '682647654', 'Raison sociale', 'Modem', 'Nicola', 'modem.nicola@gmail.com', '0742576876', 'MjTdtLDapoUd', 'Guingamp', 18, 'rue valentin', 22200, '');




-- OFFRES -- 
insert into pact.spectacle (titre, resume, "type", option, description, prix_min, accessibilite, date_creation, date_publication, duree, capacite, ville, numero_voie, voie, code_postal, complement, idC) values ('La Magie des arbres', 'Sur le site exceptionnel de la plage de Tourony, au cœur de la côte de Granit rose.', 2, 'En relief', 'Venez découvrir la Magie des arbres dans ce site exceptionnel de la côte de Granit rose : première partie musicale autour de Bagad de Perros-Guirec, puis la nuit tombée, assistez au son et lumière avec la projection sur des voiles de grands mâts tendues dans les arbres.', 5.00, 'Accessible pour personnes en situation de handicap par un ascenseur', now(), now(), interval '1 hour 30 minutes', 300, 'Perros-Guirec', 5, 'rue des cordiers', 22700, '', 11);
insert into pact.activite (titre, resume, "type", option, description, prix_min, accessibilite, date_creation, date_publication, duree, age_min, prestation_incluse, prestation_excluse, ville, numero_voie, voie, code_postal, complement, idC) values ('Qui m''aime me suive', 'Montrer que l''on peut réaliser localement de belles balades à vélo, en empruntant de petites routes tranquilles et sans trop montées', 2, '', 'Les sorties sont volontairement limitées entre 15km et 20km pour permettre à un large public familial de se joindre à nous.', 0.00, 'Le public en situation de handicap est le bienvenu', now(), now(), interval '6 hours', 12, 'Encadrant, Kit de crevaisons, Déjeuner sandwich', 'Bicyclette, Crème solaire', 'Lannion', 3, 'allée des soupirs', 22300, '', 8);
insert into pact.visite (titre, resume, "type", option, description, prix_min, accessibilite, date_creation, date_publication, duree, langues, ville, numero_voie, voie, code_postal, complement, idC) values ('Excursion vers les 7 îles', 'Découvrer l''archipel des Sept-Îles, la plus grande réserve ornithologique de France', 3, '', 'Les vedettes des 7 Îles proposent des excusrions et des visites commentées vers l''archipel des Sept-Îles, au départ de Perros-Guirrec. Le site est protégé et l''accès aux îles réglementé, mais vous pourrez néanmoins fouler le sol de l''Île-aux-Moines.', 8.50, 'Accueil du public en situation de handicap avec fauteuil roulant manuel', now(), now(), interval '3 hours', 'Français, Anglais', 'Perros-Guirec', 39, 'boulevard joseph le bihan', 22700, '', 8);
insert into pact.restauration (titre, resume, "type", option, description, prix_min, accessibilite, date_creation, date_publication, src_image, gamme_prix, petit_dejeuner, brunch, dejeuner, diner, boissons, ville, numero_voie, voie, code_postal, complement, idC) values ('La ville blanche', 'La Ville Blanche, en plein cœur du Trégor, non loin de la côte de Granit Rose vous accueille pour le plaisir des papilles.', 2, 'À la Une', 'Ce petit corps de ferme repris par la famille Jaguin est devenu au fil du temps une Maison de renom. D''aventures en aventures, la passion de cette cuisine s''est maintenant transmise, des souvenirs et des moments se sont déroulés dans cette Maison symbolique de Bretagne.', 20.00, 'Non', now(), now(), 'image_offre/13-4-menu.jpg', '€€€', false, false, true, true, true, 'Lannion', 29, 'route de tréguier', 22300, '', 13);
insert into pact.parc_d_attraction (titre, resume, "type", option, description, prix_min, accessibilite, date_creation, date_publication, src_image, nbr_attractions, age_min, ville, numero_voie, voie, code_postal, complement, idC) values ('Le village Gaulois', 'Explorer le village Gaulois de Pleumeur-Boudou et ses multiples attractions', 1, '', 'L''association un village gaulois pour l''Afrique accueil toute votre famille pour réaliser nos attractions qui sont destiner à tout âge. Des activitées seront également mis à disposition, réalisé avec nos emplyés.', 5.00, 'Le public en situation de handicap est accueillit à main ouverte', now(), now(), 'image_offre/10-5-plan.jpg', 14, 4, 'Plemeur-Boudou', 1, 'parc du radôme', 22560, '', 10);
insert into pact.activite (titre, resume, "type", option, description, prix_min, accessibilite, date_creation, date_publication, duree, age_min, prestation_incluse, prestation_excluse, ville, numero_voie, voie, code_postal, complement, idC) values ('Archipel de Bréhat en kayak', 'Découvrer l''archipel de Bréhat, en Bretagne, offre des paysages magnifiques et des eaux cristallines, parfaits pour explorer en kayak.', 2, '', 'L''archipel de Bréhat, situé au large de la côte bretonne, est un véritable joyau naturel, composé de plusieurs îles et îlots aux paysages variés. En kayak, vous pourrez naviguer entre ses eaux cristallines et ses rochers granitiques, tout en découvrant des plages de sable fin et une riche biodiversité marine.', 9.50, 'Non', now(), now(), interval '1 hour 30 minutes', 13, 'Kayak, Pagaie, Gilet de sauvetage', 'Casque', 'Île-de-Bréhat', 1, 'place du centre', 22870, '', 8);
insert into pact.visite (titre, resume, "type", option, description, prix_min, accessibilite, date_creation, date_publication, duree, langues, ville, numero_voie, voie, code_postal, complement, idC) values ('Parc et château de la Roche Jagu', 'Le Parc et Château de la Roche Jagu, situé en Bretagne, allie patrimoine historique et jardins paysagers.', 1, '', 'Le Parc et Château de la Roche Jagu est un lieu chargé d''histoire et de beauté naturelle. Datant du XVe siècle, le château, avec son architecture médiévale, surplombe la vallée du Trieux et invite à la découverte de ses salons et de son histoire fascinante.', 3.00, 'Le public en situation de handicap est accueillit et pris en main', now(), now(), interval '3 hours', 'Français', 'Ploëzal', 1, 'parc de la roche-jagu', 22260, '', 10);

update _offre set en_ligne = true; 



-- TAGS DEFAULT --
insert into pact.tag_default (libelle) values ('Culturel');
insert into pact.tag_default (libelle) values ('Patrimoine');
insert into pact.tag_default (libelle) values ('Histoire');
insert into pact.tag_default (libelle) values ('Urbain');
insert into pact.tag_default (libelle) values ('Nature');
insert into pact.tag_default (libelle) values ('Pleine air');
insert into pact.tag_default (libelle) values ('Sport');
insert into pact.tag_default (libelle) values ('Nautique');
insert into pact.tag_default (libelle) values ('Gastronomie');
insert into pact.tag_default (libelle) values ('Musée');
insert into pact.tag_default (libelle) values ('Atelier');
insert into pact.tag_default (libelle) values ('Musique');
insert into pact.tag_default (libelle) values ('Famille');
insert into pact.tag_default (libelle) values ('Cinéma');
insert into pact.tag_default (libelle) values ('Cirque');
insert into pact.tag_default (libelle) values ('Son et lumière');
insert into pact.tag_default (libelle) values ('Humour');

-- TAGS RESTO --

insert into pact.tag_resto (libelle) values ('Français');
insert into pact.tag_resto (libelle) values ('Fruit de mer');
insert into pact.tag_resto (libelle) values ('Asiatique');
insert into pact.tag_resto (libelle) values ('Indienne');
insert into pact.tag_resto (libelle) values ('Italienne');
insert into pact.tag_resto (libelle) values ('Gastronomique');
insert into pact.tag_resto (libelle) values ('Restauration rapide');
insert into pact.tag_resto (libelle) values ('Crêperie');
insert into pact.tag_resto (libelle) values ('Végétarienne');
insert into pact.tag_resto (libelle) values ('Végétalienne');
insert into pact.tag_resto (libelle) values ('Kebab');

-- TAGS OFFRES --

-- spectacle
insert into pact._tags_spectacle(idO, idTag) values (1,5);
insert into pact._tags_spectacle(idO, idTag) values (1,6);

-- activite
insert into pact._tags_activite(idO, idTag) values (2,5);
insert into pact._tags_activite(idO, idTag) values (2,6);
insert into pact._tags_activite(idO, idTag) values (2,7);
insert into pact._tags_activite(idO, idTag) values (2,13);

insert into pact._tags_activite(idO, idTag) values (6,6);
insert into pact._tags_activite(idO, idTag) values (6,7);
insert into pact._tags_activite(idO, idTag) values (6,8);
insert into pact._tags_activite(idO, idTag) values (6,13);

-- visite
insert into pact._tags_visite(idO, idTag) values (3,5);
insert into pact._tags_visite(idO, idTag) values (3,6);
insert into pact._tags_visite(idO, idTag) values (3,8);

insert into _tags_visite(idO, idTag) values (7,1);
insert into _tags_visite(idO, idTag) values (7,2);
insert into _tags_visite(idO, idTag) values (7,3);

-- restauration
insert into pact._tags_restauration(idO, idTag) values (4,18);
insert into pact._tags_restauration(idO, idTag) values (4,25);

-- parc_d_attraction
insert into pact._tags_parc_d_attraction(idO, idTag) values (5,6);
insert into pact._tags_parc_d_attraction(idO, idTag) values (5,13);
insert into pact._tags_parc_d_attraction(idO, idTag) values (5,17);

-- IMAGES --

insert into pact.photo_offre (src_image, idO) values ('image_offre/11-1-1.webp', 1);
insert into pact.photo_offre (src_image, idO) values ('image_offre/8-2-1.jpg', 2);
insert into pact.photo_offre (src_image, idO) values ('image_offre/8-3-1.jpg', 3);
insert into pact.photo_offre (src_image, idO) values ('image_offre/13-4-1.jpg', 4);
insert into pact.photo_offre (src_image, idO) values ('image_offre/10-5-1.webp', 5);
insert into pact.photo_offre (src_image, idO) values ('image_offre/8-6-1.jpg', 6);
insert into pact.photo_offre (src_image, idO) values ('image_offre/10-7-1.jpg', 7);


-- AVIS  TODO next sprint--

insert into pact.avis (note, titre, corps, date_publication, date_visite, contexte)
values (4, 'Test', 'Test', now(), now(), 'Test');

insert into pact.avis (note, titre, corps, date_publication, date_visite, contexte)
values (2, 'Test', 'Test', now(), now(), 'Test');

-- not final

insert into _experience(idA, idC, idO) values (1, 1, 1);
insert into _experience(idA, idC, idO) values (1, 2, 2);
insert into _experience(idA, idC, idO) values (1, 3, 3);
insert into _experience(idA, idC, idO) values (1, 4, 4);
insert into _experience(idA, idC, idO) values (1, 5, 5);
insert into _experience(idA, idC, idO) values (1, 6, 6);
insert into _experience(idA, idC, idO) values (1, 7, 7);

insert into _experience(idA, idC, idO) values (2, 1, 3);
insert into _experience(idA, idC, idO) values (2, 2, 4);
insert into _experience(idA, idC, idO) values (2, 3, 5);
insert into _experience(idA, idC, idO) values (2, 4, 6);