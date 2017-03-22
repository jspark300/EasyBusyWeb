<?php
include_once('./_common.php');


if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}
$mb_id = $member['mb_id'];
$mb_nick = $member['mb_nick'];

if(($bo_table!='qa' && $bo_table!='public' && $bo_table!='free') && $member[mb_level]<10)
{
		echo "<script>alert('글을 삭제할 권한이 없습니다.'); location.href = '/board_detail.php?bo_table=$bo_table&wr_id=$wr_id';</script>";
		exit;
}

$sql = "select * from g5_write_".$bo_table." where wr_id='".$wr_id."'";
$rs = sql_fetch($sql);
if($bo_table!='qa' && $bo_table!='public')// qa 인경우 유저확인
{
	if($member[mb_level]<10 && $rs[mb_id] != $member[mb_id])
	{
		echo "<script>alert('글을 삭제할 권한이 없습니다.'); location.href = '/board_detail.php?bo_table=$bo_table&wr_id=$wr_id';</script>";
		exit;
	}
}
if($b!="c" && $rs[wr_comment]>0)
{
	echo "<script>alert('댓글이 등록되어 삭제할 수 없습니다.\\n댓글을 먼저 삭제해 주세요.'); location.href = '/board_detail.php?bo_table=$bo_table&wr_id=$wr_id';</script>";
	exit;
}


$sql = "delete from g5_write_".$bo_table." where wr_id='".$wr_id."'";
sql_query($sql);

// 부모 아이디에 UPDATE
if($b=="c")
{
	sql_query(" update g5_write_".$bo_table." set wr_comment = wr_comment -1 where wr_id = '$rs[wr_parent]' ");
	sql_query(" update g5_write_".$bo_table." set wr_is_comment =0 where  wr_id = '$rs[wr_parent]' and wr_comment=0 ");
}

// 새글 -INSERT
sql_query(" delete from g5_board_new where bo_table='".$bo_table."' and wr_id='$wr_id'");

// 게시글 -1 증가
if($b=="c")
	sql_query("update g5_board set bo_count_comment = bo_count_comment - 1 where bo_table = '".$bo_table."'");
else
	sql_query("update g5_board set bo_count_write = bo_count_write - 1 where bo_table = '".$bo_table."'");
		



echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
if($b == "c")
	echo "<script>alert('삭제하였습니다.'); location.href = '/board_detail.php?bo_table=$bo_table&wr_id=$rs[wr_parent]';</script>";
else
	echo "<script>alert('삭제하였습니다.'); location.href = '/board_list.php?bo_table=$bo_table';</script>";

?>