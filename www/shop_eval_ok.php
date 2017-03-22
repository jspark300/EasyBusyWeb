<?php
include_once('./_common.php');

if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}
$mb_no = $member['mb_no'];
$nick = $member['mb_nick'];

$sql = "select name  from t_comp where  id=$com_id";
$res = sql_fetch($sql);
$company = $res[name];
$start = strtotime(date("Y-m-d"));
// 일일한도 10번 제한
$sql = "select count(id) c from t_com_eva where mb_no=$mb_no and  reg_date>=$start";
$res = sql_fetch($sql);
echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
$today_eva_gift = 0;
if($res[c]>=10)
{
	$today_eva_gift = 1;
//	echo "<script>alert('1일 평가한도(10회)를 초과하였습니다.'); location.href = '/shop_eval.php?id=$com_id';</script>";
//	exit;
}
// 동일업체 중복 평가 제한
$sql = "select count(id) c from t_com_eva where mb_no=$mb_no and reg_date>=$start and com_id=$com_id";
$res = sql_fetch($sql);
$multi_ev = 0;
if($res[c]>0)
{
	$multi_ev = 1;
	
//	echo "<script>alert('동일업체 1일 평가한도(1회)를 초과하였습니다.'); location.href = '/shop_eval.php?id=$com_id';</script>";
//	exit;
}


$ts = date("Ymd");
$t = time();

$sql = "insert into t_com_eva (com_id,mb_no,eva1,eva2,eva3,eva4,reg_date) values ($com_id,$mb_no,$eva1,$eva2,$eva3,$eva4,$t)";
sql_query($sql);
$sql = "update t_comp set eva_point=(select round(avg(eva1+eva2+eva3+eva4)/4,1) from t_com_eva where com_id=$com_id), eva_count=eva_count+1 where id=$com_id";
sql_query($sql);
// 포인트 로그 입력
$sql = "insert into t_give_point_use (point_name,point_use, point,status,reg_date,mb_no) values ('후기','$company',1,1,$t,$mb_no)";
sql_query($sql);
// 회원정보에 포인트 +1

$sql = "insert into t_com_comment (com_id,mb_no,content,reg_date,name) values ($com_id,$mb_no,'$comment',$t,'$nick')";
sql_query($sql);
$lastid = sql_insert_id();
$sql = "update t_com_comment set parent_id=$lastid where id=$lastid";
sql_query($sql);


if($today_eva_gift == 0 && $multi_ev == 0)
{
	// 포인트 로그 입력
	$sql = "insert into t_give_point_use (point_name,point_use, point,status,reg_date,mb_no) values ('주인장에게한마디','$company',1,1,$t,$mb_no)";
	sql_query($sql);
	if($today_eva_gift == 0)
	{	
		// 회원정보에 포인트 +1
		$sql = "update g5_member set give_point=give_point+1 where mb_no=$mb_no";
		sql_query($sql);
	}
}
if($today_eva_gift==0 && $multi_ev==0)
{
//	if(strlen($comment) >= 5)
//		echo "<script>alert('평가해주셔서 감사합니다.\\n경품응모권2개가 지급되었습니다'); location.href = '/shop_eval.php?id=$com_id';</script>";
//	else
		echo "<script>alert('후기글을 작성해주셔서 감사합니다.\\n경품응모권1개가 지급되었습니다'); location.href = '/shop_eval.php?id=$com_id';</script>";
}
else if($today_eva_gift !=0)
{
	echo "<script>alert('후기글을 작성해주셔서 감사합니다.\\n경품응모권은 1일 10회가 초과되어 더 이상 지급되지 않습니다.'); location.href = '/shop_eval.php?id=$com_id';</script>";
}
else{
	echo "<script>alert('후기글을 작성해주셔서 감사합니다.\\n경품응모권은 지급횟수가 초과되어 더 이상 지급되지 않습니다.'); location.href = '/shop_eval.php?id=$com_id';</script>";
}
?>














