DROP SCHEMA IF EXISTS pact CASCADE;
CREATE SCHEMA pact;
SET SCHEMA 'pact';

create table _adresse(
  ville varchar(20),
  lieu varchar(30),
  code_postal integer,

  constraint _adresse_pk primary key (ville, lieu)
);

create table _compte
(
  idC serial,
  nom varchar(20),
  prenom varchar(20),
  email varchar(20),
  telephone varchar(10),
  mdp varchar(20),
  
  -- FK
  ville varchar(20),
  lieu varchar(30),
  
  constraint _compte_pk 
  primary key (idC),
  
  constraint _compte_fk_adresse foreign key
  (ville, lieu) references _adresse(ville, lieu)
);

create table _professionnel(

    idC integer,
    codePro integer unique, -- need trigger so that this is frozen or see if you can make it an id
    
  constraint _professionnel_pk primary key (idC),
  constraint _professionnel_fk_inherit foreign key
  (idC) references _compte(idC)
);

create table _secteur_public(

    idC integer,
    
  constraint _secteur_public_pk primary key (idC),
  constraint _secteur_public_fk_inherit foreign key
  (idC) references _professionnel(idC)
);

create table _secteur_prive(

    idC integer,
    coord_banquaire varchar(30),
    siren varchar(9),
    
  constraint _secteur_prive_pk primary key (idC),
  constraint _secteur_prive_fk_inherit foreign key
  (idC) references _professionnel(idC)
);



create table _membre(

    idC integer,
    pseudo varchar(20) unique,-- need trigger so that this is frozen or see if you can make it an id
    
  constraint _membre_pk primary key (idC),
  constraint _membre_fk_inherit foreign key
  (idC) references _compte(idC)
);

create table _tag(
  idTag serial,
  libelle varchar(20),
  
  constraint _tag_pk primary key (idTag)
);

create table _tag_default(
  idTag integer,
  
  constraint _tag_default_pk primary key (idTag),
  constraint _tag_default_fk_inherit foreign key
  (idTag) references _tag(idTag)
);

create table _tag_resto(
  idTag integer,
  
  constraint _tag_resto_pk primary key (idTag),
  constraint _tag_resto_fk_inherit foreign key
  (idTag) references _tag(idTag)
);

-- Offre est ses enfants
create table _offre(
  idO serial,
  titre varchar(20),
  "type" varchar(20),
  option varchar(20),
  description varchar(50),
  photo varchar(60),
  prix_min float,
  --/moy_note
  --/nbrAvis
  accessiblitie varchar(30),
  categorie varchar(30), -- need to be frozen
  denomination varchar(30),
  date_publication date,
  
  -- FK
  ville varchar(20),
  lieu varchar(30),
  
  -- Fk for pro
  /*
  idC integer;
  constraint _offre_fk_professionnel foreign key
  (idC) references professionnel(idC),

  */

  constraint _offre_pk primary key (idO),
  
  constraint _offre_fk_adresse foreign key
  (ville, lieu) references _adresse(ville, lieu)
);

create table _activite(
  idO integer,
  duree interval not null,
  age_min integer  not null,
  prestations varchar(30) not null,
  
  constraint _activite_pk primary key(idO),
  constraint _activite_fk_inherit foreign key
  (idO) references _offre(idO)
);

create table _tags_activite(
  idO integer,
  idTag integer,
  
  constraint _tags_activite_pk primary key(idO, idTag),
  constraint _tags_activite_fk_activite foreign key
  (idO) references _activite(idO),
  constraint _tags_activite_fk_tag_default foreign key
  (idTag) references _tag_default(idTag)
);

create table _visite(
  idO integer,
  duree interval not null,
  langues  varchar(30),
  
  constraint _visite_pk primary key(idO),
  constraint _visite_fk_inherit foreign key
  (idO) references _offre(idO)
);

create table _tags_visite(
  idO integer,
  idTag integer,
  
  constraint _tags_visite_pk primary key(idO, idTag),
  constraint _tags_visite_fk_visite foreign key
  (idO) references _visite(idO),
  constraint _tags_visite_fk_tag_default foreign key
  (idTag) references _tag_default(idTag)
);

