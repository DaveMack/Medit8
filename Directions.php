<!DOCTYPE html>
<html>

<head>
<meta content="en-au" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Medit8 - Directions</title>
<link href="StyleSheet.css" rel="stylesheet" type="text/css" />
</head>

<body>
<!--Imports the website header-->
<?php include 'header.php' ?>

<!--Page contents-->
<article style="position: fixed;"><p>Our school is located at 1310 Seventeen Mile Road, Seventeen Mile QLD 4344, on the edge of the 
Lockyer National Park. This out-of-the-way location is perfect for those wanting a calm and relaxing location to meditate.</p>
<div id="map" style="width:400px;height:400px;background:yellow"></div>

<script>
	var map;
	function initMap() {
	map = new google.maps.Map(document.getElementById('map'), 
		{
		center: {lat: -27.465158, lng: 152.187860},
		zoom: 8
		});
    }
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQa7GoSNe9XaK1mxjG8CHzUhARgHNwPug&callback=initMap"></script>

</article>

</body>

</html>