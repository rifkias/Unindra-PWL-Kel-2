<?php 
session_start();
include 'dbconnect.php';

require 'helper.php';

$uri = getUri();


if (isset($_POST['btn-login'])) {
	$uname = mysqli_real_escape_string($conn, $_POST['username']);
	$upass = mysqli_real_escape_string($conn, md5($_POST['password']));

	// menyeleksi data user dengan username dan password yang sesuai
	$login = mysqli_query($conn, "select * from slogin where username='$uname' and password='$upass';");
	// menghitung jumlah data yang ditemukan
	$cek = mysqli_num_rows($login);

	// cek apakah username dan password di temukan pada database
	if ($cek > 0) {

		$data = mysqli_fetch_assoc($login);

		if ($data['role'] == "stock") {
			// buat session login dan username
			$_SESSION['user'] = $data['nickname'];
			$_SESSION['user_login'] = $data['username'];
			$_SESSION['id'] = $data['id'];
			$_SESSION['role'] = "stock";
			header("location:index.php");
		} else {
			header("location:$uri/login.php?pesan=gagal");
		}
	}else{
        header("location:$uri/login.php?pesan=Invalid%20Credential");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>System Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-144808195-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-144808195-1');
	</script>
	<script src="<?=$uri?>/assets/js/jquery.min.js"></script>
	<style>
		body {
			background-image: url("<?=$uri?>/assets/img/bg.jpg");
		}

		@media screen and (max-width: 600px) {
			h4 {
				font-size: 85%;
			}
		}
	</style>
	<link rel="icon" type="image/png" href="favicon.png">
</head>

<body>

	<div align="center">




		<img src="<?=$uri?>/assets/img/logo1.png" width="50%" style="margin-top:5%" \>

		<br \><br \>
		<div class="container">
            <?php 
                if(isset($_GET['pesan'])){
            ?>
            <div class="alert alert-primary" role="alert">
                <?= @$_GET['pesan'] ?>
            </div>
            <?php 
                }
            ?>
			<div style="color:white">
				<label>PERGUDANGAN KELOMPOK 2 :</label><br \>
				<label>LOGIN :</label><br \>
				<label>Username & Password : guest</label><br \>
			</div>
			<form method="post">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Username" name="username" autofocus>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Password" name="password">
				</div>
				<button type="submit" class="btn btn-primary" name="btn-login">Masuk</button>

			</form>

			<br \>
		</div>
	</div>




</body>

</html>