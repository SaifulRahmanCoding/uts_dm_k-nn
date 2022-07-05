<?php
// kalau pakai offline
$db = new mysqli("localhost","root","","db_knn");

// online
// $db = new mysqli("localhost","id19218370_db_knn","dm_knn123Rahman","id19218370_dm_knn");

// cek koneksi
if ($db->connect_error) {
	echo "Gagal menyambungkan ke MySQL : ".$db->connect_error;
	exit();
}
?>