<?php
include("dbconnect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5(sha1($_POST['paswd']));

    // Debugging output
    echo "Username: " . htmlspecialchars($username) . "<br>";
    echo "Password (hashed): " . htmlspecialchars($password) . "<br>";

    $stmt = $k->prepare("SELECT * FROM users WHERE username = ? AND paswd = ? AND active = 1");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($k->error));
    }

    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $rs = $stmt->get_result();

    // Debugging output
    echo "Number of rows: " . $rs->num_rows . "<br>";

    if ($rs->num_rows == 1) {
        $baris = $rs->fetch_assoc();
        session_start();
        $_SESSION['username'] = $baris['username'];
        $_SESSION['userid'] = $baris['id'];
        $_SESSION['nama'] = $baris['nama'];
        $_SESSION['views'] = 0;
        $_SESSION['is_logged_in'] = TRUE;
        header("Location: main.php");
        exit();
    } else {
        echo "Username atau password salah";
    }
    $stmt->close();
}
?>
