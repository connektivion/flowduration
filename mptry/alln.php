<?php
	require "connect_db.php";
	if(isset($_GET['name'])&&isset($_GET['type'])){
		$name=$_GET['name'];
		$type=$_GET['type'];
		if(!empty($name)&&!empty($type)){
			if($type==1){
				$query='CREATE TABLE IF NOT EXISTS `resultsab`(`name` text(100), `tabname` text(200), `start` INTEGER(4), `interval` INTEGER(4), `a` FLOAT, `b` FLOAT, `id` INTEGER NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`))';
				$query_run=mysql_query($query);
				$query="SELECT DISTINCT `name` from `resultsab` where `name`!='$name'";
				$query_run=mysql_query($query);
				echo "<select name='destinations' id='destinations' class='btn-block form-group'>";
					echo "<option value='NULL'>SELECT DESTINATION</option>";
					while($var=mysql_fetch_assoc($query_run))
						echo "<option value='".$var['name']."'>".$var['name']."</option>";
				echo "</select>";
			}else{
				$query='CREATE TABLE IF NOT EXISTS `resultsab`(`name` text(100), `tabname` text(200), `start` INTEGER(4), `interval` INTEGER(4), `a` FLOAT, `b` FLOAT, `id` INTEGER NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`))';
				$query_run=mysql_query($query);
				$query="SELECT DISTINCT `interval` from `resultsab` where `name`='$name'";
				$query_run=mysql_query($query);
				echo "<select name='interval' id='interval' class='btn-block form-group'>";
					echo "<option value='NULL'>SELECT interval</option>";
					while($var=mysql_fetch_assoc($query_run))
						echo "<option value='".$var['interval']."'>".$var['interval']."</option>";
				echo "</select>";
			}
		}
	}
	
?>