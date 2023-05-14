<?php
	session_start();
	if (isset($_SESSION['mail'])){
		$id = $_SESSION['id'];	
		$st = $_SESSION['status'];
		$mail = $_SESSION['mail'];
	}else{
		$_SESSION['mail'] = " ";
		$id = $_SESSION['id'] = " ";	
		$st = $_SESSION['status'] = " ";
		$mail = $_SESSION['mail'] = " ";
	}
?>