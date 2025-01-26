#include <errno.h>
#include <netdb.h>
#include <stdio.h>
#include <string.h>
#include <sys/socket.h>
#include <sys/types.h>
#include <unistd.h>
#include <stdlib.h>
#include <postgresql/libpq-fe.h>

#define PORT 4242
#define BUFSIZE 4096

void send_message(int socket_fd) {
char sender[BUFSIZE], receiver[BUFSIZE], message[BUFSIZE];
    char buffer[3 * BUFSIZE];  // Tampon pour toutes les données

    // Demander les informations
    printf("Your id: ");
    fgets(sender, BUFSIZE, stdin);
    sender[strcspn(sender, "\n")] = '\0';

    printf("Recipient id: ");
    fgets(receiver, BUFSIZE, stdin);
    receiver[strcspn(receiver, "\n")] = '\0';

    printf("Your message: ");
    fgets(message, BUFSIZE, stdin);
    message[strcspn(message, "\n")] = '\0';

    // Concaténer toutes les données dans le buffer
    snprintf(buffer, sizeof(buffer), u8"%s\n%s\n%s\n", sender, receiver, message);

    // Envoyer toutes les données en une seule fois
    send(socket_fd, "SEND", 4, 0);  // Envoi du préfixe "SEND"  
    send(socket_fd, buffer, strlen(buffer), 0);

}



void receive_messages(int socket_fd) {
    char username[BUFSIZE], buffer[BUFSIZE];
    int bytes_read;

    printf("Your id: ");
    fgets(username, BUFSIZE, stdin);
    username[strcspn(username, "\n")] = '\0';

    send(socket_fd, "RECEIVE", 7, 0);
    send(socket_fd, username, strlen(username), 0);

    while (1) {
        // Réception des messages
        printf("Messages for you:\n\n");
        while ((bytes_read = recv(socket_fd, buffer, BUFSIZE - 1, 0)) > 0) {
            buffer[bytes_read] = '\0';

            // Vérifier la fin du bloc
            if (strcmp(buffer, "END_OF_BLOCK") == 0) {
                break; // Fin des messages, on passe aux interactions utilisateur
            }

            printf("%s", buffer);
        }
        printf("\n");

        // Interaction utilisateur
        char choice[BUFSIZE];
        printf("- TAP '+' TO SEE PREVIOUS MESSAGES\n- TAP 'CHANGE' TO CHANGE A PREVIOUS MESSAGE\n- TAP 'SUPPR' TO DELETE A PREVIOUS MESSAGE\n- TAP '-' TO QUIT\n ->  ");
        fgets(choice, BUFSIZE, stdin);
        choice[strcspn(choice, "\n")] = '\0';

        if (choice[0] == '+') {
            int message_id;
            printf("Enter message ID: ");
            scanf("%d", &message_id);
            getchar(); // Consommer le caractère '\n' laissé par scanf

            send(socket_fd, "+", 1, 0);
            char message_id_str[BUFSIZE];
            snprintf(message_id_str, BUFSIZE, "%d", message_id);
            send(socket_fd, message_id_str, strlen(message_id_str), 0);
        } else if (choice[0] == '-') {
            break; // Quitter la boucle
        } else if (strcmp(choice, "CHANGE") == 0) {
            printf("Enter the message ID you want to change: ");
            int message_id;
            scanf("%d", &message_id);
            getchar(); // Consommer le caractère '\n'

            // Préparer la commande CHANGE avec l'ID
            char command[BUFSIZE];
            snprintf(command, BUFSIZE, "CHANGE %d", message_id);
            send(socket_fd, command, strlen(command), 0);

            printf("Enter the new message: ");
            char new_message[BUFSIZE];
            fgets(new_message, BUFSIZE, stdin);
            new_message[strcspn(new_message, "\n")] = '\0';

            // Envoyer le nouveau message
            send(socket_fd, new_message, strlen(new_message), 0);

            // Recevoir la réponse
            char response[BUFSIZE];
            int response_bytes_read = recv(socket_fd, response, BUFSIZE - 1, 0);
            response[response_bytes_read] = '\0';
            printf("\n%s\n", response);

        } else if(strcmp(choice, "SUPPR") == 0) {
            printf("Enter the message ID you want to delete: ");
            int message_id;
            scanf("%d", &message_id);
            getchar(); // Consommer le caractère '\n' laissé par scanf

            // Préparer la commande SUPPR avec l'ID
            char command[BUFSIZE];
            snprintf(command, BUFSIZE, "SUPPR %d", message_id);
            send(socket_fd, command, strlen(command), 0);

            // Recevoir la réponse
            char response[BUFSIZE];
            int response_bytes_read = recv(socket_fd, response, BUFSIZE - 1, 0);
            response[response_bytes_read] = '\0';
            printf("\n%s\n", response);
            
        } else {
            printf("Invalid command.\n");
        }
    }
}


int main(void) {
    struct sockaddr_in sa;
    int socket_fd;
    int status;
    char choice[BUFSIZE];



    printf("---- CLIENT ----\n\n");

    memset(&sa, 0, sizeof sa);
    sa.sin_family = AF_INET;
    sa.sin_addr.s_addr = htonl(INADDR_LOOPBACK); // 127.0.0.1
    sa.sin_port = htons(PORT);

    socket_fd = socket(sa.sin_family, SOCK_STREAM, 0);
    if (socket_fd == -1) {
        perror("socket");
        return 1;
    }

    status = connect(socket_fd, (struct sockaddr *)&sa, sizeof sa);
    if (status != 0) {
        perror("connect");
        return 2;
    }
    printf("Connected to server.\n");

    printf("Type 'SEND' to send a message / 'RECEIVE' to fetch messages / 'CLEAR' to drop the data of message/discussion / 'AFFICHER' to show the messages : ");
    fgets(choice, BUFSIZE, stdin);
    choice[strcspn(choice, "\n")] = '\0';

    if (strcmp(choice, "SEND") == 0) {
        send_message(socket_fd);
    } else if (strcmp(choice, "RECEIVE") == 0) {
        receive_messages(socket_fd);
    } else if(strcmp(choice, "CLEAR") == 0) {
        send(socket_fd, "CLEAR", 5, 0);
    } else if(strcmp(choice, "AFFICHER") == 0) { 
        send(socket_fd, "AFFICHER", 8, 0);
    } else {
    printf("Invalid choice.\n");
    }

    close(socket_fd);
    return 0;
}
