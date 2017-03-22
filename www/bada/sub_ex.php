<?php
include_once('./_common.php');
$sido = urldecode($reg1);
$gugun = urldecode($reg2);
$dong = urldecode($reg3);
// $sido = mb_convert_encoding($sido,'utf-8','euc-kr');
// $sido = mb_convert_encoding($sido,'euc-kr','utf-8');
// echo $sido;
// $gugun = mb_convert_encoding($gugun,'euc-kr','utf-8');
// $dong = mb_convert_encoding($dong,'euc-kr','utf-8');

//$sido          = isset($_POST['sido'])            ? trim($_POST['sido'])          : "";
//$gugun          = isset($_GET['gugun'])            ? trim($_GET['gugun'])          : "";
//$dong          = isset($_GET['dong'])            ? trim($_GET['dong'])          : "";
$sido       = clean_xss_tags($sido);
$gugun       = clean_xss_tags($gugun);
$dong       = clean_xss_tags($dong);
if($gugun == "")
{
	$sql="select distinct reg2 from b_region_sub where reg1='$sido'";
//	echo $sql;
	$ba_result = sql_query($sql);
//	echo $sql;
	while ($row=sql_fetch_array($ba_result)) {
		$str .= "<option value='".$row['reg2']."' >".$row['reg2'];
	}
}
else if($dong=="")
{
	$sql="select seq, reg3,lat,lng from b_region_sub where reg1='$sido' and reg2='$gugun'";
	$ba_result = sql_query($sql);
	while ($row=sql_fetch_array($ba_result)) {
		$str .= "<option value='".$row['reg3']."|".$row['lat']."|".$row['lng']."' >".$row['reg3'];
	//	$str .= "<option value='".$row['reg3']."' >".$row['reg3'];
	}
}
else
{
}
//echo iconv('euc-kr','utf-8',$str);
//echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
//echo $sido;

echo $str;
?>
