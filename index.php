<?php
session_start();
include 'admin/config/koneksi.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $role = $_POST['role'];

    $queryLogin = mysqli_query($config, "SELECT * FROM users WHERE email='$email' AND password='$password'");

    if (mysqli_num_rows($queryLogin) > 0) {
        $rowLogin = mysqli_fetch_assoc($queryLogin);
        $_SESSION['ID_USER'] =  $rowLogin['id'];
        $_SESSION['NAME'] = $rowLogin['name'];
        $_SESSION['ID_ROLE'] = $role;
        header("Location: menu.php");
    } else {
        header("Location: index.php?login=error");
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f2f4f8;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-container {
      background-color: #fff;
      padding: 2rem 2.5rem;
      border-radius: 12px;
      box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
      width: 100%;
      max-width: 400px;
    }

    .login-container h3 {
      margin-bottom: 1.5rem;
      text-align: center;
      font-weight: 600;
      color: #333;
    }

    .form-label {
      font-size: 0.9rem;
      color: #555;
    }

    .form-control {
      font-size: 0.95rem;
      padding: 0.6rem;
    }

    .btn-primary {
      width: 100%;
      padding: 0.6rem;
      font-weight: 500;
    }

    .form-select {
      font-size: 0.95rem;
    }

    .login-footer {
      text-align: center;
      font-size: 0.85rem;
      color: #888;
      margin-top: 1rem;
    }

    .login-footer a {
      color: #007bff;
      text-decoration: none;
    }

    .login-footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h3>Login Admin</h3>
    <form method="POST">
      <div class="mb-3">
        <label for="email" class="form-label">Alamat Email</label>
        <input required type="email" class="form-control" id="email" name="email" placeholder="Masukkan email">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Kata Sandi</label>
        <input required type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
      </div>

      <div class="mb-4">
        <label for="role" class="form-label">Peran</label>
        <select required class="form-select" name="role" id="role">
          <option value="" disabled selected>Pilih Role</option>
          <option value="admin">Admin</option>
          <option value="kasir">Kasir</option>
          <option value="owner">Owner</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Masuk</button>

      <div class="login-footer mt-3">
        Belum punya akun? <a href="#">Hubungi admin</a>
      </div>
    </form>
  </div>
</body>
</html>
