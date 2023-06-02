<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel API</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div>
        <button class="bg-blue-500 px-4 rounded-xl mt-4 ml-4" onclick="handleCreate()">Create</button>
    </div>
    @foreach ($users as $user)
        <div class="flex gap-4 my-4 w-full">
            <div>
                <p>ID : {{ $user->id }}</p>
            </div>
            <div>
                <p>Name : {{ $user->name }}</p>
            </div>
            <div>
                <p>Email : {{ $user->email }}</p>
            </div>
            <div>
                <p>Password : {{ $user->password }}</p>
            </div>
            <div class="flex gap-4 flex-1">
                <button class="bg-yellow-500 px-4 rounded-xl" onclick="handleEdit({{ $user }})">Edit</button>
                <button class="bg-red-500 px-4 rounded-xl" onclick="handleDelete({{ $user->id }})">Delete</button>
            </div>
        </div>
    @endforeach
</body>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function handleCreate() {
        Swal.fire({
            title: 'Form',
            html: `<input type="text" id="name" class="swal2-input" placeholder="Name">
                   <input type="email" id="email" class="swal2-input" placeholder="Email">
                   <input type="password" id="password" class="swal2-input" placeholder="Password">`,
            confirmButtonText: 'Submit',
            focusConfirm: false,
            preConfirm: () => {
                const name = Swal.getPopup().querySelector('#name').value
                const email = Swal.getPopup().querySelector('#email').value
                const password = Swal.getPopup().querySelector('#password').value
                if (!name || !email || !password) {
                    Swal.showValidationMessage(`Please enter your data.`)
                }
                return {
                    name: name,
                    email: email,
                    password: password
                }
            }
        }).then((result) => {
            axios.post(`api/user`, result.value)
            .then(function(response) {
                console.log(response.data);
                location.reload();
            })
            .catch(function(error) {
                console.error(error);
            });
        })

    }

    function handleEdit(user) {
        console.log(user)
        Swal.fire({
            title: 'Form',
            html: `<input type="text" id="name" class="swal2-input" placeholder="Name" value=${user.name}>
                   <input type="email" id="email" class="swal2-input" placeholder="Email" value=${user.email}>
                   <input type="text" id="password" class="swal2-input" placeholder="Password">`,
            confirmButtonText: 'Submit',
            focusConfirm: false,
            preConfirm: () => {
                const name = Swal.getPopup().querySelector('#name').value
                const email = Swal.getPopup().querySelector('#email').value
                const password = Swal.getPopup().querySelector('#password').value
                if (!name || !email || !password) {
                    Swal.showValidationMessage(`Please enter your data.`)
                }
                return {
                    name: name,
                    email: email,
                    password: password
                }
            }
        }).then((result) => {
            axios.put(`api/user/${user.id}`, result.value)
            .then(function(response) {
                console.log(response.data);
                location.reload();
            })
            .catch(function(error) {
                console.error(error);
            });
        })

    }

    function handleDelete(id) {
        axios.delete(`api/user/${id}`)
            .then(function(response) {
                console.log(response.data);
                location.reload();
            })
            .catch(function(error) {
                console.error(error);
            });
    }
</script>

</html>
