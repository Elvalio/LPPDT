#include <errno.h>
#include <arpa/inet.h>
#include <stdio.h>
#include <string.h>
#include <sys/socket.h>
#include <sys/types.h>
#include <unistd.h>
#include <stdlib.h>
#include <postgresql/libpq-fe.h>
#include <iconv.h>
#include <netdb.h>
#include <netinet/in.h>
#include <stdbool.h>

#define PORT "4242"
#define BACKLOG 10
#define BUFSIZE 4096

#define LEN_MSG_HISTORY 3


// ============================
// Prototypes de fonctions
// ============================
char *convert_to_utf8(const char *input, const char *from_encoding);
int find_discussion(PGconn *conn, int idClient, int idPro, int idEmmeteur, int idReceveur);
void fetch_all_data(PGconn *conn);
void clear_tables(PGconn *conn);
void save_message(PGconn *conn, int idClient, int idPro, int idEmmeteur, int idReceveur, const char *message_text);
void send_user_messages(PGconn *conn, int user_id, int client_fd, int max_messages, int message_id, int id_conv);
int modifier_message(PGconn *conn, int user_id, int idMessage, const char *nouveau_texte);
int supprimer_message(PGconn *conn, int user_id, int idMessage);
const char *verifier_type_compte(PGconn *conn, int id_compte);
int verif_connexion_apikey(PGconn *conn, char *api_key);
void send_conversation_list(PGconn *conn, int user_id, int client_fd);
bool validConversation(PGconn *conn, int user_id, int client_fd, char *conversation_id);


