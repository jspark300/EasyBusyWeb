<?php
include_once('./_common.php');
$x=0;
$y = 0;

if($addr=="")
{
	echo "주소가 없습니다.";
}
else
{
	$query = urlencode($addr);
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
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>EASYBUSY</title>
	<link href="/a_css/default.css" rel="stylesheet" />
	<link href="/a_css/common.css" rel="stylesheet" />
	<script src="a_js/jquery-1.11.3.min.js"></script>
	<script src="a_js/common.js"></script>
		<script type="text/javascript" src="http://openapi.map.naver.com/openapi/v2/maps.js?clientId=GnJ4HNArC0Mh_9qWN39m"></script>
</head>
<body>
<div class="d2" id="d2" style="margin:0px; height:90%; overflow:hidden; border:#ccc solid 1px;">

<script type="text/javascript">
			var defaultLevel = 11;
			var oPoint = new nhn.api.map.LatLng(<?=$y?>,<?=$x?>);
			//var oPoint = new NPoint(5564564,1212212);
			var oMap = new nhn.api.map.Map(document.getElementById('d2'),{
				point : oPoint,
				zoom : defaultLevel,
				enableWheelZoom : true,
				enableDragPan : true,
				enableDblClickZoom : false,
				mapMode : 0,
				activateTrafficMap : false,
				activeBicycleMap : false,
				minMaxLevel : [1,14]
					//,				size : new nhn.api.map.Size(340,280)
				});
			var oSlider = new nhn.api.map.ZoomControl();
			oMap.addControl(oSlider);
			oSlider.setPosition({
				top : 10,
				left : 10
			});
			
			var oMapTypeBtn = new nhn.api.map.MapTypeBtn();
			oMap.addControl(oMapTypeBtn);
			oMapTypeBtn.setPosition({
				bottom : 10,
				right : 80
			});
			
			var trafficButton = new nhn.api.map.TrafficMapBtn();
			oMap.addControl(trafficButton);
			trafficButton.setPosition({
				bottom : 10,
				right : 150
			});			
			
			var oSize = new nhn.api.map.Size(28,37);
			var oOffset = new nhn.api.map.Size(14,37);
			var oIcon = new nhn.api.map.Icon('http://static.naver.com/maps2/icons/pin_spot2.png',oSize,oOffset);

			oMarker = new nhn.api.map.Marker(oIcon,{title : '<?=$company?>'});
			oMarker.setPoint(oMap.getCenter());
			oMap.addOverlay(oMarker);

			oLabel = new nhn.api.map.MarkerLabel();
			oMap.addOverlay(oLabel);
			oLabel.setVisible(true,oMarker);
			oMap.refresh();
				
			
</script>		
</div>
<section class="member_wrap" style="top:0px;">
	<div class="btn5">
				<a href="javascript:window.open('', '_self').close();">닫기</a>
	</div>
</section>			
</div>
</body>
</html>