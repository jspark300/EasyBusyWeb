<?
include_once('./_common.php');

$sql = "select id,name,addr_s,phone,lat,lon,description from t_comp where id=$id";
$res = sql_fetch($sql);


?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>EASYBUSY</title>
	<link href="a_css/default.css" rel="stylesheet" />
	<link href="a_css/common.css" rel="stylesheet" />
	<script src="a_js/jquery-1.11.3.min.js"></script>
	<script src="a_js/common.js"></script>
	<script type="text/javascript" src="http://openapi.map.naver.com/openapi/v2/maps.js?clientId=GnJ4HNArC0Mh_9qWN39m"></script>
</head>
<body>
	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p><?=$res['name']?></p>
		</div>
	</header>
	<section class="shop_map">
		<h2>지도보기</h2>
		<div class="d2" id="d2">
<? if($res['lat'] == "0") { ?>		
			지도정보 없음.
<? } ?>		
			
		</div>
<? if($res['lat'] != "0") { ?>		
		<script type="text/javascript">
			var defaultLevel = 11;
			var oPoint = new nhn.api.map.LatLng(<?=$res['lat']?>,<?=$res['lon']?>);
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

			oMarker = new nhn.api.map.Marker(oIcon,{title : '<?=$res['name']?>'});
			oMarker.setPoint(oMap.getCenter());
			oMap.addOverlay(oMarker);

			oLabel = new nhn.api.map.MarkerLabel();
			oMap.addOverlay(oLabel);
			oLabel.setVisible(true,oMarker);
				
			
			</script>
<? }
?>
	</section>
	<section class="shop_info">
		<ul>
			<li class="exp2">
				<dl>
					<dt>주소</dt><dd><?=$res['addr_s']?></dd>
				</dl>
				<dl>
					<dt>전화번호</dt><dd><?=$res['phone']?></dd>
				</dl>
				<dl>
					<dt>매장정보</dt>
					<dd>
						<p>영업시간 : 상시(월~일) 11:00 ~ 23:00</p>
						<p>좌석정보 : 80석, 방 10개</p>
						<p>수용인원 : 80 명</p>
						<p>연중무휴</p>
					</dd>
				</dl>
				<dl>
					<dt>홈페이지</dt><dd>http://<?=$res['homepage']?></dd>
				</dl>
			</li>
		</ul>
	</section>
</body>
</html>