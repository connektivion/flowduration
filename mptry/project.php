
				<?php
					include 'upper.php';
					echo "<h4>choose an operation </h4>";
						if(isset($_GET['db'])){
							$project=$_GET['db'];
							if(!empty($project)){
								echo "<a href='./calculate.php?db=".$project."'><button class='btn btn-primary btn-block'>calculate</button></a><br>";
								echo "<a href='./results.php?db=".$project."'><button class='btn btn-success btn-block'>results(compare stations)</button></a><br>";
								echo "<a href='./compare.php?db=".$project."'><button class='btn btn-success btn-block'>results(compare within station)</button></a><br>";
								echo "<a href='./tableop.php?db=".$project."'><button class='btn btn-warning btn-block'>delete intermediate calculations or save as csv</button></a><br>";
								echo "<a href='./deleteproject.php?db=".$project."'><button class='btn btn-danger btn-block'>delete project</button></a><br>";
							}
						}
					include 'goback.php';
					include 'niche.php';
					
				?>