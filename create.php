<?php
include_once "./config/connection.php";

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($data['name'])) {
    $response = [
        "erro" => true,
        "msg" => "<div class='alert alert-warning' role='alert'>Erro: Necessário preencher o campo nome!</div>"
    ];
} elseif (empty($data['email'])) {
    $response = [
        "erro" => true,
        "msg" => "<div class='alert alert-warning' role='alert'>Erro:  Necessário preencher o campo email!</div>"
    ];
} else {
    $query_user = "INSERT INTO `users` (name, email) VALUES (:name, :email)";
    $addUser = $conn->prepare($query_user);

    $addUser->bindParam(":name", $data["name"]);
    $addUser->bindParam(":email", $data["email"]);

    $addUser->execute();

    if ($addUser->rowCount()) {
        $response = [
            "erro" => false,
            "msg" => "<div class='alert alert-success' role='alert'>Usuário cadastrado com sucesso!</div>"
        ];
    } else {
        $response = [
            "erro" => true,
            "msg" => "<div class='alert alert-danger' role='alert'>Erro: Usuário não cadastrado com sucesso!</div>"
        ];
    }
}

echo json_encode($response);
