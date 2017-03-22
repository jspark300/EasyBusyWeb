<?php
include_once('./_common.php');
$sel1 = urldecode($sel1);
$sel1       = clean_xss_tags($sel1);
if($sel1 != "")
{
	$sql="select m2,mstr2 from b_menu where m1='$sel1' order by m2";

	$ba_result = sql_query($sql);
	while ($row=sql_fetch_array($ba_result)) {
		$str .= "<option value='".$row['m2']."' >".$row['mstr2'];
	}
}

echo $str;
?>
