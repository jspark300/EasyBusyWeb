<?php
include_once('./_common.php');

if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}
if($member[mb_level]!=3)
{
	echo "<script>alert('업체회원 권한이 필요합니다.');history.back();</script>";
	exit;	
}

$sql = "select * from t_com_order where id=$id ";
$rx = sql_fetch($sql);
$sql = "select count(id) c from t_comp where id=$rx[com_id] and own_id='$member[mb_id]'";
//echo $sql;
$rxc = sql_fetch($sql);
if($rxc[c] == 0)
{
	echo "<script>alert('주문상태를 변경할 권한이 없습니다. 다시 확인해 주세요.');history.back();</script>";
	exit;
}

$sql = "update t_com_order set status=$st where id='".$id."'";
sql_query($sql);

echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
echo "<script>location.href = '/comorder.php?t=".$ost."&listcount=".$listcount."';</script>";

?>