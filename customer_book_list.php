<!DOCTYPE html>
<html>
<head>
	<title>(BDE) List Buku</title>
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
			<br>
			<img src="img/2-01.png" width="150" height="150" alt="Responsive image" class="img-rounded">
			<br><br>
			<h1 style="font-family: cabin; color: #FFFFFF;">Bright Day Expo</h1>
			<h2 style="font-family: cabin; color: #FFFFFF;">Berikut adalah daftar nama dari koleksi buku yang kami miliki</h2>
			<br><br>
			<ul style="color: #FFFFFF">
				<div align="left">
  					<div class="col-md-12">LIST BUKU
						<br>
  						<table class="table table-striped">
  							<h0 style="font-family: cabin; color: #FFFFFF;">
							<tr>
								<th>Judul Buku</th>
								<th>Produsen</th>
								<th>Harga</th>
								<th>Sisa Barang</th>
							</tr>
							<?php
								require_once("config.php");
								$sql = "SELECT p.nama_produsen, b.judul_buku, b.harga, b.kuantitas FROM buku b, produsen p WHERE b.ID_produsen = p.ID_produsen";
								
								$stmt = $db->prepare($sql);
								
								$stmt->execute();
								while($user = $stmt->fetch(PDO::FETCH_ASSOC)){
									print "<tr>";
									print "<td>".$user['judul_buku'];
									print "<td>".$user['nama_produsen'];
									print "<td>".$user['harga'];
									print "<td>".$user['kuantitas'];
									print "<br>";
								}
							?>
							</h0> 
						</table>
					</div>
				</div>
			</ul>			
		</div>			
	</div>
</body>
</html>