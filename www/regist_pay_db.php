<?php
include_once('./_common.php');


if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}
$mb_id = $member['mb_id'];
$mb_nick = $member['mb_nick'];

if($id == "")
{
//	$t = date("Ymdh");
	$t = time();
	$sql = "insert into t_com_member_ask set mb_no='".$member[mb_no]."',
								mb_id='".$mb_id."',
								com_id='".$com_id."',
								ceo='".$ceo."',
								tel = '".$tel."',
								tel_delivery = '".$tel_delivery."',
								tel_sms = '".$tel_sms."',
								pay_sel = '".$pay_sel."',
								pay_bank = '".$pay_bank."',
								reg_date=$t";
	sql_query($sql);
	$wr_id = sql_insert_id();
}
else
{
	$sql = "update t_com_member_ask set mb_no='".$member[mb_no]."',
								mb_id='".$mb_id."',
								com_id='".$com_id."',
								ceo='".$ceo."',
								tel = '".$tel."',
								tel_delivery = '".$tel_delivery."',
								tel_sms = '".$tel_sms."',
								pay_sel = '".$pay_sel."',
								pay_bank = '".$pay_bank."',
								where id=$id";

	sql_query($sql);

}

echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
echo "<script>alert('업체회원신청이 완료되었습니다.'); location.href = '/my_index.php';</script>";
?>