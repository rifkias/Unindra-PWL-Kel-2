<?php
include '../../dbconnect.php';
include '../../helper.php';

$uri = getUri();
checkAuth();

if (isset($_POST['update'])) {
    $idx = $_POST['idbrg'];
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $merk = $_POST['merk'];
    $ukuran = $_POST['ukuran'];
    $satuan = $_POST['satuan'];
    $lokasi = $_POST['lokasi'];

    $updatedata = mysqli_query($conn, "update sstock_brg set nama='$nama', jenis='$jenis', merk='$merk', ukuran='$ukuran', satuan='$satuan', lokasi='$lokasi' where idx='$idx'");

    //cek apakah berhasil
    if ($updatedata) {

        echo " <div class='alert alert-success'>
                <strong>Success!</strong> Redirecting you back in 1 seconds.
              </div>
            <meta http-equiv='refresh' content='1; url= stock.php'/>  ";
    } else {
        echo "<div class='alert alert-warning'>
                <strong>Failed!</strong> Redirecting you back in 1 seconds.
              </div>
             <meta http-equiv='refresh' content='1; url= stock.php'/> ";
    }
};

if (isset($_POST['hapus'])) {
    $idx = $_POST['idbrg'];

    $delete = mysqli_query($conn, "delete from sstock_brg where idx='$idx'");
    //hapus juga semua data barang ini di tabel keluar-masuk
    $deltabelkeluar = mysqli_query($conn, "delete from sbrg_keluar where id='$idx'");
    $deltabelmasuk = mysqli_query($conn, "delete from sbrg_masuk where id='$idx'");

    //cek apakah berhasil
    if ($delete && $deltabelkeluar && $deltabelmasuk) {

        echo " <div class='alert alert-success'>
                <strong>Success!</strong> Redirecting you back in 1 seconds.
              </div>
            <meta http-equiv='refresh' content='1; url= stock.php'/>  ";
    } else {
        echo "<div class='alert alert-warning'>
                <strong>Failed!</strong> Redirecting you back in 1 seconds.
              </div>
             <meta http-equiv='refresh' content='1; url= stock.php'/> ";
    }
};
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
	<title>PERGUDANGAN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">


	<?php
	include '../../partials/_assetsHref.php';
	?>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
	<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
</head>

