<?php
include_once('./_common.php');

if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}
$mb_id = $member['mb_id'];

$ts = date("Ymd");
$t = time();

if($mb_sms!="1")
	$mb_sms = "0";

$sql = "select count(mb_no) c from g5_member where mb_id<>'".$mb_id."' and mb_hp = '".$hp."'";

	
$res = sql_fetch($sql);
$mb_count = $res['c'];
if($mb_count>0)
{	
	echo "<script>alert('이미 등록된 휴대폰번호입니다. 다른 휴대폰번호를 입력해 주세요.');history.back();</script>";
	exit;
}

$sql = "update g5_member set mb_hp = '".$hp."',mb_sms=$mb_sms where mb_id='$mb_id'";
sql_query($sql);

echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
echo "<script>alert('계정 정보를 변경하였습니다');location.href = '/my_index.php';</script>";
?>