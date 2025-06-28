<?php
$query = mysqli_query($config, "SELECT users.name AS kasir_name, transactions.* FROM transactions 
  LEFT JOIN users ON users.id = transactions.id_user
  ORDER BY id DESC");

$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $idDel = $_GET['delete'];
    $del = mysqli_query($config, "DELETE FROM transactions WHERE id = '$idDel'");
    if ($del) {
        header("location:?page=pos");
        exit();
    }
}

function getOrderStatus($status)
{
    switch ($status) {
        case 0:
            return '<span class="badge bg-warning text-dark">Belum Bayar</span>';
        case 1:
            return '<span class="badge bg-success">Lunas</span>';
        default:
            return '<span class="badge bg-secondary">Tidak Diketahui</span>';
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<div class="container-fluid px-3 py-3">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Transaksi</h5>
            <a href="?page=tambah-pos" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle"></i> Tambah Transaksi
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>No Transaksi</th>
                            <th>Nama Kasir</th>
                            <th>Status</th>
                            <th>Sub Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($rows)): ?>
                            <tr>
                                <td colspan="6" class="text-center">Belum ada transaksi</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($rows as $index => $row): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= $row['no_transaction'] ?></td>
                                    <td><?= $row['kasir_name'] ?></td>
                                    <td><?= getOrderStatus($row['order_status']) ?></td>
                                    <td>Rp <?= number_format($row['sub_total'], 0, ',', '.') ?></td>
                                    <td>
                                        <a href="?page=print&print=<?= $row['id'] ?>" class="btn btn-sm btn-primary" target="_blank">
                                            <i class="bi bi-printer"></i> Print
                                        </a>
                                        <a href="?page=pos&delete=<?= $row['id'] ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                                            <i class="bi bi-trash3"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
