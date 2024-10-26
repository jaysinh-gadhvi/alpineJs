<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alpine Crud Using PHP</title>
    <!-- Bootstrap Link -->
    <link rel="stylesheet" href="./../assets/css/bootstrap.min.css">
    <!-- Alpine Script -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body x-data="customers_management" x-cloak x-init="getCustomers()">
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="col-md-9 col-lg-9">
            <div class="button-area mb-3">
                <button x-on:click="toggleText" x-text="addOrClose" class="btn btn-primary"></button>
            </div>
            <div class="card shadow">
                <div class="card-header text-center bg-primary text-light">
                    <div class="card-title">
                        <h3>Customers Management</h3>
                    </div>
                </div>
                <div class="card-body">
                    <template x-if="addOrClose === 'Close'">
                        <div>
                            <form x-on:submit.prevent="addCoustomer">
                                <div class="row mb-3">
                                    <input type="hidden" id="id" name="id" x-model="id">
                                    <div class="col-6">
                                        <lable class="form-lable">Name</lable>
                                        <input type="text" x-model="name" name="name" id="name" class="form-control" placeholder="Enter the name">
                                    </div>
                                    <div class="col-6">
                                        <lable class="form-lable">Email</lable>
                                        <input type="text" x-model="email" name="email" id="email" class="form-control" placeholder="Enter the email">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <lable class="form-lable">Number</lable>
                                        <input type="number" x-model="phone" name="phone" id="phone" class="form-control" placeholder="Enter the phone number">
                                    </div>
                                    <div class="col-6">
                                        <lable class="form-lable">Address</lable>
                                        <textarea x-model="address" name="address" id="address" class="form-control" placeholder="Enter the address"></textarea>
                                    </div>
                                </div>
                                <div class="sumit-button">
                                    <button type="submit" class="btn btn-primary w-100">Save</button>
                                </div>
                            </form>
                        </div>
                    </template>
                    <template x-if="addOrClose === 'Add Coustomer'">
                        <div>
                            <div class="table-responsive">
                                <table class="table table-stripped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Number</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="coustomer in showUserData()">
                                            <tr>
                                                <td x-text="coustomer.id"></td>
                                                <td x-text="coustomer.name"></td>
                                                <td x-text="coustomer.email"></td>
                                                <td x-text="coustomer.phone"></td>
                                                <td x-text="coustomer.address"></td>
                                                <td>
                                                    <button x-on:click="updateCoustomer(coustomer.id)" class="btn btn-sm btn-warning ">Update</button>
                                                    <button x-on:click="deleteCoustomer(coustomer.id)" class="btn  btn-danger btn-sm">Delete</button>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Scipt -->
    <script src="./../assets/js/bootstrap.min.js"></script>
    <script>
        function customers_management() {
            return {
                coustomers: [],
                addOrClose: 'Add Coustomer',
                id: "",
                name: "",
                email: "",
                phone: "",
                address: "",
                toggleText() {
                    this.addOrClose = (this.addOrClose == 'Add Coustomer') ? 'Close' : 'Add Coustomer';
                    this.clearValue();
                },
                getCustomers() {
                    if (this.addOrClose == 'Add Coustomer') {
                        const formData = new FormData();
                        formData.append('action', 'select');
                        axios.post('action.php', formData)
                            .then((response) => this.coustomers = response.data.data)
                            .catch(error => alert(error));
                    }
                },
                clearValue() {
                    this.id = ""
                    this.name = "";
                    this.email = "";
                    this.phone = "";
                    this.address = "";
                },
                addCoustomer() {
                    if (this.name != "" && this.email != "" && this.phone != "" && this.address != "") {
                        axios.post('action.php', new URLSearchParams({
                                action: 'save',
                                id: this.id != "" ? this.id : "",
                                name: this.name,
                                email: this.email,
                                phone: this.phone,
                                address: this.address
                            }))
                            .then((response) => {
                                alert(response.data.message);
                            })
                            .catch((error) => {
                                console.error(error);
                            });

                        this.clearValue();
                        this.addOrClose = 'Add Coustomer';
                        window.location.reload();
                    } else {
                        alert("All input field is require");
                        this.clearValue();
                    }
                },
                showUserData() {
                    if (this.coustomers.length != 0) {
                        return this.coustomers;
                    }
                },
                updateCoustomer(userId) {
                    const result = this.coustomers.find(coustomer => coustomer.id == userId);
                    this.id = result.id
                    this.name = result.name;
                    this.email = result.email;
                    this.phone = result.phone;
                    this.address = result.address;
                    this.addOrClose = 'Close';
                },
                deleteCoustomer(userId) {
                    axios.post('action.php', new URLSearchParams({
                            action: 'delete',
                            id: userId
                        }))
                        .then((response) => alert(response.data.message))
                        .catch(error => alert(error));
                    this.addOrClose = 'Add Coustomer';
                    window.location.reload();
                }
            }
        }
    </script>
</body>

</html>