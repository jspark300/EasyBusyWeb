<?php
include_once("./common.php");

$fbuserid = $_POST[id];
$fbusername = $_POST[name];
$facebook = $_POST[facebook];
//$fbusername = iconv('UTF-8','eucKR',$fbusername);


if($fbuserid !="" and $facebook == 'facebook')
{
	$mb = get_member("fac_".$fbuserid);
	if(empty($mb[mb_id])){/////페이스북 에 받은 고유키값을 비교 없으면 회원으로 등록시킨다.
		$mb_id="fac_".$fbuserid;
		$mb_nick = $fbusername;
		
		$sql="insert into g5_member (mb_id,mb_password,mb_nick,mb_name,mb_level,mb_datetime,mb_open_date)values('$mb_id',password('$mb_id'),'$mb_nick','$mb_nick','{$config['cf_register_level']}','".G5_TIME_YMDHIS."','".G5_TIME_YMD."')";
//		echo $sql;
		sql_query($sql);
	}
	set_session('ss_mb_id', "fac_".$fbuserid);
	set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
	set_session('ss_login_site','facebook');
//	echo "<script>location.href='/shop_list.php';</script>";
	echo "ok";
}

?>