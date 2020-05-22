<?php
	session_start();
	if(!isset($_SESSION['user']) || ($_SESSION['level']!="Produsen")){
		header("Location: login.php");
	}
?>