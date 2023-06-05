const userCreate = document.querySelector(".userCreate");
const userEdit = document.querySelectorAll(".userEdit");
const userDelete = document.querySelectorAll(".userDelete");

userCreate.addEventListener("click", () => {
    handleCreate();
});
userEdit.forEach((e) => {
    e.addEventListener("click", () => {
        handleEdit(JSON.parse(e.getAttribute("userData")));
    });
});
userDelete.forEach((e) => {
    e.addEventListener("click", () => {
        handleDelete(e.getAttribute("userID"));
    });
});

function handleCreate() {
    Swal.fire({
        title: "Create",
        html: `<input type="text" id="name" class="swal2-input" placeholder="Name">
                   <input type="email" id="email" class="swal2-input" placeholder="Email">
                   <input type="password" id="password" class="swal2-input" placeholder="Password">`,
        confirmButtonText: "Submit",
        focusConfirm: false,
        preConfirm: () => {
            const name = Swal.getPopup().querySelector("#name").value;
            const email = Swal.getPopup().querySelector("#email").value;
            const password = Swal.getPopup().querySelector("#password").value;
            if (!name || !email || !password) {
                Swal.showValidationMessage(`Please enter your data.`);
            }
            return {
                name: name,
                email: email,
                password: password,
            };
        },
    }).then((result) => {
        axios
            .post(`api/user`, result.value)
            .then(function (response) {
                console.log(response.data);
                location.reload();
            })
            .catch(function (error) {
                console.error(error);
            });
    });
}

function handleEdit(userData) {
    console.log(userData);
    Swal.fire({
        title: "Edit",
        html: `<input type="text" id="name" class="swal2-input" placeholder="Name" value="${userData.name}">
                   <input type="email" id="email" class="swal2-input" placeholder="Email" value=${userData.email}>
                   <input type="text" id="password" class="swal2-input" placeholder="Password" value=${userData.password}>`,
        confirmButtonText: "Submit",
        focusConfirm: false,
        preConfirm: () => {
            const name = Swal.getPopup().querySelector("#name").value;
            const email = Swal.getPopup().querySelector("#email").value;
            const password = Swal.getPopup().querySelector("#password").value;
            if (!name || !email || !password) {
                Swal.showValidationMessage(`Please enter your data.`);
            }
            return {
                name: name,
                email: email,
                password: password,
            };
        },
    }).then((result) => {
        axios
            .put(`api/user/${userData.id}`, result.value)
            .then(function (response) {
                console.log(response.data);
                location.reload();
            })
            .catch(function (error) {
                console.error(error);
            });
    });
}

function handleDelete(userID) {
    axios
        .delete(`api/user/${userID}`)
        .then(function (response) {
            console.log(response.data);
            location.reload();
        })
        .catch(function (error) {
            console.error(error);
        });
}
