#include <stdio.h>

// ========================
// Fichier de configuration
// ========================

// Port d'écoute du serveur
#define PORT "4242" // Port utilisé pour écouter les connexions entrantes

// Nombre maximal de connexions en attente
#define BACKLOG 10 // Nombre de connexions mises en file d'attente avant d'être acceptées

// Taille maximale du buffer de réception
#define BUFSIZE 4096 // Taille maximale du buffer utilisé pour recevoir les messages

// Nombre maximal de messages renvoyés à un utilisateur
#define LEN_MSG_HISTORY 3 // Nombre d'anciens messages récupérés lors d'une requête

// Durée de bannissement en secondes
#define BAN_DURATION 3600 // Temps en secondes avant qu'un utilisateur banni puisse se reconnecter

// Nombre maximal de messages envoyés par minute
#define MAX_MESSAGES_PER_MIN 30 // Limite du nombre de messages qu'un utilisateur peut envoyer par minute

// Taille maximale d'un message en caractères
#define MAX_MSG_SIZE 1024 // Nombre maximal de caractères autorisés dans un message unique

// Taille maximale du buffer de la clé d'API
#define BUFFER_SIZE 1024 // Nombre maximale de caractères dans le buffer de la clé d'API

// Taille de la clé d'API
#define SIZE_KEY 64 // Taille de la clé d'API en caractères

int main() {
    printf("Configuration chargée :\n");
    printf("Port : %s\n", PORT);
    printf("Backlog : %d\n", BACKLOG);
    printf("Taille du buffer : %d\n", BUFSIZE);
    printf("Historique de messages : %d\n", LEN_MSG_HISTORY);
    printf("Durée de bannissement : %d secondes\n", BAN_DURATION);
    printf("Messages max par minute : %d\n", MAX_MESSAGES_PER_MIN);
    printf("Taille max d'un message : %d caractères\n", MAX_MSG_SIZE);
    printf("Taille du buffer de la clé d'API : %d\n", BUFFER_SIZE);
    printf("Taille de la clé d'API : %d caractères\n", SIZE_KEY);
    return 0;
}
