<?php
	session_start();
	if(!isset($_SESSION['user']) || ($_SESSION['level']!="Kios")){
		header("Location: login.php");
	}
?>