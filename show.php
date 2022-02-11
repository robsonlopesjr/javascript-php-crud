<?php
include_once "./config/connection.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $stmt = "SELECT * FROM users WHERE id = :id LIMIT 1";
    $stmt = $conn->prepare($stmt);
    $stmt->bindParam(":id", $id, FILTER_SANITIZE_NUMBER_INT);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $response = [
        "erro" => false,
        "data" => $user,
    ];
} else {
    $response = [
        "erro" => true,
        "msg" => "<div class='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado!</div>"
    ];
}

echo json_encode($response);
