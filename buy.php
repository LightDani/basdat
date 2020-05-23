<?php
require_once('auth_k.php');
require_once('config.php');
print $_SESSION['barang']['ID_buku'];
print $_SESSION['barang']['judul_buku'];
print '<p align="left">&larr; <a style="font-family: cabin; color: #000000;" href="kios.php">Back</a><br>';

?>