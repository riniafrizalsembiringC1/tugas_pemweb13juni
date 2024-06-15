<?php
session_start();
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: form.php");
    exit;
}

include('dbconnect.php');

$user = $_POST['username'];
$email = $_POST['email'];
$nama = $_POST['nama'];
$id = $_POST['userid'];

if ($_POST['psswd'] == "") {
    $query = "UPDATE users SET username='$user', nama='$nama', email='$email' WHERE id=$id";
} else {
    $paswd = md5(sha1($_POST['psswd']));
    $query = "UPDATE users SET username='$user', nama='$nama', email='$email', paswd='$paswd' WHERE id=$id";
}

if ($k === null) {
    die("Koneksi database tidak berhasil.");
}

$result = $k->query($query);
if ($result) {
    header("Location: main.php");
} else {
    echo "Gagal melakukan update: " . htmlspecialchars($k->error);
}
?>