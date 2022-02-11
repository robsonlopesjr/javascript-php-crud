const tbody = document.querySelector(".list-users");

const form = document.getElementById("form-add-user");
const formEditUser = document.getElementById("form-edit-user");

const msgAlert = document.getElementById("msgAlert");
const msgAlertErro = document.getElementById("msgAlertErro");
const msgAlertEdit = document.getElementById("msgAlertEdit");

const addUserModal = new bootstrap.Modal(document.getElementById("addUserModal"));
const editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));

const usersList = async (page) => {
    const data = await fetch("./list.php?page=" + page);

    const response = await data.text();

    tbody.innerHTML = response;
}

usersList(1);

form.addEventListener("submit", async (e) => {
    e.preventDefault();

    document.getElementById("btn-add-user").disabled = true;
    document.getElementById("btn-add-user").value = "Salvando...";

    if (document.getElementById("name").value === "") {
        msgAlertErro.innerHTML = "<div class='alert alert-warning' role='alert'>Erro: Necessário preencher o campo nome!</div>";
    } else if (document.getElementById("email").value === "") {
        msgAlertErro.innerHTML = "<div class='alert alert-warning' role='alert'>Erro:  Necessário preencher o campo email!</div>";
    } else {

        const formData = new FormData(form);
        formData.append("add", 1);

        const data = await fetch("create.php", {
            method: "POST",
            body: formData
        });

        const response = await data.json();

        if (response['erro']) {
            msgAlertErro.innerHTML = response['msg'];
        } else {
            msgAlert.innerHTML = response['msg'];

            form.reset();

            addUserModal.hide();

            usersList(1);
        }
    }

    document.getElementById("btn-add-user").disabled = false;
    document.getElementById("btn-add-user").value = "Cadastrar";
});

async function showUser(id) {
    const data = await fetch('show.php?id=' + id);

    const response = await data.json();

    if (response['erro']) {
        msgAlert.innerHTML = response['msg'];
    } else {
        const showUserModal = new bootstrap.Modal(document.getElementById('showUserModal'));

        document.getElementById("showId").innerHTML = response['data'].id;

        document.getElementById("showName").innerHTML = response['data'].name;

        document.getElementById("showEmail").innerHTML = response['data'].email;

        showUserModal.show();
    }
}

async function editUser(id) {
    msgAlertEdit.innerHTML = "";

    const data = await fetch('show.php?id=' + id);

    const response = await data.json();

    if (response['erro']) {

        msgAlertEdit.innerHTML = response['msg'];
    } else {
        document.getElementById("editUserId").value = response['data'].id;

        document.getElementById("editUserName").value = response['data'].name;

        document.getElementById("editUserEmail").value = response['data'].email;

        editUserModal.show();
    }
}

formEditUser.addEventListener("submit", async (e) => {
    e.preventDefault();

    document.getElementById("btn-edit-user").disabled = true;
    document.getElementById("btn-edit-user").value = "Salvando...";

    if (document.getElementById("editUserId").value === "") {
        msgAlertErro.innerHTML = "<div class='alert alert-warning' role='alert'>Erro: Tente novamente mais tarde!</div>";
    } else if (document.getElementById("editUserName").value === "") {
        msgAlertErro.innerHTML = "<div class='alert alert-warning' role='alert'>Erro: Necessário preencher o campo nome!</div>";
    } else if (document.getElementById("editUserEmail").value === "") {
        msgAlertErro.innerHTML = "<div class='alert alert-warning' role='alert'>Erro:  Necessário preencher o campo email!</div>";
    } else {
        const formData = new FormData(formEditUser);

        const data = await fetch("edit.php", {
            method: "POST",
            body: formData
        });

        const response = await data.json();

        if (response['erro']) {
            msgAlertEdit.innerHTML = response['msg'];
        } else {
            msgAlertEdit.innerHTML = response['msg'];

            usersList(1);
        }
    }

    document.getElementById("btn-edit-user").disabled = false;
    document.getElementById("btn-edit-user").value = "Atualizar";
});

async function deleteUser(id) {
    var confirmDestroy = confirm("Tem certeza que deseja excluir o registro informado?");

    if (confirmDestroy) {
        const data = await fetch('delete.php?id=' + id);

        const response = await data.json();

        if (response['erro']) {
            msgAlert.innerHTML = response['msg'];
        } else {
            msgAlert.innerHTML = response['msg'];

            usersList(1);
        }
    }

}