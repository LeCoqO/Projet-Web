<?php
if (isset($_GET["register"])) {
	
	?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Ecommerce</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
<body>
<div class="wait overlay">
	<div class="loader"></div>
</div>
<div class="navbar navbar-inverse navbar-fixed-top" style="background-color:#19181f; border-color:#19181f ;height: 60px;">
		<div class="container-fluid">	
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
					<span class="sr-only">navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="index.php" class="navbar-brand"  style='font-size:25px'><span class="glyphicon glyphicon-heart-empty"></span>KhadijaStore<span class="glyphicon glyphicon-heart-empty"></span></a>
			</div>
		<div class="collapse navbar-collapse" id="collapse">
			<ul class="nav navbar-nav" style='font-size:20px'>
				<li><a href="index.php"> Home</a></li>
				<li><a href="index.php"> Products</a></li>
				<li><a href="index.php"> Help</a></li>
			</ul>
		</div>
	</div>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="signup_msg">
				<!--Alert from signup form-->
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-primary" style="border-color:#6d031c">
					<div class="panel-heading text-center" style="background-color:#6d031c; border-color:#6d031c"><b style="font-size:30px">Inscription</div>
					<div class="panel-body">
					<span  style="margin-left:200px"><img src="image/registre.png"></span>
					<form style="font-size:18px" id="signup_form" onsubmit="return false" >
						<div class="row">
							<div class="col-md-6">
								<label for="f_name">Prenom</label>
								<input type="text" id="f_name" name="f_name" class="form-control" required>
							</div>
							<div class="col-md-6">
								<label for="f_name">Nom</label>
								<input type="text" id="l_name" name="l_name"class="form-control" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="email">Email</label>
								<input type="text" id="email" name="email"class="form-control" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="password">Password</label>
								<input type="password" id="password" name="password"class="form-control" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="repassword">Confirm Password</label>
								<input type="password" id="repassword" name="repassword"class="form-control" required>
							</div>
						</div>
						<p><br/></p>
						<div class="row">
							<div class="col-md-12">
								<input value="Sign Up" type="submit" name="signup_button"class="btn btn-success btn-lg" style="float:right; background-color:#6d031c; width: 300px; border-color:#6d031c; font-size:20px">
							</div>
						</div>
						
					</div>
					</form>
					<div class="panel-footer"></div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</body>
</html>
	<?php
}



?>






