// ============================
// Fonction principale: main
// Gère la boucle principale du serveur et la communication client
// ============================
int main(void) {
    struct addrinfo hints, *res;
    int socket_fd, client_fd;
    struct sockaddr_storage client_addr;
    socklen_t addr_size;
    char buffer[BUFSIZE];
    int bytes_read;
    int ret;

    const char *conninfo = "host=lppdt.ventsdouest.dev port=5432 dbname=sae user=sae password=brute-quint3-jOUrnaux";
    PGconn *conn = PQconnectdb(conninfo);

    if (PQstatus(conn) != CONNECTION_OK) {
        fprintf(stderr, "Connection to database failed: %s\n", PQerrorMessage(conn));
        PQfinish(conn);
        return 1;
    }

    printf("Connected to the database successfully.\n");

    memset(&hints, 0, sizeof hints);
    hints.ai_family = AF_UNSPEC;
    hints.ai_socktype = SOCK_STREAM;
    hints.ai_flags = AI_PASSIVE;

    if (getaddrinfo(NULL, PORT, &hints, &res) != 0) {
        perror("getaddrinfo");
        return 1;
    }

    socket_fd = socket(res->ai_family, res->ai_socktype, res->ai_protocol);
    if (socket_fd == -1) {
        perror("socket");
        return 2;
    }

    if (bind(socket_fd, res->ai_addr, res->ai_addrlen) != 0) {
        perror("bind");
        return 3;
    }

    listen(socket_fd, BACKLOG);
    printf("Server is listening on port %s\n", PORT);

    while (1) {
        addr_size = sizeof client_addr;
        client_fd = accept(socket_fd, (struct sockaddr *)&client_addr, &addr_size);
        if (client_fd == -1) {
            perror("accept");
            continue;
        }
        printf("New client connected.\n");

        fetch_all_data(conn);

        printf("WAITING FOR CLIENT CONNEXION\n");
        bytes_read = recv(client_fd, buffer, BUFSIZE - 1, 0);
        if (bytes_read <= 0) {
            perror("recv");
            close(client_fd);
            continue;
        }
        buffer[bytes_read] = '\0';
        printf("API KEY : %s\n", buffer);

        ret = verif_connexion_apikey(conn, buffer);
        
        if (ret == -1) {
            send(client_fd, "Erreur lors de la vérification de la clé API.\n", 45, 0);
            close(client_fd);
            continue;
        } else if (ret == 0) {
            send(client_fd, "API_KEY_INVALID", 15, 0);
            printf("API key invalid.\n");
            close(client_fd);
            continue;
        } else {
            send(client_fd, "API_KEY_VALID", 13, 0);
            printf("API key valid.\n");

            int api_key = atoi(buffer);


            while (1) {
                send_conversation_list(conn, api_key, client_fd);
                send(client_fd, "END_OF_BLOCK", strlen("END_OF_BLOCK"), 0);
                printf("Conversation list sent.\n");

                bytes_read = recv(client_fd, buffer, BUFSIZE - 1, 0);
                if (bytes_read <= 0) {
                    perror("recv");
                    close(client_fd);
                    break;
                }
                buffer[bytes_read] = '\0';
                printf("buffer : %s\n", buffer);
                bytes_read = recv(client_fd, buffer, BUFSIZE - 1, 0);

                buffer[bytes_read] = '\0';
                printf("buffer : %s\n", buffer);
                if (strcmp("QUIT", buffer) == 0) {
                    printf("Client disconnected.\n");
                    close(client_fd);
                    continue;
                } else if (validConversation(conn, api_key, client_fd, buffer)) {
                    printf("Conversation selected: %s\n", buffer);
                    int id_conv = atoi(buffer);

                    while (1) {
                        memset(buffer, 0, BUFSIZE);
                        bytes_read = recv(client_fd, buffer, BUFSIZE - 1, 0);
                        if (bytes_read <= 0) {
                            if (bytes_read == 0) {
                                printf("Client disconnected.\n");
                            } else {
                                perror("recv");
                            }
                            close(client_fd);
                            break;
                        }
                        buffer[bytes_read] = '\0';

                        if (strcmp(buffer, "SEND") == 0) {
                            int sender_id, receiver_id;
                            char message[BUFSIZE];

                            bytes_read = recv(client_fd, buffer, BUFSIZE - 1, 0);
                            if (bytes_read <= 0) {
                                perror("recv");
                                close(client_fd);
                                break;
                            }
                            buffer[bytes_read] = '\0';

                            sscanf(buffer, "%d\n%d\n%[^\n]", &sender_id, &receiver_id, message);
                            printf("Message from %d to %d: %s\n", sender_id, receiver_id, message);

                            int idPro = -1;
                            int idClient = -1;

                            const char *sender_type = verifier_type_compte(conn, sender_id);
                            const char *receiver_type = verifier_type_compte(conn, receiver_id);

                            if (!sender_type || !receiver_type || strcmp(sender_type, "Inconnu") == 0 || strcmp(receiver_type, "Inconnu") == 0) {
                                send(client_fd, "Erreur : ID de compte invalide.\n", 30, 0);
                                continue;
                            } else if (strcmp(sender_type, "Professionnel") == 0) {
                                idPro = sender_id;
                                idClient = receiver_id;
                            } else {
                                idClient = sender_id;
                                idPro = receiver_id;
                            }

                            save_message(conn, idClient, idPro, sender_id, receiver_id, message);
                            send(client_fd, "Message saved.\n", 16, 0);

                        } else if (strcmp(buffer, "RECEIVE") == 0) {
                            // int user_id;
                            // recv(client_fd, buffer, BUFSIZE - 1, 0);
                            // sscanf(buffer, "%d", &user_id);

                            send_user_messages(conn, api_key, client_fd, LEN_MSG_HISTORY, 0, id_conv);
                            // Indicateur de fin d'envoi
                            send(client_fd, "END_OF_BLOCK", strlen("END_OF_BLOCK"), 0);

                            while (1) {
                                recv(client_fd, buffer, BUFSIZE - 1, 0);
                                if (buffer[0] == '+') {
                                    int message_id;
                                    char message_id_str[BUFSIZE];
                                    recv(client_fd, message_id_str, BUFSIZE - 1, 0);
                                    message_id = atoi(message_id_str);

                                    printf("Fetching messages before message ID %d\n", message_id);
                                    send_user_messages(conn, api_key, client_fd, LEN_MSG_HISTORY, message_id, id_conv);
                                    send(client_fd, "END_OF_BLOCK", strlen("END_OF_BLOCK"), 0);

                                } else if (strncmp(buffer, "CHANGE", 6) == 0) {
                                    int message_id;
                                    sscanf(buffer + 7, "%d", &message_id); // Extraire l'ID après CHANGE

                                    printf("Message ID to change: %d\n", message_id);

                                    // Recevoir le nouveau message
                                    char new_message[BUFSIZE];
                                    recv(client_fd, new_message, BUFSIZE - 1, 0);
                                    new_message[strcspn(new_message, "\n")] = '\0';

                                    printf("Changing message ID %d to: %s\n", message_id, new_message);
                                    int ret = modifier_message(conn, api_key, message_id, new_message);
                                    if (ret == 1) {
                                        const char *msg = "Message updated.\n";
                                        send(client_fd, msg, strlen(msg), 0);
                                    } else if (ret == 0) {
                                        const char *msg = "You are not the sender of this message.\n";
                                        send(client_fd, msg, strlen(msg), 0);
                                    } else {
                                        const char *msg = "Error updating message.\n";
                                        send(client_fd, msg, strlen(msg), 0);
                                    }
                                    send_user_messages(conn, api_key, client_fd, LEN_MSG_HISTORY, 0, id_conv);
                                    send(client_fd, "END_OF_BLOCK", strlen("END_OF_BLOCK"), 0);

                                } else if (strncmp(buffer, "DELETE", 6) == 0) {
                                    int message_id;
                                    sscanf(buffer + 6, "%d", &message_id); // Extraire l'ID après CHANGE


                                    printf("Deleting message ID %d\n", message_id);
                                    int ret = supprimer_message(conn, api_key, message_id);
                                    if (ret == 1) {
                                        const char *msg = "Message deleted.\n";
                                        send(client_fd, msg, strlen(msg), 0);
                                    } else if (ret == 0) {
                                        const char *msg = "You are not the sender of this message.\n";
                                        send(client_fd, msg, strlen(msg), 0);
                                    } else {
                                        const char *msg = "Error deleting message.\n";
                                        send(client_fd, msg, strlen(msg), 0);
                                    }
                                    send_user_messages(conn, api_key, client_fd, LEN_MSG_HISTORY, 0, id_conv);
                                    send(client_fd, "END_OF_BLOCK", strlen("END_OF_BLOCK"), 0);

                                } else if (buffer[0] == '-') {
                                    break;
                                } else {
                                    send(client_fd, "Invalid command.\n", 18, 0);
                                }
                            }

                        } else if (strcmp(buffer, "CLEAR") == 0) {
                            clear_tables(conn);
                            send(client_fd, "Tables cleared.\n", 16, 0);

                        } else if (strcmp(buffer, "AFFICHER") == 0) {
                            fetch_all_data(conn);

                        } else if (strcmp(buffer, "QUIT") == 0) {
                            printf("Disconnect from conversation\n");
                            break;

                        } else {
                            send(client_fd, "Invalid command.\n", 18, 0);
                        }
                    }

                } else {
                    send(client_fd, "Invalid conversation ID.\n", 25, 0);
                    printf("Invalid conversation ID.\n");
                    continue;
                }
            }
            

            
        }
    }

    close(socket_fd);
    PQfinish(conn);
    return 0;
}



