#include <errno.h>
#include <netdb.h>
#include <stdio.h>
#include <string.h>
#include <sys/socket.h>
#include <sys/types.h>
#include <unistd.h>
#include <stdlib.h>

#define PORT "4242" // le port de notre serveur
#define BACKLOG 10  // nombre max de demandes de connexion dans la file d'attente
#define BUFSIZE 1024
#define MSG_FILE "messages.txt"

// Fonction pour enregistrer un message dans le fichier
void save_message(const char *sender, const char *receiver, const char *message) {
    FILE *file = fopen(MSG_FILE, "a");
    printf("Saving message from %s to %s: %s\n", sender, receiver, message);
    if (!file) {
        perror("fopen");
        return;
    }
    fprintf(file, "%s|%s|%s\n", sender, receiver, message);
    fclose(file);
}

// Fonction pour envoyer tous les messages destinés à un utilisateur
void send_user_messages(int client_fd, const char *receiver) {
    FILE *file = fopen(MSG_FILE, "r");
    FILE *temp_file = fopen("temp.txt", "w"); // Fichier temporaire pour conserver les messages non lus par l'utilisateur
    char line[BUFSIZE];
    int found = 0;

    if (!file || !temp_file) {
        perror("fopen");
        send(client_fd, "Error accessing message file.\n", 30, 0);
    }

    while (fgets(line, sizeof(line), file)) {
        char sender[BUFSIZE], dest[BUFSIZE], message[BUFSIZE];
        sscanf(line, "%[^|]|%[^|]|%[^\n]", sender, dest, message);

        printf("--------%s----------%s------------", dest, receiver);

        if (strcmp(dest, receiver) == 0) {
            found = 1;
            send(client_fd, message, strlen(message), 0);
        } else {
            fprintf(temp_file, "%s", line); // Conserver les messages non destinés à cet utilisateur
        }
        printf("Sender: %s, Receiver: %s, Message: %s\n", sender, dest, message);
    }

    fclose(file);
    fclose(temp_file);

    // Remplacer le fichier original par le fichier temporaire
    remove(MSG_FILE);
    rename("temp.txt", MSG_FILE);

    if (!found) {
        send(client_fd, "No messages for you.\n", 22, 0);
    }
}

int main(void) {
    struct addrinfo hints, *res;
    int socket_fd, client_fd;
    int status;
    struct sockaddr_storage client_addr;
    socklen_t addr_size;
    char buffer[BUFSIZE];
    int bytes_read;

    memset(&hints, 0, sizeof hints);
    hints.ai_family = AF_UNSPEC;
    hints.ai_socktype = SOCK_STREAM;
    hints.ai_flags = AI_PASSIVE;

    status = getaddrinfo(NULL, PORT, &hints, &res);
    if (status != 0) {
        fprintf(stderr, "getaddrinfo: %s\n", gai_strerror(status));
        return 1;
    }

    socket_fd = socket(res->ai_family, res->ai_socktype, res->ai_protocol);
    if (socket_fd == -1) {
        perror("socket");
        return 2;
    }

    status = bind(socket_fd, res->ai_addr, res->ai_addrlen);
    if (status != 0) {
        perror("bind");
        return 3;
    }

    listen(socket_fd, BACKLOG);
    printf("Server is running on port %s...\n", PORT);

    while (1) {
        addr_size = sizeof client_addr;
        client_fd = accept(socket_fd, (struct sockaddr *)&client_addr, &addr_size);
        if (client_fd == -1) {
            perror("accept");
            continue;
        }
        printf("New client connected.\n");
        
        // Recevoir la commande : SEND ou RECEIVE
        bytes_read = recv(client_fd, buffer, BUFSIZE - 1, 0);
        if (bytes_read <= 0) {
            close(client_fd);
            continue;
        }
        buffer[bytes_read] = '\0';

        if (strcmp(buffer, "SEND") == 0) {
            char buffer[BUFSIZE];
            char sender[BUFSIZE], receiver[BUFSIZE], message[BUFSIZE];
            memset(buffer, 0, BUFSIZE);
            memset(sender, 0, BUFSIZE);
            memset(receiver, 0, BUFSIZE);
            memset(message, 0, BUFSIZE);

            // Lire les données dans une boucle
            int total_received = 0;
            while (1) {
                int bytes_received = recv(client_fd, buffer + total_received, BUFSIZE - total_received, 0);
                if (bytes_received <= 0) {
                    printf("Error or connection closed by client.\n");
                    return EXIT_FAILURE;
                }
                total_received += bytes_received;

                // Arrêter si on détecte un séparateur ou si le buffer est plein
                if (strchr(buffer, '\n')) {
                    break;
                }
            }

            // Extraire les données
            char *token = strtok(buffer, "\n");
            if (token != NULL) {
                strncpy(sender, token, BUFSIZE);
                token = strtok(NULL, "\n");
            }
            if (token != NULL) {
                strncpy(receiver, token, BUFSIZE);
                token = strtok(NULL, "\n");
            }
            if (token != NULL) {
                strncpy(message, token, BUFSIZE);
            }

            // Afficher les données reçues
            printf("Received sender: %s\n", sender);
            printf("Received receiver: %s\n", receiver);
            printf("Received message: %s\n", message);

            // Sauvegarder le message
            save_message(sender, receiver, message);

            // Répondre au client
            send(client_fd, "Message saved.\n", 16, 0);
        } else if (strcmp(buffer, "RECEIVE") == 0) {
            char buffer[BUFSIZE];
            char receiver[BUFSIZE];
            memset(buffer, 0, BUFSIZE);
            memset(receiver, 0, BUFSIZE);

            recv(client_fd, receiver, BUFSIZE - 1, 0);
            send_user_messages(client_fd, receiver);
        } else {
            send(client_fd, "Invalid command.\n", 18, 0);
        }

        close(client_fd);
    }

    close(socket_fd);
    return 0;
}
