<?php
$query = mysqli_query($config, "SELECT products.*, categories.name as category_name FROM products
LEFT JOIN categories ON categories.id = products.id_category ORDER BY id DESC");
//desc : 12345, asc:54321
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Product</h5>
                <div class="mb-3" align="right">
                    <a href="?page=tambah-product" class="btn btn-primary">Add Product</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Desc</th>
                                <th>Gambar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($rows as $key => $data): ?>
                                <tr>
                                    <td><?php echo $key += 1; ?></td>
                                    <td><?php echo $data['name']; ?></td>
                                    <td><?php echo $data['name']; ?></td>
                                    <td><?php echo $data['price']; ?></td>
                                    <td><?php echo $data['qty']; ?></td>
                                    <td><?php echo $data['description']; ?></td>
                                    <td><?php echo $data['image']; ?></td>


                                    <td class="container" style="width : 215px">
                                        <a href="?page=tambah-product&id=<?php echo $data['id'] ?>" class="btn btn-warning btn-sm">Add Product</a>
                                        <a href="?page=tambah-product&edit=<?php echo $data['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                        <a onclick="return confirm('Are you sure wanna delete this data??')"
                                            href="?page=tambah-instructor&delete=<?php echo $data['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>