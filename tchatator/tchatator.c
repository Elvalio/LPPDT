#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <arpa/inet.h>
#include <time.h>

#define PORT 8080
#define MAX_MESSAGE_SIZE 1000
#define MAX_CLIENTS 1

// Function prototypes
void handle_client(int client_socket);

int main() {
    int server_socket, client_socket;
    struct sockaddr_in server_addr, client_addr;
    socklen_t addr_len = sizeof(client_addr);

    // Create socket
    if ((server_socket = socket(AF_INET, SOCK_STREAM, 0)) < 0) {
        perror("Socket creation failed");
        exit(EXIT_FAILURE);
    }

    // Configure server address
    server_addr.sin_family = AF_INET;
    server_addr.sin_addr.s_addr = INADDR_ANY;
    server_addr.sin_port = htons(PORT);

    // Bind the socket
    if (bind(server_socket, (struct sockaddr *)&server_addr, sizeof(server_addr)) < 0) {
        perror("Bind failed");
        close(server_socket);
        exit(EXIT_FAILURE);
    }

    // Listen for incoming connections
    if (listen(server_socket, MAX_CLIENTS) < 0) {
        perror("Listen failed");
        close(server_socket);
        exit(EXIT_FAILURE);
    }

    printf("Server listening on port %d...\n", PORT);

    // Main server loop
    while (1) {
        // Accept client connection
        if ((client_socket = accept(server_socket, (struct sockaddr *)&client_addr, &addr_len)) < 0) {
            perror("Accept failed");
            continue;
        }

        printf("Client connected.\n");
        handle_client(client_socket);
        close(client_socket);
        printf("Client disconnected.\n");
    }

    close(server_socket);
    return 0;
}

void handle_client(int client_socket) {
    char buffer[MAX_MESSAGE_SIZE + 50]; // Extra space for protocol headers
    char response[256];

    // Example: Sending a welcome message
    snprintf(response, sizeof(response), "200/OK: Welcome to the Tchatator service!\n");
    send(client_socket, response, strlen(response), 0);

    while (1) {
        memset(buffer, 0, sizeof(buffer));

        // Receive client message
        int bytes_received = recv(client_socket, buffer, sizeof(buffer) - 1, 0);
        if (bytes_received <= 0) {
            break;
        }

        buffer[bytes_received] = '\0'; // Ensure null termination

        printf("Received: %s\n", buffer);

        // Example: Handling a simple LOGIN command
        if (strncmp(buffer, "LOGIN:", 6) == 0) {
            // Simulate API key verification
            char *api_key = buffer + 6;
            api_key[strcspn(api_key, "\n")] = 0; // Remove newline

            if (strcmp(api_key, "valid_api_key") == 0) {
                snprintf(response, sizeof(response), "200/OK: Login successful.\n");
            } else {
                snprintf(response, sizeof(response), "403/DENIED: Invalid API key.\n");
            }
            send(client_socket, response, strlen(response), 0);
        } else {
            snprintf(response, sizeof(response), "400/BADREQ: Unknown command.\n");
            send(client_socket, response, strlen(response), 0);
        }
    }
}
