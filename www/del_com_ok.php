<?php
include_once('./_common.php');

if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}

if($member[mb_level]<10)
{
	echo "<script>alert('글을 삭제할 권한이 없습니다.');history.back();</script>";
	exit;
}

$sql = "delete from t_comp where id='".$id."'";
sql_query($sql);

echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
echo "<script>alert('삭제하였습니다.'); location.href = '/shop_list.php';</script>";

?>