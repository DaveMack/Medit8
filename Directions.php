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


<article style="position: fixed;"><p>Our school is located at 1310 Seventeen Mile Road, Seventeen Mile QLD 4344, on the edge of the 
Lockyer National Park. This out-of-the-way location is perfect for those wanting a calm and relaxing location to meditate.</p>
<div id="map" style="width:400px;height:400px;background:yellow"></div>

<script>
function myMap() {
  var mapCanvas = document.getElementById("map");
  var mapOptions = {
    center: new google.maps.LatLng(-27.465158, 152.187860), zoom: 10
  };
  var map = new google.maps.Map(mapCanvas, mapOptions);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>


</article>

</body>

</html>