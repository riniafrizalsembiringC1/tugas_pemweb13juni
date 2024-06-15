<?php
    session_start();

    $_SESSION['views'] = 1;

    if(isset($_SESSION['views']))
    {
        $_SESSION['views']++;
    }
    else
    {
        $_SESSION['views'] = 1;
    }
echo $_SESSION['nama'];
echo "nilai di session: ",$_SESSION['views'];
echo '<a href="main.php">Lihat session</a>';