<?php
$uri =  parse_url((empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]", PHP_URL_PATH);
$date = new DateTime("1985-12-24");
$now = new DateTime();
$interval = $now->diff($date);
?>

<div class="mx-3">

    <div class="row">
        <div class="col-12 text-center">
            <img src="<?php echo $uri . "dist/assets/img/foto.jpg" ?>" alt="Profile Picture" class="profile-pic">
            <h1>Daryanto</h1>
            <p class="lead">Tukang Ngarit Jadi Konglomerat</p>
        </div>
    </div>
    <div class="row biodata-section">
        <div class="col-12">
            <h2>Personal Information</h2>
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-2 fw-bold">Nama</div>
                        <div class="col-auto">:</div>
                        <div class="col">Daryanto</div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-2 fw-bold">NPM</div>
                        <div class="col-auto">:</div>
                        <div class="col">202143500780</div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-2 fw-bold">Kelas</div>
                        <div class="col-auto">:</div>
                        <div class="col">Y6G</div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-2 fw-bold">Tanggal Lahir</div>
                        <div class="col-auto">:</div>
                        <div class="col">24 Desember 1985</div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-2 fw-bold">Umur</div>
                        <div class="col-auto">:</div>
                        <div class="col"><?php echo $interval->y ?></div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-2 fw-bold">Jenis Kelamin</div>
                        <div class="col-auto">:</div>
                        <div class="col">Laki - Laki</div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-2 fw-bold">Email</div>
                        <div class="col-auto">:</div>
                        <div class="col"><a href="mailto:darto354@gmailcom">darto354@gmail.com</a></div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-2 fw-bold">Github</div>
                        <div class="col-auto">:</div>
                        <div class="col"><a href="https://github.com/T3060EL">Daryanto(T3060EL)</a></div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</div>
<!DOCTYPE html>
<html>
<head>
<title> Penggunaan Tag Tabel</title>
</head>
<body>
<table border = "3" style = background-color:aqua>
<tr>
<td style = background-color:blue colspan = "3"><center><b><font color = white size = 6 >    Kartu Tanda Mahasiswa   </font></b></center>  </td>
</tr>
<tr>
<td style = background-color:blue colspan = "3"><center><b><font color = white size = 6 > UNIVERSITAS INDRAPRASTA (PGRI)
</font></b></center></td>
</tr>
<tr>
<td>NPM</td>
<td>202143500780</td>
<td rowspan =25><center><img src = "dist/assets/img/foto.jpg" width = 100 high = 300/></center></td>
</tr>
<tr>
<td>Nama</td>
<td>Daryanto </td>
</tr>
<tr>
<td>Program</td>
<td>S1</td>
</tr>
<tr>
<td>Jurusan</td>
<td>Teknik Informatika </td>
</tr>
<tr>
<td>Kelas</td>
<td>YXG</td>
</tr>
<tr>
<td>Alamat</td>
<td>Jalan Granat Blok D</td>
</tr>
<tr>
<td>Tangga Lahir </td>
<td>24 Desember 1985</td>
</tr>
<tr>
<td>Jenis Kelamin</td>
<td>Laki-Laki</td>
</tr>
<tr>
<td>Agama</td>
<td>Islam</td>
</tr>
<tr>
<td>Golongan Darah</td>
<td>O</td>
</tr>

</table>
</body>
</html>