// ============================
// Fonction: convert_to_utf8
// Convertit une chaîne de caractères en UTF-8
// ============================
char* convert_to_utf8(const char* input, const char* from_encoding) {
    iconv_t cd = iconv_open("UTF-8", from_encoding);
    if (cd == (iconv_t)-1) {
        perror("iconv_open failed");
        return NULL;
    }

    size_t in_len = strlen(input);
    size_t out_len = in_len * 2; // Prévoir un buffer plus grand pour le texte converti
    char* output = malloc(out_len);
    if (!output) {
        perror("malloc failed");
        iconv_close(cd);
        return NULL;
    }

    char* in_buf = (char*)input;
    char* out_buf = output;
    size_t out_bytes_left = out_len;

    if (iconv(cd, &in_buf, &in_len, &out_buf, &out_bytes_left) == (size_t)-1) {
        perror("iconv conversion failed");
        free(output);
        iconv_close(cd);
        return NULL;
    }

    *out_buf = '\0'; // Terminer la chaîne convertie
    iconv_close(cd);
    return output;
}






// ============================
// Fonction: find_discussion
// Trouve une discussion entre un client et un professionnel
// ============================
int find_discussion(PGconn *conn, int idClient, int idPro, int idEmmeteur, int idReceveur) {
    char query[BUFSIZE];

    printf("SELECT DISCUSSION\n");

    snprintf(query, BUFSIZE,
             "SELECT idDiscussion FROM pact._discussion "
             "WHERE (idClient = %d OR idPro = %d) AND estBloque = false;",
             idClient, idPro);

    PGresult *res = PQexec(conn, query);
    if (PQresultStatus(res) != PGRES_TUPLES_OK) {
        fprintf(stderr, "Error fetching discussion: %s\n", PQerrorMessage(conn));
        PQclear(res);
        return -1;
    }

    int discussion_id = -1;
    if (PQntuples(res) > 0) {
        discussion_id = atoi(PQgetvalue(res, 0, 0));
    }
    PQclear(res);


    printf("DISCUSSION ID : %d\n", discussion_id);
    printf("FIN DE SELECT DISCUSSION\n");

    return discussion_id;
}





