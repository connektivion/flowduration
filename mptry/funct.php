<?php
	include( 'ExponentialRegression.php' ); 
	function validate(){
		if(isset($_POST['name'])){
			$name=$_POST['name'];
			if(!empty($name)){
				$query="SELECT `COL 1` from `table 2` WHERE `COL 1` = '$name'";
				if(mysql_num_rows(mysql_query($query))>=1){
					//echo "oK2";
					if(isset($_POST['year'])){
						$year=$_POST['year'];
							if(!empty($year)){
								$query1="SELECT `COL 1` from `table 2` WHERE `COL 1` = '$name' and `col 2`='$year'";
								if(mysql_num_rows(mysql_query($query1))>=1){
									if(isset($_POST['interval'])){
										$interval=$_POST['interval'];
										if(!empty($interval)){
											$test=$interval+$year-1;
											$query2="SELECT `COL 1` from `table 2` WHERE `COL 1` = '$name' and `col 2`>='$test'";
											if(mysql_num_rows(mysql_query($query2))>=1){
												return 1;
											}else{
												echo "enter valid interval";
												return 0;
											}
										}
									}
								}else echo "enter valid year";
							}

					}
				}
				else echo "enter valid station code/name";


			}
		}
	}

	function interme($tabname,$year,$interval,$last,$stringtable,$name){
		$MAX_ITERATIONS = 50;
		$irr=-1;
		$data = array ();
		$year2=$year+$interval;
		$query0="SELECT `COL 1` FROM `$stringtable` WHERE `COL 2`>='$year' AND `COL 2`<'$year2'";
		if($query_run0=mysql_query($query0)){
			$num4=mysql_num_rows($query_run0);
			//echo $num4."  iioioio<br>";
		}
		$query="SELECT * FROM `$tabname` WHERE 1";
		if($query_run=mysql_query($query)){
			$num_rows=mysql_num_rows($query_run);
			//echo  $num_rows." number of rows<br>";
		}
		for($curr_row=1;$curr_row<=$num_rows;$curr_row++){
			$lower_query="SELECT `lower` FROM `$tabname` where `id` = '$curr_row'";
			$var=mysql_fetch_assoc(mysql_query($lower_query));
			$lower=$var['lower'];
			$upper_query="SELECT `upper` FROM `$tabname` WHERE `id` = '$curr_row'";
			$var2=mysql_fetch_assoc(mysql_query($upper_query));
			$upper=$var2['upper'];
			if($curr_row==1)
				$upper=$upper+1;
			for($col=$year;$col<($year+$interval);$col++){
				if($col<=$last){
					$query1="SELECT `COL 5` FROM `$stringtable` WHERE `COL 5`>='$lower' AND `COL 5`<'$upper' AND `COL 2`='$col'";
					$query_run1=mysql_query($query1);
					$numb=mysql_num_rows($query_run1);
					$query_insert="UPDATE `$tabname` SET `$col` = '$numb' where `id`='$curr_row'";
					mysql_query($query_insert);
					//echo $col." ".$numb." ".$curr_row."<br>";
				}

			}
			$query2="SELECT `COL 5` FROM `$stringtable` WHERE `COL 5`>='$lower' AND `COL 5`<'$upper' AND `COL 2`>='$year' and `COL 2`<'$year2'";
			$num2=mysql_num_rows(mysql_query($query2));
			$query_insert2="UPDATE `$tabname` SET `total`='$num2' where `id`='$curr_row'";
			mysql_query($query_insert2);
			$query3="SELECT `COL 5` FROM `$stringtable` WHERE `COL 5`>='$lower' AND `COL 2`>='$year' and `COL 2`<'$year2'";
			$num3=mysql_num_rows(mysql_query($query3));
			$query_insert3="UPDATE `$tabname` SET `cum` = '$num3' where `id`='$curr_row'";
			mysql_query($query_insert3);
			$percen=(($num3/($num4+1))*100);
			$query_insert4="UPDATE `$tabname` SET `perc`= '$percen' where `id`='$curr_row'";
			mysql_query($query_insert4);
			$query5="SELECT `lower`,`perc` FROM `$tabname` WHERE `id`='$curr_row'";
			$reg=mysql_fetch_assoc(mysql_query($query5));
			$data[++$irr]=array($reg['lower'],$reg['perc']);
		}

		$coefficients = array( 100,  0); 
		$lastCoefficients = array( 0, 100 ); 

		// Create an instance of the regression to use. 
		$regression = new ExponentialRegression(); 

		// Counter for the number of iterations. 
		$iteration = 0; 

		// Refine coefficients. 
		while ( ( $coefficients != $lastCoefficients )&& ( $iteration < $MAX_ITERATIONS ) ){ 
			$lastCoefficients = $coefficients; 

			// Print the results. 
			// echo "Iteration $iteration: f( x ) = $coefficients[0] * exp( $coefficients[1] * x )<br />"; 

			// Run Gauss-Newton method with current coefficients. 
			$coefficients = $regression->refineCoefficients( array_column( $data, 0 ), array_column( $data, 1 ), $coefficients ); 

			++$iteration; 
		}
			$A=$coefficients[0];
			$B=-1*$coefficients[1];
			$query='CREATE TABLE IF NOT EXISTS `resultsab`(`name` text(100), `tabname` text(200), `start` INTEGER(4), `interval` INTEGER(4), `a` FLOAT, `b` FLOAT, `id` INTEGER NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`))';
			$query_run=mysql_query($query);
			$query="INSERT INTO `resultsab`(`name`, `tabname`, `start`, `interval`, `a`, `b`) VALUES ('$name','$tabname','$year','$interval','$A','$B')";
			mysql_query($query);
			echo "FOR THE YEAR RANGE ,".$year.", A = ".$A." , B = ".$B."<br>0".$name;

	}
?>