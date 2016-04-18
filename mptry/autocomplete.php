<?php
require 'connect_db.php';
 $q=$_GET['q'];
 $my_data=mysql_real_escape_string($q);
$query="SELECT `COL 2`,`COL 3` FROM `names` WHERE `COL 2` LIKE '%$my_data%' ORDER BY `COL 1` ASC";
if($query_run=mysql_query($query))
{
	while($var=mysql_fetch_assoc($query_run))
	{
		echo $var['COL 2']."\n";
	}
}
?>