// ============================
// Fonction: save_message
// Sauvegarde un message et crée une discussion si nécessaire
// ============================
void save_message(PGconn *conn, int idClient, int idPro, int idEmmeteur, int idReceveur, const char *message_text) {
    // Trouver ou créer la discussion
    int discussion_id = find_discussion(conn, idClient, idPro, idEmmeteur, idReceveur);

    printf("INSERTION DISCUSSION\n");

    printf("idClient : %d\n", idClient);
    printf("idPro : %d\n", idPro);
    printf("idEmmeteur : %d\n", idEmmeteur);
    printf("idReceveur : %d\n", idReceveur);

    if (discussion_id == -1) {
        char create_discussion_query[BUFSIZE];
        snprintf(create_discussion_query, BUFSIZE,
                 "INSERT INTO pact._discussion (idClient, idPro, estBloque) "
                 "VALUES (%d, %d, false) RETURNING idDiscussion;",
                 idClient, idPro);

        PGresult *create_res = PQexec(conn, create_discussion_query);
        if (PQresultStatus(create_res) != PGRES_TUPLES_OK) {
            fprintf(stderr, "Error creating discussion: %s\n", PQerrorMessage(conn));
            PQclear(create_res);
            return;
        }

        // Récupérer l'idDiscussion généré
        discussion_id = atoi(PQgetvalue(create_res, 0, 0));
        PQclear(create_res);
    }

    // Convertir le texte du message en UTF-8
    char *utf8_text = convert_to_utf8(message_text, "ISO-8859-1"); // Adapter l'encodage source si nécessaire
    if (!utf8_text) {
        fprintf(stderr, "Error converting message text to UTF-8\n");
        return;
    }

    // Échapper le texte pour PostgreSQL
    char escaped_text[BUFSIZE * 2]; // Buffer pour contenir le texte échappé
    int error = 0;
    PQescapeStringConn(conn, escaped_text, utf8_text, strlen(utf8_text), &error);
    free(utf8_text); // Libérer la mémoire du texte converti

    if (error) {
        fprintf(stderr, "Error escaping message text: %s\n", PQerrorMessage(conn));
        return;
    }

    printf("INSERTION MESSAGE\n");

    // Insérer le message
    char query[BUFSIZE];
    snprintf(query, BUFSIZE,
             "INSERT INTO pact._message (idDiscussion, idEmmeteur, idReceveur, texte, dateMessage, recu, supprime) "
             "VALUES (%d, %d, %d, '%s', NOW(), false, false);",
             discussion_id, idEmmeteur, idReceveur, escaped_text);

    PGresult *res = PQexec(conn, query);
    if (PQresultStatus(res) != PGRES_COMMAND_OK) {
        fprintf(stderr, "Error inserting message: %s\n", PQerrorMessage(conn));
    }
    printf("Message inserted.\n");
    PQclear(res);
}





