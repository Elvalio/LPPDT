SET SCHEMA 'pact';


-- MEMBRES --
-- insert into membre (pseudo, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values ('jonnnie', 'Jon', 'Halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', '4 place du marchal', 22300);   insérer lors de la création de la BDD 
-- insert into membre (pseudo, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values ('bobbie', 'Jon', 'Halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', '4 place du marchal', 22300);   insérer lors de la création de la BDD 
insert into membre (pseudo, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values ('Zirconium', 'Prigent', 'Richard', 'richard.prigent@wanadoo.fr', '0758124278', 'N5W7mOliROdlXYtRep', 'Saint-Brieux', '11 rue de la gare', 22000);
insert into membre (pseudo, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values ('HolyCannolee', 'La Vedette', 'Hugo', 'hugo.lavedette@orange', '0652637537', 'hugolemeilleur!', 'Guingamp', '5 boulevard clémenceau', 22200);
insert into membre (pseudo, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values ('Kabibabie', 'Aquecouccou', 'Lillie', 'kabibaie@gmail.com', '0772368545', 'IDontLikeMakingPasswords', 'Lannion', '1 rue édouard branly', 22300);
insert into membre (pseudo, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values ('Aberrington', 'Lacèsvash', 'Guillaume', 'lacesvash.guillaume@wanadoo.fr', '0687783861', 'g7YZk?D:2*q2', 'Saint-Brieux', '7 rue piet mondrian', 22000);




-- PROFESSIONNEL --
-- insert into professionnel (codePro, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values (1001, 'Jon', 'Halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', '4 place du marchal', 22300);   insérer lors de la création de la BDD 




-- PROFESSIONNEL SECTEUR PUBLIC --
-- insert into secteur_public (codePro, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values (1002, 'Jon', 'Halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', '4 place du marchal', 22300);   insérer lors de la création de la BDD 
insert into secteur_public (codePro, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values (728, 'Prigent', 'Richard', 'richard.prigent@wanadoo.fr', '0758124278', 'N5W7mOliROdlXYtRep', 'Saint-Brieux', '11 rue de la gare', 22000);
insert into secteur_public (codePro, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values (5642, 'Glichton', 'Carter', 'theglitchton@gmail.com', '0610254122', 'exTraSpiCYhitBox', 'Dinan', '1 résidence la conninais', 22100);




-- PROFESSIONNEL SECTEUR PRIVE --
-- insert into secteur_prive (codePro, coord_banquaire, siren, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values (1003,'65151656516 44', '125475842', 'jon', 'halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', '4 place du marchal 22300', 22300);   insérer lors de la création de la BDD 
insert into secteur_prive (codePro, coord_banquaire, siren, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values (212, '26713820389 89', 144365479, 'Portimao', 'Jean-Jacques', 'jeanjacsques.portimao@orange.fr', '0654620539', 'lQ6Jm896GfAz', 'Paimpol', '13 rue salvador allende', 22500);
insert into secteur_prive (codePro, coord_banquaire, siren, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values (18, '23812068543 42', 682647654, 'Modem', 'Nicola', 'modem.nicola@gmail.com', '0742576876', 'MjTdtLDapoUd', 'Guingamp', '18 rue valentin', 22200);




-- OFFRES -- 
insert into offre (titre, resume, "type", option, description, photo, prix_min, accessibilite, categorie, denomination, date_publication) values ('La Magie des arbres', 'Sur le site exceptionnel de la plage de Tourony, au cœur de la côte de Granit rose.', 'Standard', 'À la Une', 'Venez découvrir la Magie des arbres dans ce site exceptionnel de la côte de Granit rose : première partie musicale autour du Bagad de Perros-Guirec', 'https://www.bit.ly/qehgth/', 5.00, 'Accessible pour personnes en situation de handicap par un ascenseur', 'Spectacle',  'Gignac', now());




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
