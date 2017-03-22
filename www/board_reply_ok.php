<?php
include_once('./_common.php');


if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}
$mb_id = $member['mb_id'];
$mb_nick = $member['mb_nick'];

if($bo_table != 'qa' && $bo_table != 'public')
{
		echo "<script>alert('권한이 없습니다.'); location.href = '/board_list.php?bo_table=$bo_table&wr_id=$parent_id';</script>";
		exit;
}

if($wr_id == "")
{
	$sql = "select * from g5_write_".$bo_table." where wr_id=$parent_id";
	$rs = sql_fetch($sql);
	$wr_comment = $rs[wr_comment]+1;
	$sql = "update g5_write_".$bo_table." set wr_comment=wr_comment+1  where wr_id=$parent_id";
	sql_query($sql);
	$sql = "insert into g5_write_".$bo_table." set 
								wr_content='".$content."',
								mb_id='".$mb_id."',
								wr_name='".$mb_nick."',
								wr_parent = '".$parent_id."',
								wr_is_comment=1,wr_comment=$wr_comment,
								wr_datetime=now()";
	sql_query($sql);
	$wr_id = sql_insert_id();
	// 부모 아이디에 UPDATE
	sql_query(" update g5_write_".$bo_table." set wr_parent = '$rs[wr_id]'  where wr_id = '$wr_id' ");
    // 새글 INSERT
    sql_query(" insert into g5_board_new ( bo_table, wr_id, wr_parent, bn_datetime, mb_id, as_comment, as_update ) values ( '".$bo_table."', '{$wr_id}', '{$parent_id}', '".G5_TIME_YMDHIS."', '{$member['mb_id']}', '1', '".G5_TIME_YMDHIS."' ) ");

    // 게시글 1 증가
    sql_query("update g5_board set bo_count_comment = bo_count_comment + 1 where bo_table = '".$bo_table."'");

}
else
{
	$sql = "select * from g5_write_free where wr_id='".$wr_id."'";
	$rs = sql_fetch($sql);
	if($member[mb_level]<10 && $rs[mb_id] != $member[mb_id])
	{
		echo "<script>alert('글을 수정할 권한이 없습니다.'); location.href = '/board_detail.php?bo_table=$bo_table&wr_id=$parent_id';</script>";
		exit;
	}


	$sql = "update g5_write_".$bo_table." set
								wr_content='".$content."',
								wr_2=now(),
								wr_1='".$mb_id."'
								where wr_id='".$wr_id."'";

	sql_query($sql);

}
echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
echo "<script>alert('등록하였습니다.'); location.href = '/board_detail.php?bo_table=$bo_table&wr_id=$parent_id';</script>";

?>