<?
include_once('./_common.php');


// 당첨 검색
$sql = "select count(id) c   from t_give where id=$id and lot_mb_no=$member[mb_no] and status=1";

$res = sql_fetch($sql);
$give_count = $res[c];
if($give_count == 0)
{
	echo "<script>alert('당첨된 경품이 없습니다.');history.back();</script>";
	exit;
}
$sql = "select datediff(date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 8 DAY),now()) gr  from t_give where id=$id and status=1";
$res = sql_fetch($sql);
$last_count = $res[gr];
if($last_count < 0)
{
	echo "<script>alert('당첨된 경품이 유효기간이 지났습니다.');history.back();</script>";
	exit;
}

// 사용하기 선택 status 1 업데이트 ->
$t = time();
$sql = "update t_give set status = 5, use_date=$t where id=$id and status=1";
sql_query($sql);
$sql = "update t_give_enter set status = 5 where give_id=$id and mb_no=$member[mb_no] and status=1";
sql_query($sql);

echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
echo "<script>alert('당첨된 경품을 기부하였습니다.'); location.href = '/myentry_list.php?st=5';</script>";

?>