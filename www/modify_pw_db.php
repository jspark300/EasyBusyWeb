<?php
include_once('./_common.php');

if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}
$mb_id = $member['mb_id'];

$ts = date("Ymd");
$t = time();

$sql = "select mb_no from g5_member where mb_id='$mb_id' and mb_password=password('".$pass."')";
$mrs = sql_fetch($sql);
if(!$mrs)
{
	echo "<script>alert('비밀번호가 일치하지 않습니다.');location.href='/my_index.php';</script>";
	exit;
}
if($newpass!=$newpass_re)
{
	echo "<script>alert('신규비밀번호와 신규비밀번호 확인이 일치하지 않습니다.');location.href='/my_index.php';</script>";
	exit;
}

$sql = "update g5_member set mb_password = password('".$newpass."') where mb_no='$mrs[mb_no]'";
sql_query($sql);



echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
echo "<script>alert('신규 비밀번호로 변경하였습니다');location.href = '/my_index.php';</script>";
?>