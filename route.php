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
						<li><a href="#">Route Info</a></li>
						<?php if($_SESSION['enter']=="true"){echo '<li><a href="update_route.php">Update Routes</a></li>
						<li><a href="drivers.php">Add/Remove Drivers</a></li>';}?>
						<!--<li><a href="#">Reviews <span class="badge">1,118</span></a></li>-->
					  </ul>
				  </div>
				</div>
			  </div>
			<div class="col-lg-9 col-sm-9">
				<div class="jumbotron" style="background-color:#558C89; margin:0">
					<div class="container">
						<div class="route1">
							<fieldset>
								<legend align="center"><b>SEE BUS ROUTE INFORMATION</b></legend>
								<br><br>
								<form action="#" method="post">
									<div class="row">
										<div class="col-lg-2 col-md-2"></div>
										<div class="col-lg-6 col-md-6">
											<select class="form-control" id="route" name="route" required style="width: 50%" >
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
							<?php if(isset($_POST['route'])){ ?><div class="route1_show jumbotron container">
								<?php
									if(isset($_POST['route'])) {
										$result1 = mysqli_query($conct,"SELECT * FROM route JOIN stops ON route.stop_id=stops.stop_id WHERE number = '".$_POST['route']."'");
										$row1 = mysqli_fetch_assoc($result1);
										echo '
											<div class="row">
												<div class="col-lg-2"><p>Number: '.$row1['number'].'</p></div>
												<div class="col-lg-3"><p>Name: '.$row1['name'].'</p></div>
												<div class="col-lg-2"><p>No. of buses: '.$row1['no_of_buses'].'</p></div>
												<div class="col-lg-2"><p>Interval: '.$row1['intervals'].'mins</p></div>
												<div class="col-lg-3"><p>Starting Point: '.$row1['starting_point'].'</p></div>
											</div>
										';
										echo '
											<table class="table">
												<tr>
													<th>Stops
												</tr>
												'; $alternate=true; 
												while($row1) {
													if($alternate==true) {
														echo '
														<tr class="success">
															<td>'.$row1['stop_name'].'
														</tr>
													';
													$alternate=false;
													}
													else {
														echo '
														<tr>
															<td>'.$row1['stop_name'].'
														</tr>
													';
													$alternate=true;
													}
													$row1 = mysqli_fetch_assoc($result1);
												}
										echo '
											</table>
										';
									}
								?>
							</div> <?php } ?>
						</div>
						<br><br><br><br>
						<div class="route2">
							<fieldset>
								<legend align="center"><b>FIND BUSES BETWEEN TWO STOPS</b></legend>
								<br><br>
								<form action="#" method="post">
									<div class="row">
										<div class="col-lg-5 col-md-5">
											<select class="form-control" name="route2_source" required style="width: 50%" >
												<option>Select Source</option>
													<?php
														$result = mysqli_query($conct,"SELECT stop_name FROM stops WHERE stop_name<>'MSC_Trigon'");
														$row = mysqli_fetch_assoc($result);
														while($row)
														{
															echo '<option>'.$row['stop_name'].'</option>';
															$row = mysqli_fetch_assoc($result);
														}
													?>
											</select>
										</div>
										<div class="col-lg-5 col-md-5">
											<select class="form-control" name="route2_dest" required style="width: 50%" >
												<option>Select Destination</option>
													<?php
														$result = mysqli_query($conct,"SELECT stop_name FROM stops WHERE stop_name<>'MSC_Trigon'");
														$row = mysqli_fetch_assoc($result);
														while($row)
														{
															echo '<option>'.$row['stop_name'].'</option>';
															$row = mysqli_fetch_assoc($result);
														}
													?>
											</select>
										</div>
										<div class="col-lg-2 col-md-2">
											<button class="btn btn-danger" type="submit" class="btn btn-default">SHOW</button>
										</div>
									</div>
								</form>
							</fieldset>
							<br><br>
							<?php if(isset($_POST['route2_source'])){ ?><div class="route2_show jumbotron container">
								<?php
									if(isset($_POST['route2_source'])) {
										if($_POST['route2_source']!="Select Source" and $_POST['route2_dest']!="Select Destination") {
											$query = "SELECT number, name, stop_name FROM route JOIN stops ON stops.stop_id=route.stop_id WHERE stop_name='".$_POST['route2_source']."' UNION SELECT number, name, stop_name FROM route JOIN stops ON stops.stop_id=route.stop_id WHERE stop_name='".$_POST['route2_dest']."'";
											$result1 = mysqli_query($conct,$query);
											$row1 = array();
											$row1 = mysqli_fetch_assoc($result1);
											echo '
											<table class="table">
												<tr>
													<th>Route Number
													<th>Route Name
													<th>Boarding/De-boarding Stop
													<th>Common Stop
												</tr>
												'; $alternate=true; 
												while($row1) {
													if($alternate==true) {
														echo '
														<tr class="success">
															<td>'.$row1['number'].'
															<td>'.$row1['name'].'
															<td>'.$row1['stop_name'].'
															<td>MSC_Trigon
														</tr>
													';
													$alternate=false;
													}
													else {
														echo '
														<tr>
															<td>'.$row1['number'].'
															<td>'.$row1['name'].'
															<td>'.$row1['stop_name'].'
															<td>MSC_Trigon
														</tr>
													';
													$alternate=true;
													}
													$row1 = mysqli_fetch_assoc($result1);
												}
											echo '
												</table>
											';
										}
									}
								?>
							</div> <?php } ?>
						</div>
						<br><br><br><br>
						<div class="route3">
							<fieldset>
								<legend align="center"><b>SEE WHICH BUS GOES THROUGH A PARTICULAR STOP</b></legend>
								<br><br>
								<form action="#" method="post">
									<div class="row">
										<div class="col-lg-2 col-md-2"></div>
										<div class="col-lg-6 col-md-6">
											<select class="form-control" name="route3_dest" style="width: 50%" >
												<option>Select Destination</option>
													<?php
														$result = mysqli_query($conct,"SELECT stop_name FROM stops");
														$row = mysqli_fetch_assoc($result);
														while($row)
														{
															echo '<option>'.$row['stop_name'].'</option>';
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
							<?php if(isset($_POST['route3_dest'])){ ?><div class="route3_show jumbotron container">
								<?php
									if(isset($_POST['route3_dest'])) {
										if($_POST['route3_dest']!="Select Destination") {
											$query = "SELECT number, name FROM route JOIN stops ON stops.stop_id=route.stop_id WHERE stop_name='".$_POST['route3_dest']."'";
											$result1 = mysqli_query($conct,$query);
											$row1 = array();
											$row1 = mysqli_fetch_array($result1);
											echo '
											<table class="table">
												<tr>
													<th>Route Number
													<th>Route Name
												</tr>
												'; $alternate=true; 
												while($row1) {
													if($alternate==true) {
														echo '
														<tr class="success">
															<td>'.$row1['number'].'
															<td>'.$row1['name'].'
														</tr>
													';
													$alternate=false;
													}
													else {
														echo '
														<tr>
															<td>'.$row1['number'].'
															<td>'.$row1['name'].'
														</tr>
													';
													$alternate=true;
													}
													$row1 = mysqli_fetch_assoc($result1);
												}
											echo '
												</table>
											';
										}
									}
								?>
							</div> <?php }?>
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