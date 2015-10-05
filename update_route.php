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
						<li><a href="#">Add/Remove Drivers</a></li>
						<!--<li><a href="#">Reviews <span class="badge">1,118</span></a></li>-->
					  </ul>
				  </div>
				</div>
			  </div>
			<div class="col-lg-9 col-sm-9">
				<div class="jumbotron" style="background-color:#558C89; margin:0">
					<div class="container">
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
										<input type="number" name="interval" placeholder="Bus Interval">
									</div>
									<div class="col-lg-2 col-md-2"></div>
									<div class="col-lg-2 col-md-2">
										<input type="text" name="starting_point" placeholder="Starting Point">
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-8"></div>
									<button class="btn btn-success" id="add_stops" onclick=duplicate() type="button" class="btn btn-default">ADD STOPS</button>
									<button class="btn btn-warning" id="add_stops" onclick=remove() type="button" class="btn btn-default">REMOVE STOPS</button>
								</div>
								<br>
								<div class="row">
									<ul id="add_list" style="list-style:none">
										<li id="duplicater0">
											<select class="form-control" id="update_route0" name="stop0" required style="width: 50%" >
												<option>Select Source</option>
													<?php
														$conn = mysqli_connect("localhost","root","","aggie_spirit")	 or die("Could not connect to database!");
														$result = mysqli_query($conn,"SELECT stop_name FROM stops");
														$row = mysqli_fetch_assoc($result);
														while($row)
														{
															echo '<option>'.$row['stop_name'].'</option>';
															$row = mysqli_fetch_assoc($result);
														}
													?>
											</select>
											<br>
										</li>
									</ul>
										<script>
											var i=0;
											function duplicate() {
												var original = document.getElementById('duplicater' + i);
												var clone = original.cloneNode(true); // "deep" clone
												clone.id = "duplicater" + ++i; // there can only be one element with an ID
												//clone.onclick = duplicate; // event handlers are not cloned
												original.parentNode.appendChild(clone);
												var new_elem_id = '#duplicater' + i;
												$(new_elem_id.)
											}
										</script>
								</div>
								<div class="row" align="center">
									<button class="btn btn-danger" type="submit" class="btn btn-default">SUBMIT</button>
								</div>
							</form>
						</fieldset>
						<br><br><br><br>
						<fieldset>
							<legend align="center"><b>FIND BUSES BETWEEN TWO STOPS</b></legend>
							<br><br>
							<form action="#" method="post">
								<div class="row">
									<div class="col-lg-5 col-md-5">
										<select class="form-control" id="route" name="route" required style="width: 50%" >
											<option>Select Source</option>
												<?php
													$result = mysqli_query($conn,"SELECT stop_name FROM stops");
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
										<select class="form-control" id="route" name="route" required style="width: 50%" >
											<option>Select Destination</option>
												<?php
													$result = mysqli_query($conn,"SELECT stop_name FROM stops");
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
						<br><br><br><br>
						<fieldset>
							<legend align="center"><b>SEE WHICH BUS GOES THROUGH A PARTICULAR STOP</b></legend>
							<br><br>
							<form action="#" method="post">
								<div class="row">
									<div class="col-lg-2 col-md-2"></div>
									<div class="col-lg-6 col-md-6">
										<select class="form-control" id="route" name="route" required style="width: 50%" >
											<option>Select Destination</option>
												<?php
													$result = mysqli_query($conn,"SELECT stop_name FROM stops");
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