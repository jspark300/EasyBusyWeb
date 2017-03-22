<?php
include_once('./_common.php');
$x=0;
$y = 0;

if($sido==""  || $gugun=="" || $dong=="" || $bungi == "")
{
	//echo "주소선택 및 상세주소를 입력하세요.";
}
else
{
	//echo "※ 위치가 잘못된 경우는 입력된 주소를 확인해주세요.";
	$query = urlencode($sido.$gugun.$dong.$bungi);
	$url = "http://openapi.map.naver.com/api/geocode?key=4656599e5f320c8f90d2a7454368cfea&encoding=utf-8&coord=latlng&output=xml&query=".$query;
//	echo $url;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);

    // execute and return string (this should be an empty string '')
    $str = curl_exec($curl);

    curl_close($curl);
	$xml = simplexml_load_string($str);

	$total_count = $xml->result->total;

	$x = $xml->result->items->item->point->x;
	$y = $xml->result->items->item->point->y;
}

function search_com($sido,$gugun,$dong,$bungi,$x,$y)
{
	$query = urlencode($sido.$gugun.$dong.$bungi);
	$url = "http://openapi.map.naver.com/api/geocode?key=4656599e5f320c8f90d2a7454368cfea&encoding=utf-8&coord=latlng&output=xml&query=".$query;
//	echo $url;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);

    // execute and return string (this should be an empty string '')
    $str = curl_exec($curl);

    curl_close($curl);
	$xml = simplexml_load_string($str);

	$total_count = $xml->result->total;

	$x = $xml->result->items->item->point->x;
	$y = $xml->result->items->item->point->y;
//	if($total_count>0)
//	{
//		echo "|".$xml->result->items->item->point->x;
//		echo "|".$xml->result->items->item->point->y;
//	}
//	else
//	{
//		echo "0|0|0";
//	}
}
echo "$x|$y";
?>
