<?php

if (isset($_GET['delete'])) {
    $id_user = isset($_GET['delete']) ? $_GET['delete'] : '';
    $queryDelete = mysqli_query($config, "DELETE FROM roles WHERE id='$id_user'");
    if ($queryDelete) {
        header("location:?page=roles&hapus=berhasil");
    } else {
        header("location:?page=roles&hapus=gagal");
    }
}
$id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM roles WHERE id='$id_user'");
$rowEdit = mysqli_fetch_assoc($queryEdit);
// print_r($id_user);
if (isset($_POST['name'])) {
    //ada tidak parameter bernama edit, kalo ada jalankan perintah edit/update, kalo tidak ada tambah data baru/insert
    $name = $_POST['name'];

    if (!isset($_GET['edit'])) {
        $insert = mysqli_query($config, "INSERT INTO roles (name) VALUES('$name')");
        header("location:?page=role&tambah=berhasil");
    } else {
        $Update = mysqli_query($config, "UPDATE roles SET name='$name' WHERE id='$id_user'");
        header("location:?page=role&ubah=berhasil");
    }
}

if (isset($_GET['add-role-menu'])) {
    $id_role = $_GET['add-role-menu'];

    $rowEditRoleMenu = [];
    $editRoleMenu = mysqli_query($config, "SELECT * FROM menu_roles WHERE id_roles = '$id_role'");
    while ($editMenu = mysqli_fetch_assoc($editRoleMenu)) {
        $rowEditRoleMenu[] = $editMenu['id_menu'];
    }
    $menus = mysqli_query($config, "SELECT * FROM menus ORDER BY parent_id, urutan");
    $rowMenu = [];

    while ($m = mysqli_fetch_assoc($menus)) {
        $rowMenu[] = $m;
    }
    //[0]1, [1]2, [2]3
}


if (isset($_POST['save'])) {
    $id_role = $_GET['add-role-menu'];
    $id_menus = $_POST['id_menus'] ?? [];
    // if($_POST['id_menus']){                                                                                  
    //     $id_menus = $_GET['id_menus']
    // }else{
    //     $id_menus=[];
    // }
    mysqli_query($config, "DELETE FROM menu_roles WHERE id_roles = '$id_role' ");
    foreach ($id_menus as $m) {
        $id_menu = $m;
        mysqli_query($config, "INSERT INTO menu_roles(id_roles, id_menu) VALUE('$id_role', '$id_menu')");
    }
    header("location:?page=tambah-role&add-role-menu=" . $id_role . "&tambah=berhasil");
}

?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo isset($id_user) ? 'Edit'  : 'Add' ?> Role</h5>
                <?php if (isset($_GET['add-role-menu'])): ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <!-- aktivitas delete -->
                            <ul>
                                <?php foreach ($rowMenu as $mainMenu): ?>
                                    <?php if ($mainMenu['parent_id'] == 0 or $mainMenu['parent_id'] == ""): ?>
                                        <li>
                                            <label for="">
                                                <!-- jika id value id_menu dari tabel menu Nilainya 1 
                                                == jika nilai id_menu dari table menu roles juga sama dengan 1 maka kita check -->
                                                <input <?php echo in_array($mainMenu['id'], $rowEditRoleMenu) ? 'checked' : '' ?> type="checkbox" name="id_menus[]" value="<?php echo $mainMenu['id'] ?>">
                                                <?php echo $mainMenu['name'] ?>
                                            </label>
                                            <ul>
                                                <?php foreach ($rowMenu as $subMenu): ?>
                                                    <?php if ($subMenu['parent_id'] == $mainMenu['id']): ?>
                                                        <li>
                                                            <label for="">
                                                                <input <?php echo in_array($subMenu['id'], $rowEditRoleMenu) ? 'checked' : '' ?> type="checkbox" name="id_menus[]" value="<?php echo $subMenu['id'] ?>">
                                                                <?php echo $subMenu['name'] ?>
                                                            </label>
                                                        </li>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </ul>
                                        </li>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit" name="save">Save change</button>
                        </div>
                    </form>
                <?php else: ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="">Name Role</label>
                            <input value="<?php echo isset($rowEdit['name']) ? $rowEdit['name'] : '' ?>" type="text" class="form-control" name="name" placeholder="" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" name="simpan">Submit</button>
                        </div>
                    </form>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>