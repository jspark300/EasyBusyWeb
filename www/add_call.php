<?
include_once('./_common.php');

$sql = "select count(id) c  from t_call  where com_id=$id";
$res = sql_fetch($sql);
if($res[c]>0)
{
	$sql = "update t_call set call_count = call_count+1 where com_id=$id";
	sql_query($sql);
}
else
{
	$sql = "insert into t_call (com_id,call_count) values ($id,1)";
	sql_query($sql);
}
?>
