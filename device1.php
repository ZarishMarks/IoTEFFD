
<!DOCTYPE html>
<html>
<head>
	<title>Forest Fire Detection</title>
	 <link rel="stylesheet" type="text/css" href="styles.css">
<script src="http://code.jquery.com/jquery-latest.js"></script>

<script>
  var auto_refresh = setInterval(
  function()
  {
  $('#main-content').fadeOut('slow').load('sim.php').fadeIn("slow");
  }, 10000);
</script>
</head>
<body>
	<div class="navigation">
		<ul>
			<li><a href="index.php">Location</a></li>
			<li><a href="device1.php">Real Device</a></li>
			<li><a href="avargeCharts.php">Avarge Charts</a></li>
		</ul>
	</div>
    <div class="device">
      <h1>Real Device</h1>
    </div>
	<div id="container" class="container">
    <div class="SensorsData">
      <iframe  src="https://thingspeak.com/channels/1031604/charts/1?bgcolor=%23ffffff&color=%230028ff&days=1&dynamic=true&results=60&title=Temperature&type=spline"></iframe>
      <iframe  src="https://thingspeak.com/channels/1031604/charts/2?bgcolor=%23ffffff&color=%238f71ff&days=1&dynamic=true&results=60&title=Humidity%28PPM%29&type=spline"></iframe>
    </div>
    <div class="SensorsData">
      <iframe  src="https://thingspeak.com/channels/1031604/charts/3?bgcolor=%23ffffff&color=%2300faac&days=1&dynamic=true&results=60&title=CO2&type=spline"></iframe>
      <iframe src="https://thingspeak.com/channels/1031604/charts/4?bgcolor=%23ffffff&color=%232f89fc&days=1&dynamic=true&results=60&title=Smoke&type=spline"></iframe>
    </div>
	</div>
  <div id="main-content"class="main-content">
<?php
//include("sim.php");
//$database = "ffd";
//$table_name = "real_device";
//$thingspeak = "https://api.thingspeak.com/update?api_key=HRB8240C9G5WD7I0&";
//db_created($database, $table_name, $thingspeak);
?>
  </div>
</body>
</html>
