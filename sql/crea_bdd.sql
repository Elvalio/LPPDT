DROP SCHEMA IF EXISTS pact CASCADE;
CREATE SCHEMA pact;
SET SCHEMA 'pact';

----------- ADRESSE -----------

create table pact._adresse(
  idAdresse serial,
  ville varchar(20),
  numero_voie integer,
  voie varchar(30),
  code_postal integer,
  complement varchar(30),

  constraint _adresse_pk primary key (idAdresse)
);

----------- IMAGES -----------
create table pact._image(
  idImage serial,
  src_image varchar(60),

  constraint _image_pk primary key (idImage)
);

----------- COMPTES -----------

create table pact._compte
(
  idC serial,
  nom varchar(20),
  prenom varchar(20),
  email varchar(50),
  telephone varchar(10),
  mdp varchar(25),
  
  -- FK
  idAdresse integer,
  image_compte integer,
  
  constraint _compte_pk 
  primary key (idC),
  
  constraint _compte_fk_adresse foreign key
  (idAdresse) references pact._adresse(idAdresse),

  constraint _compte_fk_image foreign key
  (image_compte) references pact._image(idImage)
);

create table pact._professionnel(

  idC integer,
  codePro integer unique, -- need trigger so that this is frozen or see if you can make it an id
  denomination_sociale varchar(30),

  constraint _professionnel_pk primary key (idC),
  constraint _professionnel_fk_inherit foreign key
  (idC) references pact._compte(idC)
);

create table pact._secteur_public(

  idC integer,
    
  constraint _secteur_public_pk primary key (idC),
  constraint _secteur_public_fk_inherit foreign key
  (idC) references pact._professionnel(idC)
);

create table pact._secteur_prive(

  idC integer,
  iban varchar(34),
  bic varchar(11),
  siren varchar(9),
  raison_sociale varchar(30),
    
  constraint _secteur_prive_pk primary key (idC),
  constraint _secteur_prive_fk_inherit foreign key
  (idC) references pact._professionnel(idC)
);



create table pact._membre(

  idC integer,
  pseudo varchar(20) unique,-- need trigger so that this is frozen or see if you can make it an id
    
  constraint _membre_pk primary key (idC),
  constraint _membre_fk_inherit foreign key
  (idC) references pact._compte(idC)
);

----------- AVIS -----------
create table pact._avis(

  idA serial,
  note integer,
  titre varchar(30),
  corps varchar(200),
  date_publication date,
  date_visite date,
  contexte varchar(20),
  --/nbr_like
  --/nbr_dislike
  consulte boolean default false,
  blackliste boolean default false,
  
  constraint _avis_pk primary key (idA),
  
  constraint check_note_min check(0<=note),
  constraint check_note_max check(note <=5)
);

create table pact._photo_avis(
  idImage integer,
  idA integer,

  constraint _photo_avis_pk primary key (idImage, idA),

  constraint _photo_avis_fk_image foreign key
  (idImage) references pact._image(idImage),

  constraint _photo_avis_fk_avis foreign key
  (idA) references pact._avis(idA)

);


----------- TAGS -----------

create table pact._tag(
  idTag serial,
  libelle varchar(20),
  
  constraint _tag_pk primary key (idTag)
);

create table pact._tag_default(
  idTag integer,
  
  constraint _tag_default_pk primary key (idTag),
  constraint _tag_default_fk_inherit foreign key
  (idTag) references pact._tag(idTag)
);

create table pact._tag_resto(
  idTag integer,
  
  constraint _tag_resto_pk primary key (idTag),
  constraint _tag_resto_fk_inherit foreign key
  (idTag) references pact._tag(idTag)
);

----------- Type_offre -----------
create table pact._type_offre(
  idT serial,
  nom_type varchar(20),
  cout float,

  constraint _type_offre_pk primary key (idT)
);

----------- Offre est ses enfants -----------

