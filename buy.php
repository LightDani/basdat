<?php
require_once('auth_k.php');
require_once('config.php');

$Err = $Scs = $kuantitas = "";

$sql = "SELECT kuantitas FROM buku WHERE ID_buku =".$_GET['id'];
$stmt = $db->prepare($sql);
$stmt->execute();
$sisa = $stmt->fetch(PDO::FETCH_ASSOC);
	

if(isset($_POST['beli'])){
    if (empty($_POST["kuantitas"])) {
        $Err = "Mohon masukkan jumlah";
    } else {
        $kuantitas = filter_input(INPUT_POST, 'kuantitas', FILTER_SANITIZE_NUMBER_INT);
    }

    $sql = "INSERT INTO transaksi VALUES (:ID_kios,:no_transaksi,:ID_buku,:kuantiti,:waktu)";
    $stmt = $db->prepare($sql);

    $params = array(
        ":ID_kios" => $_SESSION['user']['username'],
        ":no_transaksi" => date("Ymd").date("i")[1].date("s"),
        ":ID_buku" => $_GET['id'],
        ":kuantiti" => $kuantitas,
        ":waktu" => date("Ymd")
    );
    if($kuantitas){
        $saved = $stmt->execute($params);
        if($saved){
			$Scs = "Pembelian berhasil";
            $Err = "";
            sleep(2);
            header("Location: kios.php");
		}else{
			$Scs = "";
			$Err = "cek kembali jumlah pembelian";
		}
    }
}
?>

<!DOCTYPE html>
<html>
<header>
<title>(BDE) Admin Page</title>
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
    <span class="error" align="right"><?php echo $Err; ?></span>
    <span class="success" align="right"><?php echo $Scs; ?></span></p>
    <span align="right"><?php echo "stok tersedia:".$sisa['kuantitas']; ?></span></p>
    <form action="" method="POST">
        <div class="form-group">
            <label for="kuantitas">Masukkan jumlah</label>
            <input type="number" class="form-control" name="kuantitas" placeholder="Jumlah">
        </div><br>  					
        <input type="submit" class="btn btn-warning" name="beli" value="Beli"/>
	</form>
</header>
</html>