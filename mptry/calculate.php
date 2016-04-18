<?php
	$db=$_GET['db'];
	require "connect_db.php";
	include "funct.php";

	include "upper.php";
	$check=validate();
	$count=0;
	$pre2=-1;
	$rep_count=0;
	$insert_arr=array();
	$k=0;
	$dummy=0;
	$table_exists=0;
	if(isset($_POST['year'])&&isset($_POST['interval'])&&isset($_POST['name'])){
		$texta='';$year=$_POST['year'];
		$interval=$_POST['interval'];
		$name=strtolower($_POST['name']);
		$stringtable=$name.$year.$interval;
		$stringtableTemp=$stringtable."%";
		$query='CREATE TABLE IF NOT EXISTS `resultsab`(`name` text(100), `tabname` text(200), `start` INTEGER(4), `interval` INTEGER(4), `a` FLOAT, `b` FLOAT, `id` INTEGER NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`))';
		$query_run=mysql_query($query);
		$checktable = mysql_query("SELECT `id` FROM `resultsab` WHERE `tabname` LIKE '$stringtableTemp'");
		$table_exists = (mysql_num_rows($checktable) > 0)?1:0;
	}
	$urls=array();
	if($check==1&&!$table_exists){		

		$looper=$year;
		$query_last_year="SELECT `COL 2` FROM `table 2` WHERE 1 ORDER BY `table 2`.`COL 2` DESC";
		if($var=mysql_fetch_assoc(mysql_query($query_last_year)))
			$last=$var['COL 2'];
		$number=(($last-$year)/$interval);
		$repeat=(is_int($number)?$number:(int)$number+1);
		$query2="CREATE TABLE IF NOT EXISTS `$stringtable`(`COL 1` varchar(12), `COL 2` INTEGER, `COL 3` INTEGER, `COL 4` INTEGER, `COL 5` FLOAT , `COL 6` text(1) )";
		if ($query_run2=mysql_query($query2)){

		 	$query3="INSERT INTO `$stringtable`( `COL 1`, `COL 2`, `COL 3`, `COL 4`, `COL 5`, `COL 6`) SELECT `COL 1`, `COL 2`, `COL 3`, `COL 4`, `COL 5`, `COL 6` FROM `table 2` WHERE `COL 1` = '$name' and `COL 2` >= '$year'";
		 	if($query_run3=mysql_query($query3)){
				for($i=0;$i<$repeat;$i++){	
					 $urls[$i]='http://localhost/mptry/temp.php?db='.$db.'&tabname='.$stringtable.'&interval='.$interval.'&i='.$i.'&start='.($year+($interval*$i)).'&year='.$year.'&name='.$name.'&last='.$last.'';
					//$texta=$texta.'"temp.php?db='.$db.'&tabname='.$stringtable.'&interval='.$interval.'&i='.$i.'&start='.($year+($interval*$i)).'&year='.$year.'&last='.$last.'",';						
				}

				?>
				<?php
					include 'RollingCurl.php';
					include 'RollingCurlGroup.php';
					

					// a function that will process the returned responses 
					function request_callback($response, $info) {	
					    echo $response;
					}


					// create a new RollingCurl object and pass it the name of your custom callback function
					$rc = new RollingCurl("request_callback");

					// the window size determines how many simultaneous requests to allow.  
					$rc->window_size = 70;

					for($i=0;$i<$repeat;$i++) {
						// add each request to the RollingCurl object
						$request = new RollingCurlRequest($urls[$i]);
						$rc->add($request);
					}
					//echo ":22";
					$rc->execute();
				?>

				<?php
			}
		}
		
	}
	if($table_exists)
		echo "Its Already Calculted!<br>Check <a href='results1.php?db=".$db."'>Results</a>";
?>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
	<h2> calculate New Value </h2>
	<form method="POST" action="calculate.php?db=<?php echo $db;?>" id="calculate"/>
		<h5>Enter station code or the station name:</h5>
		<input type="text" name="name"  placeholder="Name" id="name" class="from-group btn-block"/>
		<h5>Enter start year:</h5>
		<input type="text" name="year" placeholder="Year Start" class="from-group btn-block"/>
		<h5>Enter the intervals:</h5>
		<input type="text" name="interval" placeholder="Interval" class="from-group btn-block"/>

		<input type="submit" name="submit" value="submit" id="submit" class="btn btn-primary btn-block form-group"><br>
	</form>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.autocomplete.js"></script>

<script>
	$(document).ready(function(){
		var db=<?php echo "'".$db."'"; ?>;
		$("#name").autocomplete("autocomplete.php?db="+db ,{
			selectFirst: true
		});
	});
	$('#calculate').submit(function(){
		$('#submit').attr("disabled","disabled").attr("value","submitted!");
	});
</script>
<?php
	echo "<h6>Please wait for 5 minutes for computing. Do not click submit again. Refresh <a href='http://localhost/mptry/tableop.php?db=".$db."'> this page </a> to check when its done</h6>";
	echo "<h5><a href='./project.php?db=".$db."'>go back</a> </h5>";
	include "niche.php";
?>

