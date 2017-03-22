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
$mb_zip1 = substr($mb_zip,0,3);
$mb_zip2 = substr($mb_zip,3,2);

$sql = "update g5_member set mb_zip1 = '".$mb_zip1."', mb_zip2 = '".$mb_zip2."',mb_addr1='$address1',mb_addr2='$address2',mb_addr3='$address3',mb_addr_jibeon='$mb_addr_jibeon' where mb_id='$mb_id'";
sql_query($sql);

echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
echo "<script>alert('주소를 변경하였습니다');location.href = '/my_index.php';</script>";
?>