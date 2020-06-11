<?php

function rand_floatforGPS($st_num=0,$end_num=1,$mul=100000)
{
  if ($st_num>$end_num) return false;
  return mt_rand($st_num*$mul,$end_num*$mul)/$mul;
}

  function db_setupWithFakeDevices()
  {
    $servername = "localhost";
    $username = "root";
    $password = "zarish123";
    $dbname = "monitoring";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

      $sql = "SELECT * FROM device;";
      $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    //nothing happen
    }
     else {
       for ($i = 1; $i <= 100; $i++)
       {
//46.110552 ; 18.219955
         $randomLongitude = rand_floatforGPS(18, 19);
         $randomLatitude = rand_floatforGPS(46,47);

         $sql = "INSERT INTO device (Temperature, Humidity, CarbonDioxide, Gas, IsSmoke, Longitude, Latitude) VALUES (0.00, 0.00, 00.0, 00.0, 0, $randomLongitude, $randomLatitude);";
         $result = $conn->query($sql);
       }
    }
    $conn->close();
  }
?>
