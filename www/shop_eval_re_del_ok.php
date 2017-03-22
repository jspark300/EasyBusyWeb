<?php
include_once('./_common.php');

if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}
$mb_no = $member['mb_no'];
$nick = $member['mb_nick'];

$ts = date("Ymd");
$t = time();

if($member[mb_level]<10)
{
	$sql = "select * from t_com_comment where id=$id and mb_no = $mb_no ";
	$rs = sql_fetch($sql);
	if(!$rs)
	{
		echo "<script>alert('댓글을 삭제할 권한이 없습니다.'); history.back();</script>";
		exit;
	}
}

$sql = "delete from t_com_comment where id=$id";
sql_query($sql);
$sql = "select count(id) c from t_com_comment where parent_id=$rs[parent_id]";
$rx = sql_fetch($sql);
if($rx[c] == "1")
{
	$sql = "update t_com_comment set is_comment = 0 where parent_id=$rs[parent_id]";
	sql_query($sql);
}
if($com_id=="")
	echo "<script>alert('댓글을 삭제하였습니다.'); location.href = '/all_eval.php';</script>";
else
	echo "<script>alert('댓글을 삭제하였습니다.'); location.href = '/shop_eval.php?id=$com_id';</script>";
?>