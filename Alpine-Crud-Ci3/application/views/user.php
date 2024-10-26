<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Alpine Script -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body x-data="user_table" x-cloak>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between">
                        <div class="heading">
                            <h4 class="mb-0">User List</h4>
                        </div>
                        <div class="addUser">
                            <a href="<?= site_url('users') ?>" class="btn btn-primary">Add User</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="user_table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Email</th>
                                        <th>City</th>
                                        <th>Gender</th>
                                        <th>Skills</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($users)): ?>
                                        <?php foreach ($users as $user): ?>
                                            <tr>
                                                <td><?= $user['id'] ?></td>
                                                <td><?= $user['name'] ?></td>
                                                <td><?= $user['age'] ?></td>
                                                <td><?= $user['email'] ?></td>
                                                <td><?= $user['city'] ?></td>
                                                <td><?= $user['gender'] ?></td>
                                                <td><?= $user['skills'] ?></td>
                                                <td>
                                                    <a href="<?= site_url('users/index/') . $user['id'] ?>" class="btn btn-sm btn-warning" id='edit' data-id='${val.id}'>Edit</a>
                                                    <button x-on:click="delete_user(<?= $user['id'] ?>)" class="btn btn-sm btn-danger" id='delete' data-id='<?= $user['id'] ?>'>Delete</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script>
        function user_table() {
            return {
                delete_user(user_id) {
                    axios.post("<?= base_url("users/delete") ?>", new URLSearchParams({
                        id: user_id
                    })).then((response) => {
                        if (response.data.status) {
                            alert(response.data.message);
                            window.location.reload();
                        } else {
                            alert(response.data.message);
                        }
                    }).catch((error) => {
                        alert(error);
                    })
                }
            }
        }
    </script>
</body>

</html>