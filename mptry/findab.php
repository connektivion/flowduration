<?php
	require "connect_db.php";
	if(isset($_GET['source'])&&isset($_GET['type'])&&isset($_GET['interval'])){
		$type=$_GET['type'];
		$source=$_GET['source'];
		$interval=$_GET['interval'];
		if(!empty($source)&&!empty($type)&&!empty($interval)){
			if($type==1){
				if(isset($_GET['dest'])){		
					$dest=$_GET['dest'];				
					if(!empty($dest)){
						$query='CREATE TABLE IF NOT EXISTS `resultsab`(`name` text(100), `tabname` text(200), `start` INTEGER(4), `interval` INTEGER(4), `a` FLOAT, `b` FLOAT, `id` INTEGER NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`))';
						$query_run=mysql_query($query);
						$query="SELECT * from `resultsab` where `interval` = '$interval' and (`name`='$dest' or `name`='$source') order by `start` ";
						$query_run=mysql_query($query);
						$vara=array();
						$var=array();
						while($var=mysql_fetch_assoc($query_run)){
							$temp=$var;
							array_push($vara, $temp);
						}
						echo json_encode($vara);
						//echo "ok";
					}
				}
			}else{
				$query='CREATE TABLE IF NOT EXISTS `resultsab`(`name` text(100), `tabname` text(200), `start` INTEGER(4), `interval` INTEGER(4), `a` FLOAT, `b` FLOAT, `id` INTEGER NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`))';
				$query_run=mysql_query($query);
				$query="SELECT * from `resultsab` where `interval` = '$interval' and `name`='$source' order by `start` ";
				$query_run=mysql_query($query);
				$vara=array();
				$var=array();
				while($var=mysql_fetch_assoc($query_run)){
					$temp=$var;
					array_push($vara, $temp);
				}
				echo json_encode($vara);
			}
		}
	}	

?>