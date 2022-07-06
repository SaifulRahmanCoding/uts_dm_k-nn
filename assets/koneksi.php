<?php
// kalau pakai offline
// $db = mysqli_connect("localhost","root","","db_knn");

// online
$db = mysqli_connect("sql210.ezyro.com","ezyro_32106300","0tgmys7","ezyro_32106300_db_knn");

// cek koneksi
if (!$db) {
	echo "Gagal menyambungkan ke MySQL:".mysqli_connect_error();
	exit();
}
?>