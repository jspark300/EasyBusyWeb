<?
function getDistance($lat1, $lon1, $lat2, $lon2)
{
    $earth_radius = 6371;
    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lng2 - $lng1);
    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
    $c = 2 * asin(sqrt($a));
    $d = $earth_radius * $c;
    return $d;
}

echo getDistance(127.0389500,37.4997760,127.033,37.4928);


?>

