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
<script type="text/javascript" src="//apis.daum.net/maps/maps3.js?apikey=2c31b44d8f915ee294058a671d1241fb&libraries=services"></script>

	<script type="text/javascript">
	function send(sido) {
		sido = encodeURIComponent(sido);
		$.ajax({
			type:"GET",
			url:"/bada/apart_ex.php?sido="+sido,
			data:"",
			dataType:'html',
			success:function(data){
				str = "<select name='gugun' id='gugun' class='gugun' onchange='send2(sido.value,this.value);' ><option value='' >구군선택" + data+"</select>";
				document.getElementById('gugun_id').innerHTML = str;
				document.getElementById('dong_id').innerHTML = "<select  ><option value=''>동읍면선택</select>";
			}
		});
	}

	function send2(sido,gugun) {

		sido = encodeURIComponent(sido);
		gugun = encodeURIComponent(gugun);
		$.ajax({
			type:"GET",
			url:"/bada/apart_ex.php?sido="+sido+"&gugun="+gugun,
			data:"",
			dataType:'html',
			success:function(data){
				str = "<select name='dong' id='dong' class='dong' onchange='setCookie(this.value,1);'><option value='' >동읍면선택" + data+"</select>";
				document.getElementById('dong_id').innerHTML = str;
			}
		});
	}

	function send_sub(reg1) {
		reg1 = encodeURIComponent(reg1);
		$.ajax({
			type:"GET",
			url:"/bada/sub_ex.php?reg1="+reg1,
			data:"",
			dataType:'html',
			success:function(data){
				str = "<select name='reg2' id='reg2' class='reg2' onchange='send_sub2(reg1.value,this.value);' ><option value='' >노선선택" + data+"</select>";
				document.getElementById('reg2_id').innerHTML = str;
				document.getElementById('reg3_id').innerHTML = "<select  ><option value=''>역선택</select>";
			}
		});
	}
	function send_sub2(reg1,reg2) {
		reg1 = encodeURIComponent(reg1);
		reg2 = encodeURIComponent(reg2);
		$.ajax({
			type:"GET",
			url:"/bada/sub_ex.php?reg1="+reg1+"&reg2="+reg2,
			data:"",
			dataType:'html',
			success:function(data){
				str = "<select name='reg3' id='reg3' class='reg3' onchange='setCookie(this.value,3);' ><option value='' >역선택" + data+"</select>";
				document.getElementById('reg3_id').innerHTML = str;
			}
		});
	}


 function setCookie(cValue,cType){
		cDay = 3000;
		cName = "location";
		cValue  = cValue + "|"+cType;
		cx = cValue;
        var expire = new Date();
        expire.setDate(expire.getDate() + cDay);
        cookies = cName + '=' + escape(cValue) + '; path=/ '; // 한글 깨짐을 막기위해 escape(cValue)를 합니다.
        if(typeof cDay != 'undefined') cookies += ';expires=' + expire.toGMTString() + ';';
        document.cookie = cookies;
		var strArray = cx.split("|");
		document.getElementById('location').innerHTML = '선택지역 : ' + strArray[0];
    }
 function setCookie_ex(cValue, cValue2, cValue3){
		cDay = 3000;
		cName = "location";
		cx = cValue + "|" + cValue2 +"|" +cValue3 + "|2";;
        var expire = new Date();
        expire.setDate(expire.getDate() + cDay);
        cookies = cName + '=' + escape(cx) + '; path=/ '; // 한글 깨짐을 막기위해 escape(cValue)를 합니다.
        if(typeof cDay != 'undefined') cookies += ';expires=' + expire.toGMTString() + ';';
        document.cookie = cookies;
		document.getElementById('location').innerHTML = '선택지역 : ' + cValue;
    }

	
