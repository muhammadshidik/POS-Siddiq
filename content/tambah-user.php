<?php

if (isset($_GET['delete'])) {
    $id_user = isset($_GET['delete']) ? $_GET['delete'] : '';
    $queryDelete = mysqli_query($config, "UPDATE users SET deleted_at = 1 WHERE id='$id_user'");

    if ($queryDelete) {
        header("location:?page=user&hapus=berhasil");
    } else {
        header("location:?page=user&hapus=gagal");
    }
}

if (isset($_GET["edit"])) {
    $id_user = isset($_GET["edit"]);
} elseif (isset($_GET["add-user-role"])) {
    $id_user = isset($_GET["add-user-role"]);
}

// $id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM users WHERE id='$id_user'");
$rowEdit = mysqli_fetch_assoc($queryEdit);
// print_r($id_user);
if (isset($_POST['name'])) {
    //ada tidak parameter bernama edit, kalo ada jalankan perintah edit/update, kalo tidak ada tambah data baru/insert
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = isset($_POST['password']) ? sha1($_POST['password']) : $rowEdit['password'];



    if (!isset($_GET['edit'])) {
        $insert = mysqli_query($config, "INSERT INTO users (name, email, password) VALUES('$name','$email','$password')");
        header("location:?page=user&tambah=berhasil");
    } else {
        $Update = mysqli_query($config, "UPDATE users SET name='$name', email='$email', password='$password' WHERE id='$id_user'");
        header("location:?page=user&ubah=berhasil");
    }
}

// $id_user = isset($_GET["add-user-role"]) ? $_GET["add-user-role"] : '';

$queryRoles = mysqli_query($config, "SELECT * FROM roles ORDER BY id DESC");
$rowRoles = mysqli_fetch_all($queryRoles, MYSQLI_ASSOC);

$queryUserRoles = mysqli_query($config, "SELECT user_role.*, roles.name FROM user_role
LEFT JOIN roles ON user_role.id_role = roles.id
WHERE id_user =  '$id_user'
ORDER BY user_role.id DESC");
$rowUserRoles = mysqli_fetch_all($queryUserRoles, MYSQLI_ASSOC);

 if (isset($_POST['id_role'])) {
        $id_role = $_POST['id_role'];
        $insert = mysqli_query($config, "INSERT INTO user_role (id_role, id_user) VALUES('$id_role','$id_user')");
        header("location:?page=Tambah-user&add-user-role=" . $id_user . "add-role=berhasil");
    }

?>


<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <!-- untuk membuat nama user muncul di form -->
                <?php 
                if(isset($_GET['add-user-role'])): 
                $title = "Add User Role : ";
                elseif(isset($_GET["edit"])):
                    $title = "Edit User";
                else:
                    $title = "Tambah User";
                    endif;
                ?>
                <h5 class="card-title"><?php echo $title?></h5>
                <!-- //untuk menghilangkan form add user dan tambah form baru 16/06/2025 -->
                <?php if(isset($_GET['add-user-role'])): ?>
                    <div align="right" class="">
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Role</button>
                    </div>
                    <table class="table table-bordered">
                        <thead></thead>
                            <tr>
                                <th>No</th>
                                <th>Role Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php foreach ($rowUserRoles as $key => $rowUserRole) : ?>
                            <tr>
                                <td><?php $key += 1; ?></td>
                                <td><?php echo $rowUserRole['name']?></td> 
                                <td>
                                    <a href="" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="" onclick="return confirm('are you sure???')" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                </tbody>
                    </table> 
                    <?php else:?>
                         <!-- //untuk menghilangkan form add user -->
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="">Full Name</label>
                        <input value="<?php echo isset($rowEdit['name']) ? $rowEdit['name'] : '' ?>" type="text" class="form-control" name="name" placeholder="Enter Your Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input value="<?php echo isset($rowEdit['email']) ? $rowEdit['email'] : '' ?>" type="email" class="form-control" name="email" placeholder="Enter Your Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Your password" <?php echo empty($id_user) ? 'required' : '' ?>>
                        <small>
                            )* if you want to change your password, you can fill this field
                        </small>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-success" name="save">
                    </div>
                </form>
                <?php endif?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Role : </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Role Name</label>
                        <select name="id_role" id="" class="form-control">
                            <option value="">Select One</option>
                            <?php foreach ($rowRoles as $rowRole): ?>
                                <option value="<?php echo $rowRole['id'] ?>"><?php echo $rowRole['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>