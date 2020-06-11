<?php

function rand_float($st_num=0,$end_num=1,$mul=100)
{
  if ($st_num>$end_num) return false;
  return mt_rand($st_num*$mul,$end_num*$mul)/$mul;
 }

  function db_RefreshWithFakeDevices()
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
      while ($row = $result->fetch_row()) {
        $row[5] = rand(0,1);
        if ($row[5] == 1){
            $row[4] = rand(1,400);
        }
        else {
            $row[4] = 0;
        }
        $sql = "UPDATE device SET Temperature = ".rand_float(20, 30).", Humidity = ".rand_float(30, 50).", CarbonDioxide = ".rand_float(100, 700).",Gas = $row[4] ,IsSmoke = $row[5] WHERE Id = $row[0];";
        //echo $sql;
        $conn->query($sql);

    //printf ("%s (%s)\n", $row[0], $row[1]);
    }
      }
    $conn->close();
  }
?>
