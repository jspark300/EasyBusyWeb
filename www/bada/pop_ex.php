<?php
include_once('./_common.php');
$pop = urldecode($pop);
$pop       = clean_xss_tags($pop);
if($pop != "")
{
	$sql="select reg2 from b_region_pop where reg1='$pop' order by seq";
	
	$ba_result = sql_query($sql);
	while ($row=sql_fetch_array($ba_result)) {
		$str .= "<option value='".$row['reg2']."' >".$row['reg2'];
	}
}

echo $str;
?>
