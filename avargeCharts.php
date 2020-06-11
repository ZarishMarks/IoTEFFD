
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
      <h1>Avarge Charts</h1>
    </div>
	<div id="container" class="container">
    <div class="SensorsData">
			<iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1077598/charts/1?bgcolor=%23ffffff&color=%23d62020&days=1&dynamic=true&results=60&title=Temperature&type=spline"></iframe>
			<iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1077598/charts/2?bgcolor=%23ffffff&color=%23d62020&days=1&dynamic=true&results=60&title=Humidity+&type=spline"></iframe>
    </div>
    <div class="SensorsData">
			<iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1077598/charts/3?bgcolor=%23ffffff&color=%23d62020&days=1&dynamic=true&results=60&title=CO2&type=spline"></iframe>
			<iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1077598/charts/4?bgcolor=%23ffffff&color=%23d62020&days=1&dynamic=true&results=60&title=Smoke&type=spline"></iframe>

    </div>
	</div>
  <div id="main-content"class="main-content">

  </div>
</body>
</html>
