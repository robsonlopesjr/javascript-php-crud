const tbody = document.querySelector("tbody");

const usersList = async () => {
    const data = await fetch("./list.php");

    const response = await data.text();

    tbody.innerHTML = response;
}

usersList();