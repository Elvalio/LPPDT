SET SCHEMA 'pact';


-- MEMBRES --
-- insert into membre (pseudo, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values ('jonnnie', 'Jon', 'Halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', '4 place du marchal', 22300);   insérer lors de la création de la BDD 
-- insert into membre (pseudo, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values ('bobbie', 'Jon', 'Halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', '4 place du marchal', 22300);   insérer lors de la création de la BDD 
insert into membre (pseudo, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values ('Zirconium', 'Prigent', 'Richard', 'richard.prigent@wanadoo.fr', '0758124278', 'N5W7mOliROdlXYtRep', 'Saint-Brieuc', '11 rue de la gare', 22000);
insert into membre (pseudo, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values ('HolyCannolee', 'La Vedette', 'Hugo', 'hugo.lavedette@orange', '0652637537', 'hugolemeilleur!', 'Guingamp', '5 boulevard clémenceau', 22200);
insert into membre (pseudo, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values ('Kabibabie', 'Aquecouccou', 'Lillie', 'kabibaie@gmail.com', '0772368545', 'IDontLikeMakingPasswords', 'Lannion', '1 rue édouard branly', 22300);
insert into membre (pseudo, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values ('Aberrington', 'Lacèsvash', 'Guillaume', 'lacesvash.guillaume@wanadoo.fr', '0687783861', 'g7YZk?D:2*q2', 'Saint-Brieuc', '7 rue piet mondrian', 22000);




-- PROFESSIONNEL --
-- insert into professionnel (codePro, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values (1001, 'Jon', 'Halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', '4 place du marchal', 22300);   insérer lors de la création de la BDD 




-- PROFESSIONNEL SECTEUR PUBLIC --
-- insert into secteur_public (codePro, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values (1002, 'Jon', 'Halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', '4 place du marchal', 22300);   insérer lors de la création de la BDD 
insert into secteur_public (codePro, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values (728, 'Prigent', 'Richard', 'richard.prigent@wanadoo.fr', '0758124278', 'N5W7mOliROdlXYtRep', 'Saint-Brieuc', '11 rue de la gare', 22000);
insert into secteur_public (codePro, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values (5642, 'Glichton', 'Carter', 'theglitchton@gmail.com', '0610254122', 'exTraSpiCYhitBox', 'Dinan', '1 résidence la conninais', 22100);




-- PROFESSIONNEL SECTEUR PRIVE --
-- insert into secteur_prive (codePro, coord_banquaire, siren, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values (1003,'65151656516 44', '125475842', 'jon', 'halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', '4 place du marchal 22300', 22300);   insérer lors de la création de la BDD 
insert into secteur_prive (codePro, coord_banquaire, siren, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values (212, '26713820389 89', 144365479, 'Portimao', 'Jean-Jacques', 'jeanjacsques.portimao@orange.fr', '0654620539', 'lQ6Jm896GfAz', 'Paimpol', '13 rue salvador allende', 22500);
insert into secteur_prive (codePro, coord_banquaire, siren, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values (18, '23812068543 42', 682647654, 'Modem', 'Nicola', 'modem.nicola@gmail.com', '0742576876', 'MjTdtLDapoUd', 'Guingamp', '18 rue valentin', 22200);




-- OFFRES -- 
-- insert into offre (titre, resume, "type", option, description, photo, prix_min, accessibilite, categorie, denomination, date_publication) values ('La Magie des arbres', 'Sur le site exceptionnel de la plage de Tourony, au cœur de la côte de Granit rose.', 'Standard', 'À la Une', 'Venez découvrir la Magie des arbres dans ce site exceptionnel de la côte de Granit rose : première partie musicale autour du Bagad de Perros-Guirec', 'https://www.bit.ly/qehgth/', 5.00, 'Accessible pour personnes en situation de handicap par un ascenseur', 'Spectacle',  'Gignac', now());   insérer lors de la création de la BDD 
insert into offre (titre, resume, "type", option, description, photo, prix_min, accessibilite, categorie, denomination, date_publication) values ('Archipel de Bréhat en kayak', "Montrer que l'on peut réaliser localement de belles balades à vélo, en empruntant de petites routes tranquilles et sans trop montées", 'Standart', 'A la Une', "Les sorties sont volontairement limitées entre 15km et 20km pour permettre à un large public familial de se joindre à nous.", 'https://www.bit.ly/dfghvf/', 0.00, "Le public en situation de handicap est le bienvenu", 'Activité', 'Planète Kayak', now());
insert into offre (titre, resume, "type", option, description, photo, prix_min, accessibilite, categorie, denomination, date_publication) values ('Excursion vers les 7 îles', "Découvrer l'archipel des Sept-Îles, la plus grande réserve ornithologique de France", 'Premium', 'A la une', "Les vedettes des 7 Îles proposent des excusrions et des visites commentées vers l'archipel des Sept-Îles, au départ de Perros-Guirrec. Le site est protégé et l'accès aux îles réglementé, mais vous pourrez néanmoins fouler le sol de l'Île-aux-Moines.", 'https://www.bit.ly/jkxfdc/', 8.50, 'Accueil du public en situation de handicap avec fauteuil roulant manuel', 'Visite', 'Armor Navigation', now());
insert into offre (titre, resume, "type", option, description, photo, prix_min, accessibilite, categorie, denomination, date_publication) values ('La ville blanche', "La Ville Blanche, en plein cœur du Trégor, non loin de la côte de Granit Rose vous accueille pour le plaisir des papilles.", 'Standart', 'A la Une', "Ce petit corps de ferme repris par la famille Jaguin est devenu au fil du temps une Maison de renom. D’aventures en aventures, la passion de cette cuisine s’est maintenant transmise, des souvenirs et des moments se sont déroulés dans cette Maison symbolique de Bretagne.", 'https://www.bit.ly/xddjgi/', 20.00, 'Non', 'Restaurant', 'SARL La Ville Blanche', now());
insert into offre (titre, resume, "type", option, description, photo, prix_min, accessibilite, categorie, denomination, date_publication) values ('Le village Gaulois',  "Explorer le village Gaulois de Pleumeur-Boudou et ses multiples attractions", 'Gratuit', 'A la une', "L'association un village gaulois pour l'Afrique accueil toute votre famille pour réaliser nos attractions qui sont destiner à tout âge. Des activitées seront aussi mis à disposition réalisé avec nos emplyés.", 'https://www.bit.ly/kuedbh/', 5.00, 'Le public en situation de handicap est accueillit à main ouverte', "Parc d'attraction", '', now());
insert into offre (titre, resume, "type", option, description, photo, prix_min, accessibilite, categorie, denomination, date_publication) values ('Archipel de Bréhat en kayak', "Découvrer l'archipel de Bréhat, en Bretagne, offre des paysages magnifiques et des eaux cristallines, parfaits pour explorer en kayak.", 'Standart', 'En relief', "L'archipel de Bréhat, situé au large de la côte bretonne, est un véritable joyau naturel, composé de plusieurs îles et îlots aux paysages variés. En kayak, vous pourrez naviguer entre ses eaux cristallines et ses rochers granitiques, tout en découvrant des plages de sable fin et une riche biodiversité marine.", 'https://www.bit.ly/fbynca/', 9.50, 'Non', 'Activité', 'Planète Kayak', now());
insert into offre (titre, resume, "type", option, description, photo, prix_min, accessibilite, categorie, denomination, date_publication) values ('Parc et château de la Roche Jagu', "Le Parc et Château de la Roche Jagu, situé en Bretagne, allie patrimoine historique et jardins paysagers.", 'Gratuit', 'A la une', "Le Parc et Château de la Roche Jagu est un lieu chargé d'histoire et de beauté naturelle. Datant du XVe siècle, le château, avec son architecture médiévale, surplombe la vallée du Trieux et invite à la découverte de ses salons et de son histoire fascinante.", 'https://www.bit.ly/cjugnb/', 3.00, 'Le public en situation de handicap est accueillit et pris en main', 'Visite', 'Département des Côtes d’Armor', now());




-- TAGS DEFAULT --
insert into tag_default (libelle) values ('Culturel');
insert into tag_default (libelle) values ('Patrimoine');
insert into tag_default (libelle) values ('Histoire');
insert into tag_default (libelle) values ('Urbain');
insert into tag_default (libelle) values ('Nature');
insert into tag_default (libelle) values ('Pleine air');
insert into tag_default (libelle) values ('Sport');
insert into tag_default (libelle) values ('Nautique');
insert into tag_default (libelle) values ('Gastronomie');
insert into tag_default (libelle) values ('Musée');
insert into tag_default (libelle) values ('Atelier');
insert into tag_default (libelle) values ('Musique');
insert into tag_default (libelle) values ('Famille');
insert into tag_default (libelle) values ('Cinéma');
insert into tag_default (libelle) values ('Cirque');
-- insert into tag_default (libelle) values ('Son et lumière');   insérer lors de la création de la BDD 
insert into tag_default (libelle) values ('Humour');




-- TAGS RESTO --
-- insert into tag_resto (libelle) values ('Français');   insérer lors de la création de la BDD 
insert into tag_resto (libelle) values ('Fruit de mer');
insert into tag_resto (libelle) values ('Asiatique');
insert into tag_resto (libelle) values ('Indienne');
insert into tag_resto (libelle) values ('Italienne');
insert into tag_resto (libelle) values ('Gastronomique');
insert into tag_resto (libelle) values ('Restauration rapide');
insert into tag_resto (libelle) values ('Crêperie');
