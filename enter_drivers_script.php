<?php
	$firstnames = array("Ivan","Khoa","Kevin","Vishwa","Jonathan","Virendra","Daniel","Graham","David","Deyana");
	$lastnames = array("Hernandez","Bui","Nguyen","Thothathri","Hartman","Karappa","Frazee","Leslie","Trigg","Wilson","Storey","Roden");
	$routes = array("01","03",'04','05','06','08','12','15','22','22_G','26','27','31','34','35','36','N_W04','02');
	$conct = mysqli_connect("localhost","root","","aggie_spirit_new")	 or die("Could not connect to database!");
	foreach($routes as $route){
		foreach($firstnames as $firstname){
			foreach($lastnames as $lastname){
				$result1 = mysqli_query($conct,"INSERT INTO drivers VALUES(NULL,'$route','$firstname','$lastname')");
			}
		}
	}
?>