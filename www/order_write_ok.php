<?php
include_once('./_common.php');

if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}
$mb_id = $member['mb_id'];

$ts = date("Ymd");
$t = time();

$sql = "select * from t_com_menu where id=$menu_id";
$mrs = sql_fetch($sql);


$sql = "select * from t_com_order where order_id='$order_id'";
$rs = sql_fetch($sql);


if($rs)
	$sql = "update t_com_order set price = price + $mrs[price]*$menu_count where order_id='$order_id'";
else
	$sql = "insert into t_com_order (com_id,order_id,mb_no,price,otype,reg_date) values ($com_id,'$order_id',$member[mb_no],$mrs[price]*$menu_count,'장바구니',$t)";
sql_query($sql);


$sql = "insert into t_com_order_sub (order_id,menu_name,price,ocount,reg_date,mb_no) values ('$order_id','$mrs[name]',$mrs[price],$menu_count,$t,$member[mb_no])";
sql_query($sql);

echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
echo "<script>location.href = '/shop_menu.php?id=$com_id&order_id=$order_id';</script>";
?>