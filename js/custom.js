const tbody = document.querySelector(".list-users");

const form = document.getElementById("form-add-user");

const msgAlertErro = document.getElementById("msgAlertErro");
const msgAlert = document.getElementById("msgAlert");

const addUserModal = new bootstrap.Modal(document.getElementById("addUserModal"));

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
        const showModal = new bootstrap.Modal(document.getElementById('showUserModal'));

        document.getElementById("showId").innerHTML = response['data'].id;

        document.getElementById("showName").innerHTML = response['data'].name;

        document.getElementById("showEmail").innerHTML = response['data'].email;

        showModal.show();
    }
}