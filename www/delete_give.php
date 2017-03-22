<?php
include_once('./_common.php');

if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}
$mb_id = $member['mb_id'];
$sql = "select count(id) c from t_give   where id=$give_id and reg_id='$mb_id'";
$rs = sql_fetch($sql);

if($give_id != "")
{
	$sql = "select count(id) c from t_give_enter where give_id='".$give_id."'";
	$re = sql_fetch($sql);
	if($re[c]>0)
	{
		echo "<script>alert('응모자가 있습니다. 삭제가 불가능합니다.');location.href = '/mygive_list.php';</script>";
		exit;
	}

}


echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
if($rs[c] > 0)
{
	$sql = "delete from t_give  where id=$give_id and reg_id='$mb_id'";
	sql_query($sql);
	echo "<script>alert('삭제하였습니다.'); location.href = '/mygive_list.php';</script>";
}
else
	echo "<script>alert('삭제권한이 없습니다.'); location.href = '/mygive_list.php';</script>";

?>