<?php
include "admin/config/koneksi.php";

// Hapus produk
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $getImage = mysqli_fetch_assoc(mysqli_query($config, "SELECT image FROM products WHERE id='$id'"));
    if ($getImage && file_exists("admin/uploads/" . $getImage['image'])) {
        unlink("admin/uploads/" . $getImage['image']);
    }
    $queryDelete = mysqli_query($config, "DELETE FROM products WHERE id='$id'");
    header("location:?page=product&hapus=" . ($queryDelete ? 'berhasil' : 'gagal'));
    exit;
}

// Edit produk
$id = $_GET['edit'] ?? '';
$queryEdit = mysqli_query($config, "SELECT * FROM products WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

// Tambah/Edit produk
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $id_category = $_POST['id_category'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $description = $_POST['description'];
    $image = $rowEdit['image'] ?? null;

    // Handle upload gambar baru
    if (!empty($_FILES['image']['name'])) {
        $extAllowed = ['jpg', 'jpeg', 'png', 'webp'];
        $fileName = $_FILES['image']['name'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (in_array($fileExt, $extAllowed)) {
            if ($image && file_exists("admin/uploads/$image")) {
                unlink("admin/uploads/$image");
            }
            $newImageName = 'product_' . time() . '.' . $fileExt;
            move_uploaded_file($_FILES['image']['tmp_name'], "admin/uploads/$newImageName");
            $image = $newImageName;
        }
    }

    if (!$id) {
        $insert = mysqli_query($config, "INSERT INTO products (id_category, name, price, qty, description, image) 
        VALUES ('$id_category','$name', '$price', '$qty', '$description', '$image')");
        header("location:?page=product&tambah=berhasil");
    } else {
        $update = mysqli_query($config, "UPDATE products 
            SET id_category='$id_category', name='$name', price='$price', qty='$qty', description='$description', image='$image' 
            WHERE id='$id'");
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
                <h5 class="card-title"><?php echo isset($id) ? 'Edit'  : 'Add' ?> Product</h5>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <div class="col-sm-2">
                            <label for="">Category Product *</label>
                        </div>
                        <div class="col-sm-10">
                            <select name="id_category" class="form-control">
                                <option value="">Select One</option>
                                <?php foreach ($rowCategoryProduct as $rowCategory): ?>
                                    <option <?php echo isset($rowEdit) ? ($rowCategory['id'] == $rowEdit['id_category']) ? 'selected' : '' : '' ?> value="<?php echo $rowCategory['id'] ?>"><?php echo $rowCategory['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-sm-2">
                            <label for="">Name Product * </label>
                        </div>
                        <div class="col-sm-10">
                            <input required name="name" type="text" class="form-control" placeholder="Insert Product Name" value="<?php echo isset($rowEdit['name']) ? $rowEdit['name'] : '' ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-sm-2">
                            <label for="">Price * </label>
                        </div>
                        <div class="col-sm-10">
                            <input required name="price" type="text" class="form-control" placeholder="" value="<?php echo isset($rowEdit['price']) ? $rowEdit['price'] : '' ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-sm-2">
                            <label for="">QTY * </label>
                        </div>
                        <div class="col-sm-10">
                            <input required name="qty" type="text" class="form-control" placeholder="" value="<?php echo isset($rowEdit['qty']) ? $rowEdit['qty'] : '' ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-sm-2">
                            <label for="">Description * </label>
                        </div>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description" cols="30" rows="5"><?php echo isset($rowEdit['description']) ? $rowEdit['description'] : '' ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-sm-2">
                            <label for="image">Gambar * </label>
                        </div>
                        <div class="col-sm-10">
                            <?php if (!empty($rowEdit['image'])): ?>
                                <div class="mb-2">
                                    <img src="admin/uploads/<?php echo $rowEdit['image'] ?>" width="100" alt="Current Image">
                                </div>
                            <?php endif; ?>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-sm-12">
                            <button name="save" type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>