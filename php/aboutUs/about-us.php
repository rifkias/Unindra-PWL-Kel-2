<?php
include '../../dbconnect.php';
include '../../helper.php';

$uri = getUri();
checkAuth();

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
			<div class="header-area">
				<div class="row align-items-center">
					<!-- nav and search button -->
					<div class="col-md-6 col-sm-8 clearfix">
						<div class="nav-btn pull-left">
							<span></span>
							<span></span>
							<span></span>
						</div>
						<div class="search-box pull-left">
							<form action="#">
								<h2>About Us</h2>
							</form>
						</div>
					</div>
					<!-- profile info & task notification -->
					<div class="col-md-6 col-sm-4 clearfix">
						<ul class="notification-area pull-right">
							<li>
								<h3>
									<div class="date">
										<script type='text/javascript'>
											var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
											var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
											var date = new Date();
											var day = date.getDate();
											var month = date.getMonth();
											var thisDay = date.getDay(),
												thisDay = myDays[thisDay];
											var yy = date.getYear();
											var year = (yy < 1000) ? yy + 1900 : yy;
											document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
										</script></b>
									</div>
								</h3>

							</li>
						</ul>
					</div>
				</div>
				<div class="album py-5 bg-light">
					<div class="container">
						<div class="row">
							<div class="col-md-4">
								<div class="card mb-4 box-shadow">
									<img src="<?= $uri ?>/php/aboutUs/202143500780/dist/assets/img/foto.jpg" style="max-width:100px;height:auto;margin-left:30%;" />
									<div class="card-body">
										<p class="card-text">Nama : Daryanto</p>
										<p class="card-text">NPM : 202143500780</p>
										<p class="card-text">Hidup itu sudah susah dan kadang banyak masalah. Untuk itulah, terkadang hidup hanya perlu ditertawakan saja Hahaha.</p>
										<div class="d-flex justify-content-between align-items-center">
											<div class="btn-group">
												<a href="<?= $uri ?>/php/aboutUs/202143500780/202143500714_index.php" class="btn btn-sm btn-outline-secondary">View</a>
											</div>
											<small class="text-muted">9 mins</small>
										</div>
									</div>
								</div>
							</div>
							<!-- Tambahkan card lainnya di sini -->
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
					<h4 class="modal-title">Input Barang Keluar</h4>
				</div>
				<div class="modal-body">
					<form action="barang_keluar_act.php" method="post">
						<div class="form-group">
							<label>Tanggal</label>
							<input name="tanggal" type="date" class="form-control">
						</div>
						<div class="form-group">
							<label>Nama Barang</label>
							<select name="barang" class="custom-select form-control">
								<option selected>Pilih barang</option>
								<?php
								$det = mysqli_query($conn, "select * from sstock_brg order by nama ASC") or die(mysqli_error($conn));
								while ($d = mysqli_fetch_array($det)) {
								?>
									<option value="<?php echo $d['idx'] ?>"><?php echo $d['nama'] ?> <?php echo $d['merk'] ?> <?php echo $d['jenis'] ?>, Uk. <?php echo $d['ukuran'] ?> --- Stock : <?php echo $d['stock'] ?></option>
								<?php
								}
								?>
							</select>

						</div>
						<div class="form-group">
							<label>Jumlah</label>
							<input name="qty" type="number" min="1" class="form-control" placeholder="Qty">
						</div>
						<div class="form-group">
							<label>Penerima</label>
							<input name="penerima" type="text" class="form-control" placeholder="Penerima barang">
						</div>
						<div class="form-group">
							<label>Keterangan</label>
							<input name="ket" type="text" class="form-control" placeholder="Keterangan">
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