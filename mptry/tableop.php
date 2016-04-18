<?php
	require 'connect_db.php';
	include 'upper.php';
	echo "<h4>Operation listings on the tables</h4></div>";
	$db=$_GET['db'];
	$query="SHOW TABLES FROM `".$db."`";
	$query_run=mysql_query($query);
	echo "<table class='table table-striped table-bordered'><tr><th>table name</th><th>download csv</th><th>delete table</th></tr>";
	while($var=mysql_fetch_array($query_run)){
		$name=$var[0];
		if($name!='table 2'&&$name!='resultsneed'&&$name!='resultsab'&&$name!='names')
			echo "<tr><td>".$var[0]."</td><td><a href='./downloadcsv.php?db=".$db."&table=".$name."' target='_blank'><button class='btn btn-success'>SAVE AS CSV</button></a></td><td><a href='./droptable.php?db=".$db."&table=".$name."' target='_blank'><button class='btn btn-danger'>DELETE TABLE</button></a></td></tr>";
	}
	echo "</table>";
	echo "<h5><a href='./project.php?db=".$db."'>go back</a> </h5>";
	include 'niche.php';
?>
