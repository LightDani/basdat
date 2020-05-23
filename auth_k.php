<?php
	session_start();
	if(!isset($_SESSION['user']) || ($_SESSION['level']!="kios")){
		header("Location: login.php");
	}
?>