<?
include_once('./_common.php');
$sql = "select m2,mstr2 from b_menu where m1 = ".$c1." order by m2";
$res = sql_query($sql);
if($c1==0 || $c1=="") 
	echo "경품";
else
	echo "전체";

while ($row=sql_fetch_array($res)) {
echo "|";
echo $row['mstr2'];

} ?>
