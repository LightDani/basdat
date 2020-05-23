<?php
	require_once("auth_k.php");
	require_once("config.php");

	$sql = "SELECT nama_kios FROM kios WHERE ID_kios =".$_SESSION['user']['username'];
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$namaK = $stmt->fetch(PDO::FETCH_ASSOC);
	$opt = 0;
	if(isset($_POST['buku'])){
		$opt = 1;
	}else if(isset($_POST['harga'])){
		$opt = 2;
	}else if(isset($_POST['kategori'])){
		$opt = 3;
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Bright Day Expo</title>
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
			<br>
			<h2 style="font-family: cabin; color: #FFFFFF;">Selamat Datang <?php echo $namaK['nama_kios']; ?> di Pusat Buku Indie di Seluruh Indonesia!</h2>
			<br><br>
			<ul style="color: #FFFFFF">
				<div class="row" >
  					<div class="col-md-4 col-xs-4">LIST BUKU 
						<br><br><br>
  						<img src="img/2-01.png" width="250" height="250" alt="Responsive image" class="img-rounded">
  						<br><br><br>
						<form action ="" method="POST">
						<input type="submit" class="btn btn-warning" name="buku" value="Klik di sini!"/>
						</form>
					</div>
 					<div class="col-md-4 col-xs-4">LIST HARGA 
						<br><br><br>
						<img src="img/1-01.png" width="250" height="250" alt="Responsive image" class="img-rounded"> 
						<br><br><br>
						<form action ="" method="POST">
						<input type="submit" class="btn btn-warning" name="harga" value="Klik di sini!"/>
						</form>
					</div>
 					<div class="col-md-4 col-xs-4">LIST KATEGORI
 						<br><br><br>
 						<img src="img/3-01.png" width="250" height="250" alt="Responsive image" class="img-rounded">
 						<br><br><br>
						<form action ="" method="POST">
						<input type="submit" class="btn btn-warning" name="kategori" value="Klik di sini!"/>
						</form>
 					</div>
 				</div>
 				<br>
 			</ul>
			 <table class="table table-striped" style="font-family: cabin; color: #FFFFFF;>
			<h0 style="font-family: cabin; color: #FFFFFF;">
			<?php
				if($opt == 1){
					print "<tr>".
					"<th>Judul Buku</th>".
					"<th>Produsen</th>".
					"<th>Harga</th>".
					"<th></th>".
					"</tr>";
					$sql = "SELECT b.ID_buku, b.judul_buku, p.nama_produsen, b.harga FROM buku b, produsen p WHERE b.ID_produsen = p.ID_produsen AND b.kuantitas > 0";
					$stmt = $db->prepare($sql);
					$stmt->execute();
					while($user = $stmt->fetch(PDO::FETCH_ASSOC)){
						print "<tr>".
						"<td>".$user['judul_buku'].
						"<td>".$user['nama_produsen'].
						"<td>".$user['harga'].
						"<td><a href='buy.php' style='color:#FFFFFF;'>Beli</a>".
						"</tr>";
					}
				}else if($opt == 2){
					header('Location: kios_price_list.php');
				}else if($opt == 3){
					header('Location: kios_category_list.php');
				}
			?>
		</div>			
	</div>
</body>
</html>
