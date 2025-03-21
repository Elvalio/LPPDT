<?php

include ('../sql/connect_params.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image-profil'])) {
    $uploadDir = "../images/";
    $fileName = uniqid() . "_" . basename($_FILES["image-profil"]["name"]);
    $uploadFile = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES["image-profil"]["tmp_name"], $uploadFile)) {
        $userId = $_COOKIE['user'];
        $db = new PDO(DB_DSN, DB_USER, DB_PASS);
        $stmt = $db->prepare("UPDATE  SET image = :image-profil WHERE idC = :idc");
        $stmt->execute([$uploadFile, $userId]);

        echo json_encode(["success" => true, "file" => $uploadFile]);
    } else {
        echo json_encode(["success" => false]);
    }
}
?>
