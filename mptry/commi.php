<?php
	require "connect_db.php";
	if(isset($_GET['source'])&&isset($_GET['dest'])){
		$source=$_GET['source'];
		$dest=$_GET['dest'];
		if(!empty($source)&&!empty($dest)){
			$query='CREATE TABLE IF NOT EXISTS `resultsab`(`name` text(100), `tabname` text(200), `start` INTEGER(4), `interval` INTEGER(4), `a` FLOAT, `b` FLOAT, `id` INTEGER NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`))';
			$query_run=mysql_query($query);
			$query="SELECT DISTINCT `interval` from `resultsab` where `interval` in (SELECT DISTINCT `interval` FROM `resultsab` WHERE `name`='$source') and `name`='$dest' ";
			$query_run=mysql_query($query);
			echo "<select name='interval' id='interval' class='btn-block form-group'>";
			echo "<option value='NULL'>SELECT interval</option>";
			while($var=mysql_fetch_assoc($query_run))
				echo "<option value='".$var['interval']."'>".$var['interval']."</option>";
			echo "</select>";
		}
	}
	
?>