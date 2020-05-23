<?php

require_once('auth_p.php');
require_once("config.php");
$ID = $judul = $kategori = $key = $harga = $kuantitas = "";
$Err = $Scs = "";

if(isset($_POST['update'])){
    if (empty($_POST["ID_buku"])) {
		$Err = "Mohon lengkapi form";
		$Scs = "";
    } else {
        $ID = filter_input(INPUT_POST, 'ID_buku', FILTER_SANITIZE_STRING);
    }

    if (empty($_POST["judul_buku"])) {
        $Err = "Mohon lengkapi form";
		$Scs = "";
    } else {
        $judul = filter_input(INPUT_POST, 'judul_buku', FILTER_SANITIZE_STRING);
    }

    if (empty($_POST["kategori"])) {
        $Err = "Mohon lengkapi form";
		$Scs = "";
    } else {
        $kategori = filter_input(INPUT_POST, 'kategori', FILTER_SANITIZE_STRING);
    }

    if (empty($_POST["kata_kunci"])) {
        $Err = "Mohon lengkapi form";
		$Scs = "";
    } else {
        $key = filter_input(INPUT_POST, 'kata_kunci', FILTER_SANITIZE_STRING);
    }

    if (empty($_POST["harga"])) {
		$Err = "Mohon lengkapi form";
		$Scs = "";
    } else {
		$harga = filter_input(INPUT_POST, 'harga', FILTER_SANITIZE_NUMBER_INT);
	}
	
	if (empty($_POST["kuantitas"])) {
		$Err = "Mohon lengkapi form";
		$Scs = "";
    } else {
		$kuantitas = filter_input(INPUT_POST, 'kuantitas', FILTER_SANITIZE_NUMBER_INT);
    }
	
	$sql = "SELECT ID_buku FROM buku WHERE ID_produsen =".$_SESSION['user']['username'];
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$cekID = $stmt->fetch(PDO::FETCH_ASSOC);
	if($cekID){
		$sql = "UPDATE buku SET judul_buku=:judul_buku, kategori=:kategori, kata_kunci=:kata_kunci, harga=:harga, kuantitas=:kuantitas WHERE ID_buku=:ID_buku AND ID_produsen=:ID_produsen";
	}else{
		$sql = "INSERT INTO buku VALUES (:ID_buku, :ID_produsen, :judul_buku, :kategori, :kata_kunci, :harga, :kuantitas)";
	}
	$stmt = $db->prepare($sql);	
	
    $params = array(
		":ID_buku" => $ID,
        ":ID_produsen" => $_SESSION['user']['username'],
        ":judul_buku" => $judul,
        ":kategori" => $kategori,
        ":kata_kunci" => $key,
        ":harga" => $harga,
        ":kuantitas" => $kuantitas
    );
    if($ID && $judul && $kategori && $key && $harga && $kuantitas){
		$saved = $stmt->execute($params);
		if($saved){
			$Scs = "Katalog berhasil diperbaharui";
			$Err = "";
		}else{
			$Scs = "";
			$Err = "Cek kembali formulir anda";
		}
		
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>(BDE) Admin Page</title>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	<style>
        @font-face {
        font-family: "Cabin";
        src: url("font/Cabin.ttf");
        }

        .cabin {
        font-family: "Cabin";
		}

		.error{
			color: #FF0000;
		}

		.success{
			color: #00FF00;
		}
	</style>
</head>
<body>
	<div class="container-fluid" style="background: #393939;>
		<div class="row" align="center">
			<p align="right"><a style="font-family: cabin; color: #FFFFFF;" href="logout.php">Logout</a></p>
			<br>
			<h1 style="font-family: cabin; color: #FFFFFF;">Bright Day Expo</h1>
			<h2 style="font-family: cabin; color: #FFFFFF;">Halaman Update Katalog Buku</h2>
			<br>
			<p align="left">&larr; <a style="font-family: cabin; color: #FFFFFF;" href="produsen.php">Back</a><br>
			<span class="error" align="right"><?php echo $Err; ?></span>
			<span class="success" align="right"><?php echo $Scs; ?></span></p>
				<div align="left">
				<ul style="color: #FFFFFF">
					<form action="" method="POST">
  					<div class="form-group">
   						<label for="ID_buku">ID Buku</label>
   						<input type="text" class="form-control" name="ID_buku" placeholder="ID Buku">
					</div>
  					<div class="form-group">
   						 <label for="judul_buku">Judul Buku</label>
   						 <input type="text" class="form-control" name="judul_buku" placeholder="Judul Buku">
  					</div>
  					<div class="form-group">
   						 <label for="kategori">Kategori</label>
   						 <input type="text" class="form-control" name="kategori" placeholder="Kategori">
  					</div>
  					<div class="form-group">
   						 <label for="kata_kunci">Kata Kunci</label>
   						 <input type="text" class="form-control" name="kata_kunci" placeholder="Kata Kunci">
  					</div>
  					<div class="form-group">
   						 <label for="harga">Harga Buku</label>
   						 <input type="number" class="form-control" name="harga" placeholder="Harga Buku">
  					</div>
  					<div class="form-group">
   						 <label for="kuantitas">Kuantitas</label>
   						 <input type="number" class="form-control" name="kuantitas" placeholder="Kuantitas">
  					</div><br>
					<input type="submit" class="btn btn-warning" name="update" value="Update"/>
					</form>
 					<br><br><br>
 				</div>
 				</ul>
 		</div>
	</div>
</body>
</html>