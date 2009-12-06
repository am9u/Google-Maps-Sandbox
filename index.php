<?php

    $DOCROOT = $_SERVER["DOCUMENT_ROOT"];
    require_once( "settings.php" );

    require_once( $DOCROOT . "/shared/classes/php/DataFeeder.php" );
    
    $dataFeedSettings = array( 
        "id" => "geocodeHome", 
        "url" => $homeAddressGeocodeUrl,
        "dataType" => "json",
        "expires" => 120 // expires timeout in minutes
    );
    $df = new DataFeeder( $dataFeedSettings );
    $homeJson = $df->load();
    $home = json_decode( $homeJson );
    $placemark = $home->Placemark[0];
    $coordinates = $placemark->Point->coordinates;

?>
<!--
    <?php echo( "url: " . $homeAddressGeocodeUrl ); ?>
    <?php echo( "coordinates:" . $coordinates[0] . " " . $coordinates[1] ); ?>
-->

<!DOCCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">

<head>
	<title>Maps Sandbox</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<style type="text/css">
		#map { width: 500px; height: 300px; }
        #geocoder { margin: 0 0 1em; }
	</style>
</head>

<body onunload="GUnload()">

<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $googleMapsAPIKey ?>&sensor=false"></script>

<script type="text/javascript">
// not wrapped in a closure for now so we can watch vars in console
// TODO: explore geocoder caching!
// (function(){

var map,
    geocoder,
    home = { address: '155 East 49th Street, New York, NY 10017' };

// init map and geocoder; center map on home
function initializeMap() {
	map = new GMap2(document.getElementById("map"));
    map.setCenter( home.latLng, 15);
    map.setUIToDefault();
}

// create a marker for home and add it to the pa
function createHomeMarker(){
    home.marker = new GMarker( home.latLng );
    map.addOverlay( home.marker );
}

function init(){
    // find latLng for home address using Geocoder and init map with that as center point
	if (GBrowserIsCompatible()) {
		geocoder = new GClientGeocoder();
        geocoder.getLatLng( home.address,
            function createMap( latLng ) {
                home.latLng = latLng;    
                initializeMap();
                createHomeMarker();
            }
        );
    }
}

var mapSandbox = (function() {
	return {
		// test geocoder getLocations()
		getCoordinates: function() {
			var address = $('#address').val();
			geocoder.getLocations(
				address,
				function( loc ) {
					console.dir(loc);
				}
			);
		}
	};
})();

// expose to window
window.mapSandbox = mapSandbox;

// init map
$(function() {
      init();
});


// })();
</script>

<div id="geocoder">
    <input type="text" name="address" id="address" /> <input type="button" onclick="mapSandbox.getCoordinates();" value="Get Locations" />
</div>

<div id="map"></div>

</body>

</html>
