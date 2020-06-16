<?php include getFullPath('cl'); if( checkLogin() ){redirect(base_url('Feed'));} ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.2/cjs/popper-base.min.js" integrity="sha256-uBVjTdPW5LRvxNOCOuD2fXiedyqgFwyIzar/z3Zoh+Q=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>
<body class="py-5 px-4">
	<?php require_once getFullPath('Modules/navbar'); ?>

	<div class="row pt-5">
		<?php show_msg(); ?>
		<div class="col-lg-6 offset-lg-3 border border-dark">
			
			<form method="post" action="<?=base_url('login_handle')?>" class="form">
				<span class="display-4 m-4 pb-4">Login</span>
				<div class="form-group mt-4">
					<legend>Username</legend>
					<input type="text" name="username" class="form-control">
				</div>
				<div class="form-group">
					<legend>Password</legend>
					<input type="password" name="password" class="form-control">
				</div>
				<a class="link" href="<?=base_url('Signin')?>"><span style="cursor: pointer;" class="p-2 link text-info">Don't Have Account?</span></a>
				<div class="form-group mt-3">
					<input type="submit" name="submit" value="Login" class="btn btn-outline-success">
				</div>
			</form>
		</div>
	</div>
</body>
</html>