// ============================
// Fonction: send_user_messages
// Envoie tous les messages reçu à l'utilisateur
// ============================
#define MAX_MESSAGES 3

void send_user_messages(PGconn *conn, int user_id, int client_fd, int max_messages, int message_id, int id_conv) {
    char query[BUFSIZE];
    
    // Si un message_id est fourni, récupérer les messages précédents ce message_id
    if (message_id > 0) {
        snprintf(query, BUFSIZE,
            "SELECT msg.idMessage, msg.dateMessage, msg.texte, "
            "emmeteur.nom AS nom_emmeteur, emmeteur.prenom AS prenom_emmeteur, "
            "receveur.nom AS nom_receveur, receveur.prenom AS prenom_receveur, "
            "emmeteur.idC AS id_emmeteur "
            "FROM pact._message msg "
            "JOIN pact._compte emmeteur ON msg.idEmmeteur = emmeteur.idC "
            "JOIN pact._compte receveur ON msg.idReceveur = receveur.idC "
            "WHERE msg.idDiscussion = %d AND msg.idMessage < %d "
            "ORDER BY msg.idMessage DESC "
            "LIMIT %d;",
            id_conv, message_id, max_messages);
    } else {
        // Sinon, récupérer les messages les plus récents
        snprintf(query, BUFSIZE,
            "SELECT msg.idMessage, msg.dateMessage, msg.texte, "
            "emmeteur.nom AS nom_emmeteur, emmeteur.prenom AS prenom_emmeteur, "
            "receveur.nom AS nom_receveur, receveur.prenom AS prenom_receveur, "
            "emmeteur.idC AS id_emmeteur "
            "FROM pact._message msg "
            "JOIN pact._compte emmeteur ON msg.idEmmeteur = emmeteur.idC "
            "JOIN pact._compte receveur ON msg.idReceveur = receveur.idC "
            "WHERE msg.idDiscussion = %d "
            "ORDER BY msg.idMessage DESC "
            "LIMIT %d;",
            id_conv, max_messages);
    }

    PGresult *res = PQexec(conn, query);
    if (PQresultStatus(res) != PGRES_TUPLES_OK) {
        fprintf(stderr, "Error fetching messages: %s\n", PQerrorMessage(conn));
        send(client_fd, "Error retrieving messages.\n", 27, 0);
        PQclear(res);
        return;
    }

    int rows = PQntuples(res);
    if (rows == 0) {
        send(client_fd, "No messages for you.\n", 22, 0);
    } else {
        for (int i = rows - 1; i >= 0; i--) { // Les messages sont récupérés en ordre descendant, les renvoyer en ordre ascendant
            const char *idMessage = PQgetvalue(res, i, 0);
            char dateMessage[11];
            strncpy(dateMessage, PQgetvalue(res, i, 1), 10);
            dateMessage[10] = '\0';
            const char *message = PQgetvalue(res, i, 2);
            const char *NomEmmeteurMessage = PQgetvalue(res, i, 3);
            const char *PrenomEmmeteurMessage = PQgetvalue(res, i, 4);
            const char *idEmmeteurMessage = PQgetvalue(res, i, 7);

            char formatted_nom[BUFSIZE];
            if (atoi(idEmmeteurMessage) == user_id) {
                snprintf(formatted_nom, BUFSIZE, "Moi");
            } else {
                snprintf(formatted_nom, BUFSIZE, "%s %s", NomEmmeteurMessage, PrenomEmmeteurMessage);
            }

            char composed_message[BUFSIZE];
            
            printf("dateMessage : %s\n", dateMessage);
            snprintf(composed_message, BUFSIZE, "%s | [%s] - %-20s: %s", idMessage, dateMessage, formatted_nom, message);

            send(client_fd, composed_message, strlen(composed_message), 0);
            send(client_fd, "\n", 1, 0);
        }
    }
    PQclear(res);
    
    // Optionnel : Marquer les messages récupérés comme lus
    snprintf(query, BUFSIZE,
             "UPDATE pact._message SET recu = true "
             "WHERE idReceveur = %d AND recu = false;", user_id);
    res = PQexec(conn, query);
    if (PQresultStatus(res) != PGRES_COMMAND_OK) {
        fprintf(stderr, "Error updating message status: %s\n", PQerrorMessage(conn));
    }
    PQclear(res);
}


