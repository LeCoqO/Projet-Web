<?php
require "config/constants.php";
session_start();
if(isset($_SESSION["uid"])){
	header("location:profile.php");
}
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
		<style></style>
	</head>
<body>
<div class="wait overlay">
	<div class="loader"></div>
</div>
	<div class="navbar navbar-inverse navbar-fixed-top"style="background-color:#19181f; border-color:#19181f ;height: 60px;" >
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
			
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown" style='font-size:20px'><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="badge" >0</span></a>
					<div class="dropdown-menu" style="width:400px;">
						<div class="panel panel-success">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-3">Sl.No</div>
									<div class="col-md-3">Product Image</div>
									<div class="col-md-3">Product Name</div>
									<div class="col-md-3">Price in <?php echo CURRENCY; ?></div>
								</div>
							</div>
							<div class="panel-body">
								<div id="cart_product">
								
								</div>
							</div>
							<div class="panel-footer"></div>
						</div>
					</div>
				</li>
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown" style='font-size:20px'><span class="glyphicon glyphicon-user"></span> Login/Register</a>
					<ul class="dropdown-menu">
						<div style="width:300px;">
							<div class="panel panel-primary" style="border-color:#6d031c; background-color:#6d031c;">
								<div class="panel-heading" style="border-color:#6d031c; background-color:#6d031c; font-size:20px">Login</div>
								<div class="panel-heading" style="background-color:#6d031c; border-color:#6d031c">
									<form onsubmit="return false" style="border-color:#6d031c; background-color:#6d031c;" id="login">
										<label for="email">Email</label>
										<input type="email" class="form-control" name="email" id="email" required/>
										<label for="email">Password</label>
										<input type="password" class="form-control" name="password" id="password" required/>
										<p><br/></p>
										<input type="submit" class="btn btn-warning" value="Login" style="background-color:#d2d2c9; border-color:#6d031c">
										<a href="customer_registration.php?register=1" style="color:white; text-decoration:none;">Create Account Now</a>
									</form>
								</div>
								<div class="panel-footer" id="e_msg"></div>
							</div>
						</div>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>	
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row" >	
			<div class="col-md-3 col-xs-12"  style='margin-left:none'>
				<div id="get_category"  style='margin-left:none'>
				</div>			
			</div>
			<div class="col-md-9 col-xs-12">
				<div class="row">
				<span  style="float:rigth; margin-left:350px"><img src="image/store.jpg"></span>
					<div class="col-md-12 col-xs-12" id="product_msg">
					</div>
				</div>
				<div class="panel panel-info"   style="border-color:#ffff">
					<div class="panel-heading" style="background-color:#ffff; border-color:#d2d2c9"><b style="color: #19181f; font-size:30px">  List of Products</b></div>
					<div class="panel-body">
						<div id="get_product">
							<!--Here we get product jquery Ajax Request-->
						</div>
					
					</div>
					
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</body>
</html>
















































