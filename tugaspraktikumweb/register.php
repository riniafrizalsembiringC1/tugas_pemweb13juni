<?php
include("dbconnect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = md5(sha1($_POST['paswd'])); // Hashing password

    // Check if username or email already exists
    $stmt = $k->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($k->error));
    }

    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $rs = $stmt->get_result();

    if ($rs->num_rows > 0) {
        echo "Username atau email sudah ada.";
    } else {
        // Insert new user into the database
        $stmt = $k->prepare("INSERT INTO users (username, nama, email, paswd, active) VALUES (?, ?, ?, ?, 1)");
        if ($stmt === false) {
            die("Prepare failed: " . htmlspecialchars($k->error));
        }

        $stmt->bind_param("ssss", $username, $nama, $email, $password);
        if ($stmt->execute()) {
            echo "Registrasi berhasil.";
        } else {
            echo "Registrasi gagal: " . htmlspecialchars($stmt->error);
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Pengguna</title>
</head>
<body>
    <h2>Form Registrasi</h2>
    <form action="register.php" method="post">
        <input type="text" name="username" required placeholder="Username"><br>
        <input type="text" name="nama" required placeholder="Nama Lengkap"><br>
        <input type="email" name="email" required placeholder="Email"><br>
        <input type="password" name="paswd" required placeholder="Password"><br>
        <input type="submit" value="Daftar">
    </form>
</body>
</html>
