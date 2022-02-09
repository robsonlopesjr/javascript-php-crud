const tbody = document.querySelector(".list-users");

const usersList = async (page) => {
    const data = await fetch("./list.php?page=" + page);

    const response = await data.text();

    tbody.innerHTML = response;
}

usersList(1);