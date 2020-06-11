<html>
<head>
  <title>Forest Fire Detection</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
  <?php
  include("PopulateSimulatedDevices.php");
  include("RefreshSimulatedDevices.php");
  db_setupWithFakeDevices();
  db_RefreshWithFakeDevices();

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

      $avargeTemperature = 0;
      $avargeHumidity= 0;
      $avargeCarbon = 0;
      $avargeGas = 0;


      while ($row = $result->fetch_row()) {
        $avargeTemperature = $avargeTemperature + $row[1];
        $avargeHumidity = $avargeHumidity + $row[2];
        $avargeCarbon = $avargeCarbon + $row[3];
        $avargeGas = $avargeGas + $row[4];
      }
	  /* average temperature of the devices we have $deviceTemperature / number of devices */
        try{
          $avargeTemperature = $avargeTemperature / 10;
          $avargeHumidity = $avargeHumidity / 10;
          $avargeCarbon = $avargeCarbon / 10;
          $avargeGas = $avargeGas / 10;

          $url = "https://api.thingspeak.com/update?api_key=WJMGEZPQKPG8Y2PZ&field1=$avargeTemperature&field2=$avargeHumidity&field3=$avargeCarbon&field4=$avargeGas";
          $response = file_get_contents($url);

          if ($response !== false) {
            # code...
            //echo "HTTP: ".$response." ".$url;
          }
          else{
            echo "Check API and try again!";
          }
        }
        catch(Exception $e){
          echo $e -> getMessage();
        }
        $conn->close();
      }
  //include("sim.php");
  //$database = "ffd";
  //$table_name = "real_device";
  //$thingspeak = "https://api.thingspeak.com/update?api_key=HRB8240C9G5WD7I0&";
  //db_created($database, $table_name, $thingspeak);

  ?>
  <div class="navigation">
    <ul>
      <li><a href="index.php">Location</a></li>
      <li><a href="device1.php">Real Device</a></li>
      <li><a href="avargeCharts.php">Avarge Charts</a></li>
    </ul>
  </div>
  <div>
    <div class="device">
        <h1>Area</h1>
    </div>
    <div class="container">
      <div id="map"></div>
    </div>


     <script>
        //let map;
        // global array to store the marker object
        let markersArray = [];

        var map, heatmap;
        //innitializing google map
        function initMap() {
          map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
          center: {lat: 46.099619, lng: 18.2179579},
          'mapTypeId': google.maps.MapTypeId.ROADMAP,
          gestureHandling: 'cooperative'
        });

        //innitializing popup window
        var infowindow = new google.maps.InfoWindow;

        // iterating through the markers point data to draw markers on the map
        for (var i = 0; i<getMarkersPoints().length; i++) {
          var myLatLng = getMarkersPoints()[i][1];
          var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: getMarkersPoints()[i][0].toString().concat(JSON.stringify(myLatLng)),
        });

      // adding click event listener to display device data when the user clicks on the marker
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
           return function() {
               infowindow.setContent(getMarkersPoints()[i][0]);
               infowindow.open(map, marker);
           }
      })(marker, i));
    }

  // Innitializing heatmaps
    heatmap = new google.maps.visualization.HeatmapLayer({
      data: new google.maps.MVCArray(getPoints()),
      radius:((Math.random() * 100) + 10),
      map: map
    });
  }

  function toggleHeatmap() {
    heatmap.setMap(heatmap.getMap() ? null : map);
  }

  // color codes
  function changeGradient() {
    var gradient = [
       'rgba(0, 255, 255, 0)',
      'rgba(0, 255, 255, 1)',
      'rgba(0, 191, 255, 1)',
      'rgba(0, 127, 255, 1)',
      'rgba(0, 63, 255, 1)',
      'rgba(0, 0, 255, 1)',
      'rgba(0, 0, 223, 1)',
      'rgba(0, 0, 191, 1)',

    ]
    heatmap.set('gradient', heatmap.get('gradient') ? null : 1000);
  }

  function changeRadius() {
    heatmap.set('radius', heatmap.get('radius') ? null : 1000);
  }

  function changeOpacity() {
    heatmap.set('opacity', heatmap.get('opacity') ? null : 1000);
  }


  // Heatmap data: 4 Points
  function getPoints() {
    <?php
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
    echo "return [";
    while ($row = $result->fetch_row())
    {
      $lat = $row[6];
      $lng = $row[7];
      $temp = $row[1];

      echo "{location: new google.maps.LatLng($lat, $lng), weight:parseInt($temp)},";
    }
    echo "];";
    ?>
  }
</script>
<script>
  // Innitializing markers point / and markers popup data
  function getMarkersPoints(){
    <?php
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
    echo "return[";
    while ($row = $result->fetch_row())
    {
      $id = $row[0];
      $lat = $row[6];
      $lng = $row[7];
      $temp = $row[1];

      echo "[\"$id\".concat(\"Temperature: \".concat($temp)),{lat: $lat,  lng: $lng}],";
    }
      echo "];";
    ?>
  }
  //console.log(temp);
  setTimeout(function () {
     window.location.reload();
  }, 10000);
  </script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6MSoGGD-qWMPsZ83-Kxo6K5u_ypgamm0&libraries=visualization&callback=initMap"></script>
</body>
</html>
