<?php
include_once('./_common.php');

if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}

// 당첨 검색
//$sql = "select id   from t_give where coupon='$coupon' and status=3 and lot_mb_no!=$member[mb_no]";
$sql = "select id   from t_give where coupon='$coupon' and status=3";
$res = sql_fetch($sql);
if(!$res)
{
	echo "<script>alert('쿠폰번호가 잘못되었거나 이미등록된 쿠폰번호입니다. 다시 시도해 주세요.');history.back();</script>";
	exit;
}
$give_id = $res[id];
// 사용하기 선택 status 2 업데이트
// 쿠폰 발행
$t = time();
$sql = "update t_give set status = 110, gift_mb_no=$member[mb_no],gift_reg_date=$t where id=$give_id and status=3";
sql_query($sql);
//$sql = "update t_give_enter set status = 200 where give_id=$give_id  and status=3 ";
//sql_query($sql);

echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
echo "<script>alert('선물받은 쿠폰을 등록하였습니다.'); location.href = '/mycoupon_list.php';</script>";

?>