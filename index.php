<?php
// Mulai session
session_start();

// Koneksi ke database
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk cek username di database
    $sql = "SELECT * FROM user WHERE username='$username'";
    $result = $conn->query($sql);

    // Jika username ditemukan
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Cek apakah password yang dimasukkan sesuai
        if ($password == $row['password']) {
            // Set session untuk user yang berhasil login
            $_SESSION['user_id'] = $row['id'];  // menyimpan id user ke session
            $_SESSION['username'] = $row['username'];  // menyimpan username ke session

            echo "<script>
                    alert('Login berhasil! Selamat datang $username');
                    window.location.href = 'dash.php';  // arahkan ke dashboard
                  </script>";
        } else {
            // Password salah
            echo "<script>
                    alert('Password salah!');
                    window.location.href = 'index.php';
                  </script>";
        }
    } else {
        // Username tidak ditemukan
        echo "<script>
                alert('Username tidak ditemukan!');
                window.location.href = 'index.php';
              </script>";
    }

    // Tutup koneksi
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/styles.css">
    <link rel="shortcut icon" type="image/icon" href="img/smk.png"/>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="all">
    <div class="container">
        <form method="POST" action="index.php">
            <h2>Login</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div>
</body>
</html>
