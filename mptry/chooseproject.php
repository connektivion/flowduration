<?php
	require 'sqlcon.php';
	include 'upper.php';
	echo "<h4>choose an Project</h4>";
	mysql_select_db('projects');
	$query="SELECT `name` from `projects` where 1";
	$query_run=mysql_query($query);
	while($var=mysql_fetch_assoc($query_run)){
		echo "<a href='http://localhost/mptry/project.php?db=".$var['name']."'><button class='btn btn-primary btn-block'>".$var['name']."</button></a><br>";
	}
	include "goback.php";
	include "niche.php";
?>

			