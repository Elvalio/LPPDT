SET SCHEMA 'pact';


-- Discussion pour le test tchatator

-- Conversation entre le client "Jonnnie" et le Pro "Nicola Modem" de l'entreprise "LaVilleBlanche"
-- Conversation à propos du Restaurant la Ville Blanche

insert into _discussion(idClient, idPro) values (1, 13);

insert into _message(texte, idDiscussion, idEmmeteur, idReceveur, recu) 
values ('Bonjour, l''annonce du restaurant La Ville Blanche est-elle toujours valide ?', 1, 1, 13, true);
SELECT pg_sleep(10);

insert into _message(texte, idDiscussion, idEmmeteur, idReceveur, recu) 
values ('Bonjour Jonnie, oui, l''annonce est toujours valable. Que souhaitez-vous savoir ?', 1, 13, 1, true);
SELECT pg_sleep(10);

insert into _message(texte, idDiscussion, idEmmeteur, idReceveur, recu) 
values ('Super ! Quels sont les horaires d''ouverture du restaurant ?', 1, 1, 13, true);
SELECT pg_sleep(10);

insert into _message(texte, idDiscussion, idEmmeteur, idReceveur, recu) 
values ('Le restaurant est ouvert du mardi au samedi, de 12h à 14h et de 19h à 22h.', 1, 13, 1, true);
SELECT pg_sleep(10);

insert into _message(texte, idDiscussion, idEmmeteur, idReceveur, recu) 
values ('D''accord, est-il possible de réserver une table en ligne ?', 1, 1, 13, true);
SELECT pg_sleep(10);

insert into _message(texte, idDiscussion, idEmmeteur, idReceveur, recu) 
values ('Oui, vous pouvez réserver via notre site ou par téléphone.', 1, 13, 1, true);
SELECT pg_sleep(10);

insert into _message(texte, idDiscussion, idEmmeteur, idReceveur, recu) 
values ('Est-ce que le restaurant propose des options végétariennes ?', 1, 1, 13, true);
SELECT pg_sleep(10);

insert into _message(texte, idDiscussion, idEmmeteur, idReceveur, recu) 
values ('Bien sûr, nous avons plusieurs plats végétariens et vegan.', 1, 13, 1, true);
SELECT pg_sleep(10);

insert into _message(texte, idDiscussion, idEmmeteur, idReceveur, recu) 
values ('Parfait ! Quels sont les moyens de paiement acceptés ?', 1, 1, 13, true);
SELECT pg_sleep(10);

insert into _message(texte, idDiscussion, idEmmeteur, idReceveur, recu) 
values ('Nous acceptons carte bancaire, espèces et tickets restaurant.', 1, 13, 1, true);
SELECT pg_sleep(10);

insert into _message(texte, idDiscussion, idEmmeteur, idReceveur, recu) 
values ('Ok, proposez-vous un service de livraison ou à emporter ?', 1, 1, 13, true);
SELECT pg_sleep(10);

insert into _message(texte, idDiscussion, idEmmeteur, idReceveur, recu) 
values ('Oui, nous faisons de la vente à emporter, mais pas de livraison.', 1, 13, 1, true);
SELECT pg_sleep(10);

insert into _message(texte, idDiscussion, idEmmeteur, idReceveur, recu) 
values ('D''accord, y a-t-il un parking à proximité ?', 1, 13, 1, true);
SELECT pg_sleep(10);

insert into _message(texte, idDiscussion, idEmmeteur, idReceveur, recu) 
values ('Oui, un parking gratuit est disponible à 50m du restaurant.', 1, 1, 13, true);
SELECT pg_sleep(10);

insert into _message(texte, idDiscussion, idEmmeteur, idReceveur, recu) 
values ('Le restaurant est-il accessible aux personnes à mobilité réduite ?', 1, 13, 1, true);
SELECT pg_sleep(10);


insert into _message(texte, idDiscussion, idEmmeteur, idReceveur, recu) 
values ('Oui, nous disposons d''un accès PMR.', 1, 1, 13, true);
SELECT pg_sleep(10);

insert into _message(texte, idDiscussion, idEmmeteur, idReceveur, recu) 
values ('Merci pour ces infos !', 1, 13, 1, true);
SELECT pg_sleep(10);

insert into _message(texte, idDiscussion, idEmmeteur, idReceveur, recu) 
values ('Avec plaisir !', 1, 1, 13, true);
SELECT pg_sleep(10);
