<?php
include_once "./config/connection.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $stmt = "DELETE FROM users WHERE id = :id LIMIT 1";
    $stmt = $conn->prepare($stmt);
    $stmt->bindParam(":id", $id, FILTER_SANITIZE_NUMBER_INT);

    if ($stmt->execute()) {
        $response = [
            "erro" => false,
            "msg" => "<div class='alert alert-success' role='alert'>Usuário apagado com sucesso!</div>"
        ];
    } else {
        $response = [
            "erro" => true,
            "msg" => "<div class='alert alert-danger' role='alert'>Erro: Tente novamente mais tarde!</div>"
        ];
    }
} else {
    $response = [
        "erro" => true,
        "msg" => "<div class='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado!</div>"
    ];
}

echo json_encode($response);