create table pact._offre(
  idO serial,
  titre varchar(20),
  resume varchar(100),
  option varchar(20),
  description varchar(200),
  prix_min float,
  --/moy_note
  --/nbrAvis
  accessibilite varchar(100),
  categorie varchar(30), -- need to be frozen
  date_creation date default now(),
  date_publication date,
  en_ligne boolean default false,
  
  -- FK
  idAdresse integer,
  "type" integer,
  idC integer,

  constraint _offre_pk primary key (idO),

  constraint _offre_fk_type_offre foreign key
  ("type") references _type_offre(idT),
  
  constraint _offre_fk_professionnel foreign key
  (idC) references _professionnel(idC),
  
  constraint _offre_fk_adresse foreign key
  (idAdresse) references pact._adresse(idAdresse)
);

create table pact._activite(
  idO integer,
  duree interval not null,
  age_min integer  not null,
  prestation_incluse varchar(30), -- not null ?
  prestation_excluse varchar(30), -- not null ?
  
  constraint _activite_pk primary key(idO),
  constraint _activite_fk_inherit foreign key
  (idO) references pact._offre(idO)
);

create table pact._tags_activite(
  -- tags liés à une offre d'activité
  idO integer,
  idTag integer,
  
  constraint _tags_activite_pk primary key(idO, idTag),
  constraint _tags_activite_fk_activite foreign key
  (idO) references pact._activite(idO),
  constraint _tags_activite_fk_tag_default foreign key
  (idTag) references pact._tag_default(idTag)
);

create table pact._visite(
  idO integer,
  duree interval not null,
  langues  varchar(30),
  
  constraint _visite_pk primary key(idO),
  constraint _visite_fk_inherit foreign key
  (idO) references pact._offre(idO)
);

create table pact._tags_visite(
  -- tags liés à une offre de visite
  idO integer,
  idTag integer,
  
  constraint _tags_visite_pk primary key(idO, idTag),
  constraint _tags_visite_fk_visite foreign key
  (idO) references _visite(idO),
  constraint _tags_visite_fk_tag_default foreign key
  (idTag) references pact._tag_default(idTag)
);

create table pact._spectacle(
  idO integer,
  duree interval not null,
  capacite integer not null,
  
  constraint _spectacle_pk primary key(idO),
  constraint _spectacle_fk_inherit foreign key
  (idO) references pact._offre(idO)
);

create table pact._tags_spectacle(
  -- tags liés à une offre de spectacle
  idO integer,
  idTag integer,
  
  constraint _tags_spectacle_pk primary key(idO, idTag),
  constraint _tags_spectacle_fk_spectacle foreign key
  (idO) references pact._spectacle(idO),
  constraint _tags_spectacle_fk_tag_default foreign key
  (idTag) references pact._tag_default(idTag)
);


create table pact._parc_d_attraction(
  idO integer,
  nbr_attractions integer not null,
  age_min integer  not null,

  -- FK

  "plan" integer not null,
  
  constraint _parc_d_attraction_pk primary key(idO),
  constraint _parc_d_attraction_fk_inherit foreign key
  (idO) references pact._offre(idO),

  constraint _parc_d_attraction_fk_image foreign key
  ("plan") references pact._image(idImage)
);

create table pact._tags_parc_d_attraction(
  -- tags liés à une offre de parc d'attraction
  idO integer,
  idTag integer,
  
  constraint _tags_parc_d_attraction_pk primary key(idO, idTag),
  constraint _tags_parc_d_attraction_fk_parc_d_attraction foreign key
  (idO) references pact._parc_d_attraction(idO),
  constraint _tags_parc_d_attraction_fk_tag_default foreign key
  (idTag) references pact._tag_default(idTag)
);

create table pact._restauration(
  idO integer,
  gamme_prix varchar(5),
  petit_dejeuner boolean not null,
  brunch boolean not null,
  dejeuner boolean not null,
  diner boolean not null,
  boissons boolean not null,

  -- FK
  carte_restaurant integer not null,
  
  constraint _restauration_pk primary key(idO),
  constraint _restauration_fk_inherit foreign key
  (idO) references pact._offre(idO),

  constraint _restauration_fk_image foreign key
  (carte_restaurant) references pact._image(idImage)
);

