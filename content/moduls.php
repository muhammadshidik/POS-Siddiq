<?php
$id_user = isset($_SESSION['ID_USER']) ? $_SESSION['ID_USER'] : '';
$id_role = isset($_SESSION['ID_ROLE']) ? $_SESSION['ID_ROLE'] : '';

// 
$rowStudent = mysqli_fetch_assoc(mysqli_query($config, "SELECT * FROM students WHERE id='$id_user'"));
$id_major   = isset($rowStudent['id_major']) ? $rowStudent['id_major'] : '';
if ($id_role == 6) {
    $where = "WHERE moduls.id_major='$id_major'";
} elseif ($id_role == 3) {
    $where = "WHERE moduls.id_instructor='$id_user'";
}

$query = mysqli_query($config, "SELECT majors.name as major_name,
instructors.name as instructor_name, moduls.* 
FROM moduls
LEFT JOIN majors ON majors.id = moduls.id_major
LEFT JOIN instructors ON instructors.id = moduls.id_instructor
$where
ORDER BY moduls.id DESC");
// 12345, 54321
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Transaction</h5>
                <?php if (canAddModul(3)): ?>
                    <div class="mb-3" align="right">
                        <a href="?page=tambah-modul" class="btn btn-primary">Add Modul</a>
                    </div>
                <?php endif ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Transaction</th>
                                <th>Cashier Name</th>
                                <th>Instructor</th>
                                <th>Sub Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $index => $row): ?>
                                <tr>
                                    <td><?php echo $index += 1; ?></td>
                                    <td><? ?></td>
                                    <td><? ?></td>
                                    <td><? ?></td>

                                    <td><?php echo $row['instructor_name'] ?></td>
                                    <td><?php echo $row['major_name'] ?></td>
                                    <td>
                                        <?php if ($id_role == 1); ?>
                                        <a href="?page=tambah-modul&edit=<?php echo $row['id'] ?>"
                                            class="btn btn-primary">Edit</a>
                                        <a onclick="return confirm('Are you sure wanna delete this data??')"
                                            href="?page=tambah-modul&delete=<?php echo $row['id'] ?>"
                                            class="btn btn-danger">Delete</a>

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