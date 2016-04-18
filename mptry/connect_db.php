<?php
	if(isset($_GET['db'])){
		$db=$_GET['db'];
		if(!empty($db)){
			if(!(@mysql_connect('localhost','root',''))||!(@mysql_select_db($db))){
				echo"we are temporarily down..cant connect";
				die();
			}
		}
	}
?>