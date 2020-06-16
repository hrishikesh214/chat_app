<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<div class="container border py-5">
		<div class="card">
			<div class="card-header h1">
				404 Not Found
			</div>
			<div class="card-body">
				Error:- No file with name 
				<span class="text-danger">
					<?=isset($_SESSION['SEFN'])?$_SESSION['SEFN']:'REQUESTED'?>
				</span> 
				in path :- 
				<span class="text-danger">
					<?=isset($_SESSION['SEPN'])?$_SESSION['SEPN']:BASE_PATH?>
				</span>	
			</div>
		</div>
	</div>
</body>
</html>
<?php 

unset($_SESSION['SEFN']);
unset($_SESSION['SEPN']);

 ?>