create table pact._tags_restauration(
  -- tags liés à une offre de restauration
  idO integer,
  idTag integer,
  
  constraint _tags_restauration_pk primary key(idO, idTag),
  constraint _tags_restauration_fk_restauration foreign key
  (idO) references pact._restauration(idO),
  constraint _tags_restauration_fk_tag_resto foreign key
  (idTag) references pact._tag_resto(idTag)
);

----------- Exprience ----------- 

create table pact._experience(
  idC integer,
  idO integer,
  idA integer,
  
  constraint _experience_pk primary key(idC, idO, idA),
  
  constraint _experience_fk_membre foreign key
  (idC) references pact._membre(idC),
  
  constraint _experience_fk_offre foreign key
  (idO) references pact._offre(idO),
  
  constraint _experience_fk_avis foreign key
  (idA) references pact._avis(idA)
  
);

----------- Reponse -----------

create table pact._reponse(
  --unsure beacuse of multiplicities
  idMembre integer,
  idPro integer,
  corps varchar(200),
  
  constraint _reponse_pk primary key(idMembre),
  
  constraint _reponse_fk_membre foreign key
  (idMembre) references pact._membre(idC),
  
  constraint _reponse_fk_professionnel foreign key
  (idPro) references pact._professionnel(idC)
);

----------- like/dislike -----------

create table pact._recommande(
  idC integer,
  idA integer,
  
  constraint _recommande_pk primary key(idC, idA),
  
  constraint _recommande_fk_membre foreign key
    (idC) references pact._membre(idC)
);

create table pact._recommande_pas(
  idC integer,
  idA integer,
  
  constraint _recommande_pas_pk primary key(idC, idA),
  
  constraint _recommande_pas_fk_membre foreign key
    (idC) references pact._membre(idC)
);

/* xor does not work
create or replace function existe_recommande_pas(idC integer, idA integer)
   returns boolean as $$
declare
  res boolean;
begin
  select exists(select * from recommande_pas rp where rp.idC = idC and rp.idA = idA) into res; 
  RETURN res;
end;
$$ language 'plpgsql';

alter table _recommande add constraint xor_recommande check (existe_recommande_pas(idC, idA));

create or replace function existe_recommande(idC integer, idA integer)
   returns boolean as $$
declare
  res boolean;
begin
  select exists(select * from recommande r where r.idC = idC and r.idA = idA) into res; 
  RETURN res;
end;
$$ language 'plpgsql';

alter table _recommande_pas add constraint xor_recommande_pas check (existe_recommande(idC, idA));
*/
---------------------------------------------
-------------Triggers tables-----------------
---------------------------------------------

--TODO test these triggers

-------- This should freeze codePro
create or replace function pact.mis_a_jour_professionnel()
  returns trigger as $$
begin
  if (new.codePro <> old.codePro) then
    raise exception 'Pas de mise à jour codePro';
  end if;  
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_update_professionnel
before update on pact._professionnel
  for each row execute procedure pact.mis_a_jour_professionnel();
  
--This should freeze pseudo
create or replace function pact.mis_a_jour_membre()
  returns trigger as $$
begin
  if (new.pseudo <> old.pseudo) then
    raise exception 'Pas de mise à jour pseudo';
  end if;
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_update_membre
before update on pact._membre
  for each row execute procedure pact.mis_a_jour_membre();


---------------------------------------------
------------------- Views ------------------- 
---------------------------------------------

-- Membre
create or replace view pact.membre as
  select idC, pseudo, nom, prenom, email, telephone, mdp, idAdresse, ville, numero_voie, voie, code_postal, complement from pact._membre natural join pact._compte natural join pact._adresse;
  


