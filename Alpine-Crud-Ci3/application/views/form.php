<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="<?= base_url('./../assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('./../assets/css/all.min.css') ?>" rel="stylesheet">
    <!-- Alpine Script -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body x-data="user_form_area" x-cloak x-init="set_values()">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><?= $title ?></h4>
                    </div>
                    <div class="card-body">
                        <form x-on:submit.prevent="save_user()" class="p-3">
                            <!-- Hidden ID field -->
                            <input type="hidden" id="id" name="id" x-model="user.id">
                            <div class="row">
                                <!-- Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-person"></i> 
                                        </span>
                                        <input type="text" id="name" name="name" x-model="user.name" class="form-control" placeholder="Enter your name">
                                    </div>
                                </div>

                                <!-- Age -->
                                <div class="col-md-6 mb-3">
                                    <label for="age" class="form-label">Age</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="number" id="age" name="age" x-model="user.age" class="form-control" placeholder="Enter your age">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-envelope"></i> 
                                        </span>
                                        <input type="email" id="email" name="email" x-model="user.email" class="form-control" placeholder="Enter your email">
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-lock"></i> 
                                        </span>
                                        <input type="password" id="password" name="password" x-model="user.password" class="form-control" placeholder="Enter your password">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- City -->
                                <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <select id="city" name="city" class="form-select" x-model="user.city">
                                        <option selected disabled>Select your city</option>
                                        <option value="Rajkot">Rajkot</option>
                                        <option value="Morbi">Morbi</option>
                                        <option value="Ahemdabad">Ahemdabad</option>
                                        <option value="Patan">Patan</option>
                                        <option value="Mumbai">Mumbai</option>
                                        <option value="Bhuj">Bhuj</option>
                                        <!-- Add more cities as needed -->
                                    </select>
                                </div>

                                <!-- Address -->
                                <div class="col-md-6 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea id="address" name="address" x-model="user.address" class="form-control" placeholder="Enter your address"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Gender -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Gender</label>
                                    <div class="form-check">
                                        <input type="radio" id="male" name="gender" x-model="user.gender" value="male" class="form-check-input">
                                        <label for="male" class="form-check-label">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="female" name="gender" x-model="user.gender" value="female" class="form-check-input">
                                        <label for="female" class="form-check-label">Female</label>
                                    </div>
                                </div>

                                <!-- Skills -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Skills</label>
                                    <div class="form-check">
                                        <input type="checkbox" id="html" name="skills[]" x-model="user.skills" value="HTML" class="form-check-input">
                                        <label for="html" class="form-check-label">HTML</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" id="css" name="skills[]" x-model="user.skills" value="CSS" class="form-check-input">
                                        <label for="css" class="form-check-label">CSS</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" id="php" name="skills[]" x-model="user.skills" value="PHP" class="form-check-input">
                                        <label for="php" class="form-check-label">PHP</label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('./../assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('./../assets/js/all.min.js') ?>"></script>
    <script>
        function user_form_area() {
            return {
                user: {
                    id          : "",
                    name        : "",
                    age         : "",
                    email       : "",
                    password    : "",
                    city        : "",
                    address     : "",
                    gender      : "",
                    skills      : []
                },
                save_user() {
                    if (this.user.name != "" && this.user.email != "" && this.user.age != "" && this.user.password != "" && this.user.city != "" && this.user.address != "" && this.user.gender != "" && this.user.skills.length != 0) {
                        axios.post('<?= base_url('users/save') ?>', new URLSearchParams(this.user))
                            .then((response) => {
                                if (response.data.status) {
                                    alert(response.data.message);
                                    window.location.href = "<?= base_url("users/table") ?>"
                                } else {
                                    alert(response.data.message);
                                }
                            }).catch((error) => {
                                alert(error);
                            })
                    }
                },
                set_values() {
                 
                    this.user.id        = "<?= $user['id'] ?? '' ?>";
                    this.user.name      = "<?= $user['name'] ?? '' ?>";
                    this.user.age       = "<?= $user['age'] ?? '' ?>";
                    this.user.email     = "<?= $user['email'] ?? '' ?>";
                    this.user.password  = "<?= $user['password'] ?? '' ?>";
                    this.user.city      = "<?= $user['city'] ?? '' ?>";
                    this.user.address   = "<?= $user['address'] ?? '' ?>";
                    this.user.gender    = "<?= $user['gender'] ?? '' ?>";
                    this.user.skills    = <?= json_encode($user['skills'] ?? []) ?>;
                }

            }
        }
    </script>
</body>

</html>