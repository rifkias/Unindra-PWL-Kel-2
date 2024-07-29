<?php
include 'dbconnect.php';
include 'helper.php';

$uri = getUri();
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
	<title>PERGUDANGAN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
	include './partials/_assetsHref.php';
	?>
</head>

<body>

	<!-- <div id="preloader">
			<div class="loader"></div>
		</div> -->
	<div class="page-container">
		<?php include './partials/_sidebar.php' ?>

		<div class="main-content">
			<?php
			$header = "SELAMAT DATANG APLIKASI PERGUDANGAN KELOMPOK 2";
			include './partials/_header.php'
			?>

			<?php

			$periksa_bahan = mysqli_query($conn, "select * from sstock_brg where stock <1");
			while ($p = mysqli_fetch_array($periksa_bahan)) {
				if ($p['stock'] <= 1) {
			?>
					<script>
						$(document).ready(function() {
							$('#pesan_sedia').css("color", "white");
							$('#pesan_sedia').append("<i class='ti-flag'></i>");
						});
					</script>
			<?php
					echo "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button>Stok  <strong><u>" . $p['nama'] . "</u> <u>" . ($p['merk']) . "</u> &nbsp <u>" . $p['ukuran'] . "</u></strong> yang tersisa sudah habis</div>";
				}
			}
			?>
			<!-- page title area start -->
			<div class="page-title-area">
				<div class="row align-items-center">
					<div class="col-sm-6">
						<div class="breadcrumbs-area clearfix">
							<h4 class="page-title pull-left">Dashboard</h4>
							<ul class="breadcrumbs pull-left">
								<li><a href="index.php">Home</a></li>
								<li><span>Dashboard</span></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6 clearfix">
						<div class="user-profile pull-right" style="color:black; padding:0px;">
							<img src="<?= $uri ?>/assets/img/log1.jpg" width="220px" class="user-name dropdown-toggle" data-toggle="dropdown" \>
						</div>
					</div>
				</div>
			</div>

			<div class="main-content-inner">
				<div class="row mt-5 mb-5">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<div class="d-sm-flex justify-content-between align-items-center">
									<h2>Notes</h2>
								</div>
								<div class="market-status-table mt-4">
									<div class="table-responsive">
										<table class="table table-bordered table-hover">
											<thead class="thead-dark">
												<tr>
													<th>
														<center> No </center>
													</th>
													<th>
														<center> Catatan </center>
													</th>
													<th>
														<center> Ditulis oleh </center>
													</th>
													<th>
														<center> Action </center>
													</th>


												</tr>
											</thead>
											<form method='POST' action='<?= $uri ?>/php/notes/notes.php'>
												<tr class="table-active">
													<td>
														<center><input type='hidden' /></center>
													</td>
													<td>
														<center> <input type='text' class='form-control' name='konten' required /></center>
													</td>
													<td>
														<center>Saya, <strong><?= $_SESSION['user']; ?></strong> <span class="badge badge-secondary"><?= $_SESSION['role']; ?></span></center>
													</td>
													<td>
														<center><input type='submit' name='submit' class='btn btn-primary btn-sm' value='Add Note' /></center>
													</td>
												<tr>
											</form>
											<?php
											// Perintah untuk menampilkan data
											$queri = "Select * From notes where status='aktif' Order by id DESC";  //menampikan SEMUA data dari tabel

											$hasil = MySQLi_query($conn, $queri);    //fungsi untuk SQL

											// nilai awal variabel untuk no urut
											$i = 1;

											// perintah untuk membaca dan mengambil data dalam bentuk array
											while ($data = mysqli_fetch_array($hasil)) {
												$id = $data['id'];
												$str = "<tr>";
												$str .= "<td><center>" . $i . "</center></td>";
												$str .= "<td><strong><center>" . $data['contents'] . "</center></strong></td>";
												$str .= "<td><strong><center>" . $data['admin'] . "</center></strong></td>";
												$str .= "<td>
															<center>
																<form method ='POST' action = 'done.php'>
																	<input type = 'hidden' name = 'id' value = '" . $data['id'] . "'> 
																	<input type='submit' name = 'submit'  class='btn btn-danger btn-sm' value = 'Delete' formaction='".$uri."/php/notes/del.php' />
																</form>
															</center>
														</td>";
												$str .= "</tr>";
												echo $str;
												$i++;
											}
											?>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php include './partials/_footer.php' ?>
	</div>


</body>

</html>