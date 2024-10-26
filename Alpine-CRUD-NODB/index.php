<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body x-data="user_management()" x-cloak>
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="col-7 col-md-7 col-lg-8">
            <div class="button-area">
                <button x-on:click="isAddOrClose = !isAddOrClose" x-show="!isAddOrClose" class="btn btn-primary mb-2">Add User</button>
                <button x-on:click="isAddOrClose = !isAddOrClose" x-show="isAddOrClose" class="btn btn-primary mb-2">Close</button>
            </div>
            <div class="form-area mb-3" x-show="isAddOrClose" x-transition>
                <form action="" x-on:submit.prevent="add()">
                    <div class="row">
                        <div class="col-4">
                            <input type="text" name="name" id="name" class="form-control" x-model="newuser.name" placeholder="Enter user name">
                        </div>
                        <div class="col-4">
                            <input type="email" name="email" id="email" class="form-control" x-model="newuser.email" placeholder="Enter user email">
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary">Add User</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h3 x-text="title"></h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-stripped table-boardered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="user in users" :key="user.id">
                                    <tr>
                                        <td x-text="$id('row').split('-')[1]"></td>
                                        <td x-text="user.name">/td>
                                        <td x-text="user.email"></td>
                                        <td>
                                            <button x-on:click="edit(user.id)" data-bs-toggle="modal" data-bs-target="#user_modal" class="btn btn-warning btn-sm">Update</button>
                                            <button x-on:click="deleteUser(user.id)" class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="user_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Submit Your Info</h5>
                    <button type="button" x-ref="close_modal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="userForm" x-on:submit.prevent="updateUser($refs.user_id.value)">
                        <input type="hidden" name="id" x-ref="user_id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" x-ref="user_name" id="name" x-model="newuser.name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" x-ref="user_email" id="email" x-model="newuser.email" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<script defer src="./assets/js/bootstrap.min.js"></script>
<script>
    function user_management() {
        return {
            title: 'User Management',
            users: [{
                'id': '1',
                'name': 'Jaysinh',
                'email': 'Jaysinh@gmail.com'
            }, {
                'id': '2',
                'name': 'Het',
                'email': 'Het@gmail.com'
            }],
            isAddOrClose: false,
            newuser: {
                name: "",
                email: ""
            },
            add() {
                user = {};
                user['id'] = Date.now();
                user['name'] = this.newuser.name;
                user['email'] = this.newuser.email;
                this.users.push(user);
                this.newuser.name = "";
                this.newuser.email = ""
                this.isAddOrClose = false;
            },
            edit(userId) {
                user = this.users.find(user => user.id == userId);
                this.$refs.user_id.value = user.id;
                this.$refs.user_name.value = user.name;
                this.$refs.user_email.value = user.email;
            },
            updateUser(userId) {
                const userIndex = this.users.findIndex(user => user.id == userId);
                if (userIndex != -1) {
                    this.newuser.name != "" ? this.users[userIndex].name = this.newuser.name : false;
                    this.newuser.email != "" ? this.users[userIndex].email = this.newuser.email : false;
                    this.newuser.name = "";
                    this.newuser.email = ""
                    this.$refs.close_modal.click();
                }
            },
            deleteUser(userId) {
                const userIndex = this.users.findIndex(user => user.id == userId);
                if (userIndex !== -1) {
                    this.users.splice(userIndex, 1);
                }
            }
        }
    }
</script>

</html>