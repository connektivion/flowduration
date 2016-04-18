<?php
	require 'connect_db.php';
	$table=$_GET['table'];
	$query='DROP TABLE `'.$table.'`';
    $query_run=mysql_query($query);
    if($query_run)
    	echo "DELETED";
?>