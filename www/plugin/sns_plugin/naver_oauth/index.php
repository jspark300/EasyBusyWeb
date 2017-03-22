<?php
include_once("../../../common.php");
//////////////COPYRIGHT/////////////////////
/////////제작 buildsoft.co.kr(빌드소프트) 
/////////제작일 2015.7.28
/////////copyright 삭제하지 않는다는 조건하에 
/////////누구든지 그대로 복제하고 배포할 수 있습니다.
/////////본 프로그램 사용으로 인한 오류 및 사고는 책임지지 않습니다.
///////////////////////////////////
echo "get:".$_GET[state];
echo "<br>sess:".$_SESSION[state];
if($_SESSION[state]==$_GET[state]){
		
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, "https://nid.naver.com/oauth2.0/token");
		curl_setopt( $ch, CURLOPT_POST, true);
		curl_setopt( $ch, CURLOPT_HTTPHEADER,0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, "grant_type=authorization_code&client_id=GnJ4HNArC0Mh_9qWN39m&client_secret=_lLyzABXeK&code={$_GET['code']}");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

		$result = curl_exec($ch);

		curl_close($ch);
		$R_value = json_decode($result);
		
		$access_token = $R_value->{'access_token'};///access token
		$expires_in =$R_value->{'expires_in'};//////토근 만료시간

		if(!empty($access_token) && $expires_in>0 && !empty($expires_in)){
			
			$headers=array("Authorization:Bearer $access_token","Content-Type:application/x-www-form-urlencoded;charset=utf-8");

			$url="https://apis.naver.com/nidlogin/nid/getUserProfile.xml";

			$ch = curl_init();

			curl_setopt( $ch, CURLOPT_URL, $url);
			curl_setopt( $ch, CURLOPT_HTTPHEADER,$headers);
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

			$result = curl_exec($ch);
			curl_close($ch);

			$xml = simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA);

			foreach ($xml->result as $value){ 
				$result_code=$value->resultcode;
			} 
			if($result_code=="00"){////00이면 성공
				foreach ($xml->response as $value){ 
					$email =  $value->email;
					$name= $value->name;
					$mid= "nv_".trim($value->id);
					
				} 
				//회원아이디 세션 생성
				$mb = get_member($mid);

				if($mid!="nv_" && empty($mb[mb_id])){/////카카오톡 에 받은 고유키값을 비교 없으면 회원으로 등록시킨다.
					$sql="insert into g5_member (mb_id,mb_password,mb_nick,mb_name,mb_email,mb_level,mb_datetime,mb_open_date)values('$mid',password('$mid'),'$name','$name','$email','{$config['cf_register_level']}','".G5_TIME_YMDHIS."','".G5_TIME_YMD."')";
					sql_query($sql);
				}
					set_session('ss_mb_id', $mid);
					set_session('ss_mb_key', md5($member['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
					set_session('ss_login_site','naver');

				echo "<script>location.href='/';</script>";
			}else{
					echo"<script>alert('파싱 오류 입니다.');location.href='/';</script>";
			}

		}else{
		
			echo"<script>alert('토큰 오류 입니다.');location.href='/';</script>";
		}
}else{///인증실패

	echo"<script>alert('인증 오류 입니다.');location.href='/';</script>";
}
?>
