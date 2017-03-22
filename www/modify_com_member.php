<?php
include_once('./_common.php');


if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}
if($member[mb_level]<10 )
{
	echo "<script>alert('권한이 없습니다.'); location.href = '/my_index.php';</script>";
	exit;
}
if($id != "")
{
	if($st=="0")
	{
		$sql = "update g5_member set mb_level=2,
									mb_3=now(),
									mb_4='".$mb_id."일반회원으로수정'
									where mb_no='".$mb_no."'";

		sql_query($sql);

		$sql = "update t_com_member_ask set status = 2 where id=$id";
		sql_query($sql);
	}
	else
	{
		// 회원등급 3으로 수정
		$sql = "update g5_member set mb_level=3,
									mb_1=now(),
									mb_2='".$mb_id."업체회원으로등업'
									where mb_no='".$mb_no."'";

		sql_query($sql);
		
		// 업체 주인장 id 등록, 주문전화,주문sms 업데이트
		$sql = "select * from  t_com_member_ask where id=$id";
		$xx = sql_fetch($sql);
		$sql = "update t_comp set own_id = '".$mb_id."', order_tel_st='".$xx[tel_delivery]."', order_sms_st='".$xx[tel_sms]."' where id=$com_id";
		sql_query($sql);
		$sql = "update t_com_member_ask set status = 1 where id=$id";
		sql_query($sql);
	}

}

echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
echo "<script>location.href = '/reg_com_member_list.php';</script>";

?>