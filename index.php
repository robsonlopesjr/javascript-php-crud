<?php
include_once "./config/connection.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>CRUD - PHP FETCH</title>
</head>

<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                    <h4>Listar Usuários</h4>
                </div>
                <div>
                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        Cadastrar
                    </button>
                </div>
            </div>
        </div>

        <hr />

        <span id="msgAlert"></span>

        <div class="row">
            <div class="col-lg-12">
                <span class="list-users"></span>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModal">Cadastrar Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-add-user">
                    <span id="msgAlertErro"></span>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Nome:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome completo..." required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">E-mail:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail..." required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
                        <input type="submit" class="btn btn-outline-success btn-sm" value="Cadastrar" id="btn-add-user" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showUserModal" tabindex="-1" aria-labelledby="showUserModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showUserModal">Detalhes do Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <span id="msgAlertErroShow"></span>
                <div class="modal-body">
                    <dl class="row">
                        <dt class="col-sm-3">ID</dt>
                        <dd class="col-sm-9"><span id="showId"></span></dd>

                        <dt class="col-sm-3">Nome</dt>
                        <dd class="col-sm-9"><span id="showName"></span></dd>

                        <dt class="col-sm-3">E-mail</dt>
                        <dd class="col-sm-9"><span id="showEmail"></span></dd>
                    </dl>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./js/custom.js"></script>
</body>

</html>