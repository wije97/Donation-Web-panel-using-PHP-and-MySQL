<?php
	session_start();
	session_destroy();
	header("Location:../DonateWebProjectPHP/login.php");

?>