<body>

	<!-- <div id="preloader">
			<div class="loader"></div>
		</div> -->
	<div class="page-container">
		<?php include '../../partials/_sidebar.php' ?>

		<div class="main-content">
			<?php
			$header = "STOK BARANG";
			include '../../partials/_header.php'
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
								<li><span>Daftar Barang</span></li>
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
									<h2>Daftar Barang</h2>
									<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah Barang</button>
								</div>
								<div class="data-tables datatable-dark">
									<table id="dataTable3" class="display" style="width:100%">
										<thead class="thead-dark">
											<tr>
												<th>No</th>
												<th>Nama Barang</th>
												<th>Jenis</th>
												<th>Merk</th>
												<th>Ukuran</th>
												<th>Stock</th>
												<th>Satuan</th>
												<th>Lokasi</th>

												<th>Opsi</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$brgs = mysqli_query($conn, "SELECT * from sstock_brg order by nama ASC");
											$no = 1;
											while ($p = mysqli_fetch_array($brgs)) {
												$idb = $p['idx'];
											?>

												<tr>
													<td><?php echo $no++ ?></td>
													<td><?php echo $p['nama'] ?></td>
													<td><?php echo $p['jenis'] ?></td>
													<td><?php echo $p['merk'] ?></td>
													<td><?php echo $p['ukuran'] ?></td>
													<td><?php echo $p['stock'] ?></td>
													<td><?php echo $p['satuan'] ?></td>
													<td><?php echo $p['lokasi'] ?></td>
													<td><button data-toggle="modal" data-target="#edit<?= $idb; ?>" class="btn btn-warning">Edit</button> <button data-toggle="modal" data-target="#del<?= $idb; ?>" class="btn btn-danger">Del</button></td>
												</tr>


												<!-- The Modal -->
												<div class="modal fade" id="edit<?= $idb; ?>">
													<div class="modal-dialog">
														<div class="modal-content">
															<form method="post">
																<!-- Modal Header -->
																<div class="modal-header">
																	<h4 class="modal-title">Edit Barang <?php echo $p['nama'] ?> - <?php echo $p['jenis'] ?> - <?php echo $p['ukuran'] ?></h4>
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																</div>

																<!-- Modal body -->
																<div class="modal-body">

																	<label for="nama">Nama</label>
																	<input type="text" id="nama" name="nama" class="form-control" value="<?php echo $p['nama'] ?>">

																	<label for="jenis">Jenis</label>
																	<input type="text" id="jenis" name="jenis" class="form-control" value="<?php echo $p['jenis'] ?>">

																	<label for="merk">Merk</label>
																	<input type="text" id="merk" name="merk" class="form-control" value="<?php echo $p['merk'] ?>">

																	<label for="ukuran">Ukuran</label>
																	<input type="text" id="ukuran" name="ukuran" class="form-control" value="<?php echo $p['ukuran'] ?>">

																	<label for="stock">Stock</label>
																	<input type="text" id="stock" name="stock" class="form-control" value="<?php echo $p['stock'] ?>" disabled>

																	<label for="satuan">Satuan</label>
																	<input type="text" id="satuan" name="satuan" class="form-control" value="<?php echo $p['satuan'] ?>">

																	<label for="lokasi">Lokasi</label>
																	<input type="text" id="lokasi" name="lokasi" class="form-control" value="<?php echo $p['lokasi'] ?>">
																	<input type="hidden" name="idbrg" value="<?= $idb; ?>">


																</div>

																<!-- Modal footer -->
																<div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																	<button type="submit" class="btn btn-success" name="update">Save</button>
																</div>
															</form>
														</div>
													</div>
												</div>



												<!-- The Modal -->
												<div class="modal fade" id="del<?= $idb; ?>">
													<div class="modal-dialog">
														<div class="modal-content">
															<form method="post">
																<!-- Modal Header -->
																<div class="modal-header">
																	<h4 class="modal-title">Hapus Barang <?php echo $p['nama'] ?> - <?php echo $p['jenis'] ?> - <?php echo $p['ukuran'] ?></h4>
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																</div>

																<!-- Modal body -->
																<div class="modal-body">
																	Apakah Anda yakin ingin menghapus barang ini dari daftar stock?
																	<input type="hidden" name="idbrg" value="<?= $idb; ?>">
																</div>

																<!-- Modal footer -->
																<div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
																	<button type="submit" class="btn btn-success" name="hapus">Hapus</button>
																</div>
															</form>
														</div>
													</div>
												</div>


											<?php
											}
											?>
										</tbody>
									</table>
								</div>
								<a href="exportstkbhn.php" target="_blank" class="btn btn-info">Export Data</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php include '../../partials/_footer.php' ?>
	</div>
	<div id="myModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Masukkan stok manual</h4>
				</div>
				<div class="modal-body">
					<form action="tmb_brg_act.php" method="post">
						<div class="form-group">
							<label>Nama</label>
							<input name="nama" type="text" class="form-control" placeholder="Nama Barang" required>
						</div>
						<div class="form-group">
							<label>Jenis</label>
							<input name="jenis" type="text" class="form-control" placeholder="Jenis / Kategori Barang">
						</div>
						<div class="form-group">
							<label>Merk</label>
							<input name="merk" type="text" class="form-control" placeholder="Merk Barang">
						</div>
						<div class="form-group">
							<label>Ukuran</label>
							<input name="ukuran" type="text" class="form-control" placeholder="Ukuran">
						</div>
						<div class="form-group">
							<label>Stock</label>
							<input name="stock" type="number" min="0" class="form-control" placeholder="Qty">
						</div>
						<div class="form-group">
							<label>Satuan</label>
							<select name="satuan" class="custom-select form-control">
								<option selected>Pilih satuan</option>
								<option value="Buah">Buah</option>
								<option value="Unit">Unit</option>
								<option value="Meter">Meter</option>
								<option value="Milimeter">Centimeter</option>
								<option value="Milimeter">Milimeter</option>
							</select>
						</div>
						<div class="form-group">
							<label>Lokasi</label>
							<input name="lokasi" type="text" class="form-control" placeholder="Lokasi barang">
						</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
				</form>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			$('input').on('keydown', function(event) {
				if (this.selectionStart == 0 && event.keyCode >= 65 && event.keyCode <= 90 && !(event.shiftKey) && !(event.ctrlKey) && !(event.metaKey) && !(event.altKey)) {
					var $t = $(this);
					event.preventDefault();
					var char = String.fromCharCode(event.keyCode);
					$t.val(char + $t.val().slice(this.selectionEnd));
					this.setSelectionRange(1, 1);
				}
			});
		});

		$(document).ready(function() {
			$('#dataTable3').DataTable({
				dom: 'Bfrtip',
				buttons: [
					'print'
				]
			});
		});
	</script>


</body>

</html>