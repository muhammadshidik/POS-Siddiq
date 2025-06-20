<?php
// Mengimpor file koneksi ke database
require_once 'admin/controller/koneksi.php';

// Fungsi untuk meng-handle proses login
function loginController($email, $password)
{
    global $connection; // Menggunakan variabel koneksi global

    // Query untuk mencari data user berdasarkan email yang tidak dihapus (deleted_at = 0)
    $queryLogin = mysqli_query($connection, "SELECT * FROM user WHERE email='$email' AND deleted_at=0");

    // Mengecek apakah ada data user yang ditemukan
    if (mysqli_num_rows($queryLogin) > 0) {
        // Mengambil data user dalam bentuk array asosiatif
        $rowLogin = mysqli_fetch_assoc($queryLogin);

        // Mengecek apakah password yang dimasukkan sama dengan password di database
        if ($password == $rowLogin['password']) {
            // Menyimpan data user ke dalam session
            $_SESSION['name'] = $rowLogin['name'];
            $_SESSION['id'] = $rowLogin['id'];

            return true; // Login berhasil
        } else {
            return false; // Password salah
        }
    } else {
        return false; // User tidak ditemukan
    }
}

// Fungsi untuk mengecek apakah user sudah login
function loginValidation()
{
    // Jika session id belum diset, berarti belum login
    if (!isset($_SESSION['id'])) {
        return false;
    } else {
        return true; // Sudah login
    }
}

// Fungsi untuk mengubah nilai status order menjadi label HTML
function getOrderStatus($status)
{
    switch ($status) {
        case 0:
            // Jika status 0, maka tampilkan label "New"
            return '<span class="badge bg-label-warning">New</span>';
        case 1:
            // Jika status 1, maka tampilkan label "Picked Up"
            return '<span class="badge bg-label-success">Picked Up</span>';
        default:
            // Jika status tidak dikenal, tampilkan "Unknown Status"
            return '<span class="badge bg-label-secondary">Unknown Status</span>';
    }
}
