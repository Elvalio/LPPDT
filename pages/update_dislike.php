<?php

include ('../sql/connect_params.php');

    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    
    $id_compte = $data['id_compte'];
    $id_avis = $data['id_avis'];
        try {
            $pdo = new PDO("$driver:host=$server;port=$port;dbname=$dbname", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            
            $stmt = $pdo->prepare('INSERT INTO pact._recommande_pas (idC, idA) VALUES (:id_compte, :id_avis)');
            $stmt->execute(['id_compte' => $id_compte, 'id_avis' => $id_avis]);

            
            $stmt = $pdo->prepare('SELECT COUNT(*) as nbr_dislikes FROM pact._recommande_pas WHERE idA = :id_avis');
            $stmt->execute(['id_avis' => $id_avis]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            
            header('Content-Type: application/json');
            echo json_encode(['nbr_dislikes' => $result['nbr_dislikes']]);
            exit;

        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
            exit;
        }
?>
