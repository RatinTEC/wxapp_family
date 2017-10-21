<?php
	require_once("config.php");
	require_once("function.php");
	$method		=	$_GET["method"];
	unset($_GET["method"]);
	include("$method.php");
?>