function getLocation()
{
	//document.getElementById('location').innerHTML = 'GPS를 실행해주세요.';
	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(showPosition,handle_error);
	}
	else
	{
		document.getElementById('location').innerHTML = 'GPS를 지원하지 않습니다.';
	}
}
function handle_error(error)
{
	//alert(error.message);
	switch(error.code) 
    {
	 case error.PERMISSION_DENIED:
		msg="위치정보사용을 허가해 주셔야합니다."
      break;
    case error.POSITION_UNAVAILABLE:
      msg="위치정보가 없습니다."
      break;
    case error.TIMEOUT:
      msg="시간이 초과되었습니다."
      break;
    case error.UNKNOWN_ERROR:
      msg="알수 없는 오류가 발생하였습니다."
      break;
	}
	document.getElementById('location').innerHTML = msg;
}
function showPosition(position)
{
//	document.getElementById('location').innerHTML="Lat: " + position.coords.latitude + "Lon: " + position.coords.longitude; 
	var geocoder = new daum.maps.services.Geocoder();
	var coords = new daum.maps.LatLng( position.coords.latitude, position.coords.longitude);
	var callback = function(status, result) {
		if (status === daum.maps.services.Status.OK) {
			xx = result[0].fullName;
			var re = xx.split(" ");
			if(re.length>2)
			{
				dong = re[2];
				//document.getElementById('location').innerHTML=dong;
				setCookie_ex(dong,position.coords.longitude,position.coords.latitude);
			}
			else if(re.length == 2)
			{
				dong = re[1];
				//document.getElementById('location').innerHTML=dong;
				setCookie_ex(dong,position.coords.longitude,position.coords.latitude);
			}
			else if(re.length == 1)
			{
				dong = re[0];
				//document.getElementById('location').innerHTML=dong;
				setCookie_ex(dong,position.coords.longitude,position.coords.latitude);
			}
		}
	};
	geocoder.coord2addr(coords, callback);     
}

function deleteLocation()
{
	deleteCookie();
}
function deleteCookie(){
		cDay = 3000;
		cName = "location";
		cx = "";
        var expire = new Date();
        expire.setDate(expire.getDate() + cDay);
        cookies = cName + '=' + escape(cx) + '; path=/ '; // 한글 깨짐을 막기위해 escape(cValue)를 합니다.
        if(typeof cDay != 'undefined') cookies += ';expires=' + expire.toGMTString() + ';';
        document.cookie = cookies;
		document.getElementById('location').innerHTML = '선택지역 : 전체지역';
}
 
</script>
						

</head>
<body>

<? include_once('./header.php');?>

<?php

$sql="select distinct reg1 from b_region order by reg1";
$ba_result = sql_query($sql);
$str = "<select name='sido' id='sido' class='sido' onchange='send(sido.value);'><option value='' >시도선택";
while ($row=sql_fetch_array($ba_result)) {
	if($row[reg1]==$sido)
		$str .= "<option value='".$row['reg1']."' selected>".$row['reg1'];
	else
		$str .= "<option value='".$row['reg1']."' >".$row['reg1'];

}
$str .="</select>";

$sql="select distinct reg2 from b_region where reg1='$sido' order by reg2";
$ba_result = sql_query($sql);
$str2 = "<select name='gugun' id='gugun' class='gugun' onchange='send2(sido.value,this.value);'><option value='' >구군선택";
while ($row=sql_fetch_array($ba_result)) {
	if($row[reg2]==$gugun)
		$str2 .= "<option value='".$row['reg2']."' selected>".$row['reg2'];
	else
		$str2 .= "<option value='".$row['reg2']."' >".$row['reg2'];
}
$str2 .="</select>";


$sql="select reg3 from b_region where reg1='$sido' and reg2='$gugun' order by reg3";
$ba_result = sql_query($sql);
$str3 = "<select name='dong' id='dong'><option value='' >동읍면선택";
while ($row=sql_fetch_array($ba_result)) {
	if($row[reg3]==$dong)
		$str3 .= "<option value='".$row['reg3']."' selected>".$row['reg3'];
	else
		$str3 .= "<option value='".$row['reg3']."' >".$row['reg3'];
}
$str3 .= "</select>";

?>

	<header class="header2">
		<div class="btn_back"><a href="/"></a></div>
		<div class="txt_tit">
			<p id="location"><?=$loc?></p> <!-- 위치설정 -->
		</div>
	</header>
	<section class="search">
		<div class="btn_wrap align_right"><a href="javascript:getLocation();">현재 위치로 설정</a> <a href="javascript:deleteLocation();">전체지역</a></div>
		<!--div class="search_wrap1">
			<p><input type="search" placeholder="지역명으로 검색"></p> <a href="#1">검색</a>
		</div -->
		<div class="tab_wrap">
			<ul class="u2">
				<li><a href="#tab1" class="on">전체지역 찾기</a></li>
				<li><a href="#tab2">인기지역 찾기</a></li>
				<li><a href="#tab3">역세권 찾기</a></li>
			</ul>
		</div>
		<div class="tab_con tab1">
			<div class="select_wrap">
						
						<?=$str?>
						
						
						<div id="gugun_id" class="gugun_id" >
							<?=$str2?>
						</div>
						<div id="dong_id" class="dong_id" >
							<?=$str3?> 
						</div>
			</div>
		</div>
		<div class="tab_con tab2">
			<dl class="locate_wrap">
				<dt>
					<ul class="u1">
						<li><a href="#1">서울강남</a></li>
						<li><a href="#1">서울강북</a></li>
						<li><a href="#1">인천,부천</a></li>
						<li><a href="#1">경기남부</a></li>
						<li><a href="#1">경기북부</a></li>
						<li><a href="#1">부산</a></li>
						<li><a href="#1">대구</a></li>
						<li><a href="#1">경남</a></li>
						<li><a href="#1">경북</a></li>
						<li><a href="#1">광주,전라</a></li>
						<li><a href="#1">대전,충청</a></li>
						<li><a href="#1">강원</a></li>
						<li><a href="#1">제주도</a></li>
					</ul>
				</dt>
				<dd>
					<ul class="u1 f1">
