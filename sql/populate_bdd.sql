SET SCHEMA 'pact';


-- MEMBRES --
insert into membre (pseudo, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values ('jonnnie', 'Jon', 'Halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', '4 place du marchal', 22300);
insert into membre (pseudo, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values ('bobbie', 'Jon', 'Halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', '4 place du marchal', 22300);
insert into membre (pseudo, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values ('Zirconium', 'Prigent', 'Richard', 'richard.prigent@wanadoo.fr', '0758124278', 'N5W7mOliROdlXYtRep', 'Saint-Brieux', '11 rue de la gare', 22000);
insert into membre (pseudo, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values ('HolyCannolee', 'La Vedette', 'Hugo', 'hugo.lavedette@orange', '0652637537', 'hugolemeilleur!', 'Guingamp', '5 boulevard clémenceau', 22200);
insert into membre (pseudo, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values ('Kabibabie', 'Aquecouccou', 'Lillie', 'kabibaie@gmail.com', '0772368545', 'Idontlikemakingpasswords', 'Lannion', '1 rue édouard branly', 22300);
insert into membre (pseudo, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values ('Aberrington', 'Lacèsvash', 'Guillaume', 'lacesvash.guillaume@wanadoo.fr', '0687783861', 'g7YZk?D:2*q2', 'Saint-Brieux', '7 rue piet mondrian', 22000);




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
insert into tag_default (libelle) values ('Son et lumière');
insert into tag_default (libelle) values ('Humour');


-- TAGS RESTO --
insert into tag_resto (libelle) values ('Français');
insert into tag_resto (libelle) values ('Fruit de mer');
insert into tag_resto (libelle) values ('Asiatique');
insert into tag_resto (libelle) values ('Indienne');
insert into tag_resto (libelle) values ('Italienne');
insert into tag_resto (libelle) values ('Gastronomique');
insert into tag_resto (libelle) values ('Restauration rapide');
insert into tag_resto (libelle) values ('Crêperie');