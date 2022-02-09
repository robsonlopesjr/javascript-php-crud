<?php
include_once "./config/connection.php";

$query_users = "SELECT id, name, email FROM `users` LIMIT 10";
$result_users = $conn->prepare($query_users);
$result_users->execute();

$data = "";

while ($row_user = $result_users->fetch(PDO::FETCH_ASSOC)) {
    extract($row_user);
    $data .= "<tr><td>$id</td><td>$name</td><td>$email</td><td>Ações</td></tr>";
}

echo $data;
