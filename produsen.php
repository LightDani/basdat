<?php
	require_once('auth_p.php');
	require_once('config.php');
	$sql = "SELECT nama_produsen FROM produsen WHERE ID_produsen =".$_SESSION['user']['username'];
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$namaP = $stmt->fetch(PDO::FETCH_ASSOC);
	$opt = 0;
	if(isset($_POST['list'])){
		$opt = 1;
	}else if(isset($_POST['update'])){
		$opt = 2;
	}else if(isset($_POST['pemasukan'])){
		$opt = 3;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>(BDE) Produsen Page</title>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	<style>
        @font-face {
        font-family: "Cabin";
        src: url("font/Cabin.ttf");
        }

        .cabin {
        font-family: "Cabin";
		}
	</style>
</head>
<body>
	<div class="container-fluid" style="background: #393939;>
		<div class="row" align="center">
			<p align="right"><a style="font-family: cabin; color: #FFFFFF;" href="logout.php">Logout</a></p>
			<br>
			<h1 style="font-family: cabin; color: #FFFFFF;">Bright Day Expo</h1>
			<h2 style="font-family: cabin; color: #FFFFFF;">Selamat Datang di Halaman Pengelola</h2>
			<h3 style="font-family: cabin; color: #FFFFFF;"><?php echo $namaP['nama_produsen'] ?></h3>
			<br><br>
			<ul style="color: #FFFFFF">
				<div class="row">
					<div class="col-md-4">
						<form action ="" method = "POST">
						<input type="submit" class="btn btn-warning" name="list" value="List Buku"/>
						</form>
  					</div>
  					<div class="col-md-4">
					  	<form action ="" method = "POST">
						<input type="submit" class="btn btn-warning" name="update" value="Update Katalog"/>
						</form>
  					</div>
  					<div class="col-md-4">
						<form action ="" method = "POST">
						<input type="submit" class="btn btn-warning" name="pemasukan" value="Pemasukan"/>
						</form>
					</div>
 				</div>
 			</ul>
			<table class="table table-striped" style="font-family: cabin; color: #FFFFFF;>
			<h0 style="font-family: cabin; color: #FFFFFF;">
			<?php
				if($opt == 1){
					print "<tr>".
					"<th>ID Buku</th>".
					"<th>Judul Buku</th>".
					"<th>Kategori</th>".
					"<th>Harga</th>".
					"<th>Kuantitas</th>".
					"</tr>";
					//require_once("config.php");
					$sql = "SELECT ID_buku, judul_buku, kategori, harga, kuantitas FROM buku WHERE ID_produsen =".$_SESSION['user']['username'];
					$stmt = $db->prepare($sql);
					$stmt->execute();
					while($user = $stmt->fetch(PDO::FETCH_ASSOC)){
						print "<tr>".
						"<td>".$user['ID_buku'].
						"<td>".$user['judul_buku'].
						"<td>".$user['kategori'].
						"<td>".$user['harga'].
						"<td>".$user['kuantitas'].
						"</tr>";
					}
					print "<br><br><br><br><br><br>";
				}else if($opt == 2){
					header('Location: produsen_update.php');
				}else if($opt == 3){
					print "<tr>".
					"<th>ID Buku</th>".
					"<th>Judul Buku</th>".
					"<th>Harga</th>".
					"<th>Kuantitas</th>".
					"<th>No Transaksi</th>".
					"<th>Tanggal Terjual</th>".
					"<th>Pembeli</th>".
					"<th>Total</th>".
					"</tr>";
					//require_once("config.php");
					$sql = "SELECT t.ID_buku, b.judul_buku, b.harga, t.kuantiti, t.no_transaksi, t.waktu, k.nama_kios FROM buku b, transaksi t, kios k WHERE b.ID_produsen ='".$_SESSION['user']['username']."'AND t.ID_buku = b.ID_buku AND t.ID_kios = k.ID_kios ORDER BY t.waktu ASC";
					$stmt = $db->prepare($sql);
					$stmt->execute();
					$total = 0;
					while($user=$stmt->fetch(PDO::FETCH_ASSOC)){
						$total = $total + $user['harga'] * $user['kuantiti'];
						print "<tr>".
						"<td>".$user['ID_buku'].
						"<td>".$user['judul_buku'].
						"<td>".$user['harga'].
						"<td>".$user['kuantiti'].
						"<td>".$user['no_transaksi'].
						"<td>".$user['waktu'].
						"<td>".$user['nama_kios'].
						"<td>".$total.
						"</tr>";
					}
					print "<br><br><br><br><br><br>";
				}else{
					print "<br><br><br><br><br><br>
					<br><br><br><br><br><br>
					<br><br><br><br><br><br>";
				}
			?>
			
		</div>
</body>
</html>