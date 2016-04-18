<?php
	
?>
<html>
	<head>
		<title>New Project</title>
		<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css"/>
	</head>
	<body class='container'>
		<h2>choose base file*</h2>
		<br>
		<button class="check btn btn-primary">Check validity</button>
		<form action="poster.php" method="post" enctype="multipart/form-data">
			<h4>Enter Project name </h4>
			<input type="text" name="proname" id="proname"> 

			<h4>Choose sql to dump *size smaller than 64M</h4>
			<input type="file" name="fileToUpload1" id="fileToUpload1">

			<h4>Choose station names to dump *size smaller than 64M</h4>
			<input type="file" name="fileToUpload2" id="fileToUpload2" class="form-group">

			<input type="submit" name="submit" id="sub" value="finish" class='btn btn-success'>
		</form>
		<script type="text/javascript" src='./js/jquery.js'></script> 

		<script type="text/javascript">


			$(document).ready(function(){

				$('#sub').attr("disabled","disabled");

				$('.check').on('click',function(event){

					var data=$('#proname').val();
					$.ajax({
						url:'checkproject.php',
						data:'proname='+data,
						success:function(adata){
							if(adata==0){
								$('#sub').removeAttr('disabled');
							}else
								$('#sub').attr("disabled","disabled");		
						}
					});
				});
			});

		</script>
	</body>
</html>