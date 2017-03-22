<?php
include('./dbconn.php');

//$sido = $_GET[sido];
//$gugun = $_GET[gugun];
//$dong = $_GET[dong];
//$sido = urldecode($sido);
//$sido = mb_convert_encoding($sido,'euc-kr','utf-8');
//$gugun = urldecode($gugun);
//$gugun = mb_convert_encoding($gugun,'euc-kr','utf-8');
//$dong = urldecode($dong);
//$dong = mb_convert_encoding($dong,'euc-kr','utf-8');

$sido = urldecode($sido);

$sido          = isset($_GET['sido'])            ? trim($_GET['sido'])          : "";
$kind          = isset($_GET['kind'])            ? trim($_GET['kind'])          : "";
$sido       = clean_xss_tags($sido);
$kind       = clean_xss_tags($kind);


$sql="select seq,schoolname from b_school where sido='$sido' and kind='$kind' order by schoolname";
$ba_result = @mysql_query($sql);
while ($row=@mysql_fetch_assoc($ba_result)) {
	$str .= "<option value='".$row['seq']."' >".$row['schoolname'];
}
//echo iconv('euc-kr','utf-8',$str);
echo $str;
?>