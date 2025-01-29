#include <errno.h>
#include <netdb.h>
#include <stdio.h>
#include <string.h>
#include <sys/socket.h>
#include <sys/types.h>
#include <unistd.h>
#include <stdlib.h>
#include <postgresql/libpq-fe.h>
#include <stdbool.h>

#define PORT 4242
#define BUFSIZE 4096

void send_message(int socket_fd, char *api_key) {
    char sender[BUFSIZE], receiver[BUFSIZE], message[BUFSIZE];
    char buffer[3 * BUFSIZE];  // Tampon pour toutes les données

    strncpy(sender, api_key, BUFSIZE);
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



void receive_messages(int socket_fd, char *api_key) {
    char username[BUFSIZE], buffer[BUFSIZE];
    int bytes_read;

    strncpy(username, api_key, BUFSIZE);
    username[strcspn(username, "\n")] = '\0';


    send(socket_fd, "RECEIVE", 7, 0);
    // send(socket_fd, username, strlen(username), 0);

    system("clear");

    while (1) {
        // Réception des messages
        system("clear");
        printf("\n\n");
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
        printf("\n\n\n============================= MENU ==============================\n∥\t\t\t\t\t\t\t\t∥\n");
        printf("∥          - '+'\t TO SEE THE PREVIOUS MESSAGES\t\t∥\n∥          - 'CHANGE'\t TO MODIFIY A PREVIOUS MESSAGE\t\t∥\n∥          - 'DELETE'\t TO DELETE A PREVIOUS MESSAGE\t\t∥\n∥          - '-'\t TO RETURN TO THE HOME MENU\t\t∥\n");
        printf("∥\t\t\t\t\t\t\t\t∥\n=================================================================\n");
        printf("\n>> ");
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
            send(socket_fd, "-", 1, 0);
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

        } else if(strcmp(choice, "DELETE") == 0) {
            printf("Enter the message ID you want to delete: ");
            int message_id;
            scanf("%d", &message_id);
            getchar(); // Consommer le caractère '\n' laissé par scanf

            // Préparer la commande SUPPR avec l'ID
            char command[BUFSIZE];
            snprintf(command, BUFSIZE, "DELETE %d", message_id);
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



void print_menu_message() {
    system("clear");
    printf("\n\n");
    printf("========================= MENU ==========================\n∥\t\t\t\t\t\t\t∥\n");
    printf("∥          - 'SEND'\t TO SEND A MESSAGE      \t∥\n∥          - 'RECEIVE'\t TO FETCH MESSAGES      \t∥\n∥          - 'QUIT'\t TO QUIT THE SERVICE     \t∥\n");
    printf("∥\t\t\t\t\t\t\t∥\n=========================================================\n");
    printf("\n>> ");
}

void menu_message(char choice[BUFSIZE], int socket_fd, char api_key[BUFSIZE]) {
    while (1) {
        system("clear");
        print_menu_message();
        fgets(choice, BUFSIZE, stdin);
        choice[strcspn(choice, "\n")] = '\0';

        if (strcmp(choice, "SEND") == 0) {
            send_message(socket_fd, api_key);
        } else if (strcmp(choice, "RECEIVE") == 0) {
            receive_messages(socket_fd, api_key);
        // } else if(strcmp(choice, "CLEAR") == 0) {
        //     send(socket_fd, "CLEAR", 5, 0);
        // } else if(strcmp(choice, "AFFICHER") == 0) { 
        //     send(socket_fd, "AFFICHER", 8, 0);
        } else if(strcmp(choice, "QUIT") == 0) {
            system("clear");
            break;
        } else {
            printf("Invalid choice.\n");
        }
    }
}

void print_menu_conv() {
    system("clear");
    printf("\n\n");
    printf("========================= MENU ==========================\n∥\t\t\t\t\t\t\t∥\n");
    printf("∥          - TAP THE ID\t TO CHOOSE THE CONV      \t∥\n∥          - TAP 'QUIT'\t TO QUIT THE SERVICE     \t∥\n");
    printf("∥\t\t\t\t\t\t\t∥\n=========================================================\n");
}


void menu_conv(char choice[BUFSIZE], int socket_fd, char api_key[BUFSIZE]) {
    char buffer[BUFSIZE];
    int bytes_read;
    while (1) {
        send(socket_fd, api_key, strlen(api_key), 0);
        print_menu_conv(socket_fd, api_key);

        printf("\n\n");

        while ((bytes_read = recv(socket_fd, buffer, BUFSIZE - 1, 0)) > 0) {
            buffer[bytes_read] = '\0';

            // Vérifier la fin du bloc
            if (strcmp(buffer, "END_OF_BLOCK") == 0) {
                break; // Fin des messages, on passe aux interactions utilisateur
            }

            printf("%s", buffer);
        }
        printf("\n");

        printf("CHOOSE YOUR CONVERSATION WITH THE ID OF THE CONVERSATION : \n");

        printf("\n>> ");

        fgets(choice, BUFSIZE, stdin);
        choice[strcspn(choice, "\n")] = '\0';

        if (strcmp(choice, "QUIT") == 0) {
            send(socket_fd, "QUIT", 4, 0);
            break; // Quitter la boucle
        } else {
            send(socket_fd, choice, strlen(choice), 0);
            menu_message(choice, socket_fd, api_key);
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

    printf("LOGIN YOUSELF WITH YOUR API KEY\n");
    char api_key[BUFSIZE];
    printf("API KEY: ");
    fgets(api_key, BUFSIZE, stdin);
    send(socket_fd, api_key, strlen(api_key), 0);

    int bytes_received = recv(socket_fd, choice, BUFSIZE - 1, 0);
    if (bytes_received < 0) {   
        perror("recv");
        close(socket_fd);
        return 3;
    }
    choice[bytes_received] = '\0';
    printf("Received: %s\n", choice);

    if (strcmp(choice, "API_KEY_INVALID") == 0) {
        printf("API key invalid.\n");
        close(socket_fd);
        return 3;
    } else if (strcmp(choice, "API_KEY_VALID") == 0) {
        printf("API key valid.\n");

        while (1) {
            menu_conv(choice, socket_fd, api_key);
        }
        
    } else {
        printf("Unknown response from server.\n");
        close(socket_fd);
        return 4;
    }


    close(socket_fd);
    return 0;
}
