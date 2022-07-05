<?php
// kalau pakai offline
$db = new mysqli("localhost","root","","db_knn");

// online
// $db = new mysqli("localhost","rahmandm_wp257","rahmandm123","rahmandm_wp257");

// cek koneksi
if ($db->connect_error) {
	echo "Gagal menyambungkan ke MySQL : ".$db->connect_error;
	exit();
}
?>