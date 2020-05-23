<?php
	session_start();
	if(!isset($_SESSION['user']) || ($_SESSION['level']!="produsen")){
		header("Location: login.php");
	}
?>