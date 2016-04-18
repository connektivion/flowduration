<?php
	require 'sqlcon.php';
	$query='CREATE DATABASE projects';
	mysql_query($query);
	echo "Projects Database Successfully created!";
?>