create or replace function pact.insert_membre()
  returns trigger as $$
begin
  if (select not exists(select * from pact._adresse where ville = new.ville and voie = new.voie and code_postal = new.code_postal and complement = new.complement)) then
    insert into pact._adresse (ville, numero_voie, voie, code_postal, complement) values (new.ville, new.numero_voie, new.voie, new.code_postal, new.complement) returning idAdresse into new.idAdresse;
  else
    select * from pact._adresse where ville = new.ville and voie = new.voie and code_postal = new.code_postal and complement = new.complement into new.idAdresse;
  end if;
  insert into pact._compte (nom, prenom, email, telephone, mdp, idAdresse) values (new.nom, new.prenom, new.email, new.telephone, new.mdp, new.idAdresse) returning idC into new.idC;
  insert into pact._membre (idc, pseudo) values (new.idc, new.pseudo);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_membre
instead of insert on pact.membre
  for each row execute procedure pact.insert_membre();


insert into pact.membre (pseudo, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) values ('jonnnie', 'jon', 'halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', 4, 'place du marchal', 22300, '');
insert into pact.membre (pseudo, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) values ('bobbie', 'jon', 'halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', 4, 'place du marchal', 22300, '');


-- update _membre set pseudo = 'azza' where idC = 1;


-- professionnel
create or replace view pact.professionnel as
  select idC, codePro, denomination_sociale, nom, prenom, email, telephone, mdp, idAdresse, ville, numero_voie, voie, code_postal, complement from pact._professionnel natural join pact._compte natural join pact._adresse;
  


create or replace function pact.insert_professionnel()
  returns trigger as $$
begin
  if (select not exists(select * from pact._adresse where ville = new.ville and voie = new.voie and code_postal = new.code_postal and complement = new.complement)) then
    insert into pact._adresse (ville, numero_voie, voie, code_postal, complement) values (new.ville, new.numero_voie, new.voie, new.code_postal, new.complement) returning idAdresse into new.idAdresse;
  else
    select * from pact._adresse where ville = new.ville and voie = new.voie and code_postal = new.code_postal and complement = new.complement into new.idAdresse;
  end if;
  insert into pact._compte (nom, prenom, email, telephone, mdp, idAdresse) values (new.nom, new.prenom, new.email, new.telephone, new.mdp, new.idAdresse) returning idC into new.idC;
  insert into pact._professionnel (idc, codePro, denomination_sociale) values (new.idc, new.codePro, new.denomination_sociale);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_professionnel
instead of insert on pact.professionnel
  for each row execute procedure pact.insert_professionnel();
  
insert into pact.professionnel (codePro, denomination_sociale, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) values (1001, 'Denom', 'jon', 'halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', 4, 'place du marchal', 22780, '');

-- professionnel secteur public

create or replace view pact.secteur_public as
  select * from pact._secteur_public natural join pact.professionnel;


create or replace function pact.insert_secteur_public()
  returns trigger as $$
begin
  insert into pact.professionnel (codePro, denomination_sociale, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) 
    values (new.codePro, new.denomination_sociale, new.nom, new.prenom, new.email, new.telephone, new.mdp, new.ville, new.numero_voie, new.voie, new.code_postal, new.complement);
  select idC from pact.professionnel where codePro = new.codePro into new.idC;
  insert into pact._secteur_public (idC) values (new.idC);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_secteur_public
instead of insert on pact.secteur_public
  for each row execute procedure pact.insert_secteur_public();
  
  
insert into pact.secteur_public (codePro, denomination_sociale, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) values (1002, 'Denom', 'jon', 'halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', 4, 'place du marchal', 22780, '');

-- professionnel secteur prive

create or replace view pact.secteur_prive as
  select * from pact._secteur_prive natural join pact.professionnel;


create or replace function pact.insert_secteur_prive()
  returns trigger as $$
