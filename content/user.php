<?php
$query = mysqli_query($config, "SELECT * FROM users ORDER BY id DESC");
// 12345, 54321
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data User</h5>
                <div align="right" class="mb-3">
                    <a href="?page=tambah-user" class="btn btn-primary">Add User</a>
                    <a href="?page=restore-user" class="btn btn-primary">Restore</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($rows as $key => $data): ?>
                                <tr>
                                    <td><?php echo $key += 1; ?></td>
                                    <td><?php echo $data['name']; ?></td>
                                    <td><?php echo $data['email']; ?></td>
                                    <td>
                                        <a href="?page=tambah-user&add-user-role=<?php echo $data['id'] ?>" class="btn btn-success btn-sm">Add User Role</a>
                                        <a href="?page=tambah-user&edit=<?php echo $data['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                        <a onclick="return confirm('Are you sure wanna delete this data??')"
                                            href="?page=tambah-user&delete=<?php echo $data['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
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