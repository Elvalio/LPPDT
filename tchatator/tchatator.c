#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <arpa/inet.h>
#include <stdbool.h>

#define PORT 8888
#define BUFFER_SIZE 1024

// Structure pour stocker les clés d'API
typedef struct {
    char key[64];
    char role[16]; // "client", "professional", "admin"
} APIKey;

// Exemple de clés d'API stockées en mémoire (pour le test)
APIKey api_keys[] = {
    {"client_api_key", "client"},
    {"professional_api_key", "professional"},
    {"admin_api_key", "admin"}
};

// Fonction pour valider une clé d'API
const char* validate_api_key(const char* api_key) {
    for (int i = 0; i < sizeof(api_keys) / sizeof(APIKey); i++) {
        if (strcmp(api_keys[i].key, api_key) == 0) {
            return api_keys[i].role;
        }
    }
    return NULL;
}

// Fonction pour traiter une requête client
void handle_client_request(int client_socket) {
    char buffer[BUFFER_SIZE];
    int bytes_read = read(client_socket, buffer, BUFFER_SIZE);
    if (bytes_read <= 0) {
        printf("Erreur lors de la lecture de la requête\n");
        close(client_socket);
        return;
    }

    buffer[bytes_read] = '\0';
    printf("Requête reçue : %s\n", buffer);

    // Analyse de la clé d'API
    char api_key[64];
    sscanf(buffer, "LOGIN:%63s", api_key);

    const char* role = validate_api_key(api_key);
    if (role) {
        char response[BUFFER_SIZE];
        snprintf(response, BUFFER_SIZE, "200/OK: Bienvenue, rôle : %s\n", role);
        write(client_socket, response, strlen(response));
    } else {
        const char* response = "403/DENIED: Clé API invalide\n";
        write(client_socket, response, strlen(response));
    }

    close(client_socket);
}

int main() {
    int server_socket, client_socket;
    struct sockaddr_in server_addr, client_addr;
    socklen_t addr_len = sizeof(client_addr);

    // Création du socket
    if ((server_socket = socket(AF_INET, SOCK_STREAM, 0)) == 0) {
        perror("Erreur lors de la création du socket");
        exit(EXIT_FAILURE);
    }

    server_addr.sin_family = AF_INET;
    server_addr.sin_addr.s_addr = INADDR_ANY;
    server_addr.sin_port = htons(PORT);

    // Liaison du socket à l'adresse et au port
    if (bind(server_socket, (struct sockaddr*)&server_addr, sizeof(server_addr)) < 0) {
        perror("Erreur lors du bind");
        close(server_socket);
        exit(EXIT_FAILURE);
    }

    // Mise en écoute
    if (listen(server_socket, 3) < 0) {
        perror("Erreur lors de l'écoute");
        close(server_socket);
        exit(EXIT_FAILURE);
    }

    printf("Serveur en écoute sur le port %d\n", PORT);

    while (true) {
        // Acceptation des connexions entrantes
        if ((client_socket = accept(server_socket, (struct sockaddr*)&client_addr, &addr_len)) < 0) {
            perror("Erreur lors de l'acceptation");
            continue;
        }

        printf("Connexion acceptée\n");
        handle_client_request(client_socket);
    }

    close(server_socket);
    return 0;
}