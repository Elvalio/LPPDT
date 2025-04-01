<?php
include ('../sql/connect_params.php');


try {
    $pdo = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Connexion à la base de données échouée']);
    exit;
}

$sql = "SELECT * FROM pact.membre WHERE idC = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $_COOKIE['user']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo json_encode(['password' => $user['password']]);
}