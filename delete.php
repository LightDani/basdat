<?php
require_once('auth_p.php');
require_once('config.php');

$confirm = "";

if(isset($_POST['konfirmasi'])){
    if (empty($_POST["confirm"])) {
        ;
    } else {
        $confirm = filter_input(INPUT_POST, 'confirm', FILTER_SANITIZE_STRING);
    }
    //$sql = "DELETE FROM `buku` WHERE ID_buku = '".:ID_buku."' AND ID_produsen = '".:ID_produsen.";
    $sql = "DELETE FROM buku WHERE ID_buku=:ID_buku AND ID_produsen=:ID_produsen";
    $stmt = $db->prepare($sql);

    $params = array(
        ":ID_buku" => $_GET['id'],
        ":ID_produsen" => $_SESSION['user']['username']
    );
    //die($params[':ID_buku']." ".$params[':ID_produsen']);

    if($confirm == 'confirm'){
        $saved = $stmt->execute($params);
        if($saved){
            header("Location: produsen.php");
		}else{
            die("gagal");
        }
    }else if($confirm == 'cancel'){
        header("Location: produsen.php");
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
    <form action="" method="POST">
        <div class="form-group">
            <label for="confirm">Type confirm to continue</label>
            <input type="text" class="form-control" name="confirm" placeholder="confirm/cancel">
        </div><br>  					
        <input type="submit" class="btn btn-warning" name="konfirmasi" value="Confirm"/>
	</form>
</header>
</html>