begin
  insert into pact.professionnel (codePro, denomination_sociale, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) 
    values (new.codePro, new.denomination_sociale, new.nom, new.prenom, new.email, new.telephone, new.mdp, new.ville, new.numero_voie, new.voie, new.code_postal, new.complement);
  select idC from pact.professionnel where codePro = new.codePro into new.idC;
  insert into pact._secteur_prive (idC, iban, bic, siren, raison_sociale) values (new.idC, new.iban, new.bic, new.siren, new.raison_sociale);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_secteur_prive
instead of insert on pact.secteur_prive
  for each row execute procedure pact.insert_secteur_prive();
  
  
insert into pact.secteur_prive (codePro, iban, bic, siren, raison_sociale, nom, prenom, email, telephone, mdp, ville, numero_voie, voie, code_postal, complement) values (1003,'iban', 'bic', '125475842', 'Raison sociale', 'jon', 'halford', 'jon.hal@gmail.com', '065110126', 'skjosdkkvd', 'Lannion', 4, 'place du marchal', 22300, '');

--- Tags

-- Tags default

create or replace view pact.tag_default as
  select * from pact._tag_default natural join pact._tag;
  
create or replace function pact.insert_tag_default()
  returns trigger as $$
begin
  insert into pact._tag (libelle) values (new.libelle) returning idTag into new.idTag;
  insert into pact._tag_default (idTag) values (new.idTag);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_tag_default
instead of insert on pact.tag_default
  for each row execute procedure pact.insert_tag_default();
  
insert into pact.tag_default (libelle) values ('Son et lumière');

-- Tags default

create or replace view pact.tag_resto as
  select * from pact._tag_resto natural join pact._tag;
  
create or replace function pact.insert_tag_resto()
  returns trigger as $$
begin
  insert into pact._tag (libelle) values (new.libelle) returning idTag into new.idTag;
  insert into pact._tag_resto (idTag) values (new.idTag);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_tag_resto
instead of insert on pact.tag_resto
  for each row execute procedure pact.insert_tag_resto();
  
insert into pact.tag_resto (libelle) values ('Français');


--- Avis

create or replace function pact.count_likes(idAvis integer)
  returns integer as $$
declare
  comp integer;
begin
  select count(*) from pact._recommande r where r.idA = idAvis into comp;
  RETURN comp;
end;
$$ language 'plpgsql';

create or replace function pact.count_dislikes(idAvis integer)
  returns integer as $$
declare
  comp integer;
begin
  select count(*) from pact._recommande_pas r where r.idA = idAvis into comp;
  RETURN comp;
end;
$$ language 'plpgsql';

create or replace view pact.avis as 
  select idA, note, titre, corps, date_publication, date_visite, contexte, pact.count_likes(idA) as nbr_likes, pact.count_dislikes(idA) as nbr_dislikes, consulte, blackliste from _avis;

-- needs member id
insert into pact.avis (note, titre, corps, date_publication, date_visite, contexte) values (4, 'hahah', 'This place sucked', now(), now(), 'seul');

insert into pact._recommande (idA, idC) values (1, 1);

--- type_offre

insert into _type_offre (nom_type, cout) values ('Gratuit', 0);
insert into _type_offre (nom_type, cout) values ('Standard', 10);
insert into _type_offre (nom_type, cout) values ('Premium', 20);

--- Offres

create or replace function pact.count_avis(idOffre integer)
  returns integer as $$
declare
  comp integer;
begin
  select count(*) from pact._experience e where e.idO = idOffre into comp;
  RETURN comp;
end;
$$ language 'plpgsql';

create or replace function pact.moy_notes(idOffre integer)
  returns float as $$
declare
  comp float;
begin
  select avg(a.note) from pact._experience e inner join pact.avis a on e.idA = a.idA where e.idO = idOffre  into comp;
  RETURN comp;
end;
$$ language 'plpgsql';

--TODO ajouter adresse et créateur de l'offre

