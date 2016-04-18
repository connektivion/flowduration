<?php
	$db=$_GET['db'];
	require "connect_db.php";
	include "funct.php";
	$count=0;
	$pre2=-1;
	$rep_count=0;
	$temp_count=0;
	$insert_arr=array();
	$k=0;
	$dummy=0;
	$stringtable=$_GET['tabname'];
	$looper=$_GET['start'];
	$interval=$_GET['interval'];
	$i=$_GET['i'];
	$year=$_GET['year'];
	$last=$_GET['last'];
	$name=$_GET['name'];

	$tab_name=$stringtable."interval".$i;//interval wise
	//echo $tab_name;
	$text="`id` INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id),`lower` FLOAT, `upper` FLOAT, "."`".$looper."` integer, `";
	$clooper=$looper;
	$looper++;
	for($j=1;$j<$interval-1;$j++){
			$text=$text.$looper."` integer, `";
			$looper++;
	}
	$text=$text.$looper."` integer, `total` integer, `cum` integer, `perc` FLOAT";
	$elooper=$looper;
	$looper++;
	$query2="CREATE TABLE IF NOT EXISTS `$tab_name`($text)";
	if($query_run2=mysql_query($query2)){		//works---ranger below-----
		$query_count_1="SELECT `COL 5` FROM `$stringtable` WHERE `COL 2`>='$clooper' and `COL 2`<='$elooper' ORDER BY `$stringtable`.`COL 5` DESC";
		if($query_run_count_1=mysql_query($query_count_1)){//start range
			$prev=mysql_fetch_assoc($query_run_count_1);
			$pre=$prev['COL 5'];
			//$query_insert_upper="INSERT INTO `$tab_name`(`upper`) VALUES ('$pre')";
			//if($queryinsert=mysql_query($query_insert_upper))
			$insert_arr[$k]=$pre;
			$k++;
			while($vara=mysql_fetch_assoc($query_run_count_1)){
				$curr=$vara['COL 5'];
				$count++;
				if($curr==$pre){
					
					$pre=$vara['COL 5'];
/*flag implies repeat*/$flag=1;
					$rep_count++;
				}else{
					$flag=0;
					$temp_count=$rep_count;
					$rep_count=0;
				}
				if($temp_count<=10&&$count>80&&$flag==0){
/*case where all diff and count>80*/
								
								//echo $curr." 1<br>";
					$insert_arr[$k]=$curr;
					$k++;
					$count=0;
					$pre2=-1;
					$temp_count=0;

				}
/*case lots of same and count>80*/  			
				if($temp_count>=80&&$flag==0){
					//echo $pre." 2<br>";
					$insert_arr[$k]=$pre;
					$k++;
					$temp_count=0;
					$count=0;
					$pre2=-1;
					//echo $curr."2 <br>";
					$insert_arr[$k]=$curr;
					$k++;
				}
/*case few are same and count>80*/ 				
				if($count>=80&&$temp_count>10&&$temp_count<80&&$flag==0){
					//echo $curr." 3<br>";
					$insert_arr[$k]=$curr;
					$k++;
					$temp_count=0;
					$count=0;
					$pre2=-1;
				}
/*case few are same and count>80 last ele*/		
				if($flag==0)
					$pre2=$pre;
				$pre=$curr;


			}
			if ($flag==1&&$pre2>0){

			//echo $pre2." pre<br>";
				$insert_arr[$k]=$pre2;
				$k++;
			}
						 	//echo $curr." last<br>";
			$insert_arr[$k]=$curr;
			$k++;
			$insert_count=$k;
			//echo "******<br>";
			$strat=1;
			for($k=$dummy;$k<$insert_count-1;$k++){	
				$s=$k+1;
				$v1=$insert_arr[$s];
				$v2=$insert_arr[$k];
				if($insert_arr[$k]!=''){
				
					$query_lowerk="INSERT INTO `$tab_name`(`lower`,`upper`) VALUES ('$v1','$v2')";
					mysql_query($query_lowerk);										
									
										//echo "ok<br>";
				}
								
				//echo $insert_arr[$k]."<br>";
				$strat++;
			}
			interme($tab_name,($year+$i*$interval),$interval,$last,$stringtable,$name);					
		}
	}	
?>