// ============================
// Fonction: modifier_message
// Modifie un message existant
// ============================
int modifier_message(PGconn *conn, int user_id, int idMessage, const char *nouveau_texte) {
    // Vérifier si l'utilisateur est l'émetteur du message
    char query_temp[BUFSIZE];
    snprintf(query_temp, BUFSIZE,
             "SELECT 1 FROM pact._message WHERE idMessage = %d AND idEmmeteur = %d;",
             idMessage, user_id);
    if (PQntuples(PQexec(conn, query_temp)) == 0) {
        fprintf(stderr, "Error: user is not the sender of the message.\n");
        return 0;
    }


    // Convertir le texte du message en UTF-8
    char *utf8_text = convert_to_utf8(nouveau_texte, "ISO-8859-1"); // Adapter l'encodage source si nécessaire
    if (!utf8_text) {
        fprintf(stderr, "Error converting message text to UTF-8\n");
        return -1;
    }

    // Échapper le texte pour PostgreSQL
    char escaped_text[BUFSIZE * 2]; // Buffer pour contenir le texte échappé
    int error = 0;
    PQescapeStringConn(conn, escaped_text, utf8_text, strlen(utf8_text), &error);
    free(utf8_text); // Libérer la mémoire du texte converti

    if (error) {
        fprintf(stderr, "Error escaping message text: %s\n", PQerrorMessage(conn));
        return -1;
    }

    // Insérer le message
    char query[BUFSIZE];
    snprintf(query, BUFSIZE,
             "UPDATE pact._message SET texte = '%s' WHERE idMessage = %d;",
             escaped_text, idMessage);

    PGresult *res = PQexec(conn, query);
    if (PQresultStatus(res) != PGRES_COMMAND_OK) {
        fprintf(stderr, "Error updating message: %s\n", PQerrorMessage(conn));
    }
    printf("Message updated.\n");
    PQclear(res);
    return 1;
}




// ============================
// Fonction: supprimer_message
// Supprime un message existant
// ============================
int supprimer_message(PGconn *conn, int user_id, int idMessage) {
    // Vérifier si l'utilisateur est l'émetteur du message
    char query[BUFSIZE];
    snprintf(query, BUFSIZE,
             "SELECT 1 FROM pact._message WHERE idMessage = %d AND idEmmeteur = %d;",
             idMessage, user_id);
    if (PQntuples(PQexec(conn, query)) == 0) {
        fprintf(stderr, "Error: user is not the sender of the message.\n");
        return 0;
    }

    // Supprimer le message
    snprintf(query, BUFSIZE,
             "DELETE FROM pact._message WHERE idMessage = %d;", idMessage);
    PGresult *res = PQexec(conn, query);
    if (PQresultStatus(res) != PGRES_COMMAND_OK) {
        fprintf(stderr, "Error deleting message: %s\n", PQerrorMessage(conn));
    }
    printf("Message deleted.\n");
    PQclear(res);
    return 1;
}




