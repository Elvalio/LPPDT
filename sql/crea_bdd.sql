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
  idC integer,
  nom varchar(20),
  prenom varchar(20),
  email varchar(20),
  telephone varchar(10),
  mdp varchar(20),
  
  -- FK
  ville varchar(20),
  lieu varchar(30),
  
  constraint __compte_pk 
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
    siren varchar[9],
    
  constraint _secteur_prive_pk primary key (idC),
  constraint _secteur_prive_fk_inherit foreign key
  (idC) references _professionnel(idC)
);



create table _membre(

    idC integer,
    pseudo character unique,-- need trigger so that this is frozen or see if you can make it an id
    
  constraint _membre_pk primary key (idC),
  constraint _membre_fk_inherit foreign key
  (idC) references _compte(idC)
);

create table _tag(
  idTag integer,
  libelle varchar(20),
  
  
);

create table _offre(
  idO integer,
  titre varchar(20),
  "type" varchar(20),
  option varchar(20),
  description varchar(50),
  photo varchar(60),
  prix_min float,
  --/moy_note
  --nbrAvis
  accessiblitie varchar(30),
  categorie varchar(30), -- need to be frozen
  denomination varchar(30),
  date_publication date,
  
  -- FK
  ville varchar(20),
  lieu varchar(30),
  
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

create table _visite(
  idO integer,
  duree interval not null,
  langues  varchar(30),
  
  constraint _visite_pk primary key(idO),
  constraint _visite_fk_inherit foreign key
  (idO) references _offre(idO)
);

create table _spectacle(
  idO integer,
  duree interval not null,
  capacite integer not null,
  
  constraint _spectacle_pk primary key(idO),
  constraint _spectacle_fk_inherit foreign key
  (idO) references _offre(idO)
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