create table _spectacle(
  idO integer,
  duree interval not null,
  capacite integer not null,
  
  constraint _spectacle_pk primary key(idO),
  constraint _spectacle_fk_inherit foreign key
  (idO) references _offre(idO)
);

create table _tags_spectacle(
  idO integer,
  idTag integer,
  
  constraint _tags_spectacle_pk primary key(idO, idTag),
  constraint _tags_spectacle_fk_spectacle foreign key
  (idO) references _spectacle(idO),
  constraint _tags_spectacle_fk_tag_default foreign key
  (idTag) references _tag_default(idTag)
);


create table _parc_d_attraction(
  idO integer,
  "plan" varchar(60) not null,
  nbr_attractions integer not null,
  age_min integer  not null,
  
  constraint _parc_d_attraction_pk primary key(idO),
  constraint _parc_d_attraction_fk_inherit foreign key
  (idO) references _offre(idO)
);

create table _tags_parc_d_attraction(
  idO integer,
  idTag integer,
  
  constraint _tags_parc_d_attraction_pk primary key(idO, idTag),
  constraint _tags_parc_d_attraction_fk_parc_d_attraction foreign key
  (idO) references _parc_d_attraction(idO),
  constraint _tags_parc_d_attraction_fk_tag_default foreign key
  (idTag) references _tag_default(idTag)
);

create table _restauration(
  idO integer,
  carte_restaurant varchar(60) not null,
  gamme_prix varchar(5),
  petit_dejeuner boolean not null,
  brunch boolean not null,
  dejeuner boolean not null,
  diner boolean not null,
  boissons boolean not null,
  
  constraint _restauration_pk primary key(idO),
  constraint _restauration_fk_inherit foreign key
  (idO) references _offre(idO)
);

create table _tags_restauration(
  idO integer,
  idTag integer,
  
  constraint _tags_restauration_pk primary key(idO, idTag),
  constraint _tags_restauration_fk_restauration foreign key
  (idO) references _restauration(idO),
  constraint _tags_restauration_fk_tag_resto foreign key
  (idTag) references _tag_resto(idTag)
);

-- Triggers tables

--TODO test these triggers

-------- This should freeze codePro
create or replace function mis_a_jour_professionnel()
  returns trigger as $$
begin
  if (new.codePro <> old.codePro) then
    raise exception 'Pas de mise à jour codePro';
  end if;  
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_update_professionnel
before update on _professionnel
  for each row execute procedure mis_a_jour_professionnel();
  
--This should freeze pseudo
create or replace function mis_a_jour_membre()
  returns trigger as $$
begin
  if (new.pseudo <> old.pseudo) then
    raise exception 'Pas de mise à jour pseudo';
  end if;
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_update_membre
before update on _membre
  for each row execute procedure mis_a_jour_membre();

------------------- Views


-- Membre
create or replace view membre as
  select idC, pseudo, nom, prenom, email, telephone, mdp, ville, lieu, code_postal from _membre natural join _compte natural join _adresse;
  


create or replace function insert_membre()
  returns trigger as $$
begin
  if (select not exists(select * from _adresse where ville = new.ville and lieu = new.lieu)) then
    insert into _adresse (ville, lieu, code_postal) values (new.ville, new.lieu, new.code_postal);
  end if;
  insert into _compte (nom, prenom, email, telephone, mdp, ville, lieu) values (new.nom, new.prenom, new.email, new.telephone, new.mdp, new.ville, new.lieu) returning idC into new.idC;
  insert into _membre (idc, pseudo) values (new.idc, new.pseudo);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_membre
instead of insert on membre
  for each row execute procedure insert_membre();


