<?php
	if(!(@mysql_connect('localhost','root',''))){
		echo "cant connect to mysql.. make sure your credentials are valid and sql is turned on from the xampp control panel";
		die();
	}
?>