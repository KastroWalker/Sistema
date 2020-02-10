<?php 
	session_start();
	session_destroy();
	header('../pages/logout.php');
	exit();
?>