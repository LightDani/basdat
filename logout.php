<?php
session_start();
session_destroy();
//session_unset("user");
//session_unset("level");
header("Location: index.php");
?>