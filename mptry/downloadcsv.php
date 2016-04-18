<?php
	$host="localhost";
	$uname="root";
	$pass="";
	$database = $_GET['db']; 

	$connection=mysql_connect($host,$uname,$pass); 

	echo mysql_error();

	//or die("Database Connection Failed");
	$selectdb=mysql_select_db($database) or 
	die("Database could not be selected"); 
	$result=mysql_select_db($database)
	or die("database cannot be selected <br>");

	// Fetch Record from Database

	$output = "";
	$table = $_GET['table']; // Enter Your Table Name 
	$sql = mysql_query("select * from $table where 1");
	$columns_total = mysql_num_fields($sql);

	// Get The Field Name
	$n=array();
	for ($i = 0; $i < $columns_total; $i++) {
		$heading = mysql_field_name($sql, $i);
		$output .= '"'.$heading.'",';
		array_push($n, $heading);
	}
	$output .="\n";
	// Get Records from the table
	//echo mysql_num_rows($sql);
	while ($var = mysql_fetch_assoc($sql)) {
		 for ($i = 0; $i < $columns_total; $i++) {
			$output .='"'.$var[$n[$i]].'",';
		 }
		 $output .="\n";
	}

	// Download the file

	$filename = $table.'.csv';
	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename='.$filename);

	echo $output;
?>