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

$sql = "insert into t_com_comment (com_id,mb_no,content,reg_date,name,is_comment,parent_id) values ($com_id,$mb_no,'$comment',$t,'$nick',2,$parent_id)";
sql_query($sql);
$sql = "update t_com_comment set is_comment=1 where id=$parent_id";
sql_query($sql);
echo "<script>alert('댓글이 입력되었습니다.'); location.href = '/shop_eval.php?id=$com_id';</script>";
?>