<?
$sql="select reg2,lat,lng from b_region_pop where reg1='서울강남' order by reg2";
$res = sql_query($sql);
$str = "";
while ($row=sql_fetch_array($res)) {
	$str .= "<li><a href='#favor' onclick='javascript:setCookie_ex(\"".$row['reg2']."\",".$row['lat'].",".$row['lng'].");'>".$row['reg2']."</a></li>";
}
echo $str;
?>
					</ul>
					<ul class="u1 f2">
<?
$sql="select reg2,lat,lng from b_region_pop where reg1='서울강북' order by reg2";
$res = sql_query($sql);
$str = "";
while ($row=sql_fetch_array($res)) {
	$str .= "<li><a href='#favor' onclick='javascript:setCookie_ex(\"".$row['reg2']."\",".$row['lat'].",".$row['lng'].");'>".$row['reg2']."</a></li>";
}
echo $str;
?>
					</ul>
					<ul class="u1 f3">
<?
$sql="select reg2,lat,lng from b_region_pop where reg1='인천,부천' order by reg2";
$res = sql_query($sql);
$str = "";
while ($row=sql_fetch_array($res)) {
	$str .= "<li><a href='#favor' onclick='javascript:setCookie_ex(\"".$row['reg2']."\",".$row['lat'].",".$row['lng'].");'>".$row['reg2']."</a></li>";
}
echo $str;
?>
					</ul>
					<ul class="u1 f4">
<?
$sql="select reg2,lat,lng from b_region_pop where reg1='경기남부' order by reg2";
$res = sql_query($sql);
$str = "";
while ($row=sql_fetch_array($res)) {
	$str .= "<li><a href='#favor' onclick='javascript:setCookie_ex(\"".$row['reg2']."\",".$row['lat'].",".$row['lng'].");'>".$row['reg2']."</a></li>";
}
echo $str;
?>
					</ul>
					<ul class="u1 f5">
<?
$sql="select reg2,lat,lng from b_region_pop where reg1='경기북부' order by reg2";
$res = sql_query($sql);
$str = "";
while ($row=sql_fetch_array($res)) {
	$str .= "<li><a href='#favor' onclick='javascript:setCookie_ex(\"".$row['reg2']."\",".$row['lat'].",".$row['lng'].");'>".$row['reg2']."</a></li>";
}
echo $str;
?>
					</ul>
					<ul class="u1 f6">
<?
$sql="select reg2,lat,lng from b_region_pop where reg1='부산' order by reg2";
$res = sql_query($sql);
$str = "";
while ($row=sql_fetch_array($res)) {
	$str .= "<li><a href='#favor'  onclick='javascript:setCookie_ex(\"".$row['reg2']."\",".$row['lat'].",".$row['lng'].");'>".$row['reg2']."</a></li>";
}
echo $str;
?>
					</ul>
					<ul class="u1 f7">
<?
$sql="select reg2,lat,lng from b_region_pop where reg1='대구' order by reg2";
$res = sql_query($sql);
$str = "";
while ($row=sql_fetch_array($res)) {
	$str .= "<li><a href='#favor' onclick='javascript:setCookie_ex(\"".$row['reg2']."\",".$row['lat'].",".$row['lng'].");'>".$row['reg2']."</a></li>";
}
echo $str;
?>
					</ul>
					<ul class="u1 f8">
<?
$sql="select reg2,lat,lng from b_region_pop where reg1='경남' order by reg2";
$res = sql_query($sql);
$str = "";
while ($row=sql_fetch_array($res)) {
	$str .= "<li><a href='#favor' onclick='javascript:setCookie_ex(\"".$row['reg2']."\",".$row['lat'].",".$row['lng'].");'>".$row['reg2']."</a></li>";
}
echo $str;
?>
					</ul>
					<ul class="u1 f9">
