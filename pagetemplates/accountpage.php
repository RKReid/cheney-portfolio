<?php
	$basicheader = "true";
	echo"<!DOCTYPE HTML>
	<html>";
	require("../Logins/staffordhistoricaldbLogin.php");
	echo "<section class='topboxes'>"; 
	include("pageparts/alert.php");
	include("pageparts/linkBar.php");
	echo"</section>
	<body class='normalbody'>";
	include("pageparts/header.php");
	echo "<script src='pageparts/jsfunctions.js'></script>
";
?>