<?php
include_once('./_common.php');

if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}
$mb_id = $member['mb_id'];

$ts = date("Ymd");
$t = time();

$sql = "select * from t_com_order_sub where id=$sub_id and mb_no=$member[mb_no]";
$rs = sql_fetch($sql);
if($rs)
{
	$sql = "delete from t_com_order_sub where id=$sub_id and mb_no=$member[mb_no]";
	sql_query($sql);

	$sql = "update t_com_order set price = price - $rs[price]*$rs[ocount] where order_id='$order_id' and mb_no=$member[mb_no]";

	sql_query($sql);
}
if($url == "")
	$url = "shop_menu.php";
echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
echo "<script>location.href = '/$url?id=$com_id&order_id=$order_id';</script>";
?>