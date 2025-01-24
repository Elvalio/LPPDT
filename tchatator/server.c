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

#define PORT "4242"
#define BACKLOG 10
#define BUFSIZE 4096

// Fonction pour convertir une chaîne en UTF-8
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

// Fonction pour insérer un message dans la base de données
void save_message(PGconn *conn, int discussion_id, int idClient, int idPro, int idEmmeteur, int idReceveur, const char *message_text) {
    // Vérifier si la discussion existe
    char check_discussion_query[BUFSIZE];
    snprintf(check_discussion_query, BUFSIZE,
             "SELECT 1 FROM pact._discussion WHERE idDiscussion = %d;", discussion_id);

    PGresult *check_res = PQexec(conn, check_discussion_query);
    if (PQresultStatus(check_res) != PGRES_TUPLES_OK) {
        fprintf(stderr, "Error checking discussion: %s\n", PQerrorMessage(conn));
        PQclear(check_res);
        return;
    }

    // Si la discussion n'existe pas, la créer
    if (PQntuples(check_res) == 0) {
        PQclear(check_res);

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
    } else {
        PQclear(check_res);
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


// Fonction pour envoyer tous les messages d'un utilisateur
void send_user_messages(PGconn *conn, int user_id, int client_fd) {
    char query[BUFSIZE];
    snprintf(query, BUFSIZE,
         "SELECT texte, dateMessage, _compte.nom, _compte.prenom "
         "FROM pact._message "
         "JOIN pact._compte ON pact._message.idEmmeteur = pact._compte.idC "
         "WHERE idReceveur = %d AND recu = false AND supprime = false;",
         user_id);


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
        for (int i = 0; i < rows; i++) {
            const char *message = PQgetvalue(res, i, 0);
            const char *dateMessage = PQgetvalue(res, i, 1);
            const char *NomEmmeteurMessage = PQgetvalue(res, i, 2);
            const char *PrenomEmmeteurMessage = PQgetvalue(res, i, 3);


            char composed_message[BUFSIZE];
            snprintf(composed_message, BUFSIZE, "[%s] - %s %s: %s", dateMessage, NomEmmeteurMessage, PrenomEmmeteurMessage, message);
            send(client_fd, composed_message, strlen(composed_message), 0);
            send(client_fd, "\n", 1, 0);
        }
    }
    PQclear(res);

    // Marquer les messages comme lus
    snprintf(query, BUFSIZE,
             "UPDATE pact._message SET recu = true WHERE idReceveur = %d AND recu = false;", user_id);
    res = PQexec(conn, query);
    if (PQresultStatus(res) != PGRES_COMMAND_OK) {
        fprintf(stderr, "Error updating message status: %s\n", PQerrorMessage(conn));
    }
    PQclear(res);
}

// Fonction principale pour récupérer les données de toutes les tables
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
    // Obtenir les informations d'adresse pour le serveur
    if (getaddrinfo(NULL, PORT, &hints, &res) != 0) {
        // Afficher un message d'erreur si getaddrinfo échoue
        perror("getaddrinfo");
        return 1; // Retourner 1 pour indiquer une erreur
    }

    // Créer une socket avec les informations d'adresse obtenues
    socket_fd = socket(res->ai_family, res->ai_socktype, res->ai_protocol);
    if (socket_fd == -1) {
        // Afficher un message d'erreur si la création de la socket échoue
        perror("socket");
        return 2; // Retourner 2 pour indiquer une erreur
    }

    // Lier la socket à l'adresse et au port spécifiés
    if (bind(socket_fd, res->ai_addr, res->ai_addrlen) != 0) {
        // Afficher un message d'erreur si la liaison échoue
        perror("bind");
        return 3; // Retourner 3 pour indiquer une erreur
    }
    listen(socket_fd, BACKLOG);

    while (1) {
        addr_size = sizeof client_addr;
        client_fd = accept(socket_fd, (struct sockaddr *)&client_addr, &addr_size);
        if (client_fd == -1) {
            perror("accept");
            continue;
        }
        printf("New client connected.\n");

        fetch_all_data(conn);


        memset(buffer, 0, BUFSIZE); // Initialize buffer
        bytes_read = recv(client_fd, buffer, BUFSIZE - 1, 0);
        if (bytes_read <= 0) {
            if (bytes_read == 0) {
                printf("Client disconnected.\n");
            } else {
                perror("recv");
            }
            close(client_fd);
            continue;
        }
        buffer[bytes_read] = '\0';

        if (strcmp(buffer, "SEND") == 0) {
            int sender_id, receiver_id;
            char message[BUFSIZE];
            ret = recv(client_fd, buffer, BUFSIZE - 1, 0);
            if (ret <= 0) {
                if (ret == 0) {
                    fprintf(stderr, "Client déconnecté.\n");
                } else {
                    perror("recv");
                }
                close(client_fd);
                continue;
            }
            buffer[ret] = '\0'; // Assurez la terminaison nulle

            char *token = strtok(buffer, "\n");
            if (token == NULL) {
                fprintf(stderr, "Erreur : format incorrect (sender_id).\n");
                close(client_fd);
                continue;
            }
            sender_id = atoi(token);

            token = strtok(NULL, "\n");
            if (token == NULL) {
                fprintf(stderr, "Erreur : format incorrect (receiver_id).\n");
                close(client_fd);
                continue;
            }
            receiver_id = atoi(token);

            token = strtok(NULL, "\n");
            if (token == NULL) {
                fprintf(stderr, "Erreur : format incorrect (message).\n");
                close(client_fd);
                continue;
            }
            strncpy(message, token, BUFSIZE - 1);
            message[BUFSIZE - 1] = '\0'; // Nul-terminé


            int discussion_id = 0; // Mettre à 0 si la discussion doit être créée
            int idClient = sender_id; // Assumer que sender_id est le client
            int idPro = receiver_id;  // L'identifiant du professionnel associé
            int idReceveur = receiver_id; // L'utilisateur qui recevra le message
            printf("Message from %d to %d: %s\n", sender_id, receiver_id, message);

            save_message(conn, discussion_id, idClient, idPro, sender_id, idReceveur, message);

            send(client_fd, "Message saved.\n", 16, 0);
        } else if (strcmp(buffer, "RECEIVE") == 0) {
            int user_id;
            recv(client_fd, buffer, BUFSIZE - 1, 0);
            sscanf(buffer, "%d", &user_id);

            send_user_messages(conn, user_id, client_fd);
        } else {
            send(client_fd, "Invalid command.\n", 18, 0);
        }

        close(client_fd);

        fetch_all_data(conn);

    }

    close(socket_fd);
    PQfinish(conn);
    return 0;
}
