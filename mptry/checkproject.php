<?php
	if(isset($_GET['proname'])){
		$name=$_GET['proname'];
		if(!empty($name)){
			$path="./basefiles/".$name;
			$var = file_exists($path);

			echo $var;
		}
	}
?>