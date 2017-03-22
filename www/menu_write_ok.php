<?php
include_once('./_common.php');

if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}
$mb_id = $member['mb_id'];

$ts = date("Ymd");
$t = time();

if($menu_id == "")
	$sql = "insert into t_com_menu (com_id,name,price,reg_date,mb_no) values ($com_id,'$menuname',$price,$t,$member[mb_no])";
else
	$sql = "update t_com_menu set name='$menuname', price=$price where id=$menu_id";
sql_query($sql);

echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
echo "<script>location.href = '/shop_menu.php?id=$com_id';</script>";
?>