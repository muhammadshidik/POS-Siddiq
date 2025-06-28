<?php
include "admin/config/koneksi.php";

if (!$config) {
    die("Koneksi ke database gagal.");
}

$query = mysqli_query($config, "SELECT * FROM products");
$produk = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Produk Laundry</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f8;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 40px;
            color: #333;
        }

        .produk-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
        }

        .produk-card {
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .produk-card:hover {
            transform: translateY(-6px);
        }

        .produk-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
        }

        .produk-info {
            padding: 16px;
            text-align: center;
        }

        .produk-info h4 {
            margin: 0 0 8px;
            font-size: 18px;
            color: #222;
        }

        .produk-info p {
            margin: 0;
            font-size: 16px;
            color: #27ae60;
            font-weight: bold;
        }

        .btn-detail {
            display: inline-block;
            margin-top: 12px;
            padding: 8px 14px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            transition: background 0.3s;
        }

        .btn-detail:hover {
            background-color: #2980b9;
        }

        .not-found {
            text-align: center;
            font-style: italic;
            color: #777;
            margin-top: 40px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Daftar Produk</h2>

        <?php if (count($produk) > 0): ?>
            <div class="produk-grid">
                <?php foreach ($produk as $item): ?>
                    <?php
                        $imagePath = !empty($item['image']) && file_exists("admin/uploads/" . $item['image'])
                            ? "admin/uploads/" . $item['image']
                            : "https://via.placeholder.com/300x200?text=No+Image";
                    ?>
                    <div class="produk-card">
                        <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                        <div class="produk-info">
                            <h4><?= htmlspecialchars($item['name']) ?></h4>
                            <p>Rp <?= number_format($item['price'], 0, ',', '.') ?></p>
                            <a href="?page=detail-produk&id=<?= $item['id'] ?>" class="btn-detail">Lihat Detail</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="not-found">Produk belum tersedia.</div>
        <?php endif; ?>
    </div>

</body>
</html>
