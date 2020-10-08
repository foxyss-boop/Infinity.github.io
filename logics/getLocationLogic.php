<?php
$client = new Clients;
$ipaddress = $client->getClient($utils->sanitize($_GET['vicid']))->ipaddress;
$json = $utils->callAPI("GET", "http://www.geoplugin.net/json.gp?ip=" . $ipaddress, false);
$data = json_decode($json);
$allowed_keys = [
    'geoplugin_request' => "IP Address",
    'geoplugin_city' => "City",
    'geoplugin_region' => "Region",
    'geoplugin_countryName' => "Country",
    'geoplugin_continentName' => "Continent",
    'geoplugin_latitude' => "latitude",
    'geoplugin_longitude' => "longitude",
    'geoplugin_timezone' => "Timezone",
];
$i = 1;
