<?php
include_once("../../../common.php");
//////////////COPYRIGHT/////////////////////
/////////제작 buildsoft.co.kr(빌드소프트) 
/////////제작일 2015.7.28
/////////copyright 삭제하지 않는다는 조건하에 
/////////누구든지 그대로 복제하고 배포할 수 있습니다.
/////////본 프로그램 사용으로 인한 오류 및 사고는 책임지지 않습니다.
///////////////////////////////////
$_Code=$_GET['code'];/////카카오톡에 받는 code값

$ch = curl_init();
$apiKey="fad4c2cb87ee47d37e463d10e8e514cb";

curl_setopt( $ch, CURLOPT_URL, "https://kauth.kakao.com/oauth/token");
curl_setopt( $ch, CURLOPT_POST, true);
curl_setopt( $ch, CURLOPT_HTTPHEADER,0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt( $ch, CURLOPT_POSTFIELDS, "grant_type=authorization_code&client_id=fad4c2cb87ee47d37e463d10e8e514cb&redirect_uri=http://{$_SERVER[SERVER_NAME]}/plugin/sns_plugin/kakao_oauth&code={$_Code}");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

$result = curl_exec($ch);
curl_close($ch);

$R_String= json_decode($result);

$Expires_time = $R_String->{'expires_in'};///남은시간
$access_token = $R_String->{'access_token'};///access_token
if($Expires_time>0 && !empty($Expires_time)){

	$headers=array("Authorization:Bearer $access_token","Content-Type:application/x-www-form-urlencoded;charset=utf-8");
	
	$url="https://kapi.kakao.com/v1/user/me";

	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $url);
	curl_setopt( $ch, CURLOPT_HTTPHEADER,$headers);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
	
	$result = curl_exec($ch);
	$Member_Info= json_decode($result);
	curl_close($ch);

//	echo $Member_Info->{'id'};
	//회원아이디 세션 생성
	$mb = get_member("kakao_".$Member_Info->{'id'});
	
	if($Member_Info->{'id'}!="" && empty($mb[mb_id])){/////카카오톡 에 받은 고유키값을 비교 없으면 회원으로 등록시킨다.
		$mb_id="kakao_".$Member_Info->{'id'};
		$mb_nick=$Member_Info->{'properties'}->{'nickname'};
		$sql="insert into g5_member (mb_id,mb_password,mb_nick,mb_name,mb_level,mb_datetime,mb_open_date)values('$mb_id',password('$mb_id'),'$mb_nick','$mb_nick','{$config['cf_register_level']}','".G5_TIME_YMDHIS."','".G5_TIME_YMD."')";
//		echo $sql;
		sql_query($sql);
	}
	set_session('ss_mb_id', "kakao_".$Member_Info->{'id'});
	set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
	set_session('ss_login_site','kakao');
	echo "<script>location.href='/';</script>";
}

?>