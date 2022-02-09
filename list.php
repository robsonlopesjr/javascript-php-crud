<?php
include_once "./config/connection.php";

$page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);

if (!empty($page)) {

    /**
     * Quantidade de registros por página
     */
    $limitUsersInPage = 30;
    $begin = ($page * $limitUsersInPage) - $limitUsersInPage;

    $query_users = "SELECT id, name, email FROM `users` ORDER BY id DESC LIMIT $begin, $limitUsersInPage";
    $result_users = $conn->prepare($query_users);
    $result_users->execute();

    $data = "<div class='table-responsive'>
<table class='table table-striped table-bordered'>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>";

    while ($row_user = $result_users->fetch(PDO::FETCH_ASSOC)) {
        extract($row_user);
        $data .= "<tr><td>$id</td><td>$name</td><td>$email</td><td>Ações</td></tr>";
    }

    $data .= "</tbody></table></div>";

    /**
     * PAGINAÇÃO
     */

    /**
     * TOTAL DE REGISTROS
     */
    $query_page = "SELECT COUNT(id) as num_result FROM `users`";
    $result_page = $conn->prepare($query_page);
    $result_page->execute();
    $row_page = $result_page->fetch(PDO::FETCH_ASSOC);

    /**
     * QUANTIDADE DE PAGINAS
     */
    $total_page = ceil($row_page['num_result'] / $limitUsersInPage);

    /**
     * MÁXIMO DE LINKS DE PAGINAÇÃO
     * ANTES E DEPOIS
     */
    $max_links = 2;

    $data .= "<nav aria-label='Page navigation example'>";
    $data .= "<ul class='pagination pagination-sm justify-content-center'>";
    $data .= "<li class='page-item'><a class='page-link' href='#' onClick='usersList(1)'>Primeira</a></li>";

    for ($page_previous = $page - $max_links; $page_previous <= $page - 1; $page_previous++) {
        if ($page_previous >= 1) {
            $data .= "<li class='page-item'><a class='page-link' href='#' onClick='usersList($page_previous)'>$page_previous</a></li>";
        }
    }

    $data .= "<li class='page-item active'><a class='page-link' href='#'>$page</a></li>";

    for ($page_next = $page + 1; $page_next <= $page + $max_links; $page_next++) {
        if ($page_next <= $total_page) {
            $data .= "<li class='page-item'><a class='page-link' href='#' onClick='usersList($page_next)'>$page_next</a></li>";
        }
    }

    $data .= "<li class='page-item'><a class='page-link' href='#' onClick='usersList($total_page)'>Última</a></li>";
    $data .= "</ul>";
    $data .= "</nav>";

    echo $data;
} else {
    echo "<div class='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado!</div>";
}
