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

    printf("Messages for you:\n");
    while ((bytes_read = recv(socket_fd, buffer, BUFSIZE - 1, 0)) > 0) {
        buffer[bytes_read] = '\0';
        printf("%s", buffer);
        printf("\n");
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

    printf("Type 'SEND' to send a message or 'RECEIVE' to fetch messages: ");
    fgets(choice, BUFSIZE, stdin);
    choice[strcspn(choice, "\n")] = '\0';

    if (strcmp(choice, "SEND") == 0) {
        send_message(socket_fd);
    } else if (strcmp(choice, "RECEIVE") == 0) {
        receive_messages(socket_fd);
    } else {
        printf("Invalid choice.\n");
    }

    close(socket_fd);
    return 0;
}
