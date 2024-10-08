<?php
// Koneksi ke database
include 'koneksi.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password']; 

    // Menyimpan file foto
    $target_dir = "uploads/";
    $foto = $_FILES['foto']['name'];
    $target_file = $target_dir . basename($foto);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek apakah file gambar
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            // Simpan data ke database setelah upload foto berhasil
            $check_user = "SELECT * FROM user WHERE email='$email' OR username='$username'";
            $result = $conn->query($check_user);

            if ($result->num_rows == 0) {
                $sql = "INSERT INTO user (email, username, password, foto) VALUES ('$email', '$username', '$password', '$foto')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "<script>
                            alert('Akun berhasil dibuat');
                            document.location.href = 'index.php'; 
                          </script>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "<script>alert('Username atau Email sudah terdaftar!');</script>";
            }
        } else {
            echo "<script>alert('Gagal mengunggah foto!');</script>";
        }
    } else {
        echo "<script>alert('File yang diunggah bukan gambar!');</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun</title>
    <link rel="stylesheet" href="style/styles.css">
    <link rel="shortcut icon" type="image/icon" href="img/smk.png"/>
</head>
<body>
    <div class="container">
        <form method="POST" action="register.php" enctype="multipart/form-data">
            <h2>Buat Akun</h2>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="file" name="foto" required> <!-- Input untuk foto -->
            <button type="submit">Daftar</button>
        </form>
    </div>
</body>
</html>
