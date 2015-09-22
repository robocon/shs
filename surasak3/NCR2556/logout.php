<?php
	session_start();
	
	unset($_SESSION["Userncr"]);
	unset($_SESSION["statusncr"]);
	unset($_SESSION["Untilncr"]);
	unset($_SESSION["Namencr"]);
	unset($_SESSION["Codencr"]);
	
	session_destroy();
	
	header("Location: ncf2.php");
?>