create or replace view offre as
  select idO, titre, resume, "type", nom_type, cout, option, description, prix_min, pact.moy_notes(idO) as moy_note, pact.count_avis(idO) as nbrAvis, 
  accessibilite, categorie, date_creation, date_publication, o.idAdresse, ville, numero_voie, voie, code_postal, complement, idC from _offre o 
  inner join _type_offre on "type" = idT 
  inner join _adresse a on a.idAdresse = o.idAdresse;
  
create or replace function pact.insert_offre()
  returns trigger as $$
begin
  -- test adresse
  if (select not exists(select * from pact._adresse where ville = new.ville and voie = new.voie and code_postal = new.code_postal and complement = new.complement)) then
    insert into pact._adresse (ville, numero_voie, voie, code_postal, complement) values (new.ville, new.numero_voie, new.voie, new.code_postal, new.complement) returning idAdresse into new.idAdresse;
  else
    select * from pact._adresse where ville = new.ville and voie = new.voie and code_postal = new.code_postal and complement = new.complement into new.idAdresse;
  end if;

  insert into pact._offre (titre, resume, "type", option, description, prix_min, accessibilite, categorie, date_creation, date_publication, idAdresse, idC)
  values (new.titre, new.resume, new."type", new.option, new.description, new.prix_min, new.accessibilite, new.categorie, new.date_creation, new.date_publication, new.idAdresse, new.idC);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_offre
instead of insert on pact.offre
  for each row execute procedure pact.insert_offre();

--
insert into pact.offre (titre, resume, "type", option, description, prix_min, accessibilite, categorie, date_creation, date_publication, ville, numero_voie, voie, code_postal, complement, idC) values
('La Magie des arbres', 'Sur le site exceptionnel de la plage de Tourony, au cœur de la côte de Granit rose.',
  2, 'À la Une', 'Venez découvrir la Magie des arbres dans ce site exceptionnel de la côte de Granit rose : première partie musicale autour du Bagad de Perros-Guirec',
   5.00, 'Accessible pour personnes en situation de handicap par un ascenseur', 'Spectacle', now(), now(), 'Lannion', 5, 'rue des cordiers', 22854, 'complement', 5);

insert into pact.avis (note, titre, corps, date_publication, date_visite, contexte) values (2, 'Loser', 'This place was cool', now(), now(), 'Famille');

insert into pact._experience (idC, idO, idA) values (2,1,1);
insert into pact._experience (idC, idO, idA) values (1,1,2);

select * from pact.offre;

-- activite

create or replace view pact.activite as
  select idO, titre, resume, "type", option, description, prix_min, accessibilite, categorie, date_creation, date_publication, duree, age_min, prestation_incluse, prestation_excluse
   from pact._activite natural join pact.offre;
  
create or replace function pact.insert_activite()
  returns trigger as $$
begin
  insert into pact._offre (titre, resume, "type", option, description, prix_min, accessibilite, categorie, date_creation, date_publication) 
  values (new.titre, new.resume, new."type", new.option, new.description, new.prix_min, new.accessibilite, new.categorie, new.date_creation, new.date_publication) returning idO into new.idO;
  insert into pact._activite (idO, duree, age_min, prestation_incluse, prestation_excluse) values (new.idO, new.duree, new.age_min, new.prestation_incluse, new.prestation_excluse);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_activite
instead of insert on pact.activite
  for each row execute procedure pact.insert_activite();

--  
insert into pact.activite(titre, resume, "type", option, description, prix_min, accessibilite, categorie, date_creation, date_publication, duree, age_min, prestation_incluse, prestation_excluse)
values ('La Magie des arbres', 'Sur le site exceptionnel de la plage de Tourony, au cœur de la côte de Granit rose.',
 2, 'À la Une', 'Lorem impum not too long', 5.00, 'Accessible pour personnes en situation de handicap par un ascenseur', 'Activite', now(), now(),
  interval '7 days', 4, 'Nada', 'rein');

-- select * from activite;


-- visite

create or replace view pact.visite as
  select idO, titre, resume, "type", option, description, prix_min, accessibilite, categorie, date_creation, date_publication, duree, langues
   from _visite natural join offre;
  
create or replace function pact.insert_visite()
  returns trigger as $$
begin
  insert into pact._offre (titre, resume, "type", option, description, prix_min, accessibilite, categorie, denomination, date_publication) 
  values (new.titre, new.resume, new."type", new.option, new.description, new.prix_min, new.accessibilite, new.categorie, new.date_publication) returning idO into new.idO;
  insert into pact._visite (idO, duree, langues) values (new.idO, new.duree, new.langues);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_visite
instead of insert on pact.visite
  for each row execute procedure pact.insert_visite();
  
-- spectacle

create or replace view pact.spectacle as
  select idO, titre, resume, "type", option, description, prix_min, accessibilite, categorie, date_creation, date_publication, duree, capacite
   from pact._spectacle natural join pact.offre;
  
create or replace function pact.insert_spectacle()
  returns trigger as $$
begin
  insert into pact._offre (titre, resume, "type", option, description, prix_min, accessibilite, categorie, denomination, date_publication) 
  values (new.titre, new.resume, new."type", new.option, new.description, new.prix_min, new.accessibilite, new.categorie, new.date_publication) returning idO into new.idO;
  insert into pact._spectacle (idO, duree, capacite) values (new.idO, new.duree, new.capacite);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_spectacle
instead of insert on pact.spectacle
  for each row execute procedure pact.insert_spectacle();
  
-- parc_d_attraction

create or replace view pact.parc_d_attraction as
  select idO, titre, resume, "type", option, description, prix_min, accessibilite, categorie, date_creation, date_publication, "plan", nbr_attractions, age_min
   from pact._parc_d_attraction natural join pact.offre;
  
create or replace function pact.insert_parc_d_attraction()
  returns trigger as $$
begin
  insert into pact._offre (titre, resume, "type", option, description, prix_min, accessibilite, categorien, date_publication) 
  values (new.titre, new.resume, new."type", new.option, new.description, new.prix_min, new.accessibilite, new.categorie, new.denomination, new.date_publication) returning idO into new.idO;
  insert into pact._parc_d_attraction (idO, "plan", nbr_attractions, age_min) values (new.idO, new."plan", new.nbr_attractions, new.age_min);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_parc_d_attraction
instead of insert on pact.parc_d_attraction
  for each row execute procedure pact.insert_parc_d_attraction();
  
-- restauration

create or replace view pact.restauration as
  select idO, titre, resume, "type", option, description, prix_min, accessibilite, categorie, date_creation, date_publication, 
  carte_restaurant, gamme_prix, petit_dejeuner, brunch, dejeuner, diner, boissons
   from pact._restauration natural join pact.offre;
  
create or replace function pact.insert_restauration()
  returns trigger as $$
begin
  insert into pact._offre (titre, resume, "type", option, description, prix_min, accessibilite, categorie, date_publication) 
  values (new.titre, new.resume, new."type", new.option, new.description, new.photo, new.prix_min, new.accessibilite, new.categorie, new.denomination, new.date_publication) returning idO into new.idO;
  insert into pact._restauration (idO, carte_restaurant, gamme_prix, petit_dejeuner, brunch, dejeuner, diner, boissons) 
  values (new.idO, new.carte_restaurant, new.gamme_prix, new.petit_dejeuner, new.brunch, new.dejeuner, new.diner, new.boissons);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_restauration
instead of insert on pact.restauration
  for each row execute procedure pact.insert_restauration();
  

--- experience ---

create or replace view pact.experience as
  select e.idC, pseudo, e.idA, avis.titre as titre_avis, e.idO, offre.titre as titre_offre from _experience e
  inner join membre on e.idC = membre.idC 
  inner join avis on e.idA = avis.idA
  inner join offre on e.idO = offre.idO;
  
select * from pact.experience;
