<?php

if (isset($_GET['delete'])) {
    $id_user = $_GET['delete'];
    $queryDelete = mysqli_query($config, "DELETE FROM transactions WHERE id='$id_user'");

    if ($queryDelete) {
        header("location:?page=pos&hapus=berhasil");
    } else {
        header("location:?page=pos&hapus=gagal");
    }
}

if (isset($_GET["edit"])) {
    $id_user = $_GET["edit"];
} elseif (isset($_GET["add-user-role"])) {
    $id_user = $_GET["add-user-role"];
}

$queryEdit = mysqli_query($config, "SELECT * FROM users WHERE id='$id_user'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = isset($_POST['password']) ? sha1($_POST['password']) : $rowEdit['password'];

    if (!isset($_GET['edit'])) {
        $insert = mysqli_query($config, "INSERT INTO users (name, email, password) VALUES('$name','$email','$password')");
        header("location:?page=user&tambah=berhasil");
    } else {
        $update = mysqli_query($config, "UPDATE users SET name='$name', email='$email', password='$password' WHERE id='$id_user'");
        header("location:?page=user&ubah=berhasil");
    }
}

$queryUserRoles = mysqli_query($config, "SELECT user_roles.*, roles.name FROM user_roles
LEFT JOIN roles ON user_roles.id_role = roles.id
WHERE id_user =  '$id_user'
ORDER BY user_roles.id DESC");
$rowUserRoles = mysqli_fetch_all($queryUserRoles, MYSQLI_ASSOC);

if (isset($_POST['id_role'])) {
    $id_role = $_POST['id_role'];
    $insert = mysqli_query($config, "INSERT INTO user_role (id_role, id_user) VALUES('$id_role','$id_user')");
    header("location:?page=Tambah-user&add-user-role=" . $id_user . "&add-role=berhasil");
}

$queryProduct = mysqli_query($config, "SELECT * FROM products ORDER BY id DESC");
$rowProducts = mysqli_fetch_all($queryProduct, MYSQLI_ASSOC);

$queryNoteTrans = mysqli_query($config, "SELECT MAX(id) as id_trans FROM transactions");
$rowNoteTrans = mysqli_fetch_assoc($queryNoteTrans);
$id_trans = $rowNoteTrans['id_trans'] ?? 0;
$id_trans++;

$format_no = "TR";
$date = date("dmy");
$increment_number = sprintf("%03s", $id_trans);
$no_transaction = $format_no . "-" . $date . "-" . $increment_number;

if (isset($_POST['save'])) {
    $no_transaction = $_POST['no_transaction'];
    $id_user = $_POST['id_user'];
    $grand_total = $_POST['grand_total'];

    $insTransaction = mysqli_query($config, "INSERT INTO transactions (id_user, no_transaction, sub_total) VALUES ('$id_user', '$no_transaction', '$grand_total')");

    if ($insTransaction) {
        $id_transaction = mysqli_insert_id($config);
        $id_products = $_POST['id_product'];
        $qtys = $_POST['qty'];
        $totals = $_POST['total'];

        foreach ($id_products as $key => $id_product) {
            $qty = $qtys[$key];
            $total = $totals[$key];

            mysqli_query($config, "INSERT INTO transaction_details (id_transaction, id_product, qty, total) VALUES ('$id_transaction', '$id_product', '$qty', '$total')");
        }
        header("location:?page=pos");
        exit();
    }
}

function getOrderStatus($status)
{
    switch ($status) {
        case 0:
            return '<span class="badge bg-warning">Baru</span>';
        case 1:
            return '<span class="badge bg-success">selesai</span>';
        default:
            return '<span class="badge bg-secondary">Unknown Status</span>';
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<div class="container-fluid px-4 py-3">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Transaksi Penjualan</h5>
                <small class="text-light">Kasir: <strong><?= $_SESSION['NAME'] ?></strong></small>
            </div>
            <span class="fw-light">No Transaksi: <strong><?= $no_transaction ?></strong></span>
        </div>
        <div class="card-body">
            <form method="POST">
                <input type="hidden" name="no_transaction" value="<?= $no_transaction ?>">
                <input type="hidden" name="id_user" value="<?= $_SESSION['ID_USER'] ?>">

                <div class="row g-2 align-items-end mb-3">
                    <div class="col-md-8">
                        <label for="id_product" class="form-label">Pilih Produk</label>
                        <select name="id_product" id="id_product" class="form-select">
                            <option value="">-- Pilih Produk --</option>
                            <?php foreach ($rowProducts as $rowProduct): ?>
                                <option value="<?= $rowProduct['id'] ?>" data-price="<?= $rowProduct['price'] ?>">
                                    <?= $rowProduct['name'] ?> - Rp <?= number_format($rowProduct['price']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-success w-100" id="addRow">
                            <i class="bi bi-plus-lg"></i> Tambah Produk
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-center" id="myTable">
                        <thead class="table-primary">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Produk</th>
                                <th style="width: 15%">Qty</th>
                                <th>Total (Rp)</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <div class="me-3">
                        <strong>Total: Rp <span id="totalDisplay">0</span></strong>
                        <input type="hidden" name="grand_total" id="grandTotalInput" value="0">
                    </div>
                    <button type="submit" name="save" class="btn btn-primary">
                        <i class="bi bi-cart-check"></i> Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const button = document.getElementById('addRow');
const select = document.getElementById('id_product');
const tbody = document.querySelector('#myTable tbody');
const totalDisplay = document.getElementById('totalDisplay');
const grandTotalInput = document.getElementById('grandTotalInput');
let no = 1;

button.addEventListener('click', function () {
    const selected = select.options[select.selectedIndex];
    const id = selected.value;
    const name = selected.text;
    const price = selected.dataset.price;

    if (!id) {
        alert('Pilih produk terlebih dahulu!');
        return;
    }

    const row = document.createElement('tr');
    row.innerHTML = `
        <td>${no}</td>
        <td><input type="hidden" name="id_product[]" value="${id}">${name}</td>
        <td><input type="number" name="qty[]" value="1" class="form-control qty"></td>
        <td>
            <input type="hidden" name="price[]" value="${price}">
            <input type="hidden" name="total[]" class="total" value="${price}">
            <span class="total-text">${parseInt(price).toLocaleString('id-ID')}</span>
        </td>
        <td><button type="button" class="btn btn-outline-danger btn-sm removeRow">Hapus</button></td>
    `;
    tbody.appendChild(row);
    no++;
    select.value = "";
    updateGrandTotal();
});

tbody.addEventListener('click', function (e) {
    if (e.target.classList.contains('removeRow')) {
        e.target.closest('tr').remove();
        updateRowNumbers();
        updateGrandTotal();
    }
});

tbody.addEventListener('input', function (e) {
    if (e.target.classList.contains('qty')) {
        const row = e.target.closest('tr');
        const qty = parseInt(e.target.value) || 0;
        const price = parseInt(row.querySelector('input[name="price[]"]').value);
        const newTotal = price * qty;
        row.querySelector('.total').value = newTotal;
        row.querySelector('.total-text').textContent = newTotal.toLocaleString('id-ID');
        updateGrandTotal();
    }
});

function updateGrandTotal() {
    const totals = tbody.querySelectorAll('.total');
    let grand = 0;
    totals.forEach(input => {
        grand += parseInt(input.value) || 0;
    });
    totalDisplay.textContent = grand.toLocaleString('id-ID');
    grandTotalInput.value = grand;
}

function updateRowNumbers() {
    const rows = tbody.querySelectorAll('tr');
    rows.forEach((row, index) => {
        row.querySelector('td').textContent = index + 1;
    });
    no = rows.length + 1;
}
</script>
