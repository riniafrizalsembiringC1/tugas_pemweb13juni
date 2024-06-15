<?php
session_start();
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: form.php");
    exit;
}

include('dbconnect.php');

$id = $_GET['urut'];
$data = $k->query("SELECT * FROM users WHERE id=".$id."");

if ($data->num_rows == 1) {
    $datauser = $data->fetch_assoc(); // Menggunakan operator "=" untuk menyimpan hasil fetch_assoc() ke $datauser
?>
    <form action="editaction.php" method="post">
        <input type="text" name="username" required placeholder="Username" value="<?php echo htmlspecialchars($datauser['username']); ?>">
        <input type="text" name="nama" required placeholder="Nama" value="<?php echo htmlspecialchars($datauser['nama']); ?>">
        <input type="email" name="email" required placeholder="Email" value="<?php echo htmlspecialchars($datauser['email']); ?>">
        <input type="password" name="psswd" placeholder="Kosongi jika tidak ingin ganti password">
        <input type="hidden" name="userid" value="<?php echo $datauser['id']; ?>">
        <input type="submit" value="Simpan">
    </form>
<?php
} else {
    echo "Data tidak ditemukan";
}
?>
