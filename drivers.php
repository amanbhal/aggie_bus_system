<?php
	session_start();
	$mysql_host = "mysql13.000webhost.com";
	$mysql_database = "a9876784_aggies";
	$mysql_user = "a9876784_aman";
	$mysql_password = "nationdie22";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="Amandeep Singh Bhal">

		<title>AGGIE BUS SYSTEM</title>
		
		<!-- Bootstrap Core CSS -->
		<!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<!--<link rel="stylesheet" href="css/agency.css">-->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		
		<!-- Custom Fonts -->
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
		<link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
		<style>
			@media (min-width: 768px) {
				.sidebar-nav .navbar {
				padding: 0;
				max-height: none;
				background-color: #000
				}
				.sidebar-nav .navbar ul {
				float: none;
				display: block;
				}
				.sidebar-nav .navbar li {
				float: none;
				display: block;
				}
				.sidebar-nav .navbar li a {
				padding-top: 12px;
				padding-bottom: 12px;
				color: white
				}
				.sidebar-nav .navbar li a:hover {
					background-color: #CBE32D;
					color:black;
				}
				.sidebar-nav .navbar li a:focus{
					background-color: #CBE32D;
					color:black;
				}
				.sidebar-nav .navbar li.active a:hover {
					background-color: #CBE32D;
					color:black;
					font-color: #000;
				}
			}
		</style>
	</head>
	
	<body id="page">
	
	<div style="background-color:#500000 !important; margin:0" class="jumbotron" align="center">
		<span class="fa-stack fa-3x">
			<i class="fa fa-circle fa-stack-2x fa-inverse"></i>
			<i class="fa fa-bus fa-stack-1x"></i>
		</span>
		<h2 style="color:white"><b>AGGIE SPIRIT</b></h2>
	</div>
	
	<div class="jumbotron" style="margin:0">
		<div class="row">
			  <div class="col-lg-3 col-sm-3">
				<div class="sidebar-nav">
				  <div class="navbar navbar-default" role="navigation">
					  <ul class="nav navbar-nav">
						<li><a href="index.php">Home</a></li>
						<li><a href="route.php">Route Info</a></li>
						<li><a href="update_route.php">Update Routes</a></li>
						<li><a href="#">Add/Remove Drivers</a></li>
						<!--<li><a href="#">Reviews <span class="badge">1,118</span></a></li>-->
					  </ul>
				  </div>
				</div>
			  </div>
			<div class="col-lg-9 col-sm-9">
				<div class="jumbotron" style="background-color:#558C89; margin:0">
					<div class="container">
						<?php
							if(isset($_POST['number'])){
								if($_POST['number']!="Select Route" and $_POST['firstname']!=null and $_POST['lastname']!=null) {
									$number = $_POST['number'];
									$firstname = $_POST['firstname'];
									$lastname = $_POST['lastname'];
									$conct = mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_database)	 or die("Could not connect to database!");
									$result1 = mysqli_query($conct,"INSERT INTO drivers VALUES(NULL,'$number','$firstname','$lastname')");
									echo '
									<div class="alert alert-success">
										<strong>Success!</strong> New Driver has been added successfully.
									</div>
									';
								}
							}
						?>
						<?php
							if(isset($_POST['del_route'])){
								if($_POST['del_route']!="Select Route") {
									$query = "DELETE FROM route WHERE number='".$_POST['del_route']."'";
									$conct = mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_database)	 or die("Could not connect to database!");
									$result2 = mysqli_query($conct, $query);
								}
								echo '
									<div class="alert alert-success">
										<strong>Success!</strong> Route has been deleted successfully.
									</div>
									';
							}
						?>
						<fieldset>
							<legend align="center"><b>ADD A DRIVER</b></legend>
							<br><br>
							<form action="#" method="post">
								<div class="row">
									<div class="col-lg-4 col-md-2" style="padding-right:5px">
										<select class="form-control" name="number" style="width: 50%" >
											<option>Select Route</option>
												<?php
													$conct = mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_database)	 or die("Could not connect to database!");
													$result = mysqli_query($conct,"SELECT DISTINCT(number), name FROM route");
													$row = mysqli_fetch_assoc($result);
													while($row)
													{
														echo '<option>'.$row['number'].'</option>';
														$row = mysqli_fetch_assoc($result);
													}
												?>
										</select>
									</div>
									
									<div class="col-lg-2 col-md-2">
										<input type="text" name="firstname" placeholder="First Name">
									</div>
									<div class="col-lg-2 col-md-2"></div>
									<div class="col-lg-2 col-md-2">
										<input type="text" name="lastname" placeholder="Last Name">
									</div>
								</div>
								<br><br>
								<div class="row" align="center">
									<button class="btn btn-danger" type="submit" class="btn btn-default">SUBMIT</button>
								</div>
							</form>
						</fieldset>
						<br><br><br>
						<div class="drivers_show">
							<fieldset>
								<legend align="center"><b>SEE DRIVERS ON A ROUTE</b></legend>
								<br><br>
								<form action="#" method="post">
									<div class="row">
										<div class="col-lg-2 col-md-2"></div>
										<div class="col-lg-6 col-md-6">
											<select class="form-control" name="driver_route" style="width: 50%" >
												<option>Select Route</option>
													<?php
														$conct = mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_database)	 or die("Could not connect to database!");
														$result = mysqli_query($conct,"SELECT DISTINCT(number), name FROM route");
														$row = mysqli_fetch_assoc($result);
														while($row)
														{
															echo '<option>'.$row['number'].'</option>';
															$row = mysqli_fetch_assoc($result);
														}
													?>
											</select>
										</div>
							
										<div class="col-lg-2 col-md-2">
											<button class="btn btn-danger" type="submit" class="btn btn-default">SHOW</button>
										</div>
										<div class="col-lg-2 col-md-2"></div>
									</div>
								</form>
							</fieldset>
							<br><br>
							<?php if(isset($_POST['driver_route'])){ ?><div class="drivers_show jumbotron container">
								<?php
									if(isset($_POST['driver_route'])){
										if($_POST['driver_route']!="Select Route") {
											$conct = mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_database)	 or die("Could not connect to database!");
											$result = mysqli_query($conct,"SELECT firstname, lastname FROM drivers WHERE route_number='".$_POST['driver_route']."'");
											$row = mysqli_fetch_assoc($result);
											echo '
												<table class="table">
													<tr>
														<th>First Name
														<th>Last Name
													</tr>
													'; $alternate=true; 
													while($row) {
														if($alternate==true) {
															echo '
															<tr class="success">
																<td>'.$row['firstname'].'
																<td>'.$row['lastname'].'
															</tr>
														';
														$alternate=false;
														}
														else {
															echo '
															<tr>
																<td>'.$row['firstname'].'
																<td>'.$row['lastname'].'
															</tr>
														';
														$alternate=true;
														}
														$row = mysqli_fetch_assoc($result);
													}
												echo '
													</table>
												';
										}
									}
								?>
							</div> <?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<footer style="margin:0; padding:0">
        <div style="background-color:#500000 !important; margin:0" class="jumbotron" align="center">
            <div class="row">
                <div class="col-md-3">
                    <span class="copyright" style="color:white"><b>Copyright &copy; AGGIE SPIRIT</b></span>
                </div>
                <div class="col-md-6">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter fa-2x fa-inverse"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook fa-2x fa-inverse"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin fa-2x fa-inverse"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="list-inline quicklinks">
                        <li><a href="#" style="color:white !important"><b>Privacy Policy</b></a>
                        </li>
                        <li><a href="#" style="color:white !important"><b>Terms of Use</b></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
	</div>
		
	</body>
<html>