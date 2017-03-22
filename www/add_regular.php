<?
include_once('./_common.php');


if (!$is_member) {
	echo "x";
	exit;
}


$sql = "select count(id) c  from t_com_regular  where com_id=$id and mb_no=$member[mb_no]";
$res = sql_fetch($sql);
if($res[c]>0)
{
	$sql = "delete from t_com_regular  where com_id=$id and mb_no=$member[mb_no]";
	sql_query($sql);
	$sql = "update t_comp set regular_count = regular_count-1 where id=$id";
	sql_query($sql);
	?>
	<a href="javascript:add_regularx('<?=$id?>');" class="regular">단골</a>
	<?
}
else
{
	$t = time();
	$sql = "insert into t_com_regular (com_id,mb_no,reg_date) values ($id,$member[mb_no],$t)";
	sql_query($sql);
	$sql = "update t_comp set regular_count = regular_count+1 where id=$id";
	sql_query($sql);
	?>
	<a href="javascript:add_regularx('<?=$id?>');" class="regular on">단골</a>
	<?
}
?>
