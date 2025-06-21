<?php
// jika user/pengguna mencet tombol simpan
// ambil data dari inputan, email, nama dan password
// masukkan ke dalam table user (name, email, password) nilainya dari masing-masing inputan 
//fungsi insert
include "admin/config/koneksi.php";
if (isset($_GET['delete'])) {
    $id = isset($_GET['delete']) ? $_GET['delete'] : '';
    $queryDelete = mysqli_query($config, "DELETE FROM products WHERE id='$id'");
    if ($queryDelete) {
        header("location:?page=product&hapus=berhasil");
    } else {
        header("location:?page=product&hapus=gagal");
    }
}
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM products WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);
// print_r($id_user);
if (isset($_POST['name'])) {
    //ada tidak parameter bernama edit, kalo ada jalankan perintah edit/update, kalo tidak ada tambah data baru/insert
    $name = $_POST['name'];
    $id_category = $_POST['id_category'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $description = $_POST['description'];


    if (!isset($_GET['edit'])) {
        $insert = mysqli_query($config, "INSERT INTO products (id_category, name, price, qty, description) 
 VALUES ('$id_category','$name', '$price', '$qty', '$description' )");
        header("location:?page=product&tambah=berhasil");
    } else {
        $Update = mysqli_query($config, "UPDATE products SET id_category='$id_category', name='$name', price='$price', qty='$qty', description='$description' WHERE id='$id'");
        header("location:?page=product&ubah=berhasil");
    }
}
$queryCategoryProduct = mysqli_query($config, "SELECT * FROM categories ORDER BY id DESC");
$rowCategoryProduct = mysqli_fetch_all($queryCategoryProduct, MYSQLI_ASSOC);

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo isset($id_user) ? 'Edit'  : 'Add' ?> Product</h5>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <div class="col-sm-2">
                            <label for="">Category Product *</label>
                        </div>
                          <div class="col-sm-10">
                        <select name="id_category" id="" class="form-control">
                            <option value="">Select One</option>
                            <?php foreach ($rowCategoryProduct as $rowCategory): ?>
                                <option <?php echo isset($rowEdit) ? ($rowCategory['id'] == $rowEdit['id_category']) ? 'selected' : '' : '' ?> value=""><?php echo $rowCategory['name']?></option>
                                <?php endforeach?>;
                            </select>
                          </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="">Name Product * </label>
                            </div>
                            <div class="col-sm-10">
                                <input required name="name" type="text"
                                    class="form-control"
                                    placeholder="Insert Produc Name."
                                    value="<?php echo isset($rowEdit['name']) ? $rowEdit['name'] : '' ?>">
                            </div>
                        </div>
                    <div class="mb-3 row">
                        <div class="col-sm-2">
                            <label for="">Price * </label>
                        </div>
                        <div class="col-sm-10">
                            <input required name="price" type="text"
                                class="form-control"
                                placeholder=""
                                value="<?php echo isset($rowEdit['price']) ? $rowEdit['price'] : '' ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-sm-2">
                            <label for=""> QTY * </label>
                        </div>
                        <div class="col-sm-10">
                            <input required name="qty" type="text"
                                class="form-control"
                                placeholder=""
                                value="<?php echo isset($rowEdit['qty']) ? $rowEdit['qty'] : '' ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-sm-2">
                            <label for="">Description * </label>
                        </div>
                        <div class="col-sm-10">
                            <textarea id="summernote" class="form-control" name="description" cols="30" rows="5"><?php echo isset($rowEdit['description']) ? $rowEdit['description'] : '' ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-sm-12">
                            <button name="save" type="submit"
                                class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>