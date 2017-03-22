<?php
include_once('./_common.php');
$sido = urldecode($sido);
$gugun = urldecode($gugun);
$dong = urldecode($dong);

$sido       = clean_xss_tags($sido);
$gugun       = clean_xss_tags($gugun);
$dong       = clean_xss_tags($dong);
if($gugun == "")
{
	$sql="select distinct reg2 from b_region where reg1='$sido' order by reg2";
	$ba_result = sql_query($sql);
	while ($row=sql_fetch_array($ba_result)) {
		$str .= "<option value='".$row['reg2']."' >".$row['reg2'];
	}
}
else if($dong=="")
{
	$sql="select seq, reg3,lat,lng from b_region where reg1='$sido' and reg2='$gugun' order by reg3";
	$ba_result = sql_query($sql);
	while ($row=sql_fetch_array($ba_result)) {
		$str .= "<option value='".$row['reg3']."' >".$row['reg3'];
	}
}
else
{
}
echo $str;
?>
