<?php
$query = mysqli_query($config, "SELECT * FROM  roles ORDER BY id DESC");
//desc : 12345, asc:54321
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Role</h5>
                <div class="mb-3" align="right">
                    <a href="?page=tambah-role" class="btn btn-primary">Add Role</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name Role</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($rows as $key => $data): ?>
                                <tr>
                                    <td><?php echo $key += 1; ?></td>
                                    <td><?php echo $data['name']; ?></td>
                                    <td>
                                        <a href="?page=tambah-role&add-role-menu=<?php echo $data['id'] ?>" class="btn btn-success btn-sm">Add Role Menu</a>
                                        <a href="?page=tambah-role&edit=<?php echo $data['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                        <a onclick="return confirm('Are you sure wanna delete this data??')"
                                            href="?page=tambah-role&delete=<?php echo $data['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
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