<?
$sql="select reg2,lat,lng from b_region_pop where reg1='경북' order by reg2";
$res = sql_query($sql);
$str = "";
while ($row=sql_fetch_array($res)) {
	$str .= "<li><a href='#favor' onclick='javascript:setCookie_ex(\"".$row['reg2']."\",".$row['lat'].",".$row['lng'].");'>".$row['reg2']."</a></li>";
}
echo $str;
?>
					</ul>
					<ul class="u1 f10">
<?
$sql="select reg2,lat,lng from b_region_pop where reg1='광주,전라' order by reg2";
$res = sql_query($sql);
$str = "";
while ($row=sql_fetch_array($res)) {
	$str .= "<li><a href='#favor' onclick='javascript:setCookie_ex(\"".$row['reg2']."\",".$row['lat'].",".$row['lng'].");'>".$row['reg2']."</a></li>";
}
echo $str;
?>
					</ul>
					<ul class="u1 f11">
<?
$sql="select reg2,lat,lng from b_region_pop where reg1='대전,충청' order by reg2";
$res = sql_query($sql);
$str = "";
while ($row=sql_fetch_array($res)) {
	$str .= "<li><a href='#favor' onclick='javascript:setCookie_ex(\"".$row['reg2']."\",".$row['lat'].",".$row['lng'].");'>".$row['reg2']."</a></li>";
}
echo $str;
?>
					</ul>
					<ul class="u1 f12">
<?
$sql="select reg2,lat,lng from b_region_pop where reg1='강원' order by reg2";
$res = sql_query($sql);
$str = "";
while ($row=sql_fetch_array($res)) {
	$str .= "<li><a href='#favor' onclick='javascript:setCookie_ex(\"".$row['reg2']."\",".$row['lat'].",".$row['lng'].");'>".$row['reg2']."</a></li>";
}
echo $str;
?>
					</ul>
					<ul class="u1 f13">
<?
$sql="select reg2,lat,lng from b_region_pop where reg1='제주도' order by reg2";
$res = sql_query($sql);
$str = "";
while ($row=sql_fetch_array($res)) {
	$str .= "<li><a href='#favor' onclick='javascript:setCookie_ex(\"".$row['reg2']."\",".$row['lat'].",".$row['lng'].");'>".$row['reg2']."</a></li>";
}
echo $str;
?>
					</ul>
				</dd>
			</dl>			
		</div>
		<div class="tab_con tab3">
			<div class="select_wrap">
<?php
//$reg1 = '수도권';

//$sql="select distinct reg1 from b_region_sub";
//$ba_result = sql_query($sql);
//$str = "<select name='reg1' id='reg1' class='reg1' onchange='send_sub(reg1.value);'><option value='' >지역선택";
//while ($row=sql_fetch_array($ba_result)) {
//	if($row[reg1]==$reg1)
//		$str .= "<option value='".$row['reg1']."' selected>".$row['reg1'];
//	else
//		$str .= "<option value='".$row['reg1']."' >".$row['reg1'];
//
//}
//$str .="</select>";

$sql="select distinct reg2 from b_region_sub where reg1='$reg1'";
$ba_result = sql_query($sql);
$str2 = "<select name='reg2' id='reg2' class='reg2' onchange='send_sub2(reg1.value,this.value);'><option value='' >노선선택";
while ($row=sql_fetch_array($ba_result)) {
	if($row[reg2]==$reg2)
		$str2 .= "<option value='".$row['reg2']."' selected>".$row['reg2'];
	else
		$str2 .= "<option value='".$row['reg2']."' >".$row['reg2'];
}
$str2 .="</select>";


$sql="select reg3,lat,lng from b_region_sub where reg1='$reg1' and reg2='$reg2'";
$ba_result = sql_query($sql);
$str3 = "<select name='reg3' id='reg3'><option value='' >역선택";
while ($row=sql_fetch_array($ba_result)) {
	if($row[reg3]==$reg3)
		$str3 .= "<option value='".$row['reg3']."|".$row['lat']."|".$row['lng']."' selected>".$row['reg3'];
	else
		$str3 .= "<option value='".$row['reg3']."|".$row['lat']."|".$row['lng']."' >".$row['reg3'];
}
$str3 .= "</select>";


?>		
<select name='reg1' id='reg1' class='reg1' onchange='send_sub(reg1.value);'>
	<option value='' >지역선택
	<option value="수도권">수도권
	<option value="부산">부산
	<option value="대구">대구
	<option value="광주">광주
	<option value="대전">대전
</select>
<div id="reg2_id" class="reg2_id" >
				<?=$str2?>
</div>
<div id="reg3_id" class="reg3_id" >
				<?=$str3?>
</div>
				
			</div>
		</div>
		<div class="btn_wrap_btm"><a href="shop_list.php">선택완료</a></div>
	</section>

</body>
</html>