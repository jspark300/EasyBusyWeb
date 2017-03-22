<?
include_once('./_common.php');


// 자동 기부
// 당첨후 7일 이내 확인 안된 케이스 status = 1 인 경우
$sql = "update t_give_enter set status=6 where status=1 and give_id in (select id from t_give where status=1 and date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 8 DAY)<now())";
sql_query($sql);
$sql = "update t_give set status=6 where status=1 and date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 8 DAY)<now()";
sql_query($sql);
// 사용기간 30일 이후 자동 기부 status=2, 3, 4 인경우
$sql = "update t_give_enter set status=7 where   status>1 and status<5 and  give_id in (select id from t_give where status>1 and status<5 and date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 31 DAY)<now())";
sql_query($sql);
$sql = "update t_give set status=7  where status>1 and status<5 and date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 31 DAY)<now()";
sql_query($sql);


// 추첨
$start = $count;
$rows = 10;
$t = date("Ymd");
$ct = time();
$sql = "select *  from t_give  where end_date<$t and status_lot=0";
//echo $sql;
$res = sql_query($sql);
$i= 0;
while($row = sql_fetch_array($res))
{
	$sql = "select count(id) c from t_give_enter where give_id=$row[id]";
	$rx = sql_fetch($sql);
	$give_count = $rx[c];
	$sel_id = rand(0, $give_count-1);
	//echo $sel_id."/";
	$sql= "select id,mb_no from t_give_enter where  give_id=$row[id] order by id limit $sel_id, 1";
	$lot = sql_fetch($sql);
	$sql = "update t_give_enter set status=1,price=$row[price] where id = $lot[id]";
	sql_query($sql);
	$sql = "update t_give set status_lot=1,lot_mb_no=$lot[mb_no],lot_date=$ct,status=1 where id=$row[id]";
	sql_query($sql);

	// 미당첨 처리
	$sql = "update t_give_enter set status=-1 where give_id='".$row[id]."' and status!=1";
	sql_fetch($sql);

	if($give_count==0)	// 응모자 없을 경우 -1 당첨자 없음
	{
		$sql = "update t_give set status=-1 where  id=$row[id]";
		sql_query($sql);
	}
} 
// 예약 경품 -> 진행중 경품 0110 >= 0110 status = -2
$sql = "update t_give set status = 0 where start_date=$t and status=-2";
sql_query($sql);

// 경품 존재하는 업체 경품 유뮤 update
// 초기화
$sql = "update t_comp set is_giveaway = 0 where is_giveaway=1";
sql_query($sql);
$sql = "select com_id from t_give where start_date<=$t and end_date>=$t ";
$rs = sql_query($sql);
while($row = sql_fetch_array($rs))
{
	// update
	$sql = "update t_comp set is_giveaway = 1 where id = $row[com_id]";
	sql_query($sql);
}
	
//$sql = "update t_comp set is_giveaway=1 where id in ( select com_id from t_give where start_date<=$t and end_date>=$t )";
//sql_query($sql);

?>