// ============================
// Fonction: verifier_type_compte
// Vérifie si un identifiant correspond à un professionnel ou un client
// ============================
const char* verifier_type_compte(PGconn *conn, int id_compte) {
    char query[BUFSIZE];
    PGresult *res;

    // Vérifier dans la table _professionnel
    snprintf(query, BUFSIZE, "SELECT 1 FROM pact._professionnel WHERE idC = %d;", id_compte);
    res = PQexec(conn, query);

    if (PQresultStatus(res) != PGRES_TUPLES_OK) {
        fprintf(stderr, "Erreur lors de la vérification dans _professionnel : %s\n", PQerrorMessage(conn));
        PQclear(res);
        return "Erreur";
    }

    if (PQntuples(res) > 0) {
        PQclear(res);
        return "Professionnel";
    }
    PQclear(res);

    // Vérifier dans la table _membre
    snprintf(query, BUFSIZE, "SELECT 1 FROM pact._membre WHERE idC = %d;", id_compte);
    res = PQexec(conn, query);

    if (PQresultStatus(res) != PGRES_TUPLES_OK) {
        fprintf(stderr, "Erreur lors de la vérification dans _membre : %s\n", PQerrorMessage(conn));
        PQclear(res);
        return "Erreur";
    }

    if (PQntuples(res) > 0) {
        PQclear(res);
        return "Client";
    }
    PQclear(res);

    // Si aucune correspondance trouvée
    return "Inconnu";
}




// ============================
// Fonction: fetch_all_data
// Affiche toutes les données de la table _message
// ============================
void fetch_all_data(PGconn *conn) {
    const char *query = "SELECT * FROM pact._message;";

    PGresult *res = PQexec(conn, query);

    // Vérifiez si la requête a réussi
    if (PQresultStatus(res) != PGRES_TUPLES_OK) {
        fprintf(stderr, "Erreur lors de l'exécution de la requête : %s\n", PQerrorMessage(conn));
        PQclear(res);
        return;
    }

    int nFields = PQnfields(res); // Nombre de colonnes
    int nRows = PQntuples(res);  // Nombre de lignes

    // Si la table est vide
    if (nRows == 0) {
        printf("La table est vide.\n");
        PQclear(res);
        return;
    }

    printf("\n========== Données de la table pact._message =========\n");
    fflush(stdout);

    // Affichage des noms des colonnes
    printf("| ");
    for (int i = 0; i < nFields; i++) {
        printf("%-20s | ", PQfname(res, i));
    }
    printf("\n");
    fflush(stdout);

    // Affichage des lignes
    for (int i = 0; i < nRows; i++) {
        printf("| ");
        for (int j = 0; j < nFields; j++) {
            if (PQgetisnull(res, i, j)) {
                printf("%-20s | ", "NULL");
            } else {
                printf("%-20s | ", PQgetvalue(res, i, j));
            }
        }
        printf("\n");
    }

    PQclear(res);
}




// ============================
// Fonction: clear_tables
// Vide les tables _message et _discussion
// ============================
void clear_tables(PGconn *conn) {
    const char *clear_message_query = "DELETE FROM pact._message;";
    PGresult *res = PQexec(conn, clear_message_query);
    if (PQresultStatus(res) != PGRES_COMMAND_OK) {
        fprintf(stderr, "Error clearing _message table: %s\n", PQerrorMessage(conn));
        PQclear(res);
        return;
    }
    PQclear(res);

    const char *clear_discussion_query = "DELETE FROM pact._discussion;";
    res = PQexec(conn, clear_discussion_query);
    if (PQresultStatus(res) != PGRES_COMMAND_OK) {
        fprintf(stderr, "Error clearing _discussion table: %s\n", PQerrorMessage(conn));
        PQclear(res);
        return;
    }
    PQclear(res);

    printf("Tables _message and _discussion cleared successfully.\n");
}




int verif_connexion_apikey(PGconn *conn, char *api_key) {
    char query[BUFSIZE];
    int temp = atoi(api_key);
    

    snprintf(query, BUFSIZE, "SELECT 1 FROM pact._compte WHERE idC = '%d';", temp);
    PGresult *res = PQexec(conn, query);

    if (PQresultStatus(res) != PGRES_TUPLES_OK) {
        fprintf(stderr, "Error fetching API key: %s\n", PQerrorMessage(conn));
        PQclear(res);
        return -1;
    }

    int rows = PQntuples(res);
    PQclear(res);
    return rows;
}



void send_conversation_list(PGconn *conn, int user_id, int client_fd) {
    char query[BUFSIZE];
    printf("Fetching discussions for user %d\n", user_id);
    snprintf(query, BUFSIZE,
             "SELECT idDiscussion, idClient, idPro FROM pact._discussion "
             "WHERE idClient = %d OR idPro = %d;", user_id, user_id);

    PGresult *res = PQexec(conn, query);
    if (PQresultStatus(res) != PGRES_TUPLES_OK) {
        fprintf(stderr, "Error fetching discussions: %s\n", PQerrorMessage(conn));
        send(client_fd, "Error retrieving discussions.\n", 28, 0);
        PQclear(res);
        return;
    }

    int rows = PQntuples(res);
    if (rows == 0) {
        send(client_fd, "No discussions for you.\n", 24, 0);
    } else {
        for (int i = 0; i < rows; i++) {
            const char *idDiscussion = PQgetvalue(res, i, 0);
            const char *idClient = PQgetvalue(res, i, 1);
            const char *idPro = PQgetvalue(res, i, 2);

            char composed_message[BUFSIZE];
            snprintf(composed_message, BUFSIZE, "Discussion ID: %s | Client ID: %s | Pro ID: %s", idDiscussion, idClient, idPro);
            char nom_prenom[BUFSIZE];
            int other_user_id = (atoi(idClient) == user_id) ? atoi(idPro) : atoi(idClient);

            snprintf(query, BUFSIZE, "SELECT nom, prenom FROM pact._compte WHERE idC = %d;", other_user_id);
            PGresult *name_res = PQexec(conn, query);
            if (PQresultStatus(name_res) != PGRES_TUPLES_OK) {
                fprintf(stderr, "Error fetching user name: %s\n", PQerrorMessage(conn));
                PQclear(name_res);
                continue;
            }

            if (PQntuples(name_res) > 0) {
                snprintf(nom_prenom, BUFSIZE, "%s %s", PQgetvalue(name_res, 0, 0), PQgetvalue(name_res, 0, 1));
            } else {
                snprintf(nom_prenom, BUFSIZE, "Unknown");
            }
            PQclear(name_res);

            snprintf(query, BUFSIZE, "SELECT COUNT(*) FROM pact._message WHERE idDiscussion = %s AND idReceveur = %d AND recu = false;", idDiscussion, user_id);
            PGresult *msg_res = PQexec(conn, query);
            int new_messages = 0;
            if (PQresultStatus(msg_res) == PGRES_TUPLES_OK && PQntuples(msg_res) > 0) {
                new_messages = atoi(PQgetvalue(msg_res, 0, 0));
            }
            PQclear(msg_res);
            if (new_messages > 0) {
                snprintf(composed_message, BUFSIZE, "Discussion ID: %s | %s (%d new messages)", idDiscussion, nom_prenom, new_messages);
            } else {
                snprintf(composed_message, BUFSIZE, "Discussion ID: %s | %s", idDiscussion, nom_prenom);
            }
            printf("Sending conversation: %s\n", composed_message);
            send(client_fd, composed_message, strlen(composed_message), 0);
            send(client_fd, "\n", 1, 0);
        }
    }
    PQclear(res);
}


bool validConversation(PGconn *conn, int user_id, int client_fd, char *conversation_id) {
    char query[BUFSIZE];
    int idChoose = atoi(conversation_id);
    snprintf(query, BUFSIZE,
             "SELECT idDiscussion FROM pact._discussion "
             "WHERE idDiscussion = %d AND (idClient = %d OR idPro = %d);",
             idChoose, user_id, user_id);

    PGresult *res = PQexec(conn, query);
    if (PQresultStatus(res) != PGRES_TUPLES_OK) {
        fprintf(stderr, "Error fetching discussion: %s\n", PQerrorMessage(conn));
        send(client_fd, "Error retrieving discussion.\n", 28, 0);
        PQclear(res);
        return false;
    }

    int rows = PQntuples(res);
    printf("rows : %d\n", rows);
    PQclear(res);
    return rows > 0;
}