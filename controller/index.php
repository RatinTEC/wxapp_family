<?php
	require_once("config.php");
	$method		=	$_GET["method"];
	unset($_GET["method"]);
	include("$method.php");
?>
