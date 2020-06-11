<?php

	$dbusername = "root";  // enter database username, I used "arduino" in step 2.2
    $dbpassword = "zarish123";  // enter database password, I used "arduinotest" in step 2.2
    $server = "localhost"; // IMPORTANT: if you are using XAMPP enter "localhost", but if you have an online website enter its address, ie."www.yourwebsite.com"

	$dbconnect = mysqli_connect($server, $dbusername, $dbpassword,'monitoring') or die('Error connection...');
	
if(isset($_GET['field1'])){ 
		
		$field1 = $_GET['field1'];
		$field2 = $_GET['field2'];
		$field3 = $_GET['field3'];
		$field4 = $_GET['field4'];
		$field5 = $_GET['field5'];
		$field6 = $_GET['field6'];
		$field7 = $_GET['field7'];
		
		
		$sql="INSERT INTO device (Temperature,Humidity,Carbondioxide,Gas,IsSmoke,Latitude,Longitude) values ('$field1','$field2','$field3','$field4','$field5','$field6','$field7')";
		mysqli_query($dbconnect,$sql)  or die('Error...'); 
} 
		 
?>