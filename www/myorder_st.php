<?php
include_once('./_common.php');

if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}

$sql = "select count(id) c from t_com_order where id=$id and mb_no=$member[mb_no]";
$rx = sql_fetch($sql);
if($rx[c] == 0)
{
	echo "<script>alert('취소할 주문이 없습니다. 다시확인해 주세요..');history.back();</script>";
	exit;
}

$sql = "update t_com_order set status=-1 where id='".$id."'";
sql_query($sql);

echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
echo "<script>alert('선택한 주문을 취소하였습니다.'); location.href = '/myorder.php?t=".$ost."&listcount=".$listcount."';</script>";

?>