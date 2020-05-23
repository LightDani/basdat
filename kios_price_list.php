<?php
	require_once('auth_k.php');
	require_once('config.php');

	$opt = 0;
	if(isset($_POST['low'])){
		$opt = 1;
	}else if(isset($_POST['low-mid'])){
		$opt = 2;
	}else if(isset($_POST['mid-high'])){
		$opt = 3;
	}else if(isset($_POST['high'])){
		$opt = 4;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>(BDE) List Harga</title>
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
			<img src="img/1-01.png" width="150" height="150" alt="Responsive image" class="img-rounded">
			<br><br>
			<h1 style="font-family: cabin; color: #FFFFFF;">Bright Day Expo</h1>
			<h2 style="font-family: cabin; color: #FFFFFF;">Berikut adalah daftar harga dari koleksi buku yang kami miliki</h2>
			<br>
			<p align="left">&larr; <a style="font-family: cabin; color: #FFFFFF;" href="kios.php">Back</a><br>
			<ul style="color: #FFFFFF">
				<div class="row">
					<div class="col-md-3">
  						<form action ="" method = "POST">
						<input type="submit" class="btn btn-warning" name="low" value="0k - 50k"/>
						</form>
  					    <br>
  					</div>
  					<div class="col-md-3">
					  	<form action ="" method = "POST">
						<input type="submit" class="btn btn-warning" name="low-mid" value="51k - 100k"/>
						</form>
					</div>
					<div class="col-md-3">
						<form action ="" method = "POST">
						<input type="submit" class="btn btn-warning" name="mid-high" value="101k - 150k"/>
						</form>
					</div>
					<div class="col-md-3">
						<form action ="" method = "POST">
						<input type="submit" class="btn btn-warning" name="high" value="151k - 200k"/>
						</form>
					</div>
 				</div>
 			</ul>
			 <table class="table table-striped" style="font-family: cabin; color: #FFFFFF;">
			<h0 style="font-family: cabin; color: #FFFFFF;">
			<?php
				if($opt == 1){
					print "<tr>".
					"<th>Judul Buku</th>".
					"<th>Produsen</th>".
					"<th>Harga</th>".
					"<th></th>".
					"</tr>";
					$sql = "SELECT b.ID_buku, b.judul_buku, p.nama_produsen, b.harga FROM buku b, produsen p WHERE b.ID_produsen = p.ID_produsen AND b.kuantitas > 0 AND b.harga < 51000";
					$stmt = $db->prepare($sql);
					$stmt->execute();
					while($user = $stmt->fetch(PDO::FETCH_ASSOC)){
						print "<tr>".
						"<td>".$user['judul_buku'].
						"<td>".$user['nama_produsen'].
						"<td>".$user['harga'].
						"<td><a style='color:#FFFFFF;'".
						"href='buy.php?id=".
						$user["ID_buku"].
						"'>Beli</a>".
						"</tr>";
					}
				}else if($opt == 2){
					print "<tr>".
					"<th>Judul Buku</th>".
					"<th>Produsen</th>".
					"<th>Harga</th>".
					"<th></th>".
					"</tr>";
					$sql = "SELECT b.ID_buku, b.judul_buku, p.nama_produsen, b.harga FROM buku b, produsen p WHERE b.ID_produsen = p.ID_produsen AND b.kuantitas > 0 AND b.harga > 50000 AND b.harga < 101000";
					$stmt = $db->prepare($sql);
					$stmt->execute();
					while($user = $stmt->fetch(PDO::FETCH_ASSOC)){
						print "<tr>".
						"<td>".$user['judul_buku'].
						"<td>".$user['nama_produsen'].
						"<td>".$user['harga'].
						"<td><a style='color:#FFFFFF;'".
						"href='buy.php?id=".
						$user["ID_buku"].
						"'>Beli</a>".
						"</tr>";
					}
				}else if($opt == 3){
					print "<tr>".
					"<th>Judul Buku</th>".
					"<th>Produsen</th>".
					"<th>Harga</th>".
					"<th></th>".
					"</tr>";
					$sql = "SELECT b.ID_buku, b.judul_buku, p.nama_produsen, b.harga FROM buku b, produsen p WHERE b.ID_produsen = p.ID_produsen AND b.kuantitas > 0 AND b.harga > 100000 AND b.harga < 151000";
					$stmt = $db->prepare($sql);
					$stmt->execute();
					while($user = $stmt->fetch(PDO::FETCH_ASSOC)){
						print "<tr>".
						"<td>".$user['judul_buku'].
						"<td>".$user['nama_produsen'].
						"<td>".$user['harga'].
						"<td><a style='color:#FFFFFF;'".
						"href='buy.php?id=".
						$user["ID_buku"].
						"'>Beli</a>".
						"</tr>";
					}
				}else if($opt == 4){
					print "<tr>".
					"<th>Judul Buku</th>".
					"<th>Produsen</th>".
					"<th>Harga</th>".
					"<th></th>".
					"</tr>";
					$sql = "SELECT b.ID_buku, b.judul_buku, p.nama_produsen, b.harga FROM buku b, produsen p WHERE b.ID_produsen = p.ID_produsen AND b.kuantitas > 0 AND b.harga > 150000 AND b.harga < 201000";
					$stmt = $db->prepare($sql);
					$stmt->execute();
					while($user = $stmt->fetch(PDO::FETCH_ASSOC)){
						print "<tr>".
						"<td>".$user['judul_buku'].
						"<td>".$user['nama_produsen'].
						"<td>".$user['harga'].
						"<td><a style='color:#FFFFFF;'".
						"href='buy.php?id=".
						$user["ID_buku"].
						"'>Beli</a>".
						"</tr>";
					}
				}else{
					print "<br><br><br><br><br><br><br><br><br><br>";
				}
			?>
		</div>
</body>
</html>