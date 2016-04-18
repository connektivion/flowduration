<?php
	if(isset($_POST["submit"])){
		$fol=$_POST['proname'];
		$target_dir = "basefiles/";
		$target_dir=$target_dir.$fol.'/';
		mkdir($target_dir);
		echo $target_dir."<br>";
		$target_file1 = $target_dir . basename($_FILES["fileToUpload1"]["name"]);
		$target_file2 = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file1,PATHINFO_EXTENSION);

		// Check file size
		if ($_FILES["fileToUpload1"]["size"] > 6400000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "sql"){
			echo "Sorry, only SQL files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file1)&&move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file2)) {
				echo "The file(s) has been uploaded.";
				require 'sqlcon.php';
				mysql_select_db('projects');
				$query='CREATE TABLE IF NOT EXISTS `projects`(`name` text(100), `id` INTEGER NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`))';
				$query_run=mysql_query($query);
				$query="INSERT INTO `projects`(`name`) VALUES ('$fol')";
				$query_run=mysql_query($query);
				$query="CREATE DATABASE ".$fol."";
				$query_run=mysql_query($query);
				if($query_run){
					include 'import.php';
					if(importsql($target_file1,$fol)&&importsql($target_file2,$fol));
						echo "<br>Successfully imported to mysql database";
				}
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}
	}
?>