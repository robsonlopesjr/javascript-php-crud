<?php
include_once "./config/connection.php";

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($data['editUserId'])) {
    $response = [
        "erro" => true,
        "msg" => "<div class='alert alert-warning' role='alert'>Erro: Tente novamente mais tarde!</div>"
    ];
} elseif (empty($data['editUserName'])) {
    $response = [
        "erro" => true,
        "msg" => "<div class='alert alert-warning' role='alert'>Erro: Necessário preencher o campo nome!</div>"
    ];
} elseif (empty($data['editUserEmail'])) {
    $response = [
        "erro" => true,
        "msg" => "<div class='alert alert-warning' role='alert'>Erro:  Necessário preencher o campo email!</div>"
    ];
} else {
    $stmt = "UPDATE `users` SET name = :name, email = :email WHERE id = :id";
    $stmt = $conn->prepare($stmt);

    $stmt->bindParam(":name", $data["editUserName"]);
    $stmt->bindParam(":email", $data["editUserEmail"]);
    $stmt->bindParam(":id", $data["editUserId"]);

    if ($stmt->execute()) {
        $response = [
            "erro" => false,
            "msg" => "<div class='alert alert-success' role='alert'>Usuário atualizado com sucesso!</div>"
        ];
    } else {
        $response = [
            "erro" => true,
            "msg" => "<div class='alert alert-danger' role='alert'>Erro: Usuário não atualizado com sucesso!</div>"
        ];
    }
}

echo json_encode($response);
