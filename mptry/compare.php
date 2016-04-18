<?php
	require "connect_db.php";
	include "upper.php";
	echo "<h4>COMPARE BETWEEN INTERVALS OF SAME STATION</h4>";
	$db=$_GET['db'];
	$query='CREATE TABLE IF NOT EXISTS `resultsab`(`name` text(100), `tabname` text(200), `start` INTEGER(4), `interval` INTEGER(4), `a` FLOAT, `b` FLOAT, `id` INTEGER NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`))';
	$query_run=mysql_query($query);
	$query="SELECT DISTINCT `name` from `resultsab` where 1";
	$query_run=mysql_query($query);
	echo "<select name='stn' id='stn' class='btn-block form-group'>";
	echo "<option value='NULL'>SELECT STATION</option>";
	while($var=mysql_fetch_assoc($query_run))
		echo "<option value='".$var['name']."'>".$var['name']."</option>";
	echo "</select>";
?>
	<div class="interval"></div>
	</div>
	<div class="col-md-6">
		<h5>A</h5>
		<canvas id="myChart" width="400" height="400"></canvas>
	</div>
	<div class="col-md-6">
		<h5>B</h5>
		<canvas id="myChart2" width="400" height="400"></canvas>
	</div>
	<div class="clearfix"></div>
	<div class="col-md-8 col-md-offset-2">
	<div class="clearb"></div>
	<script src="js/jquery.js"></script>
	<script type="text/javascript" src="js/chart.min.js"></script>
	<script type="text/javascript">
		var myBarChart,myBarChart2;
		var db=<?php echo "'".$db."'"; ?>;
		$(document).ready(function(){

			$('#stn').on('change',function(){
				var stn=$(this).val();
				$('.interval').html("");
				if(stn!="NULL"){
					$.ajax({
						url:'alln.php',
						data:'db='+db+'&type=2&name='+stn,
						success:function(data){
							$('.interval').append(data);
						}
					});
				}
			});

			$('.interval').on('change','select',function(){
				var interval=$(this).val();
				var stn=$('#stn').val();
				if(stn!="NULL"&&interval!="NULL"){
					$.ajax({
						url:'findab.php',
						data:'db='+db+'&type=2&source='+stn+'&interval='+interval,
						success:function(data){
							data=$.parseJSON(data);
							console.log(data)
							//alert("please hit clear button before changing any select feilds")
							makechart(data,stn);
						}
					});
				}
			});

			$('.clearb').on('click','button',function(){
				myBarChart.destroy();
				myBarChart2.destroy();
			})

		});

		var makechart=function(jdata,source){
			var years=[];
			var st1=[];
			var st1b=[];
			for(var i=0;i<jdata.length;i++){
				var year=jdata[i].start;
				years.push(year);
				var b=jdata[i].b;
				var a=jdata[i].a;
				st1.push(a);
				st1b.push(b);			
			}
			// Get context with jQuery - using jQuery's .get() method.
			var ctx = $("#myChart").get(0).getContext("2d");
			var ctx2 = $("#myChart2").get(0).getContext("2d");
			// This will get the first returned node in the jQuery collection.
			var adata = {
				labels: years,
				datasets: [
					{
						label: source,
						fillColor: "rgba(220,220,220,0.5)",
						strokeColor: "rgba(220,220,220,0.8)",
						highlightFill: "rgba(220,220,220,0.75)",
						highlightStroke: "rgba(220,220,220,1)",
						data: st1
					}
				]
			};
			var options={
				//Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
				scaleBeginAtZero : true,

				//Boolean - Whether grid lines are shown across the chart
				scaleShowGridLines : true,

				//String - Colour of the grid lines
				scaleGridLineColor : "rgba(0,0,0,.05)",

				//Number - Width of the grid lines
				scaleGridLineWidth : 1,

				//Boolean - Whether to show horizontal lines (except X axis)
				scaleShowHorizontalLines: true,

				//Boolean - Whether to show vertical lines (except Y axis)
				scaleShowVerticalLines: true,

				//Boolean - If there is a stroke on each bar
				barShowStroke : true,

				//Number - Pixel width of the bar stroke
				barStrokeWidth : 2,

				//Number - Spacing between each of the X value sets
				barValueSpacing : 5,

				//Number - Spacing between data sets within X values
				barDatasetSpacing : 1,

				//String - A legend template
				legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

			}
			var adata2 = jQuery.extend(true,{}, adata);
			adata2.datasets[0].data=st1b;
			myBarChart = new Chart(ctx).Bar(adata, options);
			myBarChart2 = new Chart(ctx2).Bar(adata2, options);
			$('.clearb').html('<small>Please hit clear button before changing any input feilds</small>');
			$('.clearb').append("<button id='clearChart'>Clear</button>")
		}
	</script>
	<?php
		echo "<h5><a href='./project.php?db=".$db."'>go back</a> </h5>";
		include 'niche.php';
	?>