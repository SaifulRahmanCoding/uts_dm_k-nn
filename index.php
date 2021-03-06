<?php require_once('assets/koneksi.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Metode K-NN</title>
	<?php require('config/style.php'); ?>
</head>
<body>
	<div id="wrapper">
		<div class="container">
			<h2 class="text-center mt-5 fw-bolder">Data Pengukuran kualitas Kertas Tisu (Metode K-NN)</h2>
			<p class="text-center">klasifikasi kualitas kertas tisu apakah baik atau jelek, dengan objek testing menggunakan dua attribute yaitu lama waktu tahan terhadap asam <b>(x1)</b> dan kekuatan tarikan kertas <b>(y1)</b></p>
			<p class="text-center" style="font-size: 13px;">Copyright By Saiful Rahman</p>
			<div class="row d-flex justify-content-center">
			<!-- kiri -->
			<!-- data awal -->
			<div class="kiri col-sm-12 col-lg-6 mb-3">
				<div class="wrap table-responsive shadow rounded p-3 mt-3 mx-4">
					<h4 class="mb-4 fw-bolder">Data Awal</h4>
					<?php require('komponen/modal-tambah.php'); ?>
					<table class="table table-striped table-bordered responsive-utilities text-center">
						<thead>
							<tr>
								<th scope="col">No</th>
								<th scope="col" class="col-4 asam">x1 (detik)</th>
								<th scope="col" class="col-4">y1 (N/M2)</th>
								<th scope="col" class="col-4">Klasifikasi</th>
								<th scope="col" style="min-width: 100px !important;">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php

							$query = "SELECT * FROM tb_data";
							$result = mysqli_query($db, $query);

							$queryid = "SELECT * FROM tb_data WHERE id IN (SELECT MAX(id) FROM tb_data)";
							$resultid = mysqli_query($db, $queryid);
							$id_desc = mysqli_fetch_assoc($resultid);
							$i=1;
						// foreach
							foreach ($result as $data) { ?>
								<tr>
									<td><?php echo $i++?></td>
									<td><?php echo $data['x1']?></td>
									<td><?php echo $data['y1']?></td>
									<td <?php echo ($data['class']=="Good") ? "style='background-color: #ADFFA7; color: #20982C;'" : "style='background-color: #FFAEAE; color: #B53030'" ?>><?php echo $data['class']?></td>
									<td class="aksi">
										<!-- Button trigger modal -->
										<a class="text-decoration-none text-success pe-2" data-bs-toggle="modal" data-target="#EditData<?php echo $data['id'] ?>" href="#EditData<?php echo $data['id'] ?>">Edit</a>
										<?php
										if($data['id']==$id_desc['id']) : ?>
										|<a class="text-decoration-none text-danger ps-2" data-bs-toggle="modal" data-target="#HapusData<?php echo $data['id'] ?>" href="#HapusData<?php echo $data['id'] ?>">Hapus</a>
										<?php endif; ?>
									</td>

									<?php require('komponen/modal-edit.php'); ?>
									<?php require('komponen/modal-hapus.php'); ?>
								</tr>

							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- end kiri -->

			<div class="col-12"></div>

			<!-- data olahan -->
			<!-- kanan -->
			<div class="kanan col-sm-12 col-lg-6 mb-3">
				<div class="wrap table-responsive shadow rounded p-3 mt-3 mx-4">
					<h4 class="mb-4 fw-bolder">Klasifikasikan</h4>
					<?php require('komponen/modal-data-test.php'); ?>
					<a class="btn btn-primary mb-3" style="font-size: 14px;" href="index.php">Reset</a>
					<?php
					if(isset($_GET['opsi'])) : 

						if($_GET['opsi']=="hitung") : ?>
							<p>Nilai x2 = <b><?php echo $_POST['x2']?></b> &nbsp&nbsp&nbsp&nbsp Nilai y2 = <b><?php echo $_POST['y2']?></b>  &nbsp&nbsp&nbsp&nbsp Nilai K = <b><?php echo $_POST['K']?></b> </p>
							<table class="table table-striped table-bordered responsive-utilities text-center">
								<thead>
									<tr>
										<th scope="col">x1 (detik)</th>
										<th scope="col">y1 (N/M2)</th>
										<th scope="col">Nilai Jarak</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$query= "SELECT * FROM tb_data";
									$result=mysqli_query($db, $query);
									$i=1;
									// foreach
									foreach ($result as $dataOlah) { ?>
										<tr>
											<td><?php echo $dataOlah['x1']?></td>
											<td><?php echo $dataOlah['y1']?></td>
											<?php 
											$jarak = sqrt(pow($dataOlah['x1']-$_POST['x2'],2)+pow($dataOlah['y1']-$_POST['y2'],2));
											$query = "UPDATE tb_data SET hitung = '$jarak' WHERE id = $i";
											$update = mysqli_query($db,$query);
											$i++;
											?>
											<td><?php echo $jarak?></td>
										</tr>

									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- end kanan -->

					<div class="col-sm-12 col-lg-6 mb-4">
						<div class="wrap table-responsive shadow rounded p-3 mt-3 mx-4">
							<h4 class="mb-4 fw-bolder">Hasil Data K= <?php echo $_POST['K']?></h4>

							<table class="table table-striped table-bordered responsive-utilities text-center">
								<thead>
									<tr>
										<th scope="col">x1 (detik)</th>
										<th scope="col">y1 (N/M2)</th>
										<th scope="col">Nilai Jarak</th>
										<th scope="col" class="col-4">Klasifikasi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									// array class
									$arrayClassGood = array();
									$arrayClassBad = array();

									$K = (int)$_POST['K'];
									$query= "SELECT * FROM tb_data ORDER BY hitung ASC LIMIT 0,$K";
									$k= mysqli_query($db, $query);
									// foreach
									foreach ($k as $batasK) { ?>
										<tr>
											<td><?php echo $batasK['x1']?></td>
											<td><?php echo $batasK['y1']?></td>
											<td><?php echo $batasK['hitung']?></td>
											<td <?php echo ($batasK['class']=="Good") ? "style='background-color: #ADFFA7; color: #20982C;'" : "style='background-color: #FFAEAE; color: #B53030'" ?> > <?php echo $batasK['class']?></td>
										</tr>

									<?php
									// tambah isi array
									if($batasK['class']=="Good") :
									array_push($arrayClassGood, $batasK['class']);
									endif;
									if($batasK['class']=="Bad") :
									array_push($arrayClassBad, $batasK['class']);
									endif;
								} ?>
								</tbody>
							</table>

							<?php

							// hasil final
							$jumlahGood = count($arrayClassGood);
							$jumlahBad = count($arrayClassBad);
							$class_kategori = ($jumlahGood>$jumlahBad) ? "Good" : "Bad";
							?>
							<h4 class="fw-bolder" style="margin-top: 60px !important;">Hasil Klasifikasi</h4>
							<table class="table table-striped table-bordered responsive-utilities text-center">
								<thead>
									<tr>
										<th scope="col">x2 (detik)</th>
										<th scope="col">y2 (N/M2)</th>
										<th scope="col" class="col-4">Klasifikasi</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo $_POST['x2']?></td>
										<td><?php echo $_POST['y2']?></td>
										<td <?php echo ($class_kategori=="Good") ? "style='background-color: #ADFFA7; color: #20982C;'" : "style='background-color: #FFAEAE; color: #B53030'" ?> ><?php echo $class_kategori?></td>
									</tr>
								</tbody>

							</div>
						</div>

					<?php endif; 
				endif;	?>
			</div>
		</div>
	</div>
</body>
</html>
<?php require('config/script.php');

// controller
if (isset($_GET['opsi'])) :

$opsi = $_GET['opsi'];

if($opsi=="input"){//opsi input

	if (isset($_POST['x1'])) { $x1 = $_POST['x1']; }else{ echo "x1 tidak ditemukan"; }
	if (isset($_POST['y1'])) { $y1 = $_POST['y1']; }else{ echo "y1 tidak ditemukan"; }
	if (isset($_POST['class'])) { $class = $_POST['class']; }else{ echo "class tidak ditemukan"; }

	$query = "INSERT INTO tb_data (x1, y1, class) VALUES ('$x1', '$y1', '$class')";
	$insert = mysqli_query($db,$query);

	if ($insert == false) {
		?>
		<script type='text/javascript'>
			alert('Gagal Menambah Data');
			window.location.href="index.php";
		</script>
		<?php
	}
	else{
		?>
		<script type='text/javascript'>
			alert('Sukses Menambah Data');
			window.location.href="index.php";
		</script>
		<?php
	}

}elseif($opsi=="edit"){//opsi update

	if (isset($_POST['id'])) {$id = $_POST['id']; } else{echo "id tidak ditemukan"; }
	if (isset($_POST['x1'])) { $x1 = $_POST['x1']; }else{ echo "x1 tidak ditemukan"; }
	if (isset($_POST['y1'])) { $y1 = $_POST['y1']; }else{ echo "y1 tidak ditemukan"; }
	if (isset($_POST['class'])) { $class = $_POST['class']; }else{ echo "class tidak ditemukan"; }
	$query = "UPDATE tb_data SET x1='$x1', y1='$y1', class='$class' WHERE id= '$id'";
	$update = mysqli_query($db,$query);
	
	if ($update == false) {
		?>
		<script type='text/javascript'>
			alert('Gagal Mengubah Data');
			window.location.href="index.php";
		</script>
		<?php
	}
	else{
		?>
		<script type='text/javascript'>
			alert('Sukses Mengubah Data');
			window.location.href="index.php";
		</script>
		<?php
	}	

}elseif($opsi=="delete"){//opsi delete
	if (isset($_GET['id'])) {$id = $_GET['id']; }else{echo "id tidak ditemukan";}

	// hapus data
	$query = "DELETE FROM tb_data WHERE id = $id";
	$delete = mysqli_query($db,$query);

	// panggil data id paling terakhir
	$query = "SELECT id FROM tb_data ORDER BY id DESC";
	$result = mysqli_query($db,$query);
	$id_desc = mysqli_fetch_assoc($result);
	// jumlahkan data id terakhir
	$ai = $id_desc['id']+1;

	// tetapkan auto incremet baru agar kembali terurut dari data sembelumnya
	$query = "ALTER TABLE tb_data auto_increment=$ai";
	$alter = mysqli_query($db,$query);

	if ($delete == false) {
		?>
		<script type='text/javascript'>
			alert('Gagal Menghapus Data');
			window.location.href="index.php";
		</script>
		<?php
	}
	else{
		?>
		<script type='text/javascript'>
			alert('Sukses Menghapus Data');
			window.location.href="index.php";
		</script>
		<?php
	}
}

endif;
// end controller
?>