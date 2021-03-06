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
						<li><a href="#">Update Routes</a></li>
						<li><a href="drivers.php">Add/Remove Drivers</a></li>
						<!--<li><a href="#">Reviews <span class="badge">1,118</span></a></li>-->
					  </ul>
				  </div>
				</div>
			  </div>
			<div class="col-lg-9 col-sm-9">
				<div class="jumbotron" style="background-color:#558C89; margin:0">
					<div class="container">
						<?php
							if(isset($_POST['number']) and isset($_POST['name']) and isset($_POST['no_of_bus']) and isset($_POST['intervals']) and isset($_POST['starting_point']) and isset($_POST['stops'])){
								if($_POST['number']!=null and $_POST['name']!=null and $_POST['no_of_bus']!=null and $_POST['intervals']!=null and $_POST['starting_point']!=null and $_POST['stops']!=null) {
									$number = $_POST['number'];
									$name = $_POST['name'];
									$no_of_bus = $_POST['no_of_bus'];
									$intervals = $_POST['intervals'];
									$starting_point = $_POST['starting_point'];
									$myInputs = $_POST["stops"];
									$conct = mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_database)	 or die("Could not connect to database!");
									foreach ($myInputs as $eachInput) {
										$result1 = mysqli_query($conct,"SELECT stop_id FROM stops WHERE stop_name='$eachInput'");
										$stop = mysqli_fetch_assoc($result1);
										$stop_result = $stop["stop_id"];
										$query = "INSERT INTO route VALUES('$number','$name','$stop_result','$no_of_bus','$intervals','$starting_point')";
										$result2 = mysqli_query($conct, $query);
									}
									echo '
									<div class="alert alert-success">
										<strong>Success!</strong> New Route has been added successfully.
									</div>
									';
								}
							}
						?>
						<?php
							if(isset($_POST['del_route'])){
								if($_POST['del_route']!="Select Route") {
									$query = "DELETE FROM route WHERE number='".$_POST['del_route']."'";
									$conct = mysqli_connect("localhost","root","","aggie_spirit_new")	 or die("Could not connect to database!");
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
							<legend align="center"><b>ADD A ROUTE</b></legend>
							<br><br>
							<form action="#" method="post">
								<div class="row">
									<div class="col-lg-2 col-md-2" style="padding-right:5px">
										<input type="text" name="number" placeholder="Route Number">
									</div>
									<div class="col-lg-2 col-md-2"></div>
									<div class="col-lg-2 col-md-2">
										<input type="text" name="name" placeholder="Route Name">
									</div>
									<div class="col-lg-2 col-md-2"></div>
									<div class="col-lg-2 col-md-2">
										<input type="number" name="no_of_bus" placeholder="No. of buses">
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-2 col-md-2">
										<input type="number" name="intervals" placeholder="Bus Interval">
									</div>
									<div class="col-lg-2 col-md-2"></div>
									<div class="col-lg-2 col-md-2">
										<input type="text" name="starting_point" placeholder="Starting Point">
									</div>
								</div>
								<br><br>
								<div class="row">
									<div class="row">
										<div class="col-lg-5"></div>
										<button class="btn btn-success" id="add_stops" onclick="duplicate('add_list0');" type="button" class="btn btn-default">ADD STOPS</button>
									</div>
									<br><br>
									<div class="row" id="add_list0">
										<div class="col-lg-1"></div>
										<div class="col-lg-6">
											<select class="form-control" name="stops[]" style="width: 50%" >
												<option>Select Source</option>
													<?php
														$conct = mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_database)	 or die("Could not connect to database!");
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
										<button class="btn btn-warning" id="add_stops" onclick="remove(this);" type="button" class="btn btn-default">REMOVE STOPS</button>
										<br><br>
									</div>
										<script>
											var i=0;
											function duplicate(divName) {
												var original = document.getElementById(divName);
												var clone = original.cloneNode(true); // "deep" clone
												clone.id = "add_list" + ++i; // there can only be one element with an ID
												clone.onclick = duplicate; // event handlers are not cloned
												original.parentNode.appendChild(clone);
											}
											function remove(sender) {
												var parent = sender.parentNode;
												$(parent).remove();
											}
										</script>
								</div>
								<br><br>
								<div class="row" align="center">
									<button class="btn btn-danger" type="submit" class="btn btn-default">SUBMIT</button>
								</div>
							</form>
						</fieldset>
						<br><br><br>
						<fieldset>
								<legend align="center"><b>REMOVE A ROUTE</b></legend>
								<br><br>
								<form action="#" method="post">
									<div class="row">
										<div class="col-lg-2 col-md-2"></div>
										<div class="col-lg-6 col-md-6">
											<select class="form-control" name="del_route" style="width: 50%" >
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
											<button class="btn btn-danger" type="submit" class="btn btn-default">DELETE</button>
										</div>
										<div class="col-lg-2 col-md-2"></div>
									</div>
								</form>
							</fieldset>
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