<?php
// jonferrer.com
$googleMapsAPIKey = "ABQIAAAAvYOlX04AjguN5yhxddqxJhQpshiSpNGIWNixjG34yEtU6UEb7hQOwXCPyhtyFr_aP7BmisoYj5nf1A";

// ferrinho.com
// $googleMapsAPIKey = "ABQIAAAAvYOlX04AjguN5yhxddqxJhQ09Fm2IUkCniqCvsZpPhyZNv5wbRSjvoCkrhQVuLYVkywka3u8XUjSng";

$homeAddress = "155 East 49th Street, New York, NY 10017";

// geocode sample url
// http://maps.google.com/maps/geo?q=155+East+49th+Street,+New+York+,NY+10017&sensor=false&output=json&key=ABQIAAAAvYOlX04AjguN5yhxddqxJhQpshiSpNGIWNixjG34yEtU6UEb7hQOwXCPyhtyFr_aP7BmisoYj5nf1A
$geocoderBaseUrl = "http://maps.google.com/maps/geo?";
$homeAddressGeocodeUrl = $geocoderBaseUrl . "q=" . str_replace( " ", "+", utf8_encode( $homeAddress ) ) . "&sensor=false" . "&output=json" . "&key=" . $googleMapsAPIKey;

?>