insert into membre (pseudo, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values ('jonnnie', 'jon', 'halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', '4 place du marchal 22780', 22780);
insert into membre (pseudo, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values ('bobbie', 'jon', 'halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', '4 place du marchal 22780', 22780);


-- update _membre set pseudo = 'azza' where idC = 1;


-- professionnel
create or replace view professionnel as
  select idC, codePro, nom, prenom, email, telephone, mdp, ville, lieu, code_postal from _professionnel natural join _compte natural join _adresse;
  


create or replace function insert_professionnel()
  returns trigger as $$
begin
  if (select not exists(select * from _adresse where ville = new.ville and lieu = new.lieu)) then
    insert into _adresse (ville, lieu, code_postal) values (new.ville, new.lieu, new.code_postal);
  end if;
  insert into _compte (nom, prenom, email, telephone, mdp, ville, lieu) values (new.nom, new.prenom, new.email, new.telephone, new.mdp, new.ville, new.lieu) returning idC into new.idC;
  insert into _professionnel (idc, codePro) values (new.idc, new.codePro);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_professionnel
instead of insert on professionnel
  for each row execute procedure insert_professionnel();
  
insert into professionnel (codePro, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values (1001, 'jon', 'halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', '4 place du marchal 22780', 22780);

-- professionnel secteur public

create or replace view secteur_public as
  select * from _secteur_public natural join professionnel;


create or replace function insert_secteur_public()
  returns trigger as $$
begin
  insert into professionnel (codePro, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values (new.codePro, new.nom, new.prenom, new.email, new.telephone, new.mdp, new.ville, new.lieu, new.code_postal);
  select idC from professionnel where codePro = new.codePro into new.idC;
  insert into _secteur_public (idC) values (new.idC);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_secteur_public
instead of insert on secteur_public
  for each row execute procedure insert_secteur_public();
  
  
insert into secteur_public (codePro, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values (1002, 'jon', 'halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', '4 place du marchal 22780', 22780);

-- professionnel secteur prive

create or replace view secteur_prive as
  select * from _secteur_prive natural join professionnel;


create or replace function insert_secteur_prive()
  returns trigger as $$
begin
  insert into professionnel (codePro, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values (new.codePro, new.nom, new.prenom, new.email, new.telephone, new.mdp, new.ville, new.lieu, new.code_postal);
  select idC from professionnel where codePro = new.codePro into new.idC;
  insert into _secteur_prive (idC, coord_banquaire, siren) values (new.idC, new.coord_banquaire, new.siren);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_secteur_prive
instead of insert on secteur_prive
  for each row execute procedure insert_secteur_prive();
  
  
insert into secteur_prive (codePro, coord_banquaire, siren, nom, prenom, email, telephone, mdp, ville, lieu, code_postal) values (1003,'65151656516 44', '125475842', 'jon', 'halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', '4 place du marchal 22780', 22780);

--- Tags

-- Tags default

create or replace view tag_default as
  select * from _tag_default natural join _tag;
  
create or replace function insert_tag_default()
  returns trigger as $$
begin
  insert into _tag (libelle) values (new.libelle) returning idTag into new.idTag;
  insert into _tag_default (idTag) values (new.idTag);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_tag_default
instead of insert on tag_default
  for each row execute procedure insert_tag_default();
  
insert into tag_default (libelle) values ('Son et lumière');

-- Tags default

create or replace view tag_resto as
  select * from _tag_resto natural join _tag;
  
create or replace function insert_tag_resto()
  returns trigger as $$
begin
  insert into _tag (libelle) values (new.libelle) returning idTag into new.idTag;
  insert into _tag_resto (idTag) values (new.idTag);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_tag_resto
instead of insert on tag_resto
  for each row execute procedure insert_tag_resto();
  
insert into tag_resto (libelle) values ('Français');


--- Offres

-- offre, i dont need trigger i think for insert

-- activite TODO 

--TODO add calculated stuff
/*
create or replace view activite as
  select * from _activite natural join _offre;
  
create or replace function insert_activite()
  returns trigger as $$
begin
  insert into _offre (libelle) values (new.libelle) returning idO into new.idO;
  insert into _activite (idO) values (new.idO);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_activite
instead of insert on activite
  for each row execute procedure insert_activite();
  
insert into activite(titre, "type", option, description, photo, prix_min accessibilite)
*/
