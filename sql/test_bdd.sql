SET SCHEMA 'pact'; 

update pact.spectacle set date_publication = (now() - interval '2 days') where idO = 1;

update pact.activite set date_publication = (now() - interval '3 days') where idO = 2;

update pact.visite set date_publication = (now() - interval '4 days') where idO = 3;

update pact.restauration set date_publication = (now() - interval '5 days') where idO = 4;

update pact.parc_d_attraction set date_publication = (now() - interval '6 days') where idO = 5;

update pact.activite set date_publication = (now() - interval '1 days') where idO = 6;

update pact.visite set date_publication = (now() - interval '8 days') where idO = 7;

update _option_offre set  date_lancement = now() - interval '1 day', duree_option = interval '7 day' where idO = 1;

--update _option_offre set duree_option = interval '14 day' where idO = 1;

-- update _option_offre set  date_lancement = now() + interval '1 day' where idO = 1;
