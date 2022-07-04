<?php
// kalau pakai offline
$db = new mysqli("localhost","root","","db_knn");

// cek koneksi
if ($db->connect_error) {
	echo "Gagal menyambungkan ke MySQL : ".$db->connect_error;
	exit();
}
?>