<?php
include 'admin/controller/koneksi.php';

if (isset($_GET['print'])) {
    $id = $_GET['print'];

    // Update status menjadi selesai (2)
    mysqli_query($config, "UPDATE transactions SET order_status = 1 WHERE id = '$id'");

    $query = mysqli_query($config, "SELECT transactions.*, users.name AS kasir 
        FROM transactions 
        LEFT JOIN users ON users.id = transactions.id_user 
        WHERE transactions.id = '$id'");

    $data = mysqli_fetch_assoc($query);

    $detailQuery = mysqli_query($config, "SELECT td.*, p.name AS product_name, p.price 
        FROM transaction_details td
        LEFT JOIN products p ON td.id_product = p.id
        WHERE td.id_transaction = '$id'");

    $details = mysqli_fetch_all($detailQuery, MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk</title>
    <style>
        .body {
            font-family: monospace;
            width: 80mm;
            margin: auto;
            padding: 10px;
        }

        .struk {
            text-align: center;
        }

        .line {
            margin: 5px 0;
            border-top: 1px dashed black;
        }

        .info,
        .product,
        .summary {
            text-align: left;
        }

        .product .item {
            margin-bottom: 5px;
        }

        .product .item-qty {
            display: flex;
            justify-content: space-between;
        }

        .info .row,
        .summary .row {
            display: flex;
            justify-content: space-between;
            margin: 2px 0;
        }

        footer {
            text-align: center;
            font-size: 13px;
            margin-top: 10px;
        }

        @media print {
            body {
                width: 80mm;
                margin: 0;
            }
        }
    </style>
</head>

<body>
    <div class="struk">
        <div class="struk-header">
            <h3>Kedai Kopi PPKD JP</h3>
            <h2>Enak Lho</h2>
            <div class="info">
                Jl. Karet Baru Benhill Jakarta Pusat<br>
                08994839202
            </div>
        </div>
        <div class="line"></div>
        <div class="info">
            <div class="row">
                <span><?= date('d M Y', strtotime($data['created_at'] ?? date('Y-m-d'))) ?></span>
                <span><?= date('H:i') ?></span>
            </div>
            <div class="row">
                <span>Cashier</span>
                <span><?= $data['kasir'] ?? '-' ?></span>
            </div>
            <div class="row">
                <span>Order Id</span>
                <span><?= $data['no_transaction'] ?? '-' ?></span>
            </div>
        </div>
        <div class="line"></div>
        <div class="product">
            <?php foreach ($details as $item): ?>
                <div class="item">
                    <strong><?= $item['product_name'] ?></strong>
                    <div class="item-qty">
                        <span><?= $item['qty'] ?>x @ Rp <?= number_format($item['price'], 0, ',', '.') ?></span>
                        <span>Rp <?= number_format($item['total'], 0, ',', '.') ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="line"></div>
            <div class="summary">
                <div class="row">
                    <span>Subtotal</span>
                    <span>Rp <?= number_format($data['sub_total'], 0, ',', '.') ?></span>
                </div>
            </div>
            <div class="line"></div>
            <footer class="text-center">
                Terimakasih sudah membeli disini
            </footer>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
