<?php
	include("user.class.php");
	 
	if(!is_object($_SESSION["user"]))
		$_SESSION["user"] = new User();
?>
