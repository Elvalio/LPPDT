DROP SCHEMA IF EXISTS pact CASCADE;
CREATE SCHEMA pact;
SET SCHEMA 'pact';

----------- ADRESSE -----------

create table pact._adresse(
  idAdresse serial,
  ville varchar(20) not null,
  numero_voie integer not null,
  voie varchar(30) not null,
  code_postal integer not null,
  complement varchar(30),

  constraint _adresse_pk primary key (idAdresse)
);

----------- IMAGES -----------
create table pact._image(
  idImage serial,
  src_image varchar(60) not null unique,

  constraint _image_pk primary key (idImage)
);

----------- COMPTES -----------

create table pact._compte
(
  idC serial,
  nom varchar(20) not null,
  prenom varchar(20) not null,
  email varchar(50) not null,
  telephone varchar(10) not null,
  mdp varchar(25) not null,
  
  -- FK
  idAdresse integer not null,
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
  codePro integer unique not null, -- need trigger so that this is frozen or see if you can make it an id
  denomination_sociale varchar(30) not null,

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
  siren varchar(9) not null,
  raison_sociale varchar(30) not null,
    
  constraint _secteur_prive_pk primary key (idC),
  constraint _secteur_prive_fk_inherit foreign key
  (idC) references pact._professionnel(idC)
);

create table pact._membre(

  idC integer,
  pseudo varchar(20) unique not null,-- need trigger so that this is frozen or see if you can make it an id
    
  constraint _membre_pk primary key (idC),
  constraint _membre_fk_inherit foreign key
  (idC) references pact._compte(idC)
);

----------- AVIS -----------
create table pact._avis(

  idA serial,
  note integer,
  titre varchar(30),
  corps varchar(500),
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
  libelle varchar(20) not null,
  
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
  nom_type varchar(20) not null,
  cout_HT float not null,
  cout_TTC float not null,

  constraint _type_offre_pk primary key (idT)
);

----------- Option -----------
create table pact._option(
  idOption serial,
  nom_option varchar(20) not null,
  cout_HT float not null,
  cout_TTC float not null,

  constraint _option_pk primary key (idOption)
);

----------- Offre est ses enfants -----------

create table pact._offre(
  idO serial,
  titre varchar(50),
  resume varchar(250),
  description varchar(1000),
  site_web varchar(200),
  prix_min float,
  --/moy_note
  --/nbrAvis
  accessibilite varchar(200),
  categorie varchar(30), -- need to be frozen
  date_creation date default now(),
  date_publication date,
  en_ligne boolean default false,
  date_hors_ligne date,
  
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
  prestation_incluse varchar(100), -- not null ?
  prestation_excluse varchar(100), -- not null ?
  
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

-- HORAIRE RESTO
create table pact._horaire(
  idHoraire serial,
  heureOuverture time not null,
  heureFermeture time not null,
  ouvertWeekend boolean default false,
    
  --FK
  idO integer unique,

  constraint _horaire_pk primary key (idHoraire),
  
  constraint _horaire_fk_restauration foreign key
    (idO) references pact._restauration(idO)
);

create table pact._photo_offre(
  idImage integer,
  idO integer,

  constraint _photo_offre_pk primary key (idImage, idO),

  constraint _photo_offre_fk_image foreign key
  (idImage) references pact._image(idImage),

  constraint _photo_offre_fk_offre foreign key
  (idO) references pact._offre(idO)

);

create table pact._option_offre(
  --table qui gère les options des offres
  idO integer,
  idOption integer,
  date_lancement date, -- if null when putting online ask user to set these
  duree_option interval,

  constraint _option_offre_pk primary key (idO),

  constraint _option_offre_fk_offre foreign key
  (idO) references pact._offre(idO),

  constraint _option_offre_fk_option foreign key
  (idOption) references pact._option(idOption)
);

----------- FACTURATION -----------

create table pact._facturation(
  numFacture integer,
  --/prixOffreTTC
  --/prixOffreHT
  --/prixOptionTTC
  --/prixOptionHT
  date_facture date default now(),
  idO integer,

  constraint _facturation_pk primary key (numFacture),

  constraint _facturation_fk_secteur_prive foreign key
  (idO) references pact._offre(idO)
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
  if (select not exists(select * from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement)) then
    insert into pact._adresse (ville, numero_voie, voie, code_postal, complement) values (new.ville, new.numero_voie, new.voie, new.code_postal, new.complement) returning idAdresse into new.idAdresse;
  else
    select idAdresse from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement into new.idAdresse;
  end if;
  insert into pact._compte (nom, prenom, email, telephone, mdp, idAdresse) values (new.nom, new.prenom, new.email, new.telephone, new.mdp, new.idAdresse) returning idC into new.idC;
  insert into pact._membre (idc, pseudo) values (new.idc, new.pseudo);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_membre
instead of insert on pact.membre
  for each row execute procedure pact.insert_membre();


create or replace function pact.update_membre()
  returns trigger as $$
begin
  if (select not exists(select * from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement)) then
    insert into pact._adresse (ville, numero_voie, voie, code_postal, complement) values (new.ville, new.numero_voie, new.voie, new.code_postal, new.complement) returning idAdresse into new.idAdresse;
  else
    select idAdresse from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement into new.idAdresse;
  end if;

  update pact._compte set nom = new.nom, prenom = new.prenom, email = new.email, telephone = new.telephone, mdp = new.mdp, idAdresse = new.idAdresse where idC = old.idC;
  -- on ne peut pas modifier le pseudo
  RETURN NEW;
end;
$$ language 'plpgsql';

create or replace trigger tg_update_membre
instead of update on pact.membre
  for each row execute procedure pact.update_membre();
  
-- professionnel
create or replace view pact.professionnel as
  select idC, codePro, denomination_sociale, nom, prenom, email, telephone, mdp, idAdresse, ville, numero_voie, voie, code_postal, complement from pact._professionnel natural join pact._compte natural join pact._adresse;
  


create or replace function pact.insert_professionnel()
  returns trigger as $$
begin
  if (select not exists(select * from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement)) then
    insert into pact._adresse (ville, numero_voie, voie, code_postal, complement) values (new.ville, new.numero_voie, new.voie, new.code_postal, new.complement) returning idAdresse into new.idAdresse;
  else
    select idAdresse from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement into new.idAdresse;
  end if;
  insert into pact._compte (nom, prenom, email, telephone, mdp, idAdresse) values (new.nom, new.prenom, new.email, new.telephone, new.mdp, new.idAdresse) returning idC into new.idC;
  insert into pact._professionnel (idc, codePro, denomination_sociale) values (new.idc, new.codePro, new.denomination_sociale);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_professionnel
instead of insert on pact.professionnel
  for each row execute procedure pact.insert_professionnel();

create or replace function pact.update_professionnel()
  returns trigger as $$
begin
  if (select not exists(select * from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement)) then
    insert into pact._adresse (ville, numero_voie, voie, code_postal, complement) values (new.ville, new.numero_voie, new.voie, new.code_postal, new.complement) returning idAdresse into new.idAdresse;
  else
    select idAdresse from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement into new.idAdresse;
  end if;
  update pact._compte set nom = new.nom, prenom = new.prenom, email = new.email, telephone = new.telephone, mdp = new.mdp, idAdresse = new.idAdresse where idC = old.idC;
  update pact._professionnel set denomination_sociale = new.denomination_sociale where idC = old.idC;
  -- on ne peut pas modifier le code pro
  RETURN NEW;
end;
$$ language 'plpgsql';

create or replace trigger tg_professionnel
instead of update on pact.professionnel
  for each row execute procedure pact.update_professionnel();

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

create or replace function pact.update_secteur_public()
  returns trigger as $$
begin
  if (select not exists(select * from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement)) then
    insert into pact._adresse (ville, numero_voie, voie, code_postal, complement) values (new.ville, new.numero_voie, new.voie, new.code_postal, new.complement) returning idAdresse into new.idAdresse;
  else
    select idAdresse from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement into new.idAdresse;
  end if;
  update pact._compte set nom = new.nom, prenom = new.prenom, email = new.email, telephone = new.telephone, mdp = new.mdp, idAdresse = new.idAdresse where idC = old.idC;
  update pact._professionnel set denomination_sociale = new.denomination_sociale where idC = old.idC;
  -- on ne peut pas modifier le code pro
  RETURN NEW;
end;
$$ language 'plpgsql';

create or replace trigger tg_update_secteur_public
instead of update on pact.secteur_public
  for each row execute procedure pact.update_secteur_public();


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

create or replace function pact.update_secteur_prive()
  returns trigger as $$
begin
  if (select not exists(select * from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement)) then
    insert into pact._adresse (ville, numero_voie, voie, code_postal, complement) values (new.ville, new.numero_voie, new.voie, new.code_postal, new.complement) returning idAdresse into new.idAdresse;
  else
    select idAdresse from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement into new.idAdresse;
  end if;
  update pact._compte set nom = new.nom, prenom = new.prenom, email = new.email, telephone = new.telephone, mdp = new.mdp, idAdresse = new.idAdresse where idC = old.idC;
  update pact._professionnel set denomination_sociale = new.denomination_sociale where idC = old.idC;
  update pact._secteur_prive set iban = new.iban, bic = new.bic, raison_sociale = new.raison_sociale where idC = old.idC;
  -- on ne peut pas modifier le code pro
  RETURN NEW;
end;
$$ language 'plpgsql';

create or replace trigger tg_update_secteur_prive
instead of update on pact.secteur_prive
  for each row execute procedure pact.update_secteur_prive();
  
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

create or replace function pact.delete_avis()
  returns trigger as $$
begin
  
  delete from pact._experience
  where idA = OLD.idA;
  
  delete from pact._avis
  where idA = OLD.idA;
 
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_delete_avis
instead of delete on pact.avis
  for each row execute procedure pact.delete_avis();

--- option offre
create or replace view option_offre as
 select * from _option_offre natural join _option;

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
  if (comp is null) then
    comp = 0;
  end if;
  RETURN comp;
end;
$$ language 'plpgsql';

create or replace view pact.offre as
  select  o.idO, o.titre, resume, "type", op.nom_option as option, nom_type, t.cout_HT, t.cout_TTC, description, site_web, prix_min, pact.moy_notes(o.idO) as moy_note, pact.count_avis(o.idO) as nbrAvis, 
  accessibilite, categorie, date_creation, date_publication, date_hors_ligne, o.idAdresse, ville, numero_voie, voie, code_postal, complement, en_ligne, idC from pact._offre o 
  inner join pact._type_offre t on "type" = idT
  inner join pact._adresse a on a.idAdresse = o.idAdresse
  left outer join option_offre op on op.idO = o.idO;
  
create or replace function pact.insert_offre()
  returns trigger as $$
begin

 -- test adresse
  if (select not exists(select * from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement)) then
    insert into pact._adresse (ville, numero_voie, voie, code_postal, complement) values (new.ville, new.numero_voie, new.voie, new.code_postal, new.complement) returning idAdresse into new.idAdresse;
  else
    select idAdresse from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement into new.idAdresse;
  end if;

  insert into pact._offre (titre, resume, "type", description, site_web, prix_min, accessibilite, categorie, date_creation, date_publication, date_hors_ligne, idAdresse, idC)
  values (new.titre, new.resume, new."type", new.description, new.site_web, new.prix_min, new.accessibilite, new.categorie, new.date_creation, new.date_publication, new.date_hors_ligne, new.idAdresse, new.idC);
  RETURN NEW;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_offre
instead of insert on pact.offre
  for each row execute procedure pact.insert_offre();


-- activite

--insert
create or replace view pact.activite as
  select idO, titre, resume, "type", option, description, site_web, prix_min, accessibilite, categorie, date_creation, date_publication, date_hors_ligne, duree, age_min, prestation_incluse, prestation_excluse, idAdresse, ville, numero_voie, voie, code_postal, complement, en_ligne, idC
   from pact._activite natural join pact.offre;
  
  create or replace function pact.insert_activite()
  returns trigger as $$
begin
  if (select not exists(select * from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement)) then
    insert into pact._adresse (ville, numero_voie, voie, code_postal, complement) values (new.ville, new.numero_voie, new.voie, new.code_postal, new.complement) returning idAdresse into new.idAdresse;
  else
    select idAdresse from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement into new.idAdresse;
  end if;
  insert into pact._offre (titre, resume, "type", description, site_web, prix_min, accessibilite, categorie, date_creation, date_publication, date_hors_ligne, idAdresse, idC) 
  values (new.titre, new.resume, new."type", new.description, new.site_web, new.prix_min, new.accessibilite, 'Activite', new.date_creation, new.date_publication, new.date_hors_ligne, new.idAdresse, new.idC) returning idO into new.idO;
  
  insert into pact._activite (idO, duree, age_min, prestation_incluse, prestation_excluse) values (new.idO, new.duree, new.age_min, new.prestation_incluse, new.prestation_excluse);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_activite
instead of insert on pact.activite
  for each row execute procedure pact.insert_activite();

--update
create or replace function pact.update_activite()
  returns trigger as $$
begin
  if (select not exists(select * from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement)) then
    insert into pact._adresse (ville, numero_voie, voie, code_postal, complement) values (new.ville, new.numero_voie, new.voie, new.code_postal, new.complement) returning idAdresse into new.idAdresse;
  else
    select idAdresse from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement into new.idAdresse;
  end if;

  update pact._offre set titre = new.titre, resume = new.resume, "type" = new."type", description = new.description, site_web = new.site_web,  prix_min = new.prix_min,
   accessibilite = new.accessibilite, date_publication = new.date_publication, date_hors_ligne = new.date_hors_ligne, idAdresse = new.idAdresse where idO = old.idO;
  
  update pact._activite set duree = new.duree, age_min = new.age_min, prestation_incluse = new.prestation_incluse, prestation_excluse = new.prestation_excluse where idO = old.idO;
  
  RETURN NEW;
end;
$$ language 'plpgsql';

create or replace trigger tg_update_activite
instead of update on pact.activite
  for each row execute procedure pact.update_activite();


--  

-- visite
--insert
create or replace view pact.visite as
  select idO, titre, resume, "type", option, description, site_web, prix_min, accessibilite, categorie, date_creation, date_publication, date_hors_ligne, duree, langues, idAdresse, ville, numero_voie, voie, code_postal, complement, en_ligne, idC
   from _visite natural join offre;
  
create or replace function pact.insert_visite()
  returns trigger as $$
begin
  if (select not exists(select * from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement)) then
    insert into pact._adresse (ville, numero_voie, voie, code_postal, complement) values (new.ville, new.numero_voie, new.voie, new.code_postal, new.complement) returning idAdresse into new.idAdresse;
  else
    select idAdresse from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement into new.idAdresse;
  end if;
  
  insert into pact._offre (titre, resume, "type", description, site_web, prix_min, accessibilite, categorie, date_creation, date_publication, date_hors_ligne, idAdresse, idC) 
  values (new.titre, new.resume, new."type", new.description, new.site_web, new.prix_min, new.accessibilite, 'Visite', new.date_creation, new.date_publication, new.date_hors_ligne, new.idAdresse, new.idC) returning idO into new.idO;
  
insert into pact._visite (idO, duree, langues) values (new.idO, new.duree, new.langues);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_visite
instead of insert on pact.visite
  for each row execute procedure pact.insert_visite();

--update
create or replace function pact.update_visite()
  returns trigger as $$
begin
  if (select not exists(select * from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement)) then
    insert into pact._adresse (ville, numero_voie, voie, code_postal, complement) values (new.ville, new.numero_voie, new.voie, new.code_postal, new.complement) returning idAdresse into new.idAdresse;
  else
    select idAdresse from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement into new.idAdresse;
  end if;

  update pact._offre set titre = new.titre, resume = new.resume, "type" = new."type", description = new.description, site_web = new.site_web, prix_min = new.prix_min,
   accessibilite = new.accessibilite, date_publication = new.date_publication, date_hors_ligne = new.date_hors_ligne, idAdresse = new.idAdresse where idO = old.idO;
  
  update pact._visite set duree = new.duree, langues = new.langues where idO = old.idO;
  
  RETURN NEW;
end;
$$ language 'plpgsql';

create or replace trigger tg_update_visite
instead of update on pact.visite
  for each row execute procedure pact.update_visite();
  
-- spectacle
--insert
create or replace view pact.spectacle as
  select idO, titre, resume, "type", option, description, site_web, prix_min, accessibilite, categorie, date_creation, date_publication, date_hors_ligne, duree, capacite, idAdresse, ville, numero_voie, voie, code_postal, complement, en_ligne, idC
   from pact._spectacle natural join pact.offre;
  
create or replace function pact.insert_spectacle()
  returns trigger as $$
begin

  if (select not exists(select * from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement)) then
    insert into pact._adresse (ville, numero_voie, voie, code_postal, complement) values (new.ville, new.numero_voie, new.voie, new.code_postal, new.complement) returning idAdresse into new.idAdresse;
  else
    select idAdresse from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement into new.idAdresse;
  end if;
  
  insert into pact._offre (titre, resume, "type", description, site_web, prix_min, accessibilite, categorie, date_creation, date_publication, date_hors_ligne, idAdresse, idC) 
  values (new.titre, new.resume, new."type", new.description, new.site_web, new.prix_min, new.accessibilite, 'Spectacle', new.date_creation, new.date_publication, new.date_hors_ligne, new.idAdresse, new.idC) returning idO into new.idO;
  
  insert into pact._spectacle (idO, duree, capacite) values (new.idO, new.duree, new.capacite);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_spectacle
instead of insert on pact.spectacle
  for each row execute procedure pact.insert_spectacle();

--update
create or replace function pact.update_spectacle()
  returns trigger as $$
begin
  if (select not exists(select * from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement)) then
    insert into pact._adresse (ville, numero_voie, voie, code_postal, complement) values (new.ville, new.numero_voie, new.voie, new.code_postal, new.complement) returning idAdresse into new.idAdresse;
  else
    select idAdresse from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement into new.idAdresse;
  end if;

  update pact._offre set titre = new.titre, resume = new.resume, "type" = new."type", description = new.description, site_web = new.site_web, prix_min = new.prix_min,
   accessibilite = new.accessibilite, date_publication = new.date_publication, date_hors_ligne = new.date_hors_ligne, idAdresse = new.idAdresse where idO = old.idO;
  
  update pact._spectacle set duree = new.duree, capacite = new.capacite where idO = old.idO;
  
  RETURN NEW;
end;
$$ language 'plpgsql';

create or replace trigger tg_update_spectacle
instead of update on pact.spectacle
  for each row execute procedure pact.update_spectacle();

-- parc_d_attraction
--insert
create or replace view pact.parc_d_attraction as
  select idO, titre, resume, "type", option, description, site_web, prix_min, accessibilite, categorie, date_creation, date_publication, date_hors_ligne, "plan", src_image, nbr_attractions, age_min, idAdresse, ville, numero_voie, voie, code_postal, complement, en_ligne, idC
   from pact._parc_d_attraction 
   natural join pact.offre
   inner join pact._image on "plan"=idImage;
  
create or replace function pact.insert_parc_d_attraction()
  returns trigger as $$
begin
  if (select not exists(select * from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement)) then
    insert into pact._adresse (ville, numero_voie, voie, code_postal, complement) values (new.ville, new.numero_voie, new.voie, new.code_postal, new.complement) returning idAdresse into new.idAdresse;
  else
    select idAdresse from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement into new.idAdresse;
  end if;
  
  insert into pact._offre (titre, resume, "type", description, site_web, prix_min, accessibilite, categorie, date_creation, date_publication, date_hors_ligne, idAdresse, idC) 
  values (new.titre, new.resume, new."type", new.description, new.site_web, new.prix_min, new.accessibilite, 'Parc d''attraction', new.date_creation, new.date_publication, new.date_hors_ligne, new.idAdresse, new.idC) returning idO into new.idO;
  

  insert into pact._image(src_image) values (new.src_image) returning idImage into new."plan";
  insert into pact._parc_d_attraction (idO, "plan", nbr_attractions, age_min) values (new.idO, new."plan", new.nbr_attractions, new.age_min);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_parc_d_attraction
instead of insert on pact.parc_d_attraction
  for each row execute procedure pact.insert_parc_d_attraction();
--update
create or replace function pact.update_parc_d_attraction()
  returns trigger as $$
begin
  if (select not exists(select * from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement)) then
    insert into pact._adresse (ville, numero_voie, voie, code_postal, complement) values (new.ville, new.numero_voie, new.voie, new.code_postal, new.complement) returning idAdresse into new.idAdresse;
  else
    select idAdresse from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement into new.idAdresse;
  end if;

  update pact._offre set titre = new.titre, resume = new.resume, "type" = new."type", description = new.description, site_web = new.site_web, prix_min = new.prix_min,
   accessibilite = new.accessibilite, date_publication = new.date_publication, date_hors_ligne = new.date_hors_ligne, idAdresse = new.idAdresse where idO = old.idO;
  
  update pact._image set src_image = new.src_image where idImage = old."plan";
  update pact._parc_d_attraction set "plan" = old."plan", nbr_attractions = new.nbr_attractions, age_min = new.age_min  where idO = old.idO;
  
  RETURN NEW;
end;
$$ language 'plpgsql';

create or replace trigger tg_update_parc_d_attraction
instead of update on pact.parc_d_attraction
  for each row execute procedure pact.update_parc_d_attraction();

-- restauration
--insert
create or replace view pact.restauration as
  select idO, titre, resume, "type", option, description, site_web, prix_min, accessibilite, categorie, date_creation, date_publication, date_hors_ligne, 
  carte_restaurant, src_image, gamme_prix, petit_dejeuner, brunch, dejeuner, diner, boissons, idAdresse, ville, numero_voie, voie, code_postal, complement, en_ligne, idC
   from pact._restauration 
    natural join pact.offre
    inner join pact._image on carte_restaurant=idImage;
  
create or replace function pact.insert_restauration()
  returns trigger as $$
begin
  if (select not exists(select * from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement)) then
    insert into pact._adresse (ville, numero_voie, voie, code_postal, complement) values (new.ville, new.numero_voie, new.voie, new.code_postal, new.complement) returning idAdresse into new.idAdresse;
  else
    select idAdresse from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement into new.idAdresse;
  end if;
  
  insert into pact._offre (titre, resume, "type", description, site_web, prix_min, accessibilite, categorie, date_creation, date_publication, date_hors_ligne, idAdresse, idC) 
  values (new.titre, new.resume, new."type", new.description, new.site_web, new.prix_min, new.accessibilite, 'Restauration', new.date_creation, new.date_publication, new.date_hors_ligne, new.idAdresse, new.idC) returning idO into new.idO;
  
  insert into pact._image(src_image) values (new.src_image) returning idImage into new.carte_restaurant;
  insert into pact._restauration (idO, carte_restaurant, gamme_prix, petit_dejeuner, brunch, dejeuner, diner, boissons) 
  values (new.idO, new.carte_restaurant, new.gamme_prix, new.petit_dejeuner, new.brunch, new.dejeuner, new.diner, new.boissons);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_restauration
instead of insert on pact.restauration
  for each row execute procedure pact.insert_restauration();

--update
create or replace function pact.update_restauration()
  returns trigger as $$
begin
  if (select not exists(select * from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement)) then
    insert into pact._adresse (ville, numero_voie, voie, code_postal, complement) values (new.ville, new.numero_voie, new.voie, new.code_postal, new.complement) returning idAdresse into new.idAdresse;
  else
    select idAdresse from pact._adresse where ville = new.ville and numero_voie = new.numero_voie and voie = new.voie and code_postal = new.code_postal and complement = new.complement into new.idAdresse;
  end if;

  update pact._offre set titre = new.titre, resume = new.resume, "type" = new."type", description = new.description, site_web = new.site_web, prix_min = new.prix_min,
   accessibilite = new.accessibilite, date_publication = new.date_publication, date_hors_ligne = new.date_hors_ligne, idAdresse = new.idAdresse where idO = old.idO;
  
  update pact._image set src_image = new.src_image where idImage = old.carte_restaurant;
  update pact._restauration set carte_restaurant = old.carte_restaurant, 
    gamme_prix = new.gamme_prix, 
    petit_dejeuner = new.petit_dejeuner, 
    brunch = new.brunch, 
    dejeuner = new.dejeuner, 
    diner = new.diner, 
    boissons = new.boissons
  where idO = old.idO;
  
  RETURN NEW;
end;
$$ language 'plpgsql';

create or replace trigger tg_update_restauration
instead of update on pact.restauration
  for each row execute procedure pact.update_restauration();

--- experience ---

create or replace view pact.experience as
  select e.idC, pseudo, e.idA, avis.titre as titre_avis, note, corps, avis.date_publication, date_visite, contexte, e.idO, offre.titre as titre_offre from _experience e
  inner join membre on e.idC = membre.idC 
  inner join avis on e.idA = avis.idA
  inner join offre on e.idO = offre.idO;


create or replace function pact.insert_experience()
  returns trigger as $$
begin
  insert into pact.avis (note, titre, corps, date_publication, date_visite, contexte)
  values (new.note, new.titre_avis, new.corps, now(), new.date_visite, new.contexte) returning idA into new.idA;
  insert into pact._experience(idA, idC, idO) values (new.idA, new.idC, new.idO);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_experience
instead of insert on pact.experience
  for each row execute procedure pact.insert_experience();
  
--- photo_offre ---

create or replace view pact.photo_offre as
  select * from _photo_offre natural join _image;
  
--insert
create or replace function pact.insert_photo_offre()
  returns trigger as $$
begin
  insert into pact._image (src_image) values (new.src_image) returning idImage into new.idImage;
  insert into pact._photo_offre (idImage, idO) values (new.idImage, new.idO);
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_insert_photo_offre
instead of insert on pact.photo_offre
  for each row execute procedure pact.insert_photo_offre();

--delete
create or replace function pact.delete_photo_offre()
  returns trigger as $$
declare
  idIm integer;
begin
  select idImage from pact.photo_offre where src_image = old.src_image into idIm;

  delete from pact._photo_offre where idImage = idIm;

  delete from pact._image where idImage = idIm;
  
  RETURN OLD;
end;
$$ language 'plpgsql';

create or replace trigger tg_delete_photo_offre
instead of delete on pact.photo_offre
  for each row execute procedure pact.delete_photo_offre();

--- facturation ---

/*
  Cette fonction calcule le cout TTC d'une offre pour une certaine durée 
  Le nombre de jours entre la date de publication et la date donnée dans la plupart des cas, 
  sauf si la date de mise hors ligne de l'offre est plus vielle avant.
*/

create or replace function pact.prix_offre_TTC(idOffre integer, date_fin date, idFacture integer)
  returns float as $$
declare
  cout float;
  comp float;
  date_offre date;
  date_offre_hors_ligne date;
  date_emmission_facture date;
  n integer;
begin
  comp = 0;
    
  select f.date_facture from pact._facturation f where f.numFacture = idFacture into date_emmission_facture;
  date_emmission_facture = date_trunc('month'::text, date_emmission_facture + '1 mon'::interval);
  -- Si la date d'emmission de la facture est avant la date de publication, 
  -- ça veut dire que cette offre n'etait pas active pendant ce mois
  -- (à modifier)
  select o.date_publication from pact.offre o where o.idO = idOffre into date_offre;

  if (date_emmission_facture > date_offre) then
 
    select o.cout_TTC from pact.offre o where o.idO = idOffre into cout;
  
    select o.date_hors_ligne from pact.offre o where o.idO = idOffre into date_offre_hors_ligne;

    if (date_offre_hors_ligne is null) OR (date_offre_hors_ligne > date_fin) then
      select(date_fin - date_offre) as days into n;
    else
      select(date_offre_hors_ligne - date_offre) as days into n;   
    end if;
    
    for counter in 1..n loop
      comp = comp + cout;
    end loop;
  end if;
  
  RETURN comp;
end;
$$ language 'plpgsql';

/*DEPRECIATED : compte le nombre d'offres pour une facture (facture à plusieurs offres)*/
create or replace function pact.nombre_offre_facture(idCompte integer, idFacture integer)
  returns integer as $$
declare
  comp integer;
begin
  select count(*) from pact.offre o inner join pact._facturation f  on f.idC = o.idC where o.idC = idCompte and f.numFacture = idFacture and 
    EXTRACT(MONTH FROM f.date_facture) = EXTRACT(MONTH FROM o.date_publication) 
    and EXTRACT(YEAR FROM f.date_facture) = EXTRACT(YEAR FROM o.date_publication) into comp;
  RETURN comp;
end;
$$ language 'plpgsql';

/*
  Cette fonction calcule le cout HT d'une offre pour une certaine durée
  Le nombre de jours entre la date de publication et la date donnée dans la plupart des cas, 
  sauf si la date de mise hors ligne de l'offre est plus vielle avant.
*/
create or replace function pact.prix_offre_HT(idOffre integer, date_fin date, idFacture integer)
  returns float as $$
declare
  cout float;
  comp float;
  date_offre date;
  date_offre_hors_ligne date;
  date_emmission_facture date;
  n integer;
begin
  comp = 0;
    
  select f.date_facture from pact._facturation f where f.numFacture = idFacture into date_emmission_facture;
  date_emmission_facture = date_trunc('month'::text, date_emmission_facture + '1 mon'::interval);

  -- Si la date d'emmission de la facture est avant la date de publication, 
  -- ça veut dire que cette offre n'etait pas active pendant ce mois
  -- (à modifier)
  select o.date_publication from pact.offre o where o.idO = idOffre into date_offre;
  if (date_emmission_facture > date_offre) then
 
    select o.cout_HT from pact.offre o where o.idO = idOffre into cout;
    
    
  
    select o.date_hors_ligne from pact.offre o where o.idO = idOffre into date_offre_hors_ligne;
    -- try date truncate with month if lasts over a month
    if (date_offre_hors_ligne is null) OR (date_offre_hors_ligne > date_fin) then
      select(date_fin - date_offre) as days into n;
    else
      select(date_offre_hors_ligne - date_offre) as days into n;   
    end if;
    
    for counter in 1..n loop
      comp = comp + cout;
    end loop;
  end if;
  
  RETURN comp;
end;
$$ language 'plpgsql';


/*
  Cette fonction calcule le prix TTC de la facture pour le mois et l'année, ne prend pas en compte les options
  DEPRECIATED : pour facture à plusieur offres
*/
create or replace function pact.prix_total_TTC(idCompte integer, idFacture integer)
  returns float as $$
declare
  comp float;
begin

  select sum(pact.prix_offre_TTC(idCompte, o.idO, now()::date)) from pact.offre o inner join pact._facturation f on f.idC = o.idC where o.idC = idCompte and f.numFacture = idFacture and 
    EXTRACT(MONTH FROM f.date_facture) = EXTRACT(MONTH FROM o.date_publication)
    and EXTRACT(YEAR FROM f.date_facture) = EXTRACT(YEAR FROM o.date_publication) into comp;
  if (comp is null) then
    comp = 0;
  end if;

  RETURN comp;
end;
$$ language 'plpgsql';


/*
  Cette fonction calcule le prix HT de la facture pour le mois et l'année, ne prend pas en compte les options
  DEPRECIATED : pour facture à plusieur offres
*/
create or replace function pact.prix_total_HT(idCompte integer, idFacture integer)
  returns float as $$
declare
  comp float;
begin

  select sum(pact.prix_offre_HT(idCompte, o.idO, now()::date)) from pact.offre o inner join pact._facturation f on f.idC = o.idC where o.idC = idCompte and f.numFacture = idFacture and 
    EXTRACT(MONTH FROM f.date_facture) = EXTRACT(MONTH FROM o.date_publication)
    and EXTRACT(YEAR FROM f.date_facture) = EXTRACT(YEAR FROM o.date_publication) into comp;
  if (comp is null) then
    comp = 0;
  end if;

  RETURN comp;
end;
$$ language 'plpgsql';

/*
  Fonction calcule le prix TTC d'une option pour une offre donnée,
  si la date de lancement n'a pas étée dépasée, le prix est 0
  si la date de lancement et la date de la facture ne sont pas du mêle mois et année, le prix de l'option est 0
*/
create or replace function pact.prix_option_offre_TTC(idOffre integer, idFacture integer)
  returns float as $$
declare
  cout float;
  duree interval;
  comp float;
  days integer;
  res float;
  date_lancement date;
  date_facture date;
begin
  res = 0;
  select f.date_facture from pact._facturation f where f.numFacture = idFacture into date_facture;
  select o.date_lancement from pact.option_offre o where o.idO = idOffre into date_lancement;
  if (EXTRACT(MONTH FROM date_facture) = EXTRACT(MONTH FROM date_lancement) and EXTRACT(YEAR FROM date_facture) = EXTRACT(YEAR FROM date_lancement)) then
    if (current_date > date_lancement and date_lancement is not null) then
      select o.cout_TTC from pact.option_offre o where o.idO = idOffre into cout;
      select o.duree_option from pact.option_offre o where o.idO = idOffre into duree;
      select EXTRACT(DAY FROM duree) into days;
      res = days/7 * cout;
    end if;
  end if;
  RETURN res;
end;
$$ language 'plpgsql';


/*
  Fonction calcule le prix HT d'une option pour une offre donnée,
  si la date de lancement n'a pas étée dépasée, le prix est 0
  si la date de lancement et la date de la facture ne sont pas du mêle mois et année, le prix de l'option est 0
*/
create or replace function pact.prix_option_offre_HT(idOffre integer, idFacture integer)
  returns float as $$
declare
  cout float;
  duree interval;
  comp float;
  days integer;
  res float;
  date_lancement date;
  date_facture date;
begin
  res = 0;
  select f.date_facture from pact._facturation f where f.numFacture = idFacture into date_facture;
  select o.date_lancement from pact.option_offre o where o.idO = idOffre into date_lancement;
  if (EXTRACT(MONTH FROM date_facture) = EXTRACT(MONTH FROM date_lancement) and EXTRACT(YEAR FROM date_facture) = EXTRACT(YEAR FROM date_lancement)) then
    if (current_date > date_lancement and date_lancement is not null) then
      select o.cout_HT from pact.option_offre o where o.idO = idOffre into cout;
      select o.duree_option from pact.option_offre o where o.idO = idOffre into duree;
      select EXTRACT(DAY FROM duree) into days;
      res = days/7 * cout;
    end if;
  end if;
  RETURN res;
end;
$$ language 'plpgsql';

create or replace function pact.nbrJours(idOffre integer, date_fin date, idFacture integer)
  returns integer as $$
declare
  comp float;
  date_offre date;
  date_offre_hors_ligne date;
  date_emmission_facture date;
  n integer;
begin    
  select f.date_facture from pact._facturation f where f.numFacture = idFacture into date_emmission_facture;
  date_emmission_facture = date_trunc('month'::text, date_emmission_facture + '1 mon'::interval);
  
  select o.date_publication from pact.offre o where o.idO = idOffre into date_offre;
  if (date_emmission_facture > date_offre) then

    select o.date_hors_ligne from pact.offre o where o.idO = idOffre into date_offre_hors_ligne;
    -- try date truncate with month if lasts over a month
    if (date_offre_hors_ligne is null) OR (date_offre_hors_ligne > date_fin) then
      select(date_fin - date_offre) as days into n;
    else
      select(date_offre_hors_ligne - date_offre) as days into n;   
    end if;
  end if;
  
  if (n is null) then
    n = 0;
  end if;
  RETURN n;
end;
$$ language 'plpgsql';


create or replace view pact.facturation as 
  select numfacture, date_facture, date_trunc('month', date_facture + interval '1 month') as date_emmission, pact.prix_offre_TTC(f.idO, now()::date, numfacture) as prix_offre_ttc, pact.prix_offre_HT(f.ido, now()::date, numfacture) as prix_offre_ht, 
  pact.prix_option_offre_TTC(f.idO, numfacture) as  prix_option_ttc, pact.prix_option_offre_HT(f.idO, numfacture) as  prix_option_ht, nbrJours(f.idO, now()::date, numfacture),
  f.idO, idC from pact._facturation f
  inner join pact.offre o on